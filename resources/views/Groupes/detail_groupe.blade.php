@extends('adminlte::page')
@section('title')
TASMIME WEB | {{__('MyCustom.Les_détails_de_Groupe')}}
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card my-2 bg-light">
                <div class="card-header" style="background:linear-gradient(to right top, #c8c790, #b2c89a, #a0c8a7, #94c6b3, #8fc2bd);">
                    <div class="text-center">
                        <h3 class="text-white">{{__('MyCustom.Les_détails_de_Groupe')}}</h3>
                    </div>
                </div>
                    <div class="row card-body">
                        <div class="col-md-6 form-group ">
                            <label>{{__('MyCustom.Code_Groupe')}} : </label>
                            <input class="form-control" value="{{$data->code_groupe}}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{__('MyCustom.Nom_du_Groupe')}} : </label>
                            <input class="form-control" value="{{ $data->nom_groupe }}" readonly>
                        </div>
                    </div>

                    <div class="row card-body">
                    <div class="col-md-6 form-group ">
                            <label>{{__('MyCustom.Filiére')}} : </label>
                            <input class="form-control" value="{{ $data->filliere->intitule_filliere}}" readonly>
                        </div>
                        <div class="col-md-6 form-group ">
                            <label>{{__('MyCustom.Date_dajout')}} : </label>
                            <input class="form-control" value="{{ $data->created_at }}" readonly>
                        </div>
                    </div>

                    <div class="row card-body">
                        <div class=" col-6 offset-3 form-group ">
                            <a href="{{route('groupe.index') }}" class="btn btn-outline-orange w-100 ">{{__('MyCustom.Retour')}}</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
