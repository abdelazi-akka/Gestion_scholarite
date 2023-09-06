<?php

namespace App\Http\Controllers;

use App\Imports\FilliereImport;
use App\Models\Filliere;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule as ValidationRule;
use Maatwebsite\Excel\Facades\Excel;


class AdminFilliereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Filliere::all();
        return view('Fillieres.liste_fillieres',compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role',1)->whereDoesntHave('filliere')->get();
        return view('Fillieres.ajouter_filliere',compact("users"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user=User::where('cin',$request->input("cin"))->first();
        $request->validate([
            'intitule_filliere' => ['required', 'string', 'max:255'],
            'code_filliere' => ['required', 'string', 'max:255', 'unique:fillieres,code_filliere'],
            'cin' => ['required', 'exists:users,cin'],
        ]);
        $user->filliere()->create([
            'intitule_filliere' => $request->intitule_filliere,
            'code_filliere' => $request->code_filliere,
            'cin' => $request->cin,
        ]);
        return redirect()->route('admin-filliere.index')->with('success','Filliere ajouté avec succés');
    }

    /*-------------------------------------------------*/
    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx,csv',
        ]);

        $file = $request->file('excel_file');

        try {
            Excel::import(new FilliereImport, $file);

            return redirect()->back()->with('success', 'Data imported successfully.');
        } catch (\Exception $e) {
            echo $e->getMessage();
            //return redirect()->back()->with('error', 'An error occurred while importing the data.');
        }
    }
    /*-------------------------------------------------*/

    public function show($id)
    {
        $data=Filliere::find($id);
        return view('Fillieres.show_filliere',compact("data"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data=Filliere::find($id);
        $users = User::where('role',1)->whereDoesntHave('filliere')->get();
        return view('Fillieres.edit_filliere',compact("data","users"));
        // echo $data."******** ";
        // foreach($users as $item){
        //     echo $item;
        // }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $filliere=Filliere::find($id);
    $request->validate([
        'intitule_filliere' => ['required', 'string', 'max:255'],
        'code_filliere' => [
            'required', 'string', 'max:255',
            ValidationRule::unique('fillieres', 'code_filliere')
                ->where(function ($query) use ($filliere) {
                    $query->where('id_filliere', '<>', $filliere->id_filliere);
                }),
        ],
        'cin' => ['required', 'exists:users,cin'],
    ]);
    $filliere->update([
        'intitule_filliere' => $request->intitule_filliere,
        'code_filliere' => $request->code_filliere,
        'cin' => $request->cin,
    ]);

    return redirect()->route('admin-filliere.index')->with('success', 'Filliere modifié avec succès');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=Filliere::find($id);
        $data->delete();
        return redirect()->route('admin-filliere.index')->with('success','Filliere supprimé avec succés');
    }
}
