<?php
namespace Tesis\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

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
