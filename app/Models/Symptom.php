<?php
namespace Tesis\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Symptom extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'deleted_at'];

    public function rules()
    {
        return $this->belongsToMany('Tesis\Models\Disease', 'rules')->withTimeStamps();
    }

    /**
     * Mutators
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucfirst($name);
    }
}
