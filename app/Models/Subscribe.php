<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscribe extends Model
{
    protected $table = 'subscribers';
    protected $fillable = [
        'email','website_id'
    ];
   public function notified_subscribers(): HasMany
   {
       return $this->hasMany(NotifiedSubscribe::class);
   }
}
