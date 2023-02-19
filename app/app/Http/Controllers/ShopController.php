<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;

class ShopController extends Controller
{
    //
    public function show()
    {
        $isFavor = "";
        $user = Auth::user();
        $areas = Area::all();
        $genres = Genre::all();
        $shops = Shop::with(['area', 'genre'])->get();
        if (isset($user)) {
            $areas = Area::all();
            $genres = Genre::all();
            $shops = Shop::with(['area', 'genre'])->get();
            $favorites = Favorite::where('user_id', '=', $user->id)->get();
            return view('index', [
                'shops' => $shops,
                'favorites' => $favorites,
                'user' => $user,
                'isFavor' => $isFavor,
                'areas' => $areas,
                'genres' => $genres,
            ]);
        } else {
            return view('index', [
                'shops' => $shops,
                'areas' => $areas,
                'genres' => $genres,
            ]);
        }
    }
    public function search(Request $request)
    {
        $isFavor = "";
        $user = Auth::user();
        $areas = Area::all();
        $genres = Genre::all();
        $shops = array();
        $query = Shop::query()->with(['area', 'genre']);
        $area = $request->area;
        $genre = $request->genre;
        $keyword = $request->keyword;
        if ($area && $area != 0) {
            $query->where('area_id', '=', $area);
        }
        if ($genre && $genre != 0) {
            $query->where('genre_id', '=', $genre);
        }
        if ($keyword != "") {
            $items = $query->get();
            foreach ($items as $item) {
                if (preg_match('/' . $keyword . '/', $item->name)) {
                    array_push($shops, $item);
                }
            }
        } else {
            $shops = $query->get();
        }
        if (isset($user)) {
            $favorites = Favorite::where('user_id', '=', $user->id)->get();
            return view('index', [
                'shops' => $shops,
                'favorites' => $favorites,
                'user' => $user,
                'isFavor' => $isFavor,
                'areas' => $areas,
                'genres' => $genres,
                'this_area'=>$area,
                'this_genre'=>$genre,
                'this_keyword'=>$keyword,
            ]);
        } else {
            return view('index', [
                'shops' => $shops,
                'areas' => $areas,
                'genres' => $genres,
                'this_area' => $area,
                'this_genre' => $genre,
                'this_keyword' => $keyword,
            ]);
        }
    }
    public function toggleFavorite(Request $request)
    {
        $user = Auth::user();
        $target = Favorite::where('shop_id', '=', $request->shop_id)->where('user_id', '=', $user->id)->first();
        if (isset($target)) {
            Favorite::where('id', '=', $target->id)->delete();
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'shop_id' => $request->shop_id
            ]);
        }
        //一旦インデックスに飛ばす。mypage実装後に、元のページに戻るように変更。
        $shops = Shop::with(['area', 'genre'])->get();
        $favorites = Favorite::where('user_id', '=', $user->id)->get();
        return redirect('/');
    }
    public function showDetail(Request $request)
    {
        $shop = Shop::with(['area', 'genre'])->find($request->id);
        return view('detail', ['shop' => $shop, 'page_name' => $request->page_name]);
    }
    public function showMypage()
    {
        $user = Auth::user();
        $items = Favorite::with(['shop', 'shop.area', 'shop.genre'])->get();
        $favorites = array();

        foreach ($items as $item) {
            if ($item->user_id == $user->id) {
                array_push($favorites, $item);
            }
        }
        if(Reservation::all()->count()>0){
        $reservations = Reservation::with('shop')->find($user->id)->get();
            return view('mypage', ['user' => $user, 'favorites' => $favorites, 'reservations' => $reservations]);
        }else{
            return view('mypage', ['user' => $user, 'favorites' => $favorites]);
        }

    }
    public function back(Request $request)
    {
        if ($request->page_name == 'from_mypage') {
            return redirect('/mypage');
        } else {
            return redirect('/');
        }
    }
    public function delete(Request $request)
    {
        if ($request->id) {
            Reservation::find($request->id)->delete();
        }
        return redirect('/mypage');
    }
    public function s3downtest(){
        return view('test');

    }
}
