<?php

namespace App\Imports;

use App\Models\Module;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;

class ModuleImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $index => $row) {
            if ($index === 0) {
                continue;
            }
            $module = Module::where('code_module', $row[0])->first();
            if($module != null){
                $module = new Module([
                    'code_module' => $row[0],
                    'intitule_module' => $row[1],
                    'semestre_module' => $row[2],
                    'code_filliere' => $row[3],
                    'cin' => $row[4],
                    'id' => Auth::user()->id,
                ]);
                $module->save();
            }
        }
    }
}
