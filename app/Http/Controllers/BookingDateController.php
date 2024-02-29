<?php

namespace App\Http\Controllers;

use App\Models\BookingDate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingDateController extends Controller
{


    public function getBooking(Request $request): Response
    {
        return Inertia::render('CarBookingMake', [
            'request' => $request,
        ]);
    }

    // 날짜 확인
    public function confirmDate(Request $request)
    {
        $request->validate([
            'dateStart' => 'required|string|max:255',
            'dateEnd' => 'required|string|max:255',
            'carId' => 'required',
        ]);

        $dateStart = str_replace('T', ' ', $request->dateStart);
        $dateEnd = str_replace('T', ' ', $request->dateEnd);

        $results = BookingDate::where(function ($query) use ($dateStart, $dateEnd) {
            $query->where(function ($query) use ($dateStart, $dateEnd) {
                $query->where('start_date', '>', $dateStart)
                    ->where('start_date', '<', $dateEnd);
            })->orWhere(function ($query) use ($dateStart, $dateEnd) {
                $query->where('end_date', '>', $dateStart)
                    ->where('end_date', '<', $dateEnd);
            })->orWhere(function ($query) use ($dateStart, $dateEnd) {
                $query->where('start_date', '<', $dateStart)
                    ->where('end_date', '>', $dateEnd);
            })->orWhere(function ($query) use ($dateStart, $dateEnd) {
                $query->where('start_date', '>', $dateStart)
                    ->where('end_date', '<', $dateEnd);
            });
        })->where('car_id', $request->carId)->get();

        $isVal = false;

        if (!empty($results[0])) {
            $isVal = true;
        }

        return  response()->json(['results' => $results,  'isValResult' => $isVal]);
    }

    // 차 예약
    public function createBooking(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phoneNum' => 'required|string|max:255',
            'userEmail' => 'required|string|max:255',
            'dateStart' => 'required|string|max:255',
            'dateEnd' => 'required|string|max:255',
            'carId' => 'required',
        ]);

        $userId = !empty(Auth::id()) ? Auth::id() : null;

        $Booking = BookingDate::create([
            'name' => $request->name,
            'phone_num' => $request->phoneNum,
            'user_email' => $request->userEmail,
            'start_date' => $request->dateStart,
            'end_date' => $request->dateEnd,
            'car_id' => $request->carId,
            'user_id' => $userId,
        ]);

        return redirect("/")->with('reload', true);
    }
}
