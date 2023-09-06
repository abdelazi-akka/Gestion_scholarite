@extends('adminlte::page')
@section('title')
    TASMIME WEB | {{__('MyCustom.Modifier_un_etudiant')}}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card my-2 bg-light ">
                    <div class="card-header" style="background:linear-gradient(to right top, #c8c790, #b2c89a, #a0c8a7, #94c6b3, #8fc2bd);">
                        <div class="text-center">
                            <h3 class="text-white">{{__('MyCustom.Modifier_un_etudiant')}}</h3>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        <form method="POST" action="{{ route('Etudiant.update',$data->id_etudiant)}}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="nom" class="col-md-4 col-form-label text-md-end">{{__('MyCustom.last_name')}}</label>
                                <div class="col-md-6">
                                    <input id="code_groupe" type="text" value="{{old('nom',$data->nom)}}" class="form-control" name="nom"
                                    placeholder="{{__('MyCustom.placeholder_LastName')}}" required>
                                    @error('nom')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="prenom" class="col-md-4 col-form-label text-md-end">{{__('MyCustom.First_name')}}</label>
                                <div class="col-md-6">
                                    <input id="code_groupe" type="text" value="{{old('prenom',$data->prenom)}}" class="form-control" name="prenom"
                                    placeholder="{{__('MyCustom.placeholder_FirstName')}}" required>
                                    @error('prenom')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="cin" class="col-md-4 col-form-label text-md-end">{{__('CIN')}}</label>
                                <div class="col-md-6">
                                    <input id="code_groupe" type="text" value="{{old('cin',$data->cin)}}" class="form-control" name="cin"
                                    placeholder="{{__('MyCustom.placeholder_cin')}}" required>
                                    @error('cin')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="adresse" class="col-md-4 col-form-label text-md-end">{{__('Adresse')}}</label>
                                <div class="col-md-6">
                                    <input id="code_groupe" type="text" value="{{old('adresse',$data->adresse)}}" class="form-control" name="adresse"
                                    placeholder="{{__('MyCustom.placeholder_Adresse')}}" required>
                                    @error('adresse')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="telephonne" class="col-md-4 col-form-label text-md-end">{{__('MyCustom.telephonne')}}</label>
                                <div class="col-md-6">
                                    <input id="code_groupe" type="text" value="{{old('telephonne',$data->telephonne)}}" class="form-control" name="telephonne"
                                    placeholder="{{__('MyCustom.placeholder_Téléphone')}}" required>
                                    @error('telephonne')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="cne" class="col-md-4 col-form-label text-md-end">{{__('CNE')}}</label>
                                <div class="col-md-6">
                                    <input id="cne" type="text" value="{{old('cne',$data->cne)}}" class="form-control" name="cne"
                                    placeholder="{{__('MyCustom.placeholder_CNE')}}" required>
                                    @error('cne')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="num_appoge" class="col-md-4 col-form-label text-md-end">{{__('MyCustom.num_appoge')}}</label>
                                <div class="col-md-6">
                                    <input id="num_appoge" type="text" value="{{old('num_appoge',$data->num_appoge)}}" class="form-control" name="num_appoge"
                                    placeholder="{{__('MyCustom.placeholder_NumAppoge')}}" required>
                                    @error('num_appoge')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="code_groupe" class="col-md-4 col-form-label text-md-end">{{__('Groupe')}}</label>
                                <div class="col-md-6">
                                    <select id="code_groupe" class="form-control" name="code_groupe">
                                        @foreach($groupes as $item)
                                            <option value="{{ $item->code_groupe }}">{{$item->code_groupe.' | '.$item->nom_groupe }}</option>
                                        @endforeach
                                    </select>
                                    @error('code_groupe')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-outline-orange w-100">
                                        {{ __('MyCustom.Modifier') }}
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
