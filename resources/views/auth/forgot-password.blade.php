<x-guest-layout>
    <!-- <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form> -->
    <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="container-fluid login-1">
                <div class="container">
                    <div class="login-form">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="img-box">
                                    <img src="{{asset('assets/forget-password.png')}}" class="img img-fluid" title="login" alt="welcome image">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="login-box">
                                    <div class="form-group">
                                            <!-- <h4 class="login-title">{{__('MyCustom.Welcome_back')}}</h4> -->
                                            <p class="login-p">{{__('MyCustom.Message_forget_password')}}.</p>
                                        </div>

                                <div class="form-group">
                                    <x-text-input  id="email" style="border-radius: 1rem;" class="form-control block mt-1 w-full" placeholder="{{Lang::get('MyCustom.placeholder_Email')}}" type="email" name="email" :value="old('email')" required/>
                                    <x-input-error :messages="$errors->get('email')" class="text-danger " />
                                </div>
                                <x-auth-session-status class="mb-4" :status="session('status')" />
                                <div class="input-group check-field">
                                    <x-primary-button class="btn btn-primary w-100">
                                        {{ __('MyCustom.Email_Password_Reset_Link') }}
                                    </x-primary-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>
