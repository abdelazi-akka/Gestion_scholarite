@extends('adminlte::page')
@section('title')
TASMIME WEB | {{__('MyCustom.Modifier_un_Groupe')}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card my-2 bg-light ">
                    <div class="card-header" style="background:linear-gradient(to right top, #c8c790, #b2c89a, #a0c8a7, #94c6b3, #8fc2bd);">
                        <div class="text-center">
                            <h3 class="text-white">{{__('MyCustom.Modifier_un_Groupe')}}</h3>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        <form method="POST" action="{{ route('groupe.update',$data->id_groupe)}}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="code_groupe" class="col-md-4 col-form-label text-md-end">{{__('MyCustom.Code_Groupe')}}</label>
                                <div class="col-md-6">
                                    <input id="code_groupe" type="text" value="{{old('code_groupe',$data->code_groupe)}}" class="form-control" name="code_groupe"placeholder="{{__('MyCustom.placeholder_Code_Groupe')}}" required>
                                    <input type="hidden" value="{{old('code_groupe',$data->code_groupe)}}"name="old_code">
                                    @error('code_groupe')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="nom_groupe" class="col-md-4 col-form-label text-md-end">{{__('MyCustom.Nom_du_Groupe')}}</label>
                                <div class="col-md-6">
                                    <input id="nom_groupe" type="text" value="{{old('nom_groupe',$data->nom_groupe)}}" class="form-control" name="nom_groupe"  placeholder="{{__('MyCustom.placeholder_Nom_Groupe')}}" required>
                                    @error('nom_groupe')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="code_filliere" class="col-md-4 col-form-label text-md-end">{{__('MyCustom.Filiére')}}</label>
                                <div class="col-md-6">
                                    <select id="code_filliere" class="form-control" name="code_filliere">
                                        @foreach($filliere as $item)
                                            <option value="{{ $item->code_filliere }}">{{ $item->intitule_filliere }}</option>
                                        @endforeach
                                    </select>
                                    @error('code_filliere')
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
