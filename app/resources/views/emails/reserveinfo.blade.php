<body>
    <p>{{$name}}様</p>
    <p>この度は{{$reservation->shop->name}}をご予約いただき、誠にありがとうございます。</p>
    <p>ご予約の日時が近づいてまいりましたので、お知らせいたします。ご予約の内容をご確認下さい。</p>
    <p>ご予約の店舗：{{$reservation->shop->name}}</p>
    <p>日時：{{$reservation->date->format('Y-m-d G:i')}}</p>
    <p>ご利用人数：{{$reservation->number}}名様</p>

    <p>※ご来店の際は、下記のリンク先で表示されるQRコードをご提示ください</p>
    <a href="/showqr/{{$reservation->id}}">QRコードを表示</a>
    <p>お客様のご来店を心よりお待ちしております。</p>
    <p>{{$reservation->shop->name}}</p>
</body>