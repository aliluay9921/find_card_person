<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardFound extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function card()
    {
        return $this->belongsTo(card::class, 'card_id');
    }
}