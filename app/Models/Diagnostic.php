<?php
namespace Tesis\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diagnostic extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function disease()
    {
        return $this->belongsTo('Tesis\Models\Disease', 'disease_id');
    }

    public function user()
    {
        return $this->belongsTo('Tesis\Models\User', 'user_id');
    }
}
