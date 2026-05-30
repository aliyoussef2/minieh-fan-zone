<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\FootballMatch;
use App\Models\Reservation;
use App\Models\Customer;
use App\Models\TicketCategory;
use App\Models\Payment;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total'    => Reservation::count(),
            'pending'  => Reservation::pending()->count(),
            'verified' => Reservation::verified()->count(),
            'seats'    => Reservation::verified()->sum('quantity'),
        ];

        $recentReservations = Reservation::with(['customer', 'footballMatch', 'ticketCategory'])
            ->latest()->limit(10)->get();

        $reservations = Reservation::with(['customer', 'footballMatch', 'ticketCategory'])
            ->latest()->get();

        $matches = FootballMatch::withCount('reservations')
            ->orderBy('match_date')->orderBy('match_time')->get();

        $customers = Customer::withCount('reservations')
            ->latest()->get();

        $categories = TicketCategory::orderBy('section')->get();

        return view('admin.dashboard', compact(
            'stats', 'recentReservations', 'reservations',
            'matches', 'customers', 'categories'
        ));
    }

    public function showReservation(int $id): JsonResponse
    {
        $r = Reservation::with(['customer', 'footballMatch', 'ticketCategory'])->findOrFail($id);

        return response()->json([
            'booking_code'      => $r->booking_code,
            'customer_name'     => $r->customer->full_name,
            'email'             => $r->customer->email,
            'phone'             => $r->customer->phone,
            'match'             => $r->footballMatch->label,
            'match_date'        => $r->footballMatch->formatted_date,
            'section'           => $r->ticketCategory->section,
            'section_name'      => $r->ticketCategory->name,
            'quantity'          => $r->quantity,
            'payment_reference' => $r->payment_reference,
            'payment_status'    => $r->payment_status,
            'entry_status'      => $r->entry_status,
            'created_at'        => $r->created_at->format('M j, Y H:i'),
        ]);
    }

    public function updateReservationStatus(Request $request, int $id): JsonResponse
    {
        $request->validate(['status' => 'required|in:pending,verified,rejected']);

        $reservation = Reservation::findOrFail($id);
        $reservation->update(['payment_status' => $request->status]);

        if ($reservation->payment) {
            $reservation->payment->update([
                'status'      => $request->status,
                'verified_at' => $request->status === 'verified' ? now() : null,
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function showMatch(int $id): JsonResponse
    {
        $m = FootballMatch::findOrFail($id);
        return response()->json($m);
    }

    public function storeMatch(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'team_a'      => 'required|string|max:100',
            'team_b'      => 'required|string|max:100',
            'flag_code_a' => 'nullable|string|max:10',
            'flag_code_b' => 'nullable|string|max:10',
            'match_date'  => 'required|date',
            'match_time'  => 'required',
            'stage'       => 'required|string',
            'group'       => 'nullable|string|max:5',
            'status'      => 'required|in:upcoming,live,finished',
        ]);

        $match = FootballMatch::create($validated);
        return response()->json(['success' => true, 'id' => $match->id]);
    }

    public function updateMatch(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'team_a'      => 'required|string|max:100',
            'team_b'      => 'required|string|max:100',
            'flag_code_a' => 'nullable|string|max:10',
            'flag_code_b' => 'nullable|string|max:10',
            'match_date'  => 'required|date',
            'match_time'  => 'required',
            'stage'       => 'required|string',
            'group'       => 'nullable|string|max:5',
            'status'      => 'required|in:upcoming,live,finished',
        ]);

        FootballMatch::findOrFail($id)->update($validated);
        return response()->json(['success' => true]);
    }

    public function updatePrices(Request $request): JsonResponse
    {
        $request->validate(['prices' => 'required|array']);

        foreach ($request->prices as $item) {
            TicketCategory::find($item['id'])?->update(['price' => $item['price']]);
        }

        return response()->json(['success' => true]);
    }

    public function toggleAvailability(Request $request, int $id): JsonResponse
    {
        $request->validate(['is_available' => 'required|boolean']);
        TicketCategory::findOrFail($id)->update(['is_available' => $request->is_available]);
        return response()->json(['success' => true]);
    }

    public function scan(string $code): JsonResponse
    {
        $reservation = Reservation::with(['customer', 'footballMatch', 'ticketCategory'])
            ->where('booking_code', strtoupper($code))
            ->first();

        if (!$reservation) {
            return response()->json(['error' => 'Not found'], 404);
        }

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
        ]);
    }

    public function markEntered(string $code): JsonResponse
    {
        $reservation = Reservation::where('booking_code', strtoupper($code))->first();

        if (!$reservation) {
            return response()->json(['success' => false, 'message' => 'Not found.'], 404);
        }

        if ($reservation->payment_status !== 'verified') {
            return response()->json(['success' => false, 'message' => 'Payment not verified.'], 403);
        }

        if ($reservation->entry_status === 'entered') {
            return response()->json(['success' => false, 'message' => 'Already entered.'], 409);
        }

        $reservation->update(['entry_status' => 'entered']);
        return response()->json(['success' => true]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_logged_in');
        return redirect('/admin/login');
    }
    public function adsIndex()
{
    $ads = \App\Models\Ad::orderBy('order')->get();
    return view('admin.ads', compact('ads'));
}

public function storeAd(Request $request)
{
    $request->validate(['image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120']);
    
    $file = $request->file('image');
    $filename = time() . '_' . $file->getClientOriginalName();
    $path = $file->storeAs('ads', $filename, 'public');
    
    $maxOrder = \App\Models\Ad::max('order') ?? 0;
    
    \App\Models\Ad::create([
        'file_path' => $path,
        'original_name' => $file->getClientOriginalName(),
        'is_active' => true,
        'order' => $maxOrder + 1,
    ]);

    return redirect()->route('admin.ads')->with('success', 'Ad uploaded successfully.');
}

public function toggleAd($id)
{
    $ad = \App\Models\Ad::findOrFail($id);
    $ad->update(['is_active' => !$ad->is_active]);
    return response()->json(['success' => true, 'is_active' => $ad->is_active]);
}

public function deleteAd($id)
{
    $ad = \App\Models\Ad::findOrFail($id);
    \Illuminate\Support\Facades\Storage::disk('public')->delete($ad->file_path);
    $ad->delete();
    return response()->json(['success' => true]);
}
public function toggleSoldOut($id)
{
    $category = \App\Models\TicketCategory::findOrFail($id);
    $category->update(['sold_out' => !$category->sold_out]);
    return response()->json([
        'success'   => true,
        'sold_out'  => $category->sold_out,
    ]);
}
}