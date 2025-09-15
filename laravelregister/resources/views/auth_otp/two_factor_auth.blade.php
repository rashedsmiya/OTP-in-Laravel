<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Enable/ Disable Two Factor Auth') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('If you want to secure your account, then enable two factor authentication.') }}
        </p>
    </header>

   <form method="post" action="{{ route('enable.two.factor.auth') }}" class="mt-6 space-y-6">
    @csrf
     <input type="hidden" name="enable_two_factor_auth" value="{{ $user->enable_two_factor_auth }}">
    <x-primary-button>{{ __($user->enable_two_factor_auth ? 'Disable' : 'Enable') }}</x-primary-button>
   </form>

</section>
