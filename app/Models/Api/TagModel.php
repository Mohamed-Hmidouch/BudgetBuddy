<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function expenses()
    {
        return $this->belongsToMany(ExpenseModel::class, 'expense_tag', 
            'tag_model_id', 'expense_model_id');
    }
}
