<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name','currency'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
