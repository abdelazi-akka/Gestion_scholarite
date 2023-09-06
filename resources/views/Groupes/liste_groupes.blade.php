@extends('adminlte::page')
@section('plugins.Datatables',true)
@section('title')
TASMIME WEB | {{__('MyCustom.Gestion_des_Groupes')}}
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card my-2 bg-light">
                <div class="card-header" style="background:linear-gradient(to right top, #c8c790, #b2c89a, #a0c8a7, #94c6b3, #8fc2bd);">
                    <div class="text-center">
                        <h3 class="text-white">{{__('MyCustom.La_liste_des_groupes')}}</h3>
                    </div>
                </div>
                @if (Request::is('chef-filliere/groupe'))
                    <form class="row m-2" action="{{ route('import-groupe')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-8">
                            <input type="file" name="excel_file" class="form-control mt-1"/>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn text-dark btn-outline-orange w-100 mt-1" type="submit">{{__('MyCustom.Upload')}}</button>
                        </div>
                    </form>
                @endif
                <div class="card-body" style="overflow-x:auto;">
                    <table id="mytable" class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <!-- <th>#</th> -->
                                <th>{{__('MyCustom.Code_Groupe')}}</th>
                                <th>{{__('MyCustom.Nom_du_Groupe')}}</th>
                                <th>{{__('MyCustom.Filiére')}}</th>
                                <th>{{__('MyCustom.Date_dajout')}}</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($data as $item)
                                <tr class="text-center">
                                    <td data-label="{{__('MyCustom.Code_Groupe')}}">{{ $item->code_groupe}}</td>
                                    <td data-label="{{__('MyCustom.Nom_du_Groupe')}}">{{ $item->nom_groupe}}</td>
                                    <td data-label="{{__('MyCustom.Filiére')}}">{{ $item->filliere->intitule_filliere}}</td>
                                    <td data-label="{{__('MyCustom.Date_dajout')}}">{{ date("d/m/Y", strtotime( $item->created_at)) }}</td>
                                    <td data-label="Actions">
                                        @if (Request::is('chef-filliere/affectation'))
                                            <a href="{{ route('affectation.show', $item->id_groupe) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-solid fa-info-circle"></i>
                                            </a>
                                        @elseif (Request::is('chef-filliere/Etudiant'))
                                            <a href="{{ route('Etudiant.show', $item->code_groupe) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-hand-point-right"></i>
                                            </a>
                                        @elseif(Request::is('fourmateur-groupe'))
                                            <a href="{{ route('fourmateur-notes.show', $item->code_groupe) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-hand-point-right"></i>
                                            </a>
                                        @else
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $item->id_groupe }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $item->id_groupe }}">
                                                    <a class="dropdown-item" href="{{ route('groupe.show', $item->id_groupe) }}">
                                                        <i class="fas fa-eye"></i> {{__('MyCustom.Voir')}}
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('groupe.edit', $item->id_groupe) }}">
                                                        <i class="fas fa-edit"></i> {{__('MyCustom.Modifier')}}
                                                    </a>
                                                    <form id="deleteForm{{ $item->id_groupe }}" action="{{ route('groupe.destroy', $item->id_groupe) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="button" class="dropdown-item" onclick="deleteForm('{{$item->id_groupe}}')">
                                                            <i class="fas fa-trash"></i> {{__('MyCustom.Supprimer')}}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $('#mytable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                exportOptions: {
                    columns: ':visible'
                },
                extend: 'print',
                customize: function ( win ) {
                    $(win.document.body)
                        .css('font-size', '10pt')
                        .css('margin', '2rem')
                        .prepend(
                            '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
                        );

                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                    $(win.document.body).find('th')
                        .css('color', 'black');
                }
            },
            'colvis',
            {
            extend: 'excelHtml5',
            exportOptions: {
                    columns: ':visible'
                },
            autoFilter: true,
            sheetName: 'Exported data'
        },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ],
        "pageLength": 4,

        "language": {
            "sEmptyTable": "",
            "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ entrées ",
            "sSearch": "Chercher:",
            "oPaginate": {
                "sNext": "Suivant",
                "sPrevious": "Précedent"
            }
        }
    });
});
function deleteForm(id){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {confirmButton: 'btn btn-success m-2', cancelButton: 'btn btn-danger m-2'},
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: 'Es-tu sûr?',
            text: "Vous ne pourrez pas revenir en arrière !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'OUI, supprimer !',
            cancelButtonText: 'NON, Annuler!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm' + id).submit();
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Annulé.',
                    'Votre fichier imaginaire est en sécurité. :)',
                    'error'
                )
            }
        })
    }
</script>
@if (session()->has('success'))
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: "{{ session()->get('success') }}",
        showConfirmButton: true,
        timer: 4000
    });
</script>
@endif
<!--****************************************************-->
@if (session()->has('error'))
<!-- Show an error message using SweetAlert when needed -->
<script>
    Swal.fire({
        icon: 'error',
        position: 'top-end',
        title: "{{ session()->get('error') }}",
        showConfirmButton: true,
        timer: 5000

    });
</script>
@endif
@if (session()->has('info'))
<!-- Show an error message using SweetAlert when needed -->
<script>
    Swal.fire({
        icon: 'info',
        position: 'top-end',
        title: "{{ session()->get('info') }}",
        showConfirmButton: true,
        timer: 5000

    });
</script>
@endif

@endsection
