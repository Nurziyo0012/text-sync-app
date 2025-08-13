<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextRow extends Model
{
    public function scopeAllowed($query)
{
    return $query->where('status', 'Allowed');
}
protected $fillable = ['text', 'status'];
}
