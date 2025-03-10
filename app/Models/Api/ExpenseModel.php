<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseModel extends Model
{
    use HasFactory;

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
        return $this->belongsToMany(TagModel::class, 'expense_tag', 
            'expense_model_id', 'tag_model_id');
    }
}
