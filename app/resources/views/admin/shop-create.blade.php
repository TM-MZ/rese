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

    button,
    input {
        background-color: white;

    }
</style>
<x-app-layout>
    <div class="container">
        <h1 class="title">店舗情報新規作成</h1>
        <form action="/admin/create" method="post" enctype="multipart/form-data">
            @csrf
            <table>
                <tr>
                    <th>店舗名</th>
                    <td>
                        <input type="text" name="name" value="">
                    </td>
                </tr>
                <tr>
                    <th>エリア</th>
                    <td>
                        <select name="area">
                            <option selected>エリア名</option>
                            @foreach($areas as $area)
                            <option value="{{$area->id}}">{{
                    $area->name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>ジャンル</th>
                    <td>
                        <select name="genre">
                            <option value="">ジャンル名</option>
                            @foreach($genres as $genre)
                            <option value="{{$genre->id}}">{{
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
                <tr>
                    <th> <label for="summary">詳細</label></th>
                    <td></td>
                </tr>
            </table>
            <textarea name="summary" cols="30" rows="10"></textarea>
            <div>
                <button onclick="location.href='/admin'">戻る</button>
                <input type="submit" value="作成する">
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