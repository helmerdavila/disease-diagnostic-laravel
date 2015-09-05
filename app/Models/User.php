<?php

namespace Tesis\Models;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, EntrustUserTrait;

    protected $table = 'users';

    protected $fillable = ['email', 'password', 'name', 'lastname', 'gender', 'birthday', 'phone', 'mobil'];

    protected $guarded = ['password'];

    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['birthday'];

    public function diagnostics()
    {
        return $this->belongsTo('Tesis\Models\Diagnostic', 'user_id');
    }

    public function getGender()
    {
        if ($this->gender == 1) {
            return 'M';
        } elseif ($this->gender == 0) {
            return 'F';
        }
    }

    public function setPassword($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function setBirthday($birthday)
    {
        $this->attributes['birthday'] = Carbon::createFromFormat('d/m/Y', $birthday)->format('Y-m-d');
    }
}
