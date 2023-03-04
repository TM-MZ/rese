<style scoped>
    p {
        line-height: 1.2rem;
    }

    .container {
        width: 400px;
        padding: 20px;
        margin: 150px auto;
        border-radius: 5px;
        background-color: #fff;
        box-shadow: 0 1px 5px 1px rgba(0, 0, 0, .5);
    }

    .shop_name {
        margin: 20px 0;
        font-size: 20px;
        font-weight: bold;
    }

    .star_container {
        background-color: #fff;
        margin: 10px 0;


    }

    .star {
        width: 20px;
        height: 20px;
        margin-right: 3px;
        color: #eee;
        border: none;
        background: none;
        cursor: pointer;
        text-shadow: 1px 1px 1px #999;
    }

    .fill_yellow {
        color: yellow;
    }

    .comment {
        font-size: 15px;
        padding: 5px;
        border-radius: 5px;
        margin-bottom: 20px;

    }

    .submit_button {
        font-size: 20px;
        color: white;
        background-color: #305dff;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
    }
</style>
<x-app-layout>
    <div class="flex">
        <div class="container">
            <p>この度は{{$reservation->shop->name}}をご利用頂きまして、誠にありがとうございます。</p>
            <p>よろしければご評価、ご意見をお願い致します。</p>
            <p class="shop_name">{{$reservation->shop->name}}</p>
            <form class="flex_column" action="/rating_upload" method="post">
                @csrf
                <div class="flex star_container">
                    @for($i=1;$i<6;$i++)
                    <div class="star" id="star{{$i}}">★</div>
                @endfor
        </div>
        <input type="hidden" name="rating" id="starValue">
        <input type="hidden" name="user_id" value="{{$reservation->user_id}}">
        <input type="hidden" name="shop_id" value="{{$reservation->shop_id}}">
        <textarea name="comment" class="comment" cols="30" rows="10" max:255></textarea>
        <input class="submit_button" type="submit" value="送信する">
        </form>
    </div>
    </div>

    <script>
        const starValue = document.getElementById('starValue');
        const star1 = document.getElementById('star1');
        const star2 = document.getElementById('star2');
        const star3 = document.getElementById('star3');
        const star4 = document.getElementById('star4');
        const star5 = document.getElementById('star5');

        function setRate(e) {
            switch (this.num) {
                case 1:
                    for (var i = 1; i < 6; i++) {
                        if (i == 1) {
                            eval("star" + i + ".classList.add('fill_yellow');");
                        } else {
                            eval("star" + i + ".classList.remove('fill_yellow');");
                        }
                    }
                    starValue.value = 1;
                    break;
                case 2:
                    for (var i = 1; i < 6; i++) {
                        if (i == 1 || i == 2) {
                            eval("star" + i + ".classList.add('fill_yellow');");
                        } else {
                            eval("star" + i + ".classList.remove('fill_yellow');");
                        }
                    }
                    starValue.value = 2;
                    break;
                case 3:
                    for (var i = 1; i < 6; i++) {
                        if (i == 1 || i == 2 || i == 3) {
                            eval("star" + i + ".classList.add('fill_yellow');");
                        } else {
                            eval("star" + i + ".classList.remove('fill_yellow');");
                        }
                    }
                    starValue.value = 3;
                    break;
                case 4:
                    for (var i = 1; i < 6; i++) {
                        if (i == 1 || i == 2 || i == 3 || i == 4) {
                            eval("star" + i + ".classList.add('fill_yellow');");
                        } else {
                            eval("star" + i + ".classList.remove('fill_yellow');");
                        }
                    }
                    starValue.value = 4;
                    break;
                case 5:
                    for (var i = 1; i < 6; i++) {
                        eval("star" + i + ".classList.add('fill_yellow');");
                    }
                    starValue.value = 5;
                    break;
            }
        }
        star1.addEventListener('click', {
            num: 1,
            handleEvent: setRate
        });
        star2.addEventListener('click', {
            num: 2,
            handleEvent: setRate
        });
        star3.addEventListener('click', {
            num: 3,
            handleEvent: setRate
        });
        star4.addEventListener('click', {
            num: 4,
            handleEvent: setRate
        });
        star5.addEventListener('click', {
            num: 5,
            handleEvent: setRate
        });
    </script>
</x-app-layout>