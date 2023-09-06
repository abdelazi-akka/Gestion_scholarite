@extends("adminlte::page")
@section('title')
TASMIME WEB | {{__('MyCustom.Home')}}

@endsection
@section("content")
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card my-2 bg-light">
                <div class="card-body">
                    @if (Auth::user()->role=="administrateur")
                    <!----admin---->
                    <div class="row">
                        <div class="col-4">
                            <div class="small-box bg-gradient-gray">
                                <div class="inner">
                                    <h3 class="text-white">{{ \App\Models\User::where("role",1)->count()}}</h3>
                                    <p class="text-white">{{__('MyCustom.Nombre_du_chef_département')}}</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-graduate text-white"></i>
                                </div>
                                <a  class="small-box-footer" href="{{url('admin-utilisateurs')}}">
                                    {{__("MyCustom.Plus_d'infos")}} <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!---------------------------------------------------------------->
                        <div class="col-4">
                            <div class="small-box bg-gradient-success">
                                <div class="inner">
                                    <h3 class="text-white">{{ \App\Models\User::where("role",2)->count()}}</h3>
                                    <p class="text-white">{{__('MyCustom.Nombre_des_Fourmateurs')}}</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-solid fa-person-booth text-white"></i>
                                </div>
                                <a  class="small-box-footer" href="{{url('admin-utilisateurs')}}">
                                {{__("MyCustom.Plus_d'infos")}} <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ------------------------------------------------------------------>
                        <div class="col-4">
                            <div class="small-box bg-gradient-primary">
                                <div class="inner">
                                    <h3 class="text-white">{{ \App\Models\Filliere::count()}}</h3>
                                    <p class="text-white">{{__('MyCustom.Nombre_du_Filiére')}}</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-solid fa-person-booth text-white"></i>
                                </div>
                                <a  class="small-box-footer" href="{{route('admin-filliere.index')}}">
                                {{__("MyCustom.Plus_d'infos")}} <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!----chef-filliere---->
                    @elseif (Auth::user()->role==="chef_filliere")
                    <div class="row">
                        <div class="col-4">
                            <div class="small-box bg-gradient-gray">
                                <div class="inner">
                                    <h3 class="text-white">{{ \App\Models\Groupe::where("cin",Auth::user()->cin)->count()}}</h3>
                                    <p class="text-white">{{__('MyCustom.Nombre_des_groupes')}}</p>
                                </div>
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512">
                                        <path d="M72 88a56 56 0 1 1 112 0A56 56 0 1 1 72 88zM64 245.7C54 256.9 48 271.8 48 288s6 31.1 16 42.3V245.7zm144.4-49.3C178.7 222.7 160 261.2 160 304c0 34.3 12 65.8 32 90.5V416c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V389.2C26.2 371.2 0 332.7 0 288c0-61.9 50.1-112 112-112h32c24 0 46.2 7.5 64.4 20.3zM448 416V394.5c20-24.7 32-56.2 32-90.5c0-42.8-18.7-81.3-48.4-107.7C449.8 183.5 472 176 496 176h32c61.9 0 112 50.1 112 112c0 44.7-26.2 83.2-64 101.2V416c0 17.7-14.3 32-32 32H480c-17.7 0-32-14.3-32-32zm8-328a56 56 0 1 1 112 0A56 56 0 1 1 456 88zM576 245.7v84.7c10-11.3 16-26.1 16-42.3s-6-31.1-16-42.3zM320 32a64 64 0 1 1 0 128 64 64 0 1 1 0-128zM240 304c0 16.2 6 31 16 42.3V261.7c-10 11.3-16 26.1-16 42.3zm144-42.3v84.7c10-11.3 16-26.1 16-42.3s-6-31.1-16-42.3zM448 304c0 44.7-26.2 83.2-64 101.2V448c0 17.7-14.3 32-32 32H288c-17.7 0-32-14.3-32-32V405.2c-37.8-18-64-56.5-64-101.2c0-61.9 50.1-112 112-112h32c61.9 0 112 50.1 112 112z"/>
                                    </svg>

                                </div>
                                <a  class="small-box-footer" href="{{route('groupe.index')}}">
                                    {{__("MyCustom.Plus_d'infos")}} <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!---------------------------------------------------------------->
                        <div class="col-4">
                            <div class="small-box bg-gradient-success">
                                <div class="inner">
                                    <h3 class="text-white">{{ \App\Models\Module::where("id",Auth::user()->id)->count()}}</h3>
                                    <p class="text-white">{{__('MyCustom.Nombre_des_Modules')}}</p>
                                </div>
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <style>svg{fill:#ffffff}</style><path d="M160 96a96 96 0 1 1 192 0A96 96 0 1 1 160 96zm80 152V512l-48.4-24.2c-20.9-10.4-43.5-17-66.8-19.3l-96-9.6C12.5 457.2 0 443.5 0 427V224c0-17.7 14.3-32 32-32H62.3c63.6 0 125.6 19.6 177.7 56zm32 264V248c52.1-36.4 114.1-56 177.7-56H480c17.7 0 32 14.3 32 32V427c0 16.4-12.5 30.2-28.8 31.8l-96 9.6c-23.2 2.3-45.9 8.9-66.8 19.3L272 512z"/>
                                    </svg>
                                </div>
                                <a  class="small-box-footer" href="{{route('groupe.index')}}">
                                    {{__("MyCustom.Plus_d'infos")}} <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ------------------------------------------------------------------>

                    </div>
                    <!----Fourmateur---->
                    @elseif (Auth::user()->role==="fourmateur")
                    <div class="row">
                        <div class="col-4">
                            <div class="small-box bg-gradient-info">
                                <div class="inner">
                                    <h3 class="text-white">{{ \App\Models\Inscription::where("id_prof",Auth::user()->id)->distinct()->count('id_groupe')}}</h3>
                                    <p class="text-white">{{__('MyCustom.Nombre_des_groupes')}}</p>
                                </div>
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512">
                                    <style>svg{fill:#ffffff}</style><path d="M72 88a56 56 0 1 1 112 0A56 56 0 1 1 72 88zM64 245.7C54 256.9 48 271.8 48 288s6 31.1 16 42.3V245.7zm144.4-49.3C178.7 222.7 160 261.2 160 304c0 34.3 12 65.8 32 90.5V416c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V389.2C26.2 371.2 0 332.7 0 288c0-61.9 50.1-112 112-112h32c24 0 46.2 7.5 64.4 20.3zM448 416V394.5c20-24.7 32-56.2 32-90.5c0-42.8-18.7-81.3-48.4-107.7C449.8 183.5 472 176 496 176h32c61.9 0 112 50.1 112 112c0 44.7-26.2 83.2-64 101.2V416c0 17.7-14.3 32-32 32H480c-17.7 0-32-14.3-32-32zm8-328a56 56 0 1 1 112 0A56 56 0 1 1 456 88zM576 245.7v84.7c10-11.3 16-26.1 16-42.3s-6-31.1-16-42.3zM320 32a64 64 0 1 1 0 128 64 64 0 1 1 0-128zM240 304c0 16.2 6 31 16 42.3V261.7c-10 11.3-16 26.1-16 42.3zm144-42.3v84.7c10-11.3 16-26.1 16-42.3s-6-31.1-16-42.3zM448 304c0 44.7-26.2 83.2-64 101.2V448c0 17.7-14.3 32-32 32H288c-17.7 0-32-14.3-32-32V405.2c-37.8-18-64-56.5-64-101.2c0-61.9 50.1-112 112-112h32c61.9 0 112 50.1 112 112z"/>
                                    </svg>
                                </div>
                                <a  class="small-box-footer" href="{{route('fourmateur-groupe.index')}}">
                                    {{__("MyCustom.Plus_d'infos")}} <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-------------------------------------------------------------------------------------------------------->

                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
