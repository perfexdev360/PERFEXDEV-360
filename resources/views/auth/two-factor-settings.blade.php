<x-app-layout>
    <div class="max-w-xl mx-auto py-8">
        @if (Auth::user()->two_factor_secret)
            <p class="mb-4">{{ __('Two-factor authentication is enabled.') }}</p>
            <form method="POST" action="{{ route('two-factor.disable') }}">
                @csrf
                @method('DELETE')
                <x-primary-button>{{ __('Disable') }}</x-primary-button>
            </form>
        @else
            <p class="mb-4">{{ __('Scan the QR code using your authenticator app or enter the code below.') }}</p>
            <div class="mb-4">
                @isset($qrCode)
                    <img src="{{ $qrCode }}" alt="QR Code" class="mb-4" />
                @endisset
                <p class="font-mono">{{ $secret }}</p>
            </div>
            <form method="POST" action="{{ route('two-factor.enable') }}">
                @csrf
                <input type="hidden" name="secret" value="{{ $secret }}">
                <div>
                    <x-input-label for="code" :value="__('Code')" />
                    <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" autofocus required />
                    <x-input-error :messages="$errors->get('code')" class="mt-2" />
                </div>
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button>{{ __('Enable') }}</x-primary-button>
                </div>
            </form>
        @endif
    </div>
</x-app-layout>
