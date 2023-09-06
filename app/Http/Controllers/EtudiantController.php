<?php

namespace App\Http\Controllers;

use App\Imports\EtudiantImport;
use App\Models\Etudiant;
use App\Models\Groupe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class EtudiantController extends Controller
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
        $groupes=Groupe::where("cin",Auth::user()->cin)->get();
        return view('Etudiants.add_etudiant',compact('groupes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nom'=>['required','string','max:255'],
    //         'prenom'=>['required','string','max:255'],
    //         'cin'=>['required','string','max:255',Rule::unique('etudiants','cin')],
    //         'cne'=>['required','string','max:255',Rule::unique('etudiants','cne')],
    //         'code_groupe'=>['required','string','max:255'],
    //         'telephonne'=>['required','string','max:255'],
    //         'num_appoge'=>['required','string','max:255',Rule::unique('etudiants','num_appoge')],
    //         'adresse'=>['required','string','max:255']
    //     ]);

    //     Etudiant::create([
    //         'nom'=>$request->nom,
    //         'prenom'=>$request->prenom,
    //         'cin'=>$request->cin,
    //         'cne'=>$request->cne,
    //         'code_groupe'=>$request->code_groupe,
    //         'telephonne'=>$request->telephonne,
    //         'num_appoge'=>$request->num_appoge,
    //         'adresse'=>$request->adresse,
    //     ]);

    //     return redirect()->route("Etudiant.show",$request->code_groupe)->with(["success"=>"Un étudiant a été ajouté"]);
    // }
    public function store(Request $request)
{
    try {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'cin' => ['required', 'string', 'max:255', Rule::unique('etudiants', 'cin')],
            'cne' => ['required', 'string', 'max:255', Rule::unique('etudiants', 'cne')],
            'code_groupe' => ['required', 'string', 'max:255'],
            'telephonne' => ['required', 'string', 'max:255'],
            'num_appoge' => ['required', 'string', 'max:255', Rule::unique('etudiants', 'num_appoge')],
            'adresse' => ['required', 'string', 'max:255'],
        ]);

        Etudiant::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'cin' => $request->cin,
            'cne' => $request->cne,
            'code_groupe' => $request->code_groupe,
            'telephonne' => $request->telephonne,
            'num_appoge' => $request->num_appoge,
            'adresse' => $request->adresse,
        ]);

        return redirect()->route("Etudiant.show", $request->code_groupe)->with(["success" => "Un étudiant a été ajouté"]);
    } catch (\Exception $e) {
        // Handle the exception, log it, or return an error response
        return redirect()->back()->with(["error" => "Une erreur est survenue : " . $e->getMessage()]);
    }
}



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data=Etudiant::where('code_groupe',$id)->get();
        return view('Etudiants.liste_etudiants',compact('data'));
        //return $data;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data=Etudiant::find($id);
        $groupes=Groupe::where("cin",Auth::user()->cin)->get();
        return view('Etudiants.edit_etudiant',compact('data','groupes'));
    }

    /**
     * Update the specified resource in storage.
     */
//     public function update(Request $request, $id)
// {
//     $etudiant = Etudiant::find($id);

//     $request->validate([
//         'nom' => ['required', 'string', 'max:255'],
//         'prenom' => ['required', 'string', 'max:255'],
//         'cin' => [
//             'required',
//             'string',
//             'max:255',
//             Rule::unique('etudiants', 'cin')
//                 ->ignore($etudiant),
//         ],
//         'cne' => [
//             'required', 'string', 'max:255',
//             Rule::unique('etudiants', 'cne')
//                 ->ignore($etudiant),
//         ],
//         'code_groupe' => ['required', 'string', 'max:255'],
//         'telephonne' => ['required', 'string', 'max:255'],
//         'num_appoge' => [
//             'required', 'string', 'max:255',
//             Rule::unique('etudiants', 'num_appoge')
//                 ->ignore($etudiant),
//         ],
//         'adresse' => ['required', 'string', 'max:255']
//     ]);

//     // Update the student's information
//     $etudiant->update([
//         'nom' => $request->nom,
//         'prenom' => $request->prenom,
//         'cin' => $request->cin,
//         'cne' => $request->cne,
//         'code_groupe' => $request->code_groupe,
//         'telephonne' => $request->telephonne,
//         'num_appoge' => $request->num_appoge,
//         'adresse' => $request->adresse,
//     ]);

//     return redirect()->route("Etudiant.show", $etudiant->code_groupe)->with(["success" => "Un étudiant a été modifié"]);
// }
public function update(Request $request, $id)
{
    try {
        $etudiant = Etudiant::find($id);

        if (!$etudiant) {
            return redirect()->route('Etudiant.show', $etudiant->code_groupe)->with('error', 'Étudiant introuvable.');
        }

        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'cin' => [
                'required',
                'string',
                'max:255',
                Rule::unique('etudiants', 'cin')->ignore($etudiant),
            ],
            'cne' => [
                'required', 'string', 'max:255',
                Rule::unique('etudiants', 'cne')->ignore($etudiant),
            ],
            'code_groupe' => ['required', 'string', 'max:255'],
            'telephonne' => ['required', 'string', 'max:255'],
            'num_appoge' => [
                'required', 'string', 'max:255',
                Rule::unique('etudiants', 'num_appoge')->ignore($etudiant),
            ],
            'adresse' => ['required', 'string', 'max:255'],
        ]);

            $etudiant->update([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'cin' => $request->cin,
                'cne' => $request->cne,
                'code_groupe' => $request->code_groupe,
                'telephonne' => $request->telephonne,
                'num_appoge' => $request->num_appoge,
                'adresse' => $request->adresse,
            ]);
            if ($etudiant->wasChanged()) {

            return redirect()->route('Etudiant.show', $etudiant->code_groupe)->with('success', 'Étudiant modifié avec succès.');
        } else {
            return redirect()->route('Etudiant.show', $etudiant->code_groupe)->with('info', 'Aucune modification détectée.');
        }
    } catch (\Exception $e) {
        return redirect()->route('Etudiant.show', $etudiant->code_groupe)->with('error', 'Une erreur est survenue : ' . $e->getMessage());
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $etudiant=Etudiant::find($id);
        $etudiant->delete();
        return redirect()->back()->with('success', 'Etudiant supprimé avec succès.');
    }
}
