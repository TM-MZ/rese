<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<link rel="stylesheet" href="{{asset('/css/default.css')}}">
<style scoped>
  .container {
    margin: 150px 100px 0 50px;
  }

  .contents {
    display: flex;
    justify-content: space-between;

    margin: 0 auto;
  }

  .user_name {
    text-align: center;
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 50px;
  }

  .reservations {
    width: 40%;
    text-align: left;
    padding: 20px;
    margin-right: 100px;
  }

  .reservation_container {
    margin-bottom: 20px;
    padding: 20px;
    background-color: #305dff;
    border-radius: 5px;
  }

  .reservation_container * {
    color: white;
  }

  .title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
  }

  .reserve_num {
    margin-left: 20px;
  }

  .contents_table {
    width: 100%;
    text-align: left;
    padding: 10px;
    margin-top: 20px;
  }

  .contents_table tr {
    text-align: left;
  }

  .contents_table th {
    width: 30%;
    padding: 10px 0;
  }

  .favorites {
    width: 60%;
    text-align: left;
  }

  .edit_icon {
    display: block;
  }

  .icon {
    width: 20px;
    height: 20px;
  }

  .favorite_icon {
    width: 30px;
    height: 30px;
    fill: red;
  }

  .card_container {
    display: grid;
    justify-items: start;
    grid-template-columns: repeat(2, 280px);
  }

  .card {
    border-radius: 8px;
    background-color: #fff;
    box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, .5);
    width: 240px;
    margin: 15px 0;
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

  .area_tag {
    margin-right: 3px;
  }

  .img_container {
    height: 150px;
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
</style>

<x-app-layout>
  <div class="container">
    <p class="user_name">{{$user->name}}さん</p>
    <div class="contents">

      <div class="reservations">
        <p class="title">予約状況</p>
        @if(isset($reservations))
        @foreach($reservations as $i => $reservation)
        <div class="reservation_container">
          <div class="flex_between">
            <div class="flex">
              <a class="edit_icon" href="/edit/{{$reservation->id}}"><img class="icon" loading="lazy" src="{{asset('img/clock.svg')}}" alt="clock"></a>
              <p class="reserve_num">予約{{$i+1}}</p>
            </div>
            <a href="/delete/{{$reservation->id}}">
              <img class="icon" loading="lazy" src="{{asset('img/delete.svg')}}" alt="delete">
            </a>

          </div>
          <table class="contents_table">
            <tr>
              <th>Shop</th>
              <td>{{$reservation->shop->name}}</td>
            </tr>
            <tr>
              <th>Date</th>
              <td>{{$reservation->date->format('Y-n-j')}}</td>
            </tr>
            <tr>
              <th>Time</th>
              <td>{{$reservation->date->format('G:i')}}</td>
            </tr>
            <tr>
              <th>Number</th>
              <td>{{$reservation->number}}人</td>
            </tr>
          </table>
        </div>
        @endforeach
        @endif
      </div>
      <div class="favorites">

        <p class="title">お気に入り店舗</p>

        <div class="card_container">
          @foreach($favorites as $favorite)
          <div class="card">
            <div class="img_container">
              <img class="img" loading="lazy" src="{{asset('img/'.$favorite->shop->picture_name)}}" alt="{{$favorite->shop->picture_name}}">
            </div>
            <div class="card_contents">
              <p class="shop_name">{{$favorite->shop->name}}</p>
              <div class="flex tags">
                <p class="area_tag">#{{$favorite->shop->area->name}}</p>
                <p>#{{$favorite->shop->genre->name}}</p>
              </div>
              <div class="flex_between">
                <a class="detail_link" href="/detail/{{$favorite->shop->id}}/from_mypage">詳しくみる</a>
                <a href="/favorite/{{$favorite->shop->id}}"><svg class="favorite_icon " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                  </svg></a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</x-app-layout>