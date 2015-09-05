<?php
namespace Tesis\Models;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    protected $fillable = ['name'];

    public function rules()
    {
        return $this->hasMany('Tesis\Models\Rule', 'symptom_id');
    }
}
