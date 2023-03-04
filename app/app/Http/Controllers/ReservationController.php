<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReserveRequest;
use App\Models\Reservation;
use App\Models\Rating;
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
    public function edit(Request $request){
        $reservation=Reservation::with(['shop'])->find($request->id);
        return view('edit',['reservation'=>$reservation]);
    }
    public function update(ReserveRequest $request){
        $datetime = new Carbon();
        $datetime = Carbon::createFromFormat('Y-m-d', $request->date);
        $array = explode(':', $request->time);
        $datetime->setTime($array[0], $array[1], 00);
        $result = $datetime->toDateTime();
        $number = $request->number;
        Reservation::where('id','=',$request->id)->update(['date'=>$result,'number'=>$number]);
        return redirect('/mypage');
    }
    public function rating(Request $request){
        $reservation=Reservation::with(['shop'])->find($request->id);
        $today=new Carbon;
        $today=Carbon::now();
        if($reservation && Auth::user()->id == $reservation->user_id &&  $reservation->date <$today){
            return view('rating',['reservation'=>$reservation]);
        }else{
            return redirect('/mypage');
        }
    }
    public function setRating(Request $request){
        Rating::create([
            'shop_id'=>$request->shop_id,
            'user_id'=>$request->user_id,
            'rating'=>$request->rating,
            'comment'=>$request->comment
        ]);
        return view('thanks');

    }
        public function checkout(Request $request){
        $reservation=Reservation::with('shop')->where('id','=',$request->id)->first();
        $line_items=[];
        $line_item=[
            'price_data'=>[
                'currency'=>'jpy',
                'unit_amount'=>'3000',
                'product_data'=>[
                    'name'=>$reservation->shop->name.'お食事代',
                    'description'=>$reservation->shop->name.'のお食事代１人前（事前予約割引）'
                ],

            ],
            'quantity' => $reservation->number,
        ];
        array_push($line_items,$line_item);

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $session=\Stripe\Checkout\Session::create([
            'payment_method_types'=>['card'],
            'line_items'=>[$line_items],
            'success_url'=>route('success'),
            'cancel_url'=>route('cancel'),
            'mode'=>'payment',
        ]);

        return view('checkout',[
            'session'=>$session,
            'publicKey'=>env('STRIPE_PUBLIC_KEY')
        ]);
    }
    public function success(){
        return view('checkout-success');
    }
    public function cancel()
    {
        return view('checkout-cancel');
    }
    public function showQr(Request $request){
        return view('qrpage',['id'=>$request->id]);
    }
}
