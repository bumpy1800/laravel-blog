<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{-- <x-jet-authentication-card-logo /> --}}
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('이 기능은 이메일 인증이 완료된 회원만 사용할 수 있습니다 이메일 인증을 완료해 주십시요.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('가입시 등록한 이메일로 인증메일을 보냈습니다 :)') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-jet-button type="submit">
                        {{ __('이메일 인증하기') }}
                    </x-jet-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('로그아웃') }}
                </button>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
