<?php
namespace Tesis\Models;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    public function rules()
    {
        return $this->hasMany('Tesis\Models\Rule', 'disease_id');
    }

    public function diagnostics()
    {
        return $this->hasMany('Tesis\Models\Diagnostic', 'disease_id');
    }
}
