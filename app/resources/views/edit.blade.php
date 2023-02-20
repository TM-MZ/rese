<style scoped>
    .back {
        margin-top: 150px;
    }

    .reservation {
        width: 40%;
        margin: 150px auto;
        background-color: #305dff;
        border-radius: 5px;
        box-shadow: 1px 1px 5px 2px rgba(0, 0, 255, .5);
        padding-bottom: 50px;
    }

    .reserve_title {
        margin: 30px;
        font-size: 24px;
        font-weight: bold;
        color: white;
    }

    .shop_title {
        display: flex;
        align-items: center;
        margin-bottom: 30px;
    }

    .title p {
        text-decoration: none;

    }

    .contents {

        width: 80%;
        margin: 20px 30px;
        border-radius: 5px;
        background-color: #4d7fff;
        padding: 30px 10px;
    }

    .tags {
        display: flex;
    }

    .summary {
        font-family: 'Zen Maru Gothic', sans-serif;
    }

    .summary,
    .tags p {
        margin-top: 20px;
        margin-right: 5px;
        font-size: 16px;
    }

    form {
        position: relative;
        height: 100%;
        margin: 0;
    }

    .contents table {
        width: 80%;
        background-color: #4d7fff;
        color: white;
        text-align: left;
        padding: 10px;
        border-radius: 5px;
        margin-top: 10px;
    }

    .contents table tr {
        text-align: left;
    }

    .contents table th {
        width: 30%;
    }

    .contents table th,
    .contents table td {
        padding: 10px;
    }


    .reserve_button {
        display: block;
        align-items: center;
        position: absolute;
        background-color: #0538ff;
        width: 100%;
        bottom: 34px;
        height: 50px;
        padding: 0;
        cursor: pointer;
        text-align: center;
        border: none;
        border-radius: 5px;
        color: white;
    }

    .date_input {
        margin: 0 30px;
        height: 30px;
        width: 50%;
        border-radius: 5px;
        border: none;
        padding: 0 10px;
    }

    .date_input:focus {
        outline: 1px solid blue;
    }

    .selectbox-003 {
        display: flex;
        align-items: center;
        position: relative;
        margin: 10px 30px;
    }

    .selectbox-003::after {
        position: absolute;
        right: 80px;
        width: 10px;
        height: 7px;
        background-color: #777;
        clip-path: polygon(0 0, 100% 0, 50% 100%);
        content: '';
        pointer-events: none;
        color: #555;
    }

    .selectbox-003 select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        width: 90%;
        min-width: 200px;
        height: 30px;
        padding: 5px 50px 5px 15px;
        border: 1px solid #d0d0d0;
        border-radius: 5px;
        background-color: #fff;
        color: #555;
        cursor: pointer;
    }

    .selectbox-003 select:focus {
        outline: 1px solid blue;

    }
</style>
<x-app-layout>
    <div class="flex">
        <div class="reservation">
            <p class="reserve_title">予約内容の変更</p>
            <div class="reserve_form">
                <form action="/update" method="post">
                    @csrf
                    <input class="date_input" type="date" name="date" id="date_input" value="{{$reservation->date->format('Y-m-d')}}">
                    <label class="selectbox-003">
                        <select name="time" id="time_input">
                            <option value="9:00" @if($reservation->date->format('G:i')=='9:00') selected @endif>9:00</option>
                            @for($i = 10; $i <24; $i++) <option value="{{$i.':00'}}" @if($reservation->date->format('G:i')==$i.':00') selected @endif>{{$i.':00'}}</option>
                                @endfor
                        </select>
                    </label>
                    <label class="selectbox-003">
                        <select name="number" id="number_input">
                            <option value="1" @if($reservation->number==1) selected @endif>1人</option>
                            @for($i = 2; $i <30; $i++) <option value="{{$i}}" @if($reservation->number==$i) selected @endif>{{$i.'人'}}</option>
                                @endfor
                        </select>
                    </label>
                    <input type="hidden" name="id" value="{{$reservation->id}}">
                    <div class="contents">
                        <table>
                            <tr>
                                <th>Shop</th>
                                <td>{{$reservation->shop->name}}</td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td id="date_value"></td>
                            </tr>
                            <tr>
                                <th>time</th>
                                <td id="time_value"></td>
                            </tr>
                            <tr>
                                <th>Number</th>
                                <td id="number_value"></td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                    <input class="reserve_button" type="submit" value="変更する">
                </form>
            </div>

        </div>
    </div>
    </div>
    <script>
        //onchangeでgetElementByIdを使用してvalueを取得し、table内のvalueに代入する？
        const dateView = document.getElementById("date_value");
        const timeView = document.getElementById("time_value");
        const numberView = document.getElementById("number_value");
        const dateInput = document.getElementById("date_input");
        const timeInput = document.getElementById("time_input");
        const numberInput = document.getElementById("number_input");
        const now = new Date();
        const year = now.getFullYear();
        const month = ("00" + (now.getMonth() + 1)).slice(-2);;
        const date = ("00" + (now.getDate())).slice(-2);
        window.onload = function() {
            dateView.innerHTML = dateInput.value;
            timeView.innerHTML = timeInput.value;
            numberView.innerHTML = numberInput.value + "人";
        }

        function showDateValue() {
            dateView.innerHTML = dateInput.value;
            console.log(dateInput.value);
        }

        function showTimeValue() {
            const index = timeInput.selectedIndex;
            timeView.innerHTML = timeInput.options[index].text;
        }

        function showNumberValue() {
            const index = numberInput.selectedIndex;
            numberView.innerHTML = numberInput.options[index].text;
        }

        dateInput.addEventListener('change', showDateValue);
        timeInput.addEventListener('change', showTimeValue);
        numberInput.addEventListener('change', showNumberValue);
    </script>
</x-app-layout>