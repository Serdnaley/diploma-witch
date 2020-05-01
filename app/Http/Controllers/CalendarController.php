<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CalendarController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke(Request $request)
    {
        $today = Carbon::today();
        $tempDate = Carbon::createFromDate($today->year, $today->month, 1);
        $calendar = [];

        $skip = $tempDate->dayOfWeek;
        $tempDate->subtract($skip, 'day');

        $row = 0;
        do {
            for($col = 0; $col < 7; $col++) {
                $calendar[$row][$col] = [
                    'is_active' => $tempDate->month === $today->month,
                    'day' => $tempDate->day,
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
}
