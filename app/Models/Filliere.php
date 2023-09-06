<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filliere extends Model
{
    use HasFactory;
    protected $fillable = ["id_filliere","intitule_filliere","code_filliere","cin"];
    protected $primaryKey = "id_filliere";
    protected $table ="fillieres";
    public function user(){
        return $this->belongsTo(User::class,"cin","cin");
    }
    public function modules(){
        return $this->hasMany(Module::class,"code_filliere","code_filliere");
    }
    public function groupes(){
        return $this->hasMany(Groupe::class,"code_filliere","code_filliere");
    }
}
