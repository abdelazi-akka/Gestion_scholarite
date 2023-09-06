<?php

namespace App\Http\Controllers;

use App\Imports\EtudiantImport;
use App\Imports\FilliereImport;
use App\Imports\GroupeImport;
use App\Imports\ModuleImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx,csv',
        ]);

        $file = $request->file('excel_file');

        try {
            if($request->is("import-groupe")){
                Excel::import(new GroupeImport, $file);
            }else if($request->is("import-module")){
                Excel::import(new ModuleImport, $file);
            }else if($request->is("import-filliere")){
                Excel::import(new FilliereImport, $file);
            }else if($request->is("import-etudiant")){
                Excel::import(new EtudiantImport, $file);
            }



            return redirect()->back()->with('success', 'Data imported successfully.');
        } catch (\Exception $e){
            echo $e->getMessage();
           //return redirect()->back()->with('error', 'An error occurred while importing the data.');
        }
    }
}
