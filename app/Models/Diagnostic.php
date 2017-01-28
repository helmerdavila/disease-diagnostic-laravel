<?php
namespace Tesis\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

/**
 * Tesis\Models\Diagnostic
 *
 * @property int $id
 * @property int $user_id
 * @property int $disease_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Tesis\Models\Disease $disease
 * @property-read \Tesis\Models\User $user
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Diagnostic search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Diagnostic searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Diagnostic whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Diagnostic whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Diagnostic whereDiseaseId($value)
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Diagnostic whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Diagnostic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Diagnostic whereUserId($value)
 * @mixin \Eloquent
 */
class Diagnostic extends Model
{
    use SearchableTrait, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $searchable = [
        'columns' => [
            'diseases.name'  => 10,
            'users.name'     => 10,
            'users.lastname' => 10,
        ],
        'joins'   => [
            'diseases' => ['diagnostics.disease_id', 'diseases.id'],
            'users'    => ['diagnostics.user_id', 'users.id'],
        ],
    ];

    public function disease()
    {
        return $this->belongsTo(Disease::class, 'disease_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
