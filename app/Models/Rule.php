<?php
namespace Tesis\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    public function disease()
    {
        return $this->belongsTo('Tesis\Models\Disease', 'disease_id');
    }

    public function symptom()
    {
        return $this->belongsTo('Tesis\Models\Symptom', 'symptom_id');
    }
}
