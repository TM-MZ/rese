<style scoped>
    .search_container {
        position: fixed;
        top: 20px;
        right: 20px;
        width: 40%;
        min-width: 300px;
        height: 35px;
        background-color: white;
        box-shadow: 0 1px 1px 2px rgba(0, 0, 0, .5);
        border-radius: 5px;
        margin-right: 80px;
        padding: 5px 10px;
        z-index: 15;
    }

    .form {
        align-items: center;
    }

    .card_container {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        margin: 100px 40px 0 40px;
    }

    .card {
        border-radius: 8px;
        box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, .5);
        width: 300px;
        margin: 15px 8px;
        border: none;
    }

    .card_contents {
        padding: 10px;
    }

    .shop_name {
        font-size: 20px;
        font-weight: bold;
        margin: 5px 0;
    }

    .tags {
        font-size: 10px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .tags p {
        font-size: 14px;
    }

    .area_tag {
        margin-right: 3px;
    }

    .img_container {
        height: 175px;
        overflow: hidden;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .img {
        width: 100%;
        object-fit: cover;
        object-position: center;
    }

    .detail_link {
        font-size: 10px;
        color: white;
        background-color: #305dff;
        padding: 10px 15px;
        border-radius: 5px;
    }

    .favorite_icon {
        width: 30px;
        height: 30px;
    }

    .fill-red {
        fill: red;
    }

    .fill-gray {
        fill: #ccc;
    }

    .selectbox-003 {
        display: inline-flex;
        align-items: center;
        position: relative;
    }

    .selectbox-003::after {
        position: absolute;
        right: 15px;
        width: 10px;
        height: 7px;
        background-color: #777;
        clip-path: polygon(0 0, 100% 0, 50% 100%);
        content: '';
        pointer-events: none;
    }

    .selectbox-003 select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        min-width: 50px;
        height: 20px;
        padding: 0 30px 0 5px;
        border: none;
        background-color: #fff;
        color: #000;
        cursor: pointer;
        border-right: 2px solid #eee;
    }

    .selectbox-003 select:focus {
        outline: none;
    }

    .search-form-011 {
        display: flex;
        align-items: center;
        overflow: hidden;
        border: 1px solid #ffffff;
        border-radius: 3px;
    }

    .search-form-011 input {
        width: 50%;
        height: 30px;
        padding: 5px 15px 5px 0;
        border: none;
        box-sizing: border-box;
        outline: none;
    }

    .search-form-011 input::placeholder {
        color: #767d83;
    }

    .search-form-011 button {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 45px;
        height: 45px;
        border: none;
        background-color: transparent;
        cursor: pointer;
    }

    .search-form-011 button::before {
        width: 20px;
        height: 20px;
        background-image: url('data:image/svg+xml;charset=utf8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2024%2024%22%3E%20%3Cpath%20d%3D%22M23.7%2020.8%2019%2016.1c-.2-.2-.5-.3-.8-.3h-.8c1.3-1.7%202-3.7%202-6C19.5%204.4%2015.1%200%209.7%200S0%204.4%200%209.7s4.4%209.7%209.7%209.7c2.3%200%204.3-.8%206-2v.8c0%20.3.1.6.3.8l4.7%204.7c.4.4%201.2.4%201.6%200l1.3-1.3c.5-.5.5-1.2.1-1.6zm-14-5.1c-3.3%200-6-2.7-6-6s2.7-6%206-6%206%202.7%206%206-2.6%206-6%206z%22%20fill%3D%22%23d6d6d6%22%3E%3C%2Fpath%3E%20%3C%2Fsvg%3E');
        background-repeat: no-repeat;
        content: '';
    }

</style>
<x-app-layout>

    <div class="search_container">
        <form class="flex form" action="/search" method="get">
            @csrf
            <label class="selectbox-003">
                <select name="area" onchange="submit(this.form)">
                    <option value="0" @if(isset($this_area) && $this_area==0) selected @endif>All area</option>
                    @foreach($areas as $area)
                    <option value="{{$area->id}}" @if(isset($this_area) && $this_area==$area->id) selected @endif>{{$area->name}}</option>
                    @endforeach
                </select>
            </label>
            <div class="genre flex">
                <label class="selectbox-003">
                    <select name="genre" onchange="submit(this.form)">
                        <option value="0" @if(isset($this_genre) && $this_genre==0) selected @endif>All genre</option>
                        @foreach($genres as $genre)
                        <option value="{{$genre->id}}" @if(isset($this_genre) && $this_genre==$genre->id) selected @endif>{{$genre->name}}</option>
                        @endforeach
                    </select>
                </label>
            </div>
            <div class="search-form-011">
                <label>
                    <input name="keyword" type="text" placeholder="Search">
                </label>
            </div>
        </form>
    </div>

    <div class="card_container">
        @foreach($shops as $shop)
        <div class="card">
            <div class="img_container">
                <img class="img" loading="lazy" src="{{\Storage::disk('s3')->url('img/'.$shop->picture_name)}}" alt="{{$shop->picture_name}}">
            </div>
            <div class="card_contents">
                <p class="shop_name">{{$shop->name}}</p>
                <div class="flex tags">
                    <p class="area_tag">#{{$shop->area->name}}</p>
                    <p>#{{$shop->genre->name}}</p>
                </div>
                <div class="flex_between">
                    <a class="detail_link " href="/detail/{{$shop->id}}/from_home">詳しくみる</a>
                    @php
                    $isFavor=false;
                    if(isset($favorites)){
                    foreach($favorites as $favorite){
                    if($favorite->shop_id==$shop->id && $favorite->user_id==$user->id){
                    $isFavor=true;
                    }
                    }
                    }
                    @endphp
                    @if(isset($favorites))
                    <a href="/favorite/{{$shop->id}}"><svg class="favorite_icon {{$isFavor ? 'fill-red' : 'fill-gray'}}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                        </svg></a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>