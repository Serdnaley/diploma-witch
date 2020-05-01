<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $today = Carbon::today();
        $tempDate = Carbon::createFromDate($today->year, $today->month, 1);
        $calendar = [];

        $skip = $tempDate->dayOfWeek;
        $tempDate->subtract($skip, 'day');

        $row = 0;
        do {
            for($col = 0; $col < 7; $col++) {

                $from = $tempDate->clone()->hour(6);
                $to = $tempDate->clone()->hour(23);

                $booking = Booking::where('user_id', \Auth::user()->id)
                    ->where('date', '>', $from)
                    ->where('date', '<', $to)
                    ->get();

                $calendar[$row][$col] = [
                    'is_active' => $tempDate > $today && \Auth::user()->available_visits,
                    'booked' => ! $booking->isEmpty(),
                    'date' => $tempDate->clone(),
                ];
                $tempDate->addDay();
            }
            $row++;
        } while ($tempDate->month === $today->month);

        return view('calendar', [
            'today' => $today,
            'calendar' => $calendar,
        ]);
    }

    public function day(Request $request)
    {
        $day = new Carbon($request->day);
        $timestamps = [];

        $start = $day->clone()->hour(7);
        $end = $day->clone()->hour(22);

        while ($start <= $end) {

            $booking = Booking::where('user_id', \Auth::user()->id)
                ->where('date', $start)
                ->get();

            $timestamps[] = [
                'date' => $start->clone(),
                'books_count' => $booking->count(),
            ];
            $start->addHour();
        }

        return view('day', [
            'day' => $day,
            'timestamps' => $timestamps,
        ]);
    }

}
