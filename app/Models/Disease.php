<?php
namespace Tesis\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disease extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'name_c', 'deleted_at'];

    public function rules()
    {
        return $this->belongsToMany('Tesis\Models\Symptom', 'rules')->withTimeStamps();
    }

    public function diagnostics()
    {
        return $this->hasMany('Tesis\Models\Diagnostic', 'disease_id');
    }

    /**
     * Mutators
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucfirst($name);
    }
}
