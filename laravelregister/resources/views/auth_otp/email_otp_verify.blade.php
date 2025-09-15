<x-guest-layout>
    @if(session('message'))
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ session('message') }}
        </div>
    @endif
 
    <form method="POST" action="{{ route('verify.otp.store') }}">
        @csrf
        <!-- OTP -->
        <div>
            <x-input-label for="otp" :value="__('Enter OTP')" />
            <x-text-input id="otp" class="block mt-1 w-full" type="text" name="otp" :value="old('otp')" required autofocus autocomplete="otp" />
            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Verity & Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
