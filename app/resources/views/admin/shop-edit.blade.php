<style scoped>
    .container {
        width: 50%;
        margin: 150px auto;
    }

    table tr th,
    table tr td {
        text-align: left;
        padding: 5px;
    }

    .title {
        margin-bottom: 50px;
        font-size: 30px;
    }

    textarea {
        width: 80%;
        padding: 5px;
        margin-bottom: 20px;
    }
    button,input{
        background-color: white;
    }
</style>
<x-app-layout>
    <div class="container">
        <h1 class="title">店舗情報編集</h1>
        <form action="/admin/shopupdate" method="post" enctype="multipart/form-data">
            @csrf
            <table>
                <tr>
                    <th>店舗名</th>
                    <td>
                        <input type="text" name="name" value="{{$shop->name}}">
                    </td>
                </tr>
                <tr>
                    <th>エリア</th>
                    <td>
                        <select name="area">
                            @foreach($areas as $area)
                            <option value="{{$area->id}}" @if($shop->area_id==$area->id) selected @endif">{{
                    $area->name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>ジャンル</th>
                    <td>
                        <select name="genre">
                            @foreach($genres as $genre)
                            <option value="{{$genre->id}}" @if($shop->genre_id==$genre->id) selected @endif">{{
                    $genre->name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>画像ファイル
                    </th>
                    <td>
                        <input type="file" name="picture">
                    </td>

                </tr>
            </table>
            <textarea name="summary" cols="30" rows="10">{{$shop->summary}}</textarea>
            <input type="hidden" name="id" value="{{$shop->id}}">
            <div>
                <button onclick="location.href='/admin'">戻る</button>
                <input type="submit" value="変更する">
            </div>
            @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif

        </form>
    </div>
</x-app-layout>