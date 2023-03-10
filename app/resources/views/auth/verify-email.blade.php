<x-guest-layout>
    <x-slot name="page_title">ご登録ありがとうございます</x-slot>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('ご登録ありがとうございます。ご利用を開始する前に、メールでお送りしたリンクをクリックして、メールアドレスの確認をお願いします。') }}
    </div>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('メールが届いていない場合は、下のボタンでもう一度お送りできます。') }}
    </div>
    @if (session('status') == 'verification-link-sent')
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ __('登録時に入力されたメールアドレスに、新しい認証メールが送信されました。') }}
    </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('認証メールを再送する') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>