<?php
namespace Tesis\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Symptom extends Model
{
    use SearchableTrait, SoftDeletes;

    protected $fillable = ['name', 'description', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'name' => 10,
        ],
    ];

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
