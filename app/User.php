<?php

namespace SportStore;

use SportStore\Orden;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getPrimerNombre() {
        if (str_word_count($this->name) > 1) {
            return substr($this->name, 0, strpos($this->name, " "));
        }
        return $this->name;
    }

    public function tieneRol(string $rol)
    {
        return $this->rol == $rol;
    }

    public function esAdmin()
    {
        return $this->tieneRol('admin');
    }

    public function ordenes()
    {
        return $this->hasMany(Orden::class);
    }
}
