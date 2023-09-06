<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;
    protected $fillable = ['nom','prenom','cin','telephonne','adresse','cne','num_appoge',"code_groupe"];
    protected $primaryKey = 'id_etudiant';
    protected $table="etudiants";
    public function groupe(){
        return $this->belongsTo(Groupe::class,'code_groupe',"code_groupe");
    }
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_etudiant', 'id_etudiant', 'id_module')
            ->withPivot('note');
    }

}
