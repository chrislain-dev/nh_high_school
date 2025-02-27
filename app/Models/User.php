<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes, HasApiTokens, HasRoles;

    protected $guarded = [];

    // Un utilisateur peut avoir un seul élève associé (s'il y a une relation)
    public function student()
    {
        return $this->hasOne(Student::class);
    }

    // Un utilisateur peut avoir un ou plusieurs enseignants associés
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    // Relation avec l'historique des connexions
    public function logins()
    {
        // return $this->hasMany(LoginHistory::class); // À créer si vous suivez les connexions
    }

    // Accessors and Mutators
    // Exemple d'un accessoir pour formater le nom de l'utilisateur
    public function getFullNameAttribute()
    {
        return $this->name;
    }
}
