<?php

namespace Tesis\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    /**
     * Relationships
     */
    public function diagnostics()
    {
        return $this->hasManyThrough(Diagnostic::class, User::class, 'state_id', 'user_id');
    }
}
