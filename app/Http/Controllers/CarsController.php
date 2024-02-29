<?php

namespace App\Http\Controllers;

use App\Models\BookingDate;
use App\Models\Cars;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CarsController extends Controller
{


    public function list(Request $request): Response
    {

        // DB::enableQueryLog();


        $searchName = $request->query('carNameSearch');

        // $cars = Cars::paginate(3, ['*'], 'carspage')
        // ->when(!empty($searchName), function ($query, $searchName) {
        //     // $query->where('name', '=', $searchName);
        //     $query->where('name', 'like', '%' . $searchName . '%');
        // });

        $cars = Cars::when(!empty($searchName), function ($query) use ($searchName) {
            $query->where('name', 'like', '%' . $searchName . '%');
        })
            ->paginate(3, ['*'], 'carspage');

        // $queries = DB::getQueryLog();
        // print_r($queries);
        // print_r($searchName);



        $bookingDates = [];
        $userId = !empty(Auth::id()) ? Auth::id() : null;

        // 내가 예약한 리스트
        if (!empty($userId)) {
            $bookingDates = BookingDate::join('cars', 'booking_date.car_id', '=', 'cars.id')
                ->where('user_id', '=', $userId)
                ->orderBy('start_date', 'asc')
                ->paginate(2, ['*'], 'bookingpage');
        }

        return Inertia::render('CarBookingList', [
            'cars' => $cars,
            'bookingDates' => $bookingDates,
        ]);
    }

    public function showDetail($id): Response
    {

        $car = Cars::findOrFail($id);
        $bookingDates = BookingDate::where('car_id', '=', $id)
            ->orderBy('start_date', 'asc')
            ->get();

        return Inertia::render('CarBookingShow', [
            'car' => $car,
            'carId' => $id,
            'bookingDates' => $bookingDates,
        ]);
    }

    //
    public function createCar(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:' . Cars::class,
            'brand' => 'required|string|max:255',
            'car_size' => 'required|string|max:255',

        ]);

        $cars = Cars::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'car_size' => $request->car_size,
        ]);

        return redirect("/create")->with('reload', true);
    }
}
