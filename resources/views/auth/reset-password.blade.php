<!-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>


        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> -->
<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="container-fluid login-1">
                <div class="container">
                    <div class="login-form">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="img-box">
                                    <img src="{{asset('assets/new-password.png')}}" class="img img-fluid w-100" title="login" alt="welcome image">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="login-box">
                                    <div class="form-group">
                                        <x-text-input  id="email" style="border-radius: 1rem;" class="form-control block mt-1 w-full" placeholder="{{Lang::get('MyCustom.Email')}}" type="email" name="email" :value="old('email', $request->email)" required/>
                                        <x-input-error :messages="$errors->get('email')" class="text-danger " />
                                    </div>
                                    <div class="form-group">
                                        <x-text-input id="password" style="border-radius: 1rem;" class="form-control block  w-full" type="password" placeholder="{{Lang::get('MyCustom.Password')}}" name="password" :value="old('email')" required />
                                        <x-input-error :messages="$errors->get('password')" class="text-danger" />
                                    </div>
                                    <div class="form-group">
                                        <x-text-input id="password" style="border-radius: 1rem;" class="form-control block w-full" type="password" placeholder="{{Lang::get('MyCustom.Confirme_Password')}}" name="password_confirmation"  required />
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger" />
                                    </div>
                                    <x-primary-button class="btn btn-primary w-100">
                                        {{ __('MyCustom.Reset_Password') }}
                                    </x-primary-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
</x-guest-layout>
