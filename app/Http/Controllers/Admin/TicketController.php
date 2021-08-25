<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\FPDF\Ticket;
use App\Models\ReservationSeat;

class TicketController extends Controller
{
    public function download($ticket_no, Request $request)
    {
        $ticket = ReservationSeat::query()
            ->where('ticket_number', $ticket_no)
            ->with('reservation.pickup_point', 'reservation.drop_point', 'seat')
            ->firstOrFail();

        // echo json_encode($ticket);
        // exit();

        $fare = floatval($ticket->amount_paid);

        $tt = new Ticket();

        $tt->print(
            $ticket->passenger->name,
            $ticket->reservation->pickup_point->pickup_point,
            $ticket->reservation->drop_point->drop_off_point,
            $ticket->ticket_number,
            $ticket->reservation->travel_date,
            $ticket->reservation->pickup_point->pickup_time,
            $fare,
            $ticket->seat->name,
        );

        $tt->save();

        return back();
    }
}
