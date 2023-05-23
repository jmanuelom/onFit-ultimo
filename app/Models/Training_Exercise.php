<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class training_exercise extends Model
{
    use HasFactory;

    public function training()
    {
        return $this->belongsTo(Training::class, 'trainingId');
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'exerciseId');
    }
}
