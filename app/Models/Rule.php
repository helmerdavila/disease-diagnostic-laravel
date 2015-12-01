<?php
namespace Tesis\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $fillable = ['number', 'disease_id', 'symptom_id'];

    public function disease()
    {
        return $this->belongsTo(Disease::class, 'disease_id');
    }

    public function symptom()
    {
        return $this->belongsTo(Symptom::class, 'symptom_id');
    }
}
