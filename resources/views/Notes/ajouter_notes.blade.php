@extends('adminlte::page')
@section('title')
    TASMIME WEB | {{__('MyCustom.Ajouter_une_note')}}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card my-2 bg-light ">
                    <div class="card-header"style="background:linear-gradient(to right top, #c8c790, #b2c89a, #a0c8a7, #94c6b3, #8fc2bd);">
                        <div class="text-center">
                            <h3 class="text-white">{{__('MyCustom.Ajouter_une_note')}}</h3>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <form method="POST" action="{{route('fourmateur-notes.store')}}">
                            @csrf
                            <div class="row mb-3">
                                <label for="code_module" class="col-md-4 col-form-label text-md-end">{{__("MyCustom.Information_d'étudiant")}} :</label>
                                <div class="col-md-6">
                                    <input type="text"  value="{{'Nom & Prénom : '.$dataEtudiant->nom.' '.$dataEtudiant->prenom.' | CIN : '.$dataEtudiant->cin}}" class="form-control" readonly>
                                    <input type="hidden" name="id_etudiant"  value="{{$dataEtudiant->id_etudiant}}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="code_module" class="col-md-4 col-form-label text-md-end">Module</label>
                                <div class="col-md-6">
                                    <select name="id_module" class="form-control">
                                        @forelse($dataModules as $module)
                                            <option value="{{$module->id_module}}">{{$module->intitule_module}}</option>
                                        @empty
                                            <option value="0">Aucun module</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="note" class="col-md-4 col-form-label text-md-end">Note  :</label>
                                <div class="col-md-6">
                                    <input type="number" max="20" min="0" class="form-control" name="note">
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
