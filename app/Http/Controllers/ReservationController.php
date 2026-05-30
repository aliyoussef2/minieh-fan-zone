<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Customer;
use App\Models\FootballMatch;
use App\Models\Reservation;
use App\Models\TicketCategory;
use App\Models\Payment;
use App\Mail\TicketConfirmation;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\SvgWriter;

class ReservationController extends Controller
{
    public function index()
    {
        $matches = FootballMatch::upcoming()->get();
        return view('frontend.reserve', compact('matches'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'match_id'    => 'required|exists:matches,id',
            'section'     => 'required|string|max:2',
            'quantity'    => 'required|integer|min:1|max:20',
            'first_name'  => 'required|string|max:100',
            'last_name'   => 'required|string|max:100',
            'phone'       => 'required|string|max:30',
            'email'       => 'required|email|max:150',
            'payment_ref' => 'required|string|max:100',
        ]);

        $category = TicketCategory::where('section', $validated['section'])->first();
        if (!$category) {
            return response()->json(['success' => false, 'message' => 'Invalid section.'], 422);
        }

        $customer = Customer::firstOrCreate(
            ['email' => $validated['email']],
            [
                'first_name' => $validated['first_name'],
                'last_name'  => $validated['last_name'],
                'phone'      => $validated['phone'],
            ]
        );

        $bookingCode = Reservation::generateBookingCode();
        $totalPrice  = $category->price ? $category->price * $validated['quantity'] : null;

        $qrPath = $this->generateQrCode($bookingCode);

        $reservation = Reservation::create([
            'customer_id'        => $customer->id,
            'match_id'           => $validated['match_id'],
            'ticket_category_id' => $category->id,
            'quantity'           => $validated['quantity'],
            'total_price'        => $totalPrice,
            'booking_code'       => $bookingCode,
            'qr_code'            => $qrPath,
            'payment_reference'  => $validated['payment_ref'],
            'payment_status'     => 'pending',
            'entry_status'       => 'not_entered',
        ]);

        Payment::create([
            'reservation_id'        => $reservation->id,
            'payment_method'        => 'wish_money',
            'amount'                => $totalPrice,
            'transaction_reference' => $validated['payment_ref'],
            'status'                => 'pending',
        ]);

        // Send confirmation email
        try {
            $reservation->load(['customer', 'footballMatch', 'ticketCategory']);
            Mail::to($customer->email)->send(new TicketConfirmation($reservation));
        } catch (\Exception $e) {
            Log::error('Email failed: ' . $e->getMessage());
        }

        return response()->json([
            'success'      => true,
            'booking_code' => $bookingCode,
            'qr_code_url'  => $qrPath ? asset('storage/' . $qrPath) : null,
        ]);
    }

    private function generateQrCode(string $bookingCode): ?string
    {
        try {
            $qrCode = QrCode::create($bookingCode)
                ->setSize(300)
                ->setMargin(10);

            $writer = new SvgWriter();
            $result = $writer->write($qrCode);

            $path = 'qrcodes/' . $bookingCode . '.svg';
            Storage::disk('public')->put($path, $result->getString());

            return $path;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function lookup(string $bookingCode): JsonResponse
    {
        $reservation = Reservation::with(['customer', 'footballMatch', 'ticketCategory'])
            ->where('booking_code', $bookingCode)
            ->firstOrFail();

        return response()->json([
            'booking_code'   => $reservation->booking_code,
            'customer'       => $reservation->customer->full_name,
            'match'          => $reservation->footballMatch->label,
            'match_date'     => $reservation->footballMatch->formatted_date,
            'section'        => $reservation->ticketCategory->section,
            'section_name'   => $reservation->ticketCategory->name,
            'quantity'       => $reservation->quantity,
            'payment_status' => $reservation->payment_status,
            'entry_status'   => $reservation->entry_status,
            'qr_code_url'    => $reservation->qr_code ? asset('storage/' . $reservation->qr_code) : null,
        ]);
    }

    public function markEntered(string $bookingCode): JsonResponse
    {
        $reservation = Reservation::where('booking_code', $bookingCode)->firstOrFail();

        if ($reservation->payment_status !== 'verified') {
            return response()->json(['success' => false, 'message' => 'Payment not verified.'], 403);
        }

        $reservation->update(['entry_status' => 'entered']);
        return response()->json(['success' => true, 'message' => 'Entry recorded.']);
    }
}