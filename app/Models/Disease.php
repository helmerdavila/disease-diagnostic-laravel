<?php
namespace Tesis\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

/**
 * Tesis\Models\Disease
 *
 * @property int $id
 * @property string $name
 * @property string $name_c
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Tesis\Models\Diagnostic[] $diagnostics
 * @property-read \Illuminate\Database\Eloquent\Collection|\Tesis\Models\Symptom[] $rules
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Disease search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Disease searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Disease whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Disease whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Disease whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Disease whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Disease whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Disease whereNameC($value)
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Disease whereSymptoms($symptoms = array())
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Disease whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
