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
        <h1 class="title">メール送信</h1>
        <form action="/admin/sendmail" method="post">
            @csrf
            <table>
                <tr>
                    <th>宛先：</th>
                    <td>
                        <p>{{$customer->name}}　様</p>
                    </td>
                </tr>
                <tr>
                    <th>タイトル</th>
                    <td>
                        <input type="text" name="title">
                    </td>
                </tr>
            </table>
            <textarea name="content" cols="30" rows="10"></textarea>
            <input type="hidden" name="id" value="{{$customer->id}}">
            <div>
                <button onclick="location.href='/admin'">戻る</button>
                <input type="submit" value="送信する">
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