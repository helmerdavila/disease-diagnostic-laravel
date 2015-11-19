<?php
namespace Tesis\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Disease extends Model
{
    use SearchableTrait, SoftDeletes;

    protected $fillable = ['name', 'name_c', 'description', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'name'   => 10,
            'name_c' => 9,
        ],
    ];

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

    public function scopeWhereSymptoms($query, $symptoms = [])
    {
        return $query->whereHas('rules', function ($query) use ($symptoms) {
            $query->whereIn('symptom_id', $symptoms);
        });
    }
}
