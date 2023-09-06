<?php

namespace App\Imports;

use App\Models\Filliere;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;

class FilliereImport implements ToCollection
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

            $filliere = new Filliere([
                'intitule_filliere' => $row[0],
                'code_filliere' => $row[1],
                'cin' =>$row[2]
            ]);

            $filliere->save();
        }
    }
}
