<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int        $id
 * @property int        $created_user_id
 * @property int        $updated_user_id
 * @property int        $deleted_user_id
 * @property string     $nombre
 * @property string     $descripcion
 * @property int        $deleted_at
 * @property int        $created_at
 * @property int        $updated_at
 */
class Course extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'courses';

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
        'nombre', 'descripcion', 'created_user_id', 'updated_user_id', 'deleted_user_id', 'deleted_at', 'created_at', 'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nombre' => 'string', 'descripcion' => 'string', 'deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at', 'created_at', 'updated_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    //Accessors
    //

    //Mutators
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = ucfirst($value);
    }

    //Relaciones
    public function UserCreated()
    {
        return $this->belongsTo('App\Models\User', 'created_user_id');
    }

    public function UserUpdated()
    {
        return $this->belongsTo('App\Models\User', 'updated_user_id');
    }

    public function UserDeleted()
    {
        return $this->belongsTo('App\Models\User', 'deleted_user_id');
    }
}
