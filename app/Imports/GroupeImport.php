<?php

namespace App\Imports;

use App\Models\Groupe;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;

class GroupeImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            if ($index === 0) {
                continue;
            }

            Groupe::create([
                'code_groupe' => $row[0],
                'nom_groupe' => $row[1],
                'code_filliere' => $row[2],
                'cin'  =>Auth::user()->cin
            ]);
        }
    }
}
