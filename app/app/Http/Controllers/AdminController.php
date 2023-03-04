<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShopRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Shop;
use App\Models\Genre;
use App\Models\Area;
use App\Models\Reservation;
use App\Mail\ShopMail;
use App\Mail\CustomerMail;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    //
    public function showAdmin(){
        $role=Auth::user()->role_id;
        if($role==1){
            $users=User::with('role');
            return view('/admin/user-management',['users'=>$users]);
        }elseif($role==2){
            $shops=Shop::all();
            return view('/admin/shop-management',['shops'=>$shops]);
        }else{
            return redirect('/');
        }
    }
    public function setShopManager(Request $request){
        $user=User::find($request->id);
        if($user && $user->role_id!=2){
            User::where('id',$request->id)->update(['role_id'=>'2']);
        }
        return redirect('/admin');

    }
    public function deleteShopManager(Request $request){
        $user = User::find($request->id);
        if ($user && $user->role_id == 2) {
            User::where('id',$request->id)->update(['role_id' => '3']);
        }
        return redirect('/admin');
    }
    public function shopEdit(Request $request){
        $shop=Shop::find($request->id);
        $areas=Area::all();
        $genres=Genre::all();
        $user=Auth::user();
        if($user && $user->role_id==2){
            return view('/admin/shop-edit',['shop'=>$shop,'areas'=>$areas,'genres'=>$genres]);
        }else{
            return redirect('/admin');
        }
    }
    public function shopUpdate(ShopRequest $request)
    {
        if(Auth::user()->role_id!=2){
            return redirect('/admin');
        }
        $name = $request->name;
        $area_id = $request->area;
        $genre_id = $request->genre;
        $summary = $request->summary;

        if ($request->file) {
            //$reslut=Storage::disk('s3')->put('/img/',$request->file('picture'));
            $picture_name = $request->file('picture')->getClientOriginalName();
            Shop::where('id', $request->id)->update(['name' => $name, 'area_id' => $area_id, 'genre_id' => $genre_id, 'picture_name'=>$picture_name,'summary' => $summary,]);
        }else{
            Shop::where('id', $request->id)->update(['name' => $name, 'area_id' => $area_id, 'genre_id' => $genre_id, 'summary' => $summary,]);
        }
        return redirect('/admin');
    }
    public function reserveList(Request $request){
        $shop=Shop::find($request->id);
        $reservations=Reservation::with('user')->where('shop_id',$request->id)->get();
        return view('admin/reserve-list',['reservations'=>$reservations,'shop'=>$shop]);
    }
    public function showCreatePage(){
        $areas=Area::all();
        $genres=Genre::all();
        return view('admin/shop-create',['areas'=>$areas,'genres'=>$genres]);
    }
    public function shopCreate(ShopRequest $request){
        if (Auth::user()->role_id != 2) {
            return redirect('/admin');
        }
        $name=$request->name;
        $area_id=$request->area;
        $genre_id=$request->genre;
        $summary=$request->summary;
        $picture_name="";
        if ($request->file) {
            //$reslut=Storage::disk('s3')->put('/img/',$request->file('picture'));
            $picture_name = $request->file('picture')->getClientOriginalName();
            Shop::create(['name' => $name, 'area_id' => $area_id, 'genre_id' => $genre_id, 'picture_name' => $picture_name, 'summary' => $summary,]);
        } else {
            Shop::create(['name' => $name, 'area_id' => $area_id, 'genre_id' => $genre_id, 'summary' => $summary,]);
        }
        return redirect('/admin');
    }
    public function sendReserveInfo(Request $request){
        $reservation=Reservation::with('shop')->first();
        $user=User::find(1);
        Mail::to($user->email)->send(new ShopMail($user,$reservation));

    }
    public function showMailForm(Request $request){
        $customer=User::find($request->id);
        return view('admin/mailform',['customer'=>$customer]);
    }
    public function sendMail(Request $request){
        $customer=User::find($request->id);
        Mail::to($customer->email)->send(new CustomerMail($customer,$request->content));
        return redirect('/admin');

    }
}
