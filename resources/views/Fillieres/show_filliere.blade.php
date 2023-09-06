@extends('adminlte::page')
@section('title')
    TASMIME WEB | {{__('MyCustom.Les_détails_de_Filliére')}}
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card my-2 bg-light">
                <div class="card-header" style="background:linear-gradient(to right top, #c8c790, #b2c89a, #a0c8a7, #94c6b3, #8fc2bd);color: white;">
                    <div class="text-center">
                        <h3 class="text-white">{{__("MyCustom.Les_détails_de_Filliére")}}</h3>
                    </div>
                </div>
                    <div class="row card-body">
                        <div class="col-md-6 form-group ">
                            <label>{{__('MyCustom.CodeFiliére')}} : </label>
                            <input class="form-control" value="{{ $data->code_filliere }}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{__('MyCustom.Intitulé_Filiére')}} : </label>
                            <input class="form-control" value="{{ $data->intitule_filliere }}" readonly>
                        </div>
                    </div>

                    <div class="row card-body">
                        <div class="col-md-6 form-group">
                            <label>{{__('MyCustom.Chef_Filliére')}} : </label>
                            <input class="form-control" value="{{ $data->user->nom.' '.$data->user->prenom}}" readonly>
                        </div>
                        <div class="col-md-6 form-group ">
                            <label>{{__("MyCustom.Date_dajout")}} : </label>
                            <input class="form-control" value="{{ $data->created_at }}" readonly>
                        </div>
                    </div>

                    <div class="row card-body">
                        <div class=" col-6 offset-3 form-group ">
                            <a href="{{route('admin-filliere.index') }}" class="btn btn-outline-orange w-100 ">{{__("MyCustom.Retour")}}</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
