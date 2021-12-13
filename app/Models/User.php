<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;
use Laravel\Passport\HasApiTokens;

/**
 * @property int        $id
 * @property int        $person_id
 * @property string     $username
 * @property string     $password
 * @property string     $remember_token
 * @property boolean    $force_password
 * @property int        $failed_logins
 * @property int        $deleted_at
 * @property int        $created_at
 * @property int        $updated_at
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use HasApiTokens, Authenticatable, Authorizable, HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'person_id', 'username', 'force_password', 'failed_logins'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'username' => 'string', 'force_password' => 'boolean', 'deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at', 'created_at', 'updated_at'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    //Accessors
    //

    //Mutators
    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = strtolower($value);
    }

    //Relaciones
    public function Person()
    {
        return $this->belongsTo('App\Models\Person');
    }

    public function UserLogin()
    {
        return $this->hasMany('App\Models\UserLogin');
    }
}
