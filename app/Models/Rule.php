<?php
namespace Tesis\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    public function disease()
    {
        return $this->belongsTo(Disease::class, 'disease_id');
    }

    public function symptom()
    {
        return $this->belongsTo(Symptom::class, 'symptom_id');
    }
}
