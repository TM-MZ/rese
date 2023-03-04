<style scoped>
    .container {
        width: 50%;
        margin: 150px auto;
    }

    .title {
        margin-bottom: 50px;
        font-size: 30px;
    }

    .table_header {
        width:50%;
        border-bottom: 1px solid black;
    }
    .table_header th{
        text-align: left;
        padding:10px;
    }
    table tr td {
        padding: 5px 10px;
        text-align: left;
    }
    button,input{
        background-color: white;
    }
</style>
<x-app-layout>
    <div class="container">
        <h1 class="title">店舗管理ページ</h1>
        <button onclick="location.href='/admin/create-shop'">店舗を新規作成する</button>
        <table>
            <tr class="table_header">
                <th>shop_id</th>
                <th>店舗名</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($shops as $shop)
            <tr>
                <td>{{$shop->id}}</td>
                <td>{{$shop->name}}</td>
                <td>
                    <form action="/admin/shopedit" method="get">
                        @csrf
                        <input type="hidden" name="id" value="{{$shop->id}}">
                        <input type="submit" value="店舗情報を編集する">
                    </form>
                </td>
                <td>
                    <form action="/admin/reservelist" method="get">
                        @csrf
                        <input type="hidden" name="id" value="{{$shop->id}}">
                        <input type="submit" value="予約情報を確認する">
                    </form>
                </td>
            </tr>

            @endforeach
        </table>

    </div>
</x-app-layout>