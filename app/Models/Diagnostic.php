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
        return $this->belongsTo(Disease::class, 'disease_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
