<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Groupe;
use App\Models\Inscription;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create(Request $request)
    // {
    //     $cin = $request->cin;
    //     session(['cin' => $cin]);
    //     $dataEtudiant = Etudiant::where("cin", $cin)->first();
    //     $dataGroupe = Groupe::where("code_groupe", $dataEtudiant->code_groupe)->first();
    //     $dataInscription = Inscription::where("id_groupe", $dataGroupe->id_groupe)->get();
    //     $id_module = $dataInscription->pluck('id_module')->toArray();
    //     $dataModules = Module::whereIn("id_module", $id_module)->get();
    //     // $dataModules=DB::select("SELECT * from modules where id_module not in (
    //     //     select module_etudiant.id_module from module_etudiant where id_etudiant=?
    //     // )",[$dataEtudiant->id_etudiant]);
    //     //$dataNote = DB::select("SELECT * FROM module_etudiant WHERE module_etudiant.id_module IN (" . implode(",", $id_module) . ")");
    //     return $dataModules;
    //     //return view('Notes.ajouter_notes', compact('dataEtudiant', 'dataGroupe', 'dataInscription', 'dataModules', 'dataNote'));
    // }
    public function create(Request $request)
    {
        $cin = $request->cin;
        session(['cin' => $cin]);

        // Get the student's information
        $dataEtudiant = Etudiant::where("cin", $cin)->first();
        $dataGroupe = Groupe::where("code_groupe", $dataEtudiant->code_groupe)->first();

        // Get the IDs of modules assigned to the group
        $moduleIdsAssignedToGroup = Inscription::where("id_groupe", $dataGroupe->id_groupe)->where("id_prof",Auth::user()->id)->pluck('id_module')->toArray();

        // Get the IDs of modules that are already assigned to the student
        $moduleIdsAssignedToStudent = DB::table('module_etudiant')
            ->where("id_etudiant", $dataEtudiant->id_etudiant)
            ->pluck('id_module')
            ->toArray();

        // Calculate the difference to find modules not assigned to the student
        $moduleIdsNotAssignedToStudent = array_diff($moduleIdsAssignedToGroup, $moduleIdsAssignedToStudent);

        // Get the details of modules that are not assigned to the student
        $dataModules = DB::table('modules')
            ->whereIn("id_module", $moduleIdsNotAssignedToStudent)
            ->get();

        //return $dataModules;
        return view("Notes.ajouter_notes",compact('dataModules','dataEtudiant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputData = $request->all();
        $dataEtudiant = Etudiant::find($request->id_etudiant);
        $dataGroupe = Groupe::where("code_groupe", $dataEtudiant->code_groupe)->first();

    try {
        DB::table('module_etudiant')->insert([
            'id_module' => $inputData['id_module'],
            'id_etudiant' => $inputData['id_etudiant'],
            'note' => $inputData['note']
        ]);
        return redirect()->route("fourmateur-notes.show",$dataGroupe->code_groupe)->with('success', 'Module etudiant record has been created successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while creating the module etudiant record: ' . $e->getMessage());
    }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Get the ID of the currently logged-in trainer (formateur)
        $formateurId = Auth::user()->id;
        $data_groupe=Groupe::where('code_groupe',$id)->first();
        // $id_groupe=0;
        // foreach($data_groupe as $item){

        // }

        // Check if the trainer is associated with the requested group
        $isTrainerAssociatedWithGroup = DB::table('inscriptions')
            ->where('id_prof', $formateurId)
            ->where('id_groupe', $data_groupe->id_groupe)
            ->exists();

        if (!$isTrainerAssociatedWithGroup) {
            // Handle the case where the trainer is not associated with the requested group
            return view("404");
        }

        $etudiants = Etudiant::with('modules')->where('code_groupe', $id)->get();
        $organizedData = [];

        foreach ($etudiants as $etudiant) {
            $modules = [];
            foreach ($etudiant->modules as $module) {
                $modules[] = [
                    'intitule_module' => $module->intitule_module,
                    'note' => $module->pivot->note,
                ];
            }

            $organizedData[] = [
                'nom' => $etudiant->nom,
                'prenom' => $etudiant->prenom,
                'num_appoge' => $etudiant->num_appoge,
                'code_groupe' => $etudiant->code_groupe,
                'cin' => $etudiant->cin,
                'modules' => $modules,
            ];
        }

        $modulesList = array_unique(array_reduce($organizedData, function ($carry, $item) {
            foreach ($item['modules'] as $module) {
                $carry[] = $module['intitule_module'];
            }
            return $carry;
        }, []));

        return view('Notes.liste_notes', compact('organizedData', 'modulesList'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit($id)
    // {
    //     $dataEtudiant = Etudiant::where("cin", $id)->first();
    //     $dataGroupe = Groupe::where("code_groupe", $dataEtudiant->code_groupe)->first();
    //     $dataInscription = Inscription::where("id_groupe", $dataGroupe->id_groupe)->get();
    //     $id_module = $dataInscription->pluck('id_module')->toArray();
    //     $dataNote = DB::select("SELECT * FROM module_etudiant WHERE module_etudiant.id_etudiant='{$dataEtudiant->id_etudiant}'
    //      and module_etudiant.id_module IN (" . implode(",", $id_module) . ")");
    //     $dataModules = Module::whereIn("id_module", $id_module)->get();
    //     //return $dataNote;
    //     //return $dataModules;
    //     return view('Notes.modifier_notes', compact('dataEtudiant','dataGroupe', 'dataInscription', 'dataModules', 'dataNote'));

    // }
    public function edit($id)
{
    $dataEtudiant = Etudiant::where("cin", $id)->first();
    $dataGroupe = Groupe::where("code_groupe", $dataEtudiant->code_groupe)->first();
    $dataInscription = Inscription::where("id_groupe", $dataGroupe->id_groupe)->where('id_prof',Auth::user()->id)->get();
    $id_module = $dataInscription->pluck('id_module')->toArray();

    // Récupérez les notes pour chaque module
    $dataNote = [];
    foreach ($id_module as $module_id) {
        $note = DB::table('module_etudiant')
            ->where('id_etudiant', $dataEtudiant->id_etudiant)
            ->where('id_module', $module_id)
            ->first();

        $dataNote[$module_id] = $note ? $note->note : null;
    }

    $dataModules = Module::whereIn("id_module", $id_module)->get();

    return view('Notes.modifier_notes', compact('dataEtudiant', 'dataGroupe', 'dataInscription', 'dataModules', 'dataNote'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $cin)
{
    // Find the student by their CIN
    $student = Etudiant::where("cin", $cin)->first();

    if (!$student) {
        // Handle the case where the student is not found
        return redirect()->route('your.students.index')->with('error', 'Student not found.');
    }

    // Loop through the submitted notes and update them
    try {
        foreach ($request->input('notes', []) as $moduleId => $note) {
            // Use Eloquent relationships to update the module note
            $student->modules()->updateExistingPivot($moduleId, ['note' => $note]);
        }

        return redirect()->route('fourmateur-notes.show', $student->code_groupe)->with('success', 'Notes updated successfully.');
    } catch (\Exception $e) {
        // Log the error for debugging purposes
        Log::error('An error occurred while updating student notes: ' . $e->getMessage());

        return redirect()->back()->with('error', 'An error occurred while updating the notes. Please try again later.');
    }
}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
