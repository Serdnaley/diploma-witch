<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $date = $request->date;

        if (!$date)
            return abort(404);

        $data = [
            'user_id' => \Auth::user()->id,
            'date' => $date,
        ];

        $booking = Booking::where($data)->get();

        if (!$booking->isEmpty()) {
            return redirect()
                ->route('calendar')
                ->withSuccess(['Already booked!']);
        }

        Booking::create($data);

        return redirect()
            ->route('calendar')
            ->withSuccess(['Booked!']);
    }

}
