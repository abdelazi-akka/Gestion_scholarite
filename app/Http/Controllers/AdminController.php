<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("dashboard");
    }
    /********************************** */
    public function getUtilisateur(Request $request)
    {
        $typeUser=$request->typeUser;
        $users=User::where("role",$typeUser)->get();
        return view("users.liste_users",compact("users"));
        // return $users;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("users.add_users");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'cin' => ['required', 'string', 'max:255','unique:'.User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role'=>['required']
        ]);
        $role=0;
        $status="";
        if($request->role==2){
            $role=2;
            $status="Permanent";
        }else if($request->role==3){
            $role=2;
            $status="Vacataire";
        }else{
            $role=$request->input("role");
            $status = null;
        }
        User::create([
            'nom' => $request->nom,
            'prenom'=>$request->prenom,
            'cin'=>$request->cin,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'=>$role,
            'status'=>$status


        ]);
        return redirect()->route("admin-utilisateurs")->with("success","Utilisateur ajouté avec succès");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user=User::where("id",$id)->first();
        return view("users.show_users",compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user=User::where("id",$id)->first();
        return view("users.edit_users",compact("user"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role=0;
        $status="";
        if($request->role==2){
            $role=2;
            $status="Permanent";
        }else if($request->role==3){
            $role=2;
            $status="Vacataire";
        }else{
            $role=$request->input("role");
            $status = null;
        }
        $user =User::find($id);
        $oldCin = $request->input("old_cin");
        $oldEmail = $request->input("old_email");

        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'cin' => ['required', 'string', 'max:255', 'unique:users,cin,' . $user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->nom = $request->input('nom');
        $user->prenom = $request->input('prenom');
        $user->cin = $request->input('cin');
        $user->email = $request->input('email');
        $user->role=$role;
        $user->status=$status;
        $user->save();
            return redirect()->route("admin-utilisateurs")->with(["success"=>"un utilisateur a été modifié"]);
        }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user=User::where("id",$id)->first();
        $user->delete();
        return redirect()->route("admin-utilisateurs")->with("success","Utilisateur supprimé avec succès");
    }
}
