@extends('adminlte::page')
@section('title')
    TASMIME WEB | {{__('MyCustom.Ajouter_une_Filiére')}}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card my-2 bg-light ">
                    <div class="card-header" style="background:linear-gradient(to right top, #c8c790, #b2c89a, #a0c8a7, #94c6b3, #8fc2bd);color: white;">
                        <div class="text-center">
                            <h3 class="text-white">{{__('MyCustom.Ajouter_une_Filiére')}}</h3>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        <form method="POST" action="{{ route('admin-filliere.store')}}">
                            @csrf
                            <div class="row mb-3">
                                <label for="code_filliere" class="col-md-4 col-form-label text-md-end">{{ __('MyCustom.CodeFiliére') }} :</label>
                                <div class="col-md-6">
                                    <input id="code_filliere" type="text" class="form-control" name="code_filliere"  placeholder="{{__('MyCustom.placeholder_Code_Filliére')}}" required>
                                    @error('code_filliere')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="intitule_filliere" class="col-md-4 col-form-label text-md-end">{{ __('MyCustom.Intitulé_Filiére') }} :</label>
                                <div class="col-md-6">
                                    <input id="intitule_filliere" type="text" class="form-control" name="intitule_filliere"  placeholder="{{__('MyCustom.placeholder_Intitulé_Filliére')}}" required>
                                    @error('intitule_filliere')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="row mb-3">
                                <label for="cin" class="col-md-4 col-form-label text-md-end">{{ __('MyCustom.Chef_Filliére')}} :</label>
                                <div class="col-md-6">
                                    <select id="cin" class="form-control" name="cin">
                                        @foreach ( $users as $user )
                                            <option value="{{ $user->cin}}">{{ $user->nom." ".$user->prenom}}</option>
                                        @endforeach
                                    </select>
                                    @error('cin')
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
