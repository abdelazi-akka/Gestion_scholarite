<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_groupe',
        'code_groupe',
        'code_filliere',
        'cin',

    ];
    public $primaryKey="id_groupe";
    protected $table="groupes";
    public function filliere(){
        return $this->belongsTo(Filliere::class,"code_filliere","code_filliere");
    }
    public function modules()
    {
        return $this->belongsToMany(Module::class);
    }
    public function etudiants()
    {
        return $this->hasMany(Etudiant::class,"code_groupe","code_groupe");
    }
}
