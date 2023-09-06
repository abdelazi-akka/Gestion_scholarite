<?php

namespace App\Http\Controllers;

use App\Models\Filliere;
use App\Models\Groupe;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Module::where("id",Auth::user()->id)->get();
        return view('Modules.liste_module',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fourmateurs=User::where("role",2)->get();
        $filliere=Filliere::all();
        return view('Modules.ajouter_module',compact("filliere","fourmateurs"));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate(['code_module' => ['required', 'string', 'max:255', 'unique:modules,code_module'],
    //         'intitule_module' => ['required', 'string', 'max:255'],
    //         'semestre_module' => ['required', 'string', 'max:255'],
    //         'code_filliere' => ['required'],
    //         'cin' => ['required',"string","max:10","exists:users,cin"]
    //     ]);
    //     $module=new Module();
    //     $module->code_module=$request->input('code_module');
    //     $module->intitule_module=$request->input('intitule_module');
    //     $module->semestre_module=$request->input('semestre_module');
    //     $module->code_filliere=$request->input('code_filliere');
    //     $module->id=Auth::user()->id;
    //     $module->cin=$request->input('cin');
    //     $module->save();
    //     return redirect()->route('module.index')->with('success','Module ajouté avec succés');
    // }
    public function store(Request $request)
{
    try {
        $request->validate([
            'code_module' => ['required', 'string', 'max:255', 'unique:modules,code_module'],
            'intitule_module' => ['required', 'string', 'max:255'],
            'semestre_module' => ['required', 'string', 'max:255'],
            'code_filliere' => ['required'],
            'cin' => ['required', 'string', 'max:10', 'exists:users,cin'],
        ]);

        $module = new Module();
        $module->code_module = $request->input('code_module');
        $module->intitule_module = $request->input('intitule_module');
        $module->semestre_module = $request->input('semestre_module');
        $module->code_filliere = $request->input('code_filliere');
        $module->id = Auth::user()->id;
        $module->cin = $request->input('cin');
        $module->save();

        return redirect()->route('module.index')->with('success', 'Module ajouté avec succès');
    } catch (\Exception $e) {
        // Handle the exception, log it, or return an error response
        return redirect()->route('module.index')->with('error', 'Une erreur est survenue : ' . $e->getMessage());
    }
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data=Module::find($id);
        return view('Modules.details_module',compact("data"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fourmateurs=User::where("role",2)->get();
        $data=Module::find($id);
        $filliere=Filliere::all();
        return view('Modules.modifier_module',compact("data","filliere","fourmateurs"));
    }

    public function update(Request $request, $id)
    {
        try {
            $module = Module::find($id);

            if (!$module) {
                return redirect()->route('module.index')->with('error', 'Module introuvable.');
            }

            $request->validate([
                        'intitule_module' => ['required', 'string', 'max:255'],
                        'code_module' => ['required', 'string', 'max:255',Rule::unique('modules', 'code_module')->ignore($module->id)],
                        'semestre_module' => ['required', 'string', 'max:255'],
                        'code_filliere' => ['required',"exists:fillieres,code_filliere"],
                        'cin' => ['required',"string","max:10","exists:users,cin"]
                    ]);
                    if ($module->code_module !== $request->input('code_module')) {
                        $existingModule = Module::where('code_module', $request->input('code_module'))->first();
                        if ($existingModule) {
                            return redirect()->route('module.edit', $id)->withErrors(['code_module' => 'This code_module is already taken.']);
                        }
                    }

            $module->update([
                        'intitule_module' => $request->input('intitule_module'),
                        'code_module' => $request->input('code_module'),
                        'semestre_module' => $request->input('semestre_module'),
                        'code_filliere' => $request->input('code_filliere'),
                        'cin' => $request->input('cin')
                    ]);

            if ($module->wasChanged()) {
                return redirect()->route('module.index')->with('success', 'Module modifié avec succès.');
            } else {
                return redirect()->route('module.index')->with('info', 'Aucune modification détectée.');
            }
        } catch (\Exception $e) {
            return redirect()->route('module.index')->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }
    // public function update(Request $request,$id)
    // {
    //     $module=Module::find($id);
    //     $request->validate([
    //         'intitule_module' => ['required', 'string', 'max:255'],
    //         'code_module' => ['required', 'string', 'max:255',Rule::unique('modules', 'code_module')->ignore($module->id)],
    //         'semestre_module' => ['required', 'string', 'max:255'],
    //         'code_filliere' => ['required',"exists:fillieres,code_filliere"],
    //         'cin' => ['required',"string","max:10","exists:users,cin"]
    //     ]);
    //     if ($module->code_module !== $request->input('code_module')) {
    //         $existingModule = Module::where('code_module', $request->input('code_module'))->first();
    //         if ($existingModule) {
    //             return redirect()->route('module.edit', $id)->withErrors(['code_module' => 'This code_module is already taken.']);
    //         }
    //     }
    //     $module->update([
    //         'intitule_module' => $request->input('intitule_module'),
    //         'code_module' => $request->input('code_module'),
    //         'semestre_module' => $request->input('semestre_module'),
    //         'code_filliere' => $request->input('code_filliere'),
    //         'cin' => $request->input('cin')
    //     ]);
    //     return redirect()->route('module.index')->with('success', 'Module modifié avec succès');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $module=Module::find($id);
        $module->delete();
        return redirect()->route('module.index')->with('success','Module supprimé avec succés');
    }
}
