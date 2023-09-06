@extends('adminlte::page')
@section('title')
TASMIME WEB | {{__('MyCustom.Modifier_un_Module')}}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card my-2 bg-light ">
                    <div class="card-header"style="background:linear-gradient(to right top, #c8c790, #b2c89a, #a0c8a7, #94c6b3, #8fc2bd);">
                        <div class="text-center">
                            <h3 class="text-white">{{__('MyCustom.Modifier_un_Module')}}</h3>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <form method="POST" action="{{ route('module.update',$data->id_module)}}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="code_module" class="col-md-4 col-form-label text-md-end">{{__('MyCustom.Code_Module')}}</label>
                                <div class="col-md-6">
                                    <input id="code_module" type="text" value="{{old('code_module',$data->code_module)}}" class="form-control" name="code_module"placeholder="{{__('MyCustom.placeholder_Code_Module')}}" required>
                                    <input type="hidden" value="{{old('code_module',$data->code_module)}}"name="old_code">
                                    @error('code_module')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="intitule_module" class="col-md-4 col-form-label text-md-end">{{__('MyCustom.Intitulé_du_Module')}}</label>
                                <div class="col-md-6">
                                    <input id="intitule_module" type="text" value="{{old('intitule_module',$data->intitule_module)}}" class="form-control" name="intitule_module"  placeholder="{{__('MyCustom.placeholder_Intitulé_du_Module')}}" required>
                                    @error('intitule_module')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="semestre_module" class="col-md-4 col-form-label text-md-end">{{__('MyCustom.Semestre')}}</label>
                                <div class="col-md-6">
                                    <select id="semestre_module" class="form-control" name="semestre_module">
                                        <option value="Semestre 1">Semestre 1</option>
                                        <option value="Semestre 2">Semestre 2</option>
                                        <option value="Semestre 3">Semestre 3</option>
                                        <option value="Semestre 4">Semestre 4</option>
                                        <option value="Semestre 5">Semestre 5</option>
                                        <option value="Semestre 6">Semestre 6</option>
                                    </select>
                                    @error('semestre_module')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="code_filliere" class="col-md-4 col-form-label text-md-end">{{__('MyCustom.Intitulé_Filiére')}}</label>
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

                            <div class="row mb-3">
                                <label for="cin" class="col-md-4 col-form-label text-md-end">{{__('MyCustom.Fourmateur')}}</label>
                                <div class="col-md-6">
                                    <select id="cin" class="form-control" name="cin">
                                        @foreach ($fourmateurs as $fourmateur )
                                            <option value="{{$fourmateur->cin}}">{{$fourmateur->nom.' '.$fourmateur->prenom}}</option>
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
