<?php

namespace App\Providers;
use App\AdminLTE\AccountMenuBuildingEvent;
// use App\Models\Handbook;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Dispatcher $events)
    {

        app('view')->addNamespace('adminlte', resource_path("views/vendor/adminlte"));
        app('translator')->addNamespace("site", resource_path("lang/vendor/site"));

        // Account menu
        // $events->listen(AccountMenuBuildingEvent::class, function (AccountMenuBuildingEvent $event) {
            $events->listen(AccountMenuBuildingEvent::class, function ( $event) {

            foreach (config("app.account.navigation") as $item) {
                $event->menu->add($item);
            }
        });

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            if(auth()->user()->role=='administrateur'){
            $event->menu->add(
                    // ['header' => 'NAVIGATION_PRINCIPALE'],<i class="fa-solid fa-users-gear"></i>
                        [
                            'text' => Lang::get("MyCustom.profile"),
                            'url'  => '/profile',
                            'icon' => 'fas fa-fw fa-user',
                        ],
                        [
                        'text' => '',
                        'topnav_right' => true,
                        'icon' => 'fas fa-language',
                        'submenu' => [
                                [
                                    'text'=>Lang::get("MyCustom.English"),
                                    'icon' => 'fas fa-flag-usa',
                                    "url"=>route("languageConverter",'en'),
                                ],
                                [
                                    'text'=>Lang::get("MyCustom.Frensh"),
                                    'icon' => 'fas fa-flag-usa',
                                    "url"=>route("languageConverter",'fr'),
                                ]
                            ]
                        ],
                        [
                            'text' => Lang::get("MyCustom.Home"),
                            'url'  => 'dashboard/admin',
                            'icon' => 'fas fa-tachometer-alt',
                        ],
                        [
                            'text' => Lang::get("MyCustom.Gestion_des_utilisateurs"),
                            'icon' => 'fas fa-solid fa-users',
                            'submenu'=>[
                                [
                                    "text"=>Lang::get("MyCustom.La_liste_des_utilisateurs"),
                                    "url"=>"admin-utilisateurs",
                                    "icon"=>"fas fa-list"
                                ],
                                [
                                    "text"=>Lang::get("MyCustom.Ajouter_un_utilisateur"),
                                    "url"=>"dashboard/admin/create",
                                    "icon"=>"fas fa-user-plus"
                                ]
                            ]
                        ],
                        [
                            'text' => Lang::get("MyCustom.Gestion_des_Filiére"),
                            'icon' => 'fas fa-bezier-curve',
                            'submenu'=>[
                                [
                                    "text"=>Lang::get("MyCustom.La_liste_des_Filiéres"),
                                    "url" =>"admin-filliere",
                                    "icon"=>"fas fa-list"
                                ],
                                [
                                    "text"=>Lang::get("MyCustom.Ajouter_une_Filiére"),
                                    "url"=>"admin-filliere/create",
                                    "icon"=>"fas fa-plus-square"
                                ]
                            ]
                        ],
        );
        /***************************************************************************** */
        }elseif (auth()->user()->role=='chef_filliere'){
            $event->menu->add(
                // ['header' => 'NAVIGATION_PRINCIPALE'],<i class="fa-solid fa-users-gear"></i>
                    [
                        'text' => Lang::get("MyCustom.profile"),
                        'url'  => '/profile',
                        'icon' => 'fas fa-fw fa-user',
                    ],
                    [
                    'text' => '',
                    'topnav_right' => true,
                    'icon' => 'fas fa-language',
                    'submenu' => [
                            [
                                'text'=>Lang::get("MyCustom.English"),
                                'icon' => 'fas fa-flag-usa',
                                "url"=>route("languageConverter",'en'),
                            ],
                            [
                                'text'=>Lang::get("MyCustom.Frensh"),
                                'icon' => 'fas fa-flag-usa',
                                "url"=>route("languageConverter",'fr'),
                            ]
                        ]
                    ],
                    [
                        'text' => Lang::get("MyCustom.Home"),
                        'url'  => '/dashboard/chef-filiere',
                        'icon' => 'fas fa-tachometer-alt',
                    ],
                    [
                        'text' =>Lang::get("MyCustom.Gestion_des_Groupes"),
                        'icon' => 'fas fa-users',
                        'submenu'=>[
                            [
                                "text"=>Lang::get("MyCustom.La_liste_des_groupes"),
                                "url"=>"chef-filliere/groupe",
                                "icon"=>"fa fa-th"
                            ],
                            [
                                "text"=>Lang::get("MyCustom.Ajouter_un_groupe"),
                                "url"=>"chef-filliere/groupe/create",
                                "icon"=>"fa fa-user-plus"
                            ]
                        ]
                    ],
                    [
                        'text' =>Lang::get("MyCustom.Gestion_des_Modules"),
                        'icon' => 'fas fa-book',
                        'submenu'=>[
                            [
                                "text"=>Lang::get("MyCustom.La_liste_des_modules"),
                                "url" =>"chef-filliere/module",
                                "icon"=>"fas fa-list-ol"
                            ],
                            [
                                "text"=>Lang::get("MyCustom.Ajouter_un_module"),
                                "url"=>"chef-filliere/module/create",
                                "icon"=>"fas fa-book-medical"
                            ]
                        ]
                    ],
                    [
                        'text' =>Lang::get("MyCustom.Gestion_des_Affectations"),
                        'icon' => 'fas fa-solid fa-people-arrows',
                        'submenu'=>[
                            [
                                "text"=>Lang::get("MyCustom.La_liste_des_Affectations"),
                                "url" =>"chef-filliere/affectation",
                                "icon"=>"fas fa-list-ol"
                            ],
                            [
                                "text"=>Lang::get("MyCustom.Ajouter_une_Affectation"),
                                "url"=>"chef-filliere/affectation/create",
                                "icon"=>"fas fa-walking"
                            ]
                        ]
                    ],
                    [
                        'text' =>Lang::get("MyCustom.Gestion_des_étudiants"),
                        'icon' => 'fas fa-solid fa-address-book',
                        'submenu'=>[
                            [
                                "text"=>Lang::get("MyCustom.La_liste_des_étudiants"),
                                "url" =>"chef-filliere/Etudiant",
                                "icon"=>"fas fa-list-ol"
                            ],
                            [
                                "text"=>Lang::get("MyCustom.Ajouter_un_étudiant"),
                                "url"=>"chef-filliere/Etudiant/create",
                                "icon"=>"fas fa-solid fa-user-plus"
                            ]
                        ]
                    ],
    );
        }elseif (auth()->user()->role=='fourmateur'){
            $event->menu->add(
                // ['header' => 'NAVIGATION_PRINCIPALE'],<i class="fa-solid fa-users-gear"></i>
                    [
                        'text' => Lang::get("MyCustom.profile"),
                        'url'  => '/profile',
                        'icon' => 'fas fa-fw fa-user',
                    ],
                    [
                    'text' => '',
                    'topnav_right' => true,
                    'icon' => 'fas fa-language',
                    'submenu' => [
                            [
                                'text'=>Lang::get("MyCustom.English"),
                                'icon' => 'fas fa-flag-usa',
                                "url"=>route("languageConverter",'en'),
                            ],
                            [
                                'text'=>Lang::get("MyCustom.Frensh"),
                                'icon' => 'fas fa-flag-usa',
                                "url"=>route("languageConverter",'fr'),
                            ]
                        ]
                    ],
                    [
                        'text' => Lang::get("MyCustom.Home"),
                        'url'  => '/dashboard/fourmateur',
                        'icon' => 'fas fa-tachometer-alt',
                    ],
                    [
                        'text' =>Lang::get("MyCustom.Gestion_des_Groupes"),
                        'icon' => 'fas fa-users',
                        'submenu'=>[
                            [
                                "text"=>Lang::get("MyCustom.La_liste_des_groupes"),
                                "url"=>"fourmateur-groupe",
                                "icon"=>"fa fa-th"
                            ],
                            // [
                            //     "text"=>Lang::get("MyCustom.Ajouter_un_groupe"),
                            //     "url"=>"chef-filliere/groupe/create",
                            //     "icon"=>"fa fa-user-plus"
                            // ]
                        ]
                    ],
                );
        }
        });
    }
}
