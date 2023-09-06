<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="container-fluid login-1">
            <div class="container">
                <div class="login-form">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="img-box">
                                <img src="{{asset('assets/school-software-removebg.png')}}" class="img img-fluid" title="login" alt="welcome image">
                            </div>
                        </div>
                        <div class="col-md-6">
                            @auth
                                <a href="{{url('/dashboard')}}" class="btn btn-primary w-100">{{__('MyCustom.Dashboard')}}</a>
                            @else
                            <div class="login-box">
                                <div class="row">
                                    <h4 class="login-title">{{__('MyCustom.Welcome_back')}}</h4>
                                    <p class="login-p">{{__('MyCustom.Please_Login')}}.</p>
                                </div>
                                <div class="form-group">
                                    <x-text-input  id="email" class="form-control block mt-1 w-full" placeholder="{{Lang::get('MyCustom.placeholder_Email')}}" type="email" name="email" :value="old('email')" required/>
                                    <x-input-error :messages="$errors->get('email')" class="text-danger " />
                                </div>
                                <div class="form-group">
                                    <x-text-input id="password" class="form-control block  w-full" type="password" placeholder="{{Lang::get('MyCustom.placeholder_Password')}}" name="password" :value="old('email')" required />
                                    <x-input-error :messages="$errors->get('password')" class="text-danger" />
                                </div>
                                <x-auth-session-status class="my-2" :status="session('status')" />
                                <div class="input-group check-field">
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('MyCustom.Remember_me') }}</span>
                                    </label>
                                    @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                            {{ __('MyCustom.Forgot_your_password') }} ?
                                        </a>
                                    @endif
                                </div>
                                <x-primary-button class="btn btn-primary w-100">
                                    {{ __('MyCustom.Login_in') }}
                                </x-primary-button>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>


