<?php
namespace Tesis\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{

    public function disease()
    {
        return $this->belongsTo('Tesis\Models\Disease', 'disease_id');
    }

    public function user()
    {
        return $this->belongsTo('Tesis\Models\User', 'user_id');
    }
}
