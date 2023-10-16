<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="container-fluid login-1">
                <div class="container">
                    <div class="login-form">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="img-box">
                                    <img src="{{asset('assets/register.png')}}" class="img img-fluid"  title="login" alt="welcome image">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <x-text-input id="nom" style="border-radius: 1rem;" class="form-control block w-100  w-full" type="text" name="nom" :value="old('nom')" required autofocus placeholder="{{Lang::get('MyCustom.First_name')}}" />
                                        <x-input-error :messages="$errors->get('nom')" class="text-danger" />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <x-text-input id="prenom" style="border-radius: 1rem;" class="form-control block  w-full" type="text" name="prenom" :value="old('prenom')" required autofocus placeholder="{{Lang::get('MyCustom.last_name')}}"/>
                                        <x-input-error :messages="$errors->get('prenom')" class="text-danger" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <x-text-input id="cin" style="border-radius: 1rem;" class="form-control block  w-full" type="text" name="cin" :value="old('cin')" required autofocus placeholder="CIN" />
                                        <x-input-error :messages="$errors->get('cin')" class="text-danger" />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <x-text-input  id="email" style="border-radius: 1rem;" class="form-control block w-100  w-full" placeholder="Email" type="email" name="email" :value="old('email')" required/>
                                        <x-input-error :messages="$errors->get('email')" class="text-danger" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <x-text-input id="password" style="border-radius: 1rem;" class="form-control block  w-full" type="password" placeholder="{{Lang::get('MyCustom.Password')}}" name="password" :value="old('email')" required />
                                        <x-input-error :messages="$errors->get('password')" class="text-danger" />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <x-text-input id="password" style="border-radius: 1rem;" class="form-control block  w-full" type="password" placeholder="{{Lang::get('MyCustom.Confirme_Password')}}" name="password_confirmation"  required />
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger" />
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-md-6 form-group">
                                        <x-text-input id="password" class="form-control block  w-full" type="password" placeholder="{{Lang::get('MyCustom.Password')}}" name="password" :value="old('email')" required />
                                        <x-input-error :messages="$errors->get('password')" class="text-danger" />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <x-text-input id="password" class="form-control block  w-full" type="password" placeholder="{{Lang::get('MyCustom.Confirme_Password')}}" name="password_confirmation"  required />
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger" />
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <div class="input-group check-field">
                                            <x-primary-button class="btn btn-primary w-100">
                                                {{ __('MyCustom.Register') }}
                                            </x-primary-button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>


