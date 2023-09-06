@extends('adminlte::page')
@section('plugins.Datatables',true)
@section('title')
    TASMIME WEB | {{__('MyCustom.Gestion_des_étudiants')}}
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card my-2 bg-light">
                <div class="card-header" style="background:linear-gradient(to right top, #c8c790, #b2c89a, #a0c8a7, #94c6b3, #8fc2bd);">
                    <div class="text-center">
                        <h3 class="text-white">{{__('MyCustom.La_liste_des_étudiants')}}</h3>
                    </div>
                </div>
                <div class="card-body" style="overflow-x:auto;">
                    <!-- Form for filtering users based on role -->
                    <form class="row mb-2" action="{{route('import-etudiant')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-8">
                            <input type="file" name="excel_file" class="form-control mt-1"/>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn text-dark btn-outline-orange w-100 mt-1" type="submit">{{__('MyCustom.Upload')}}</button>
                        </div>
                    </form>
                    <table id="mytable" class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>{{__('MyCustom.last_name')}}</th>
                                <th>{{__('MyCustom.First_name')}}</th>
                                <th>CIN</th>
                                <th>Adresse</th>
                                <th>Téléphonne</th>
                                <th>CNE</th>
                                <th>Numero Appoge</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through the users data and display them in the table -->
                            @foreach($data as $item)
                                <tr class="text-center">
                                    <td data-label="{{__('MyCustom.last_name')}}">{{ $item->nom }}</td>
                                    <td data-label="{{__('MyCustom.First_name')}}">{{ $item->prenom }}</td>
                                    <td data-label="CIN">{{ $item->cin }}</td>
                                    <td data-label="Adresse">{{ $item->adresse }}</td>
                                    <td data-label="Téléphonne">{{ $item->telephonne }}</td>
                                    <td data-label="CNE">{{ $item->cne }}</td>
                                    <td data-label="Numero Appoge">{{ $item->num_appoge }}</td>
                                    <td data-label="Actions">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $item->id_groupe }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $item->id_etudiant}}">
                                                <a class="dropdown-item" href="{{ route('Etudiant.edit', $item->id_etudiant) }}">
                                                    <i class="fas fa-edit"></i> {{__('MyCustom.Modifier')}}
                                                </a>
                                                <form id="deleteForm{{ $item->id_etudiant}}" action="{{ route('Etudiant.destroy', $item->id_etudiant) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="button" class="dropdown-item" onclick="deleteForm('{{ $item->id_etudiant}}')">
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
    $(document).ready(function(){
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
                        // .prepend(
                        //     '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
                        // );

                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                    $(win.document.body).find('th')
                        .css('color', 'black')
                        .css('background-color', '#f5f5f5');
                    $(win.document.body).find('td')
                        .css('color', 'black')
                        .css('background-color', 'white')
                        //text-center
                        .css('text-align', 'center');
                }
            },
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
            },
            'colvis',
        ],
            "pageLength": 4,

            "language": {
                "sEmptyTable": "",
                "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ entrées ",
                "sSearch": "Chercher:",
                "oPaginate": {
                    "sNext": "Suivant",
                    "sPrevious": "Précedent"
                },
            }
        });
    });

    // Function to confirm and handle user deletion
    function deleteForm(id){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: { confirmButton: 'btn btn-success m-2', cancelButton: 'btn btn-danger m-2' },
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
                );
            }
        });
    }
</script>
@if (session()->has('success'))
<!-- Show a success message using SweetAlert when needed -->
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: "{{ session()->get('success') }}",
        showConfirmButton: true,
        timer: 5000
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
