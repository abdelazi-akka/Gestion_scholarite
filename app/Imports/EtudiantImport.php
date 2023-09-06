<?php

namespace App\Imports;

use App\Models\Etudiant;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class EtudiantImport implements ToCollection
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

            $etudiant = new Etudiant([
                'nom' => $row[0],
                'prenom' => $row[1],
                'adresse' => $row[2],
                'cin' => $row[3],
                'telephonne' => $row[4],
                'cne' => $row[5],
                'num_appoge' => $row[6],
                'code_groupe' => $row[7],
            ]);

            $etudiant->save();
        }
    }
}
