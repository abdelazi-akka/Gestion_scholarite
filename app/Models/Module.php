<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $fillable = [
        'code_module',
        'intitule_module',
        'id',
        'code_filliere',
        'semestre_module',
        'cin',
    ];
    protected $primaryKey = 'id_module';
    protected $table = "modules";
    public function fourmateur(){
        return $this->belongsTo(User::class,"cin","cin");
    }
    // public function user(){
    //     return $this->belongsTo(User::class,"id","id");
    // }
    public function filliere(){
        return $this->belongsTo(Filliere::class,"code_filliere","code_filliere");
    }
    public function groupes()
    {
        return $this->belongsToMany(Groupe::class);
    }
    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class, 'module_etudiant', 'id_module', 'id_etudiant')
            ->withPivot('note');
    }

}
