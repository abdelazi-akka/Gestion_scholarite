@extends('adminlte::page')
@section('title')
    TASMIME WEB | {{__("MyCustom.Les_détails_d'utilisateur")}}
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card my-2 bg-light">
                <div class="card-header" style="background:linear-gradient(to right top, #c8c790, #b2c89a, #a0c8a7, #94c6b3, #8fc2bd);">
                    <div class="text-center">
                        <h3 class="text-white">{{__("MyCustom.Les_détails_d'utilisateur")}}</h3>
                    </div>
                </div>

                    <div class="row card-body">
                        <div class="col-md-6 form-group ">
                            <label>{{__('MyCustom.last_name')}} : </label>
                            <input class="form-control" value="{{ $user->nom }}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{__('MyCustom.First_name')}} : </label>
                            <input class="form-control" value="{{ $user->prenom }}" readonly>
                        </div>
                    </div>

                    <div class="row card-body">
                        <div class="col-md-6 form-group">
                            <label>Cin : </label>
                            <input class="form-control" value="{{ $user->cin }}" readonly>
                        </div>
                        <div class="col-md-6 form-group ">
                            <label>Email : </label>
                            <input class="form-control" value="{{ $user->email }}" readonly>
                        </div>
                    </div>
                    <div class="row card-body">
                        <div class="col-md-6 form-group">
                            <label>Role : </label>
                            @if ($user->role==="fourmateur")
                                <input class="form-control" value="{{ $user->role.' '.$user->status}}" readonly>
                            @else
                                <input class="form-control" value="{{ $user->role==='chef_filliere'? 'Chef Filiére':null }}" readonly>
                            @endif
                        </div>
                        <div class="col-md-6 form-group ">
                            <label>{{__('MyCustom.Create_at')}} : </label>
                            <input class="form-control" value="{{ $user->created_at }}" readonly>
                        </div>
                    </div>

                    <div class="row card-body">
                        <div class=" col-6 offset-3 form-group ">
                            <a href="{{url('admin-utilisateurs') }}" class="btn btn-outline-orange w-100 ">{{__('MyCustom.Retour')}}</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
