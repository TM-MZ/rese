<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReserveRequest;
use App\Models\Reservation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    //
    public function reserve(ReserveRequest $request)
    {
        //formのdateとtimeを結合してdatetime型にする
        $datetime = new Carbon();
        $datetime = Carbon::createFromFormat('Y-m-d', $request->date);
        $array = explode(':', $request->time);
        $datetime->setTime($array[0], $array[1], 00);
        $result = $datetime->toDateTime();

        $user_id = Auth::user()->id;
        $shop_id = $request->shop_id;
        $number = $request->number;
        Reservation::create([
            'shop_id' => $shop_id,
            'user_id' => $user_id,
            'date' => $result,
            'number' => $number
        ]);
        return view('reserved');
    }
}
