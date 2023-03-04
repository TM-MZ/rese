<style scoped>
    .container {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        background-color: #eee;

    }

    .message {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        width: 400px;
        height: 300px;
        margin-top: 150px;
        background-color: white;
        box-shadow: 1px 1px 5px 0 rgba(0, 0, 0, .5);
        border-radius: 5px;
    }

    .message p {
        font-size: 24px;
        font-weight: bold;
        margin: 20px auto;

    }

    .back {
        color: white;
        background-color: #305dff;
        padding: 10px 20px;
        border-radius: 5px;

    }
</style>
<x-app-layout>
    <div class="container">
        <div class="message">
            <p>ありがとうございました。</p>
            <p>またのご来店をお待ちしております。</p>
            <a href="/mypage" class="back">マイページへ</a>
        </div>
    </div>


</x-app-layout>