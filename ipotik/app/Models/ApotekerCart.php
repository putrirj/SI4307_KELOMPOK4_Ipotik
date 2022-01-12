<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApotekerCart extends Model
{
    use HasFactory;

    public function medicine()
    {
        return $this->hasOne(Medicine::class, 'id', 'medicine_id');
    }
}
