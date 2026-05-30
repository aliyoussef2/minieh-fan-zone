<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Your Minieh Fan Zone Ticket</title>
</head>
<body style="margin:0;padding:0;background:#0B1220;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#0B1220;padding:40px 20px;">
  <tr>
    <td align="center">
      <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;">

        {{-- HEADER --}}
        <tr>
          <td style="background:linear-gradient(135deg,#0d1728,#162035);border-radius:16px 16px 0 0;padding:40px 40px 30px;text-align:center;border:1px solid rgba(255,215,0,0.2);border-bottom:none;">
            <p style="margin:0 0 8px;font-size:11px;letter-spacing:4px;color:#FFD700;text-transform:uppercase;">FIFA World Cup 2026</p>
            <h1 style="margin:0;font-size:36px;font-weight:900;color:#FFD700;letter-spacing:2px;text-transform:uppercase;">Minieh Fan Zone</h1>
            <p style="margin:8px 0 0;font-size:13px;color:rgba(255,255,255,0.5);">Minieh Corniche · North Lebanon</p>
          </td>
        </tr>

        {{-- TICKET BODY --}}
        <tr>
          <td style="background:#111827;border:1px solid rgba(255,215,0,0.2);border-top:none;border-bottom:none;padding:0 40px;">

            {{-- STATUS BANNER --}}
            <table width="100%" cellpadding="0" cellspacing="0" style="margin:30px 0 0;">
              <tr>
                <td style="background:rgba(250,204,21,0.1);border:1px solid rgba(250,204,21,0.3);border-radius:10px;padding:14px 20px;text-align:center;">
                  <p style="margin:0;font-size:12px;color:#facc15;letter-spacing:2px;text-transform:uppercase;">⏳ Pending Payment Verification</p>
                  <p style="margin:6px 0 0;font-size:12px;color:rgba(255,255,255,0.45);">Your QR ticket will be activated once we verify your Wish Money payment</p>
                </td>
              </tr>
            </table>

            {{-- BOOKING CODE --}}
            <table width="100%" cellpadding="0" cellspacing="0" style="margin:24px 0;">
              <tr>
                <td style="text-align:center;">
                  <p style="margin:0 0 8px;font-size:11px;color:rgba(255,255,255,0.4);letter-spacing:3px;text-transform:uppercase;">Booking Code</p>
                  <p style="margin:0;font-size:32px;font-weight:900;color:#FFD700;letter-spacing:6px;background:rgba(255,215,0,0.08);border:1px solid rgba(255,215,0,0.25);border-radius:10px;padding:14px 20px;display:inline-block;">{{ $reservation->booking_code }}</p>
                </td>
              </tr>
            </table>

            {{-- DIVIDER --}}
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td style="border-top:1px dashed rgba(255,255,255,0.1);padding:0;"></td>
              </tr>
            </table>

            {{-- MATCH INFO --}}
            <table width="100%" cellpadding="0" cellspacing="0" style="margin:24px 0;">
              <tr>
                <td style="text-align:center;padding-bottom:16px;">
                  <p style="margin:0 0 4px;font-size:11px;color:rgba(255,255,255,0.4);letter-spacing:3px;text-transform:uppercase;">Match</p>
                  <p style="margin:0;font-size:20px;font-weight:700;color:#ffffff;">{{ $reservation->footballMatch->label }}</p>
                  <p style="margin:6px 0 0;font-size:13px;color:rgba(255,255,255,0.5);">{{ $reservation->footballMatch->match_date->format('l, F j, Y') }} · {{ $reservation->footballMatch->match_time }}</p>
                  <p style="margin:4px 0 0;font-size:12px;color:rgba(255,215,0,0.6);">{{ $reservation->footballMatch->stage }}</p>
                </td>
              </tr>
            </table>

            {{-- DIVIDER --}}
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td style="border-top:1px dashed rgba(255,255,255,0.1);padding:0;"></td>
              </tr>
            </table>

            {{-- DETAILS GRID --}}
            <table width="100%" cellpadding="0" cellspacing="0" style="margin:24px 0;">
              <tr>
                <td width="50%" style="padding:12px 12px 12px 0;vertical-align:top;">
                  <p style="margin:0 0 4px;font-size:10px;color:rgba(255,255,255,0.4);letter-spacing:2px;text-transform:uppercase;">Section</p>
                  <p style="margin:0;font-size:18px;font-weight:700;color:#fff;">Section {{ $reservation->ticketCategory->section }}</p>
                  <p style="margin:2px 0 0;font-size:12px;color:rgba(255,255,255,0.5);">{{ $reservation->ticketCategory->name }}</p>
                  <p style="margin:2px 0 0;font-size:11px;color:rgba(255,255,255,0.35);">{{ $reservation->ticketCategory->seating_style }}</p>
                </td>
                <td width="50%" style="padding:12px 0 12px 12px;vertical-align:top;border-left:1px solid rgba(255,255,255,0.07);">
                  <p style="margin:0 0 4px;font-size:10px;color:rgba(255,255,255,0.4);letter-spacing:2px;text-transform:uppercase;">Quantity</p>
                  <p style="margin:0;font-size:18px;font-weight:700;color:#fff;">{{ $reservation->quantity }} {{ $reservation->quantity == 1 ? 'Person' : 'People' }}</p>
                  <p style="margin:2px 0 0;font-size:12px;color:rgba(255,255,255,0.5);">{{ $reservation->ticketCategory->location_label }}</p>
                </td>
              </tr>
              <tr>
                <td width="50%" style="padding:12px 12px 12px 0;vertical-align:top;border-top:1px solid rgba(255,255,255,0.07);">
                  <p style="margin:0 0 4px;font-size:10px;color:rgba(255,255,255,0.4);letter-spacing:2px;text-transform:uppercase;">Customer</p>
                  <p style="margin:0;font-size:15px;font-weight:600;color:#fff;">{{ $reservation->customer->full_name }}</p>
                  <p style="margin:2px 0 0;font-size:12px;color:rgba(255,255,255,0.5);">{{ $reservation->customer->phone }}</p>
                </td>
                <td width="50%" style="padding:12px 0 12px 12px;vertical-align:top;border-top:1px solid rgba(255,255,255,0.07);border-left:1px solid rgba(255,255,255,0.07);">
                  <p style="margin:0 0 4px;font-size:10px;color:rgba(255,255,255,0.4);letter-spacing:2px;text-transform:uppercase;">Payment Ref</p>
                  <p style="margin:0;font-size:13px;font-weight:600;color:#fff;">{{ $reservation->payment_reference }}</p>
                  <p style="margin:2px 0 0;font-size:11px;color:rgba(255,255,255,0.35);">Wish Money</p>
                </td>
              </tr>
            </table>

            {{-- QR CODE --}}
            @if($reservation->qr_code)
            <table width="100%" cellpadding="0" cellspacing="0" style="margin:0 0 24px;">
              <tr>
                <td style="text-align:center;">
                  <table cellpadding="0" cellspacing="0" style="margin:0 auto;background:#fff;border-radius:12px;padding:16px;display:inline-table;">
                    <tr>
                      <td style="text-align:center;">
                        <img src="{{ asset('storage/' . $reservation->qr_code) }}" width="160" height="160" alt="QR Code" style="display:block;">
                        <p style="margin:8px 0 0;font-size:10px;color:#666;letter-spacing:1px;">SCAN AT ENTRANCE</p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            @endif

          </td>
        </tr>

        {{-- FOOTER --}}
        <tr>
          <td style="background:#0d1728;border:1px solid rgba(255,215,0,0.2);border-top:1px dashed rgba(255,215,0,0.15);border-radius:0 0 16px 16px;padding:24px 40px;text-align:center;">
            <p style="margin:0 0 6px;font-size:12px;color:rgba(255,255,255,0.4);line-height:1.6;">Questions? Contact us on WhatsApp</p>
            <p style="margin:0 0 16px;font-size:13px;color:#FFD700;">+961 XX XXX XXX</p>
            <p style="margin:0;font-size:11px;color:rgba(255,255,255,0.25);line-height:1.6;">This ticket is pending payment verification. Do not attempt entry until you receive a confirmation that your payment has been verified.<br>miniehfanzone.com</p>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>

</body>
</html>