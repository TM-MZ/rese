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
        border-bottom: 1px solid black;
    }

    table tr td {
        padding: 10px;
    }
    button,input{
        background-color: white;
    }
</style>
<x-app-layout>

    <div class="container">
        <h1 class="title">店舗代表者管理ページ</h1>
        <div>{{$users->links()}}</div>

        <table>
            <tr class="table_header">
                <th>user_id</th>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>役職</th>
            </tr>
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    @if($user->role_id==1)
                    <p>管理者
                    </p>
                    @elseif($user->role_id==2)
                    <p>店舗代表者</p>
                    @else
                    <form action="/admin/set_shop_manager" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <input type="submit" value="店舗代表者に設定する">
                    </form>
                    @endif
                </td>
                <td>
                    @if($user->role_id==2)
                    <form action="/admin/delete_shop_manager" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <input type="submit" value="解除する">
                    </form>
                    @endif
                </td>
            </tr>

            @endforeach
        </table>

    </div>
</x-app-layout>