<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('MyCustom.Profile_Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("MyCustom.Update_your_account's") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!--************************************************************************---Nom---************************************************************************************-->
        <div>
            <x-input-label for="nom" :value="__('MyCustom.last_name')" />
            <x-text-input id="nom" class="block my-2 w-full" type="text" name="nom" :value="old('nom', $user->nom)" required autofocus autocomplete="nom" />
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
        </div>
        <!--************************************************************************---Prénom---************************************************************************************-->
        <div>
            <x-input-label for="prenom" :value="__('MyCustom.First_name')" />
            <x-text-input id="prenom" class="block my-2 w-full" type="text" name="prenom" :value="old('prenom', $user->prenom)" required autofocus autocomplete="prenom" />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>
        <!--************************************************************************---CIN---************************************************************************************-->
        <div>
            <x-input-label for="cin" :value="__('CIN')" />
            <x-text-input id="cin" class="block my-2 w-full" type="text" name="cin" :value="old('cin', $user->cin)" required autofocus autocomplete="cin" />
            <x-text-input  type="hidden" name="old_cin" :value="old('cin', $user->cin)" />
            <x-input-error :messages="$errors->get('cin')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-text-input name="old_email" type="hidden" class="mt-1 block w-full" :value="old('email', $user->email)"/>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('MyCustom.Your_email_address') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('MyCustom.Click_here_to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('MyCustom.A_new_verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('MyCustom.Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('MyCustom.Saved') }}</p>
            @endif
        </div>
    </form>
</section>
