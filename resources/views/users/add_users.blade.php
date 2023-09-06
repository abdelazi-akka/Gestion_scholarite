@extends('adminlte::page')
@section('title')
    TASMIME WEB | {{__('MyCustom.Ajouter_un_utilisateur')}}
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card my-2 bg-light ">
                    <div class="card-header" style="background:linear-gradient(to right top, #c8c790, #b2c89a, #a0c8a7, #94c6b3, #8fc2bd);color: white;">
                        <div class="text-center">
                            <h3 class="text-white">{{__('MyCustom.Ajouter_un_utilisateur')}}</h3>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <form method="POST" action="{{ route('admin.store')}}">
                            @csrf
                            <div class="row mb-3">
                                <label for="nom" class="col-md-4 col-form-label text-md-end">{{ __('MyCustom.last_name') }} :</label>
                                <div class="col-md-6">
                                    <input id="nom" type="text" class="form-control" name="nom"  placeholder="{{__('MyCustom.placeholder_LastName')}}" required>
                                    @error('nom')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="prenom" class="col-md-4 col-form-label text-md-end">{{ __('MyCustom.First_name') }} :</label>
                                <div class="col-md-6">
                                    <input id="prenom" type="text" class="form-control" name="prenom"  placeholder="{{__('MyCustom.placeholder_FirstName')}}" required>
                                    @error('prenom')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="cin" class="col-md-4 col-form-label text-md-end">{{ __('CIN : ') }}</label>
                                <div class="col-md-6">
                                    <input id="cin" type="text" class="form-control" name="cin" placeholder="{{__('MyCustom.placeholder_cin')}}"  required/>
                                    @error('cin')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email : ') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" placeholder="{{__('MyCustom.placeholder_Email')}}"  required/>
                                    @error('email')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role : ') }}</label>
                                <div class="col-md-6">
                                    <select id="role" class="form-control" name="role">
                                        <option value="0">Administrateur</option>
                                        <option value="1">Chef département</option>
                                        <option value="2">Fourmateur Permanent</option>
                                        <option value="3">Fourmateur Vacataire</option>
                                    </select>
                                    @error('role')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('MyCustom.Password') }} :</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="{{__('MyCustom.placeholder_Password')}}"  required/>
                                    @error('password')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('MyCustom.Confirme_Password') }} :</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password_confirmation" placeholder="{{__('MyCustom.placeholder_Confirmer_Password')}}"  required/>
                                    @error('password_confirmation')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-outline-orange w-100">
                                        {{ __('MyCustom.Add') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
