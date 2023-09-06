<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AffectationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Groupe::where('cin',Auth::user()->cin)->get();
        return view('Groupes.liste_groupes',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modules=Module::where("id",Auth::user()->id)->get();
        $groupes=Groupe::where("cin",Auth::user()->cin)->get();
        $fourmateurs=User::where("role",2)->get();
        return view('Affectations.ajouter_affectation',compact('modules','groupes',"fourmateurs"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_groupe' => 'required|exists:groupes,id_groupe',
            'id_prof' => 'required|exists:users,id',
            'id_module' => [
                'required',
                'exists:modules,id_module',
                Rule::unique('inscriptions')->where(function ($query) use ($request) {
                    return $query->where('id_groupe', $request->id_groupe);
                })
            ]
        ]);

        try {
            DB::beginTransaction();

            // Insert the new record into the inscriptions table
            DB::table('inscriptions')->insert([
                'id_groupe' => $request->id_groupe,
                'id_module' => $request->id_module,
                'id_prof' => $request->id_prof,
            ]);

            // Update the associated module's 'cin' field
            $profCin = DB::table('users')->where('id', $request->id_prof)->value('cin');
            DB::table('modules')->where('id_module', $request->id_module)->update(['cin' => $profCin]);
            //DB::table('module_etudiant')->insert(["id_module"=>$request->id_module]);

            DB::commit();

            return redirect()->route('affectation.show', $request->id_groupe)->with('success', 'Affectation ajoutée avec succès');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'ajout de l\'affectation');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $data=DB::select("SELECT * FROM groupe_module WHERE groupe_module.id_groupe='{$id}'");
        $groupes=Groupe::find($id);
        $modules=DB::select("SELECT modules.*,users.*,inscriptions.* from inscriptions inner join modules on
        inscriptions.id_module=modules.id_module INNER JOIN users
        ON modules.cin=users.cin where inscriptions.id_groupe=?",[$id]);
        return view("Affectations.details_affectation",compact("groupes","modules"));
        // return $modules;

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $modules=Module::where("id",Auth::user()->id)->get();
        $groupes=Groupe::where("cin",Auth::user()->cin)->get();
        $fourmateurs=User::where("role",2)->get();
        $data=DB::table("inscriptions")->where("id_affectation","=",$id)->first();
        return view("Affectations.modifier_affectation",compact("modules","groupes","fourmateurs","data"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $existingAffectation = DB::table('inscriptions')->where("id_affectation", $id)->first();

    if (!$existingAffectation) {
        // Handle the case where the affectation doesn't exist
        return redirect()->route('affectation.index')->with('error', 'Affectation not found');
    }

    $request->validate([
        'id_module' => 'required|exists:modules,id_module',
        'id_groupe' => 'required|exists:groupes,id_groupe',
        'id_prof' => 'required|exists:users,id',
        'id_module' => Rule::unique('inscriptions')->where(function ($query) use ($request, $id) {
            return $query->where('id_groupe', $request->id_groupe)->where('id_affectation', '<>', $id);
        }),
    ]);

    if ($existingAffectation->id_groupe != $request->id_groupe ||
        $existingAffectation->id_module != $request->id_module ||
        $existingAffectation->id_prof != $request->id_prof) {

        DB::table('inscriptions')
            ->where('id_affectation', $id)
            ->update([
                'id_groupe' => $request->id_groupe,
                'id_module' => $request->id_module,
                'id_prof' => $request->id_prof,
            ]);

            $profCin = DB::table('users')->where('id', $request->id_prof)->value('cin');
            DB::table('modules')->where('id_module', $request->id_module)->update(['cin' => $profCin]);;

        return redirect()->route('affectation.show',$request->id_groupe)->with('success', 'Affectation mise à jour avec succès');
    }

    return redirect()->route('affectation.show',$request->id_groupe)->with('info', 'Aucun changement détecté dans l\'affectation');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=DB::delete("DELETE FROM inscriptions WHERE inscriptions.id_affectation=?",[$id]);
        return redirect()->route('affectation.index')->with('success', 'Affectation supprimée avec succès');
    }
}
