@extends('adminlte::page')
@section('plugins.Datatables',true)
@section('title')
TASMIME WEB | {{__('MyCustom.Gestion_des_Modules')}}
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card my-2 bg-light">
                <div class="card-header" style="background:linear-gradient(to right top, #c8c790, #b2c89a, #a0c8a7, #94c6b3, #8fc2bd);">
                    <div class="text-center">
                        <h3 class="text-white">{{__('MyCustom.La_liste_des_modules')}}</h3>
                    </div>
                </div>
                <div class="card-body" style="overflow-x:auto;">
                    <table id="mytable" class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>{{__('MyCustom.Code_Module')}}</th>
                                <th>{{__('MyCustom.Intitulé_du_Module')}}</th>
                                <th>{{__('MyCustom.Semestre')}}</th>
                                <th>{{__('MyCustom.Intitulé_Filiére')}}</th>
                                <th>{{__('MyCustom.Fourmateur')}}</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                                <tr class="text-center">
                                    <td data-label="{{__('MyCustom.Code_Module')}}">{{ $item->code_module}}</td>
                                    <td data-label="{{__('MyCustom.Intitulé_du_Module')}}">{{ $item->intitule_module}}</td>
                                    <td data-label="{{__('MyCustom.Semestre')}}">{{ $item->semestre_module}}</td>
                                    <td data-label="{{__('MyCustom.Intitulé_Filiére')}}">{{ $item->filliere->intitule_filliere}}</td>
                                    <td data-label="{{__('MyCustom.Fourmateur')}}">{{ $item->fourmateur->nom.' '.$item->fourmateur->prenom}}</td>
                                    <td data-label="Actions">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $item->id_module }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $item->id_module}}">
                                                <a class="dropdown-item" href="{{ route('module.show', $item->id_module) }}">
                                                    <i class="fas fa-eye"></i> {{__('MyCustom.Voir')}}
                                                </a>
                                                <a class="dropdown-item" href="{{ route('module.edit', $item->id_module) }}">
                                                    <i class="fas fa-edit"></i> {{__('MyCustom.Modifier')}}
                                                </a>
                                                <form id="deleteForm{{ $item->id_module }}" action="{{ route('module.destroy', $item->id_module) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="button" class="dropdown-item" onclick="deleteForm('{{$item->id_module}}')">
                                                        <i class="fas fa-trash"></i> {{__('MyCustom.Supprimer')}}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
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
<!-- DataTables script for table sorting and filtering -->
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
        },initComplete: function () {
            this.api()
                .columns()
                .every(function () {
                    var column = this;
                    var select = $("<select class='form-control'><option value=''></option></select>")
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });
                });
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
<!-- Show a success message using SweetAlert when needed -->
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: "{{ session()->get('success') }}",
        showConfirmButton: false,
        timer: 1500
    });
</script>
@endif
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
