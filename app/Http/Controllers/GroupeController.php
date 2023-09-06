<?php

namespace App\Http\Controllers;


use App\Models\Filliere;
use App\Models\Groupe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule as ValidationRule;

class GroupeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->is("chef-filliere/groupe")){
            $data=Groupe::where('cin',Auth::user()->cin)->get();
            //return $data;
            return view('Groupes.liste_groupes',compact('data'));
        }else if($request->is("fourmateur-groupe")){
            $data = Groupe::select('groupes.*')
    ->distinct()
    ->join('inscriptions', 'groupes.id_groupe', '=', 'inscriptions.id_groupe')
    ->where('inscriptions.id_prof', Auth::user()->id)
    ->get();
            return view('Groupes.liste_groupes',compact('data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $filliere=Filliere::all();
        return view('groupes.ajouter_groupe',compact("filliere"));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate(['code_groupe' => ['required', 'string', 'max:255', 'unique:groupes,code_groupe'],
    //         'nom_groupe' => ['required', 'string', 'max:255'],
    //         'code_filliere' => ['required','exists:fillieres,code_filliere'],

    //     ]);
    //     $groupe=new Groupe();
    //     $groupe->code_groupe=$request->input('code_groupe');
    //     $groupe->nom_groupe=$request->input('nom_groupe');
    //     $groupe->cin=Auth::user()->cin;
    //     $groupe->code_filliere=$request->code_filliere;
    //     $groupe->save();
    //     return redirect()->route('groupe.index')->with('success','Groupe ajouté avec succés');
    // }
    /*-------------------------------------------------*/
    public function store(Request $request)
    {
        try {
            $request->validate([
                'code_groupe' => ['required', 'string', 'max:255', 'unique:groupes,code_groupe'],
                'nom_groupe' => ['required', 'string', 'max:255'],
                'code_filliere' => ['required', 'exists:fillieres,code_filliere'],
            ]);

            $groupe = new Groupe();
            $groupe->code_groupe = $request->input('code_groupe');
            $groupe->nom_groupe = $request->input('nom_groupe');
            $groupe->cin = Auth::user()->cin;
            $groupe->code_filliere = $request->input('code_filliere');
            $groupe->save();

            return redirect()->route('groupe.index')->with('success', 'Groupe ajouté avec succès');
        } catch (\Exception $e) {
            // Handle the exception, log it, or return an error response
            return redirect()->route('groupe.index')->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    /*-------------------------------------------------*/

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data=Groupe::find($id);
        return view('groupes.detail_groupe',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $filliere=Filliere::all();
        $data=Groupe::find($id);
        return view('groupes.modifier_groupe',compact('data','filliere'));
    }


     public function update(Request $request, $id)
{
    try {
        $groupe = Groupe::find($id);

        if (!$groupe) {
            return redirect()->route('groupe.index')->with('error', 'Groupe introuvable.');
        }

       $request->validate([
            'nom_groupe' => ['required', 'string', 'max:255'],
            // 'code_groupe' => ['required', 'string', 'max:255',Rule::unique('groupes', 'code_groupe')->ignore($groupe->id)],
                'code_groupe' => [
                    'required', 'string', 'max:255',
                    ValidationRule::unique('groupes', 'code_groupe')
                        ->where(function ($query) use ($groupe) {
                            $query->where('id_groupe', '<>', $groupe->id_groupe);
                        }),
                ],
                'code_filliere' => ['required','exists:fillieres,code_filliere'],
        ]);

        $groupe->update([
            'nom_groupe' => $request->input('nom_groupe'),
            'code_groupe' => $request->input('code_groupe'),
            'code_filliere' => $request->input('code_filliere'),
        ]);

        if ($groupe->wasChanged()) {
            return redirect()->route('groupe.index')->with('success', 'Groupe modifié avec succès.');
        } else {
            return redirect()->route('groupe.index')->with('info', 'Aucune modification détectée.');
        }
    } catch (\Exception $e) {
        return redirect()->route('groupe.index')->with('error', 'Une erreur est survenue : ' . $e->getMessage());
    }
}

    // public function update(Request $request,$id)
    // {
    //     $groupe=Groupe::find($id);
    //     $request->validate([
    //         'nom_groupe' => ['required', 'string', 'max:255'],
    //         // 'code_groupe' => ['required', 'string', 'max:255',Rule::unique('groupes', 'code_groupe')->ignore($groupe->id)],
    //             'code_groupe' => [
    //                 'required', 'string', 'max:255',
    //                 ValidationRule::unique('groupes', 'code_groupe')
    //                     ->where(function ($query) use ($groupe) {
    //                         $query->where('id_groupe', '<>', $groupe->id_groupe);
    //                     }),
    //             ],
    //             'code_filliere' => ['required','exists:fillieres,code_filliere'],
    //     ]);

    //     $groupe->update([
    //         'nom_groupe' => $request->input('nom_groupe'),
    //         'code_groupe' => $request->input('code_groupe'),
    //         'code_filliere' => $request->input('code_filliere'),
    //     ]);

    //     return redirect()->route('groupe.index')->with('success', 'Groupe modifié avec succès');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $groupe=Groupe::find($id);
        $groupe->delete();
        return redirect()->route('groupe.index');
    }
}
