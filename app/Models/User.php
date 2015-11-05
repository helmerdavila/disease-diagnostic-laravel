<?php

namespace Tesis\Models;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, EntrustUserTrait, SoftDeletes;

    protected $table = 'users';

    protected $fillable = ['email', 'name', 'lastname', 'gender', 'birthday', 'phone', 'mobil'];

    protected $guarded = ['password'];

    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['birthday', 'deleted_at'];

    public function diagnostics()
    {
        return $this->hasMany(Diagnostic::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function getFullName()
    {
        return "{$this->name} {$this->lastname}";
    }

    public function getGender()
    {
        if ($this->gender == 1) {
            return 'M';
        }
        return 'F';
    }

    public function getGenderColored()
    {
        if ($this->gender == 1) {
            return '<span class="label label-primary">Masculino</span>';
        }
        return '<span class="label label-danger">Femenino</span>';
    }

    public function setPassword($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function setBirthdayAttribute($birthday)
    {
        $this->attributes['birthday'] = Carbon::createFromFormat('d/m/Y', $birthday)->format('Y-m-d');
    }
}
