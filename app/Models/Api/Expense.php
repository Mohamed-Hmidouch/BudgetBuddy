<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $table = 'expense';

    protected $fillable = [
        'name',
        'amount',
        'user_id',
        'date',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_expense', 
            'expense_id', 'tag_id');
    }
}
