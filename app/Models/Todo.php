<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Return relationship with Todo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
