@extends('adminlte::page')
@section('title')
    TASMIME WEB | {{__('MyCustom.Ajouter_une_Affectation')}}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card my-2 bg-light ">
                    <div class="card-header" style="background:linear-gradient(to right top, #c8c790, #b2c89a, #a0c8a7, #94c6b3, #8fc2bd);">
                        <div class="text-center">
                            <h3 class="text-white">{{__('MyCustom.Ajouter_une_Affectation')}}</h3>
                        </div>
                    </div>
                    <!--show all erros-->
                    @if ($errors->any())
                        <div class="alert alert-danger">

                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body bg-light">
                        <form method="POST" action="{{ route('affectation.store')}}">
                            @csrf

                            <div class="row mb-3">
                                <label for="id_module" class="col-md-4 col-form-label text-md-end">{{ __('Module : ') }}</label>
                                <div class="col-md-6">
                                    <select id="id_module" class="form-control" name="id_module">
                                        @foreach($modules as $item)
                                            <option value="{{ $item->id_module }}">{{ $item->intitule_module }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_module')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="id_groupe" class="col-md-4 col-form-label text-md-end">{{ __('Groupe : ') }}</label>
                                <div class="col-md-6">
                                    <select id="id_groupe" class="form-control" name="id_groupe">
                                        @foreach($groupes as $item)
                                            <option value="{{ $item->id_groupe }}">{{$item->code_groupe.' | '.$item->nom_groupe }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_groupe')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{--  --}}
                            <div class="row mb-3">
                                <label for="id_prof" class="col-md-4 col-form-label text-md-end">{{ __('MyCustom.Fourmateur') }}</label>
                                <div class="col-md-6">
                                    <select id="id_prof" class="form-control" name="id_prof">
                                        @foreach($fourmateurs as $item)
                                            <option value="{{ $item->id }}">{{ $item->nom.' '.$item->prenom }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_prof')
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
