@extends('adminlte::page')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card my-2 bg-light">
                    <div class="card-header" style="background:linear-gradient(to right top, #c8c790, #b2c89a, #a0c8a7, #94c6b3, #8fc2bd);">
                        <div class="text-center">
                            <h3 class="text-white">Modifier une Note</h3>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <form method="POST" action="{{route('fourmateur-notes.update',$dataEtudiant->cin)}}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="etudiant_info" class="col-md-4 col-form-label text-md-end">Information de l'étudiant :</label>
                                <div class="col-md-6">
                                    <input type="text" value="{{ 'Nom & Prénom : ' . $dataEtudiant->nom . ' ' . $dataEtudiant->prenom . ' | CIN : ' . $dataEtudiant->cin }}" class="form-control" readonly>
                                    <input type="hidden" name="id_etudiant" value="{{ $dataEtudiant->id_etudiant }}" readonly>
                                </div>
                            </div>
                            @foreach ($dataModules as $module)
                                <div class="row mb-3">
                                    <label for="note_{{ $module->id_module }}" class="col-md-4 col-form-label text-md-end">{{ $module->intitule_module }}</label>
                                    <div class="col-md-6">
                                        <input name="id_module" value="{{ $module->id_module }}" type="hidden" readonly>
                                        <input id="note_{{ $module->id_module }}" type="number" class="form-control" name="notes[{{ $module->id_module }}]" value="{{ isset($dataNote[$module->id_module]) ? $dataNote[$module->id_module] : '' }}">
                                    </div>
                                </div>
                            @endforeach
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
