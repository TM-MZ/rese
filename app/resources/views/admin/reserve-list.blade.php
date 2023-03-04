<style scoped>
    .container {
        width: 50%;
        margin: 150px auto;
    }

    .title {
        margin: 50px 0;
        font-size: 30px;
    }

    .table_header {
        width: 50%;
        border-bottom: 1px solid black;
    }

    .table_header th {
        text-align: left;
        padding: 10px;
    }

    table tr td {
        padding: 5px 10px;
        text-align: left;
    }
    button{
        background-color: white;
    }
</style>
<x-app-layout>
    <div class="container">
        <button onclick="location.href='/admin'">戻る</button>
        <h1 class="title">予約情報リスト</h1>
        <p>店舗名:{{$shop->name}}</p>
        <table>
            <tr class="table_header">
                <th>id</th>
                <th>ユーザー名</th>
                <th>予約日時</th>
                <th>人数</th>
            </tr>
            @foreach($reservations as $reservation)
            <tr>
                <td>{{$reservation->id}}</td>
                <td>{{$reservation->user->name}}</td>
                <td>
                    {{$reservation->date->format('Y-m-d G:i')}}
                </td>
                <td>{{$reservation->number}}人</td>
                <td>
                    <form action="/admin/mailform/" method="get">
                        @csrf
                        <input type="hidden" name="id" value="{{$reservation->user->id}}">
                        <input type="submit" value="メールを送信する">
                    </form>
                </td>
            </tr>
            @endforeach
        </table>

    </div>
</x-app-layout>