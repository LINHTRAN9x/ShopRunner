<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Role extends Model
{
    protected $fillable = ['name']; // Optional for display purposes

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
