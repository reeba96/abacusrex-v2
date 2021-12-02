<?php

namespace Modules\Access\Entities;

use Illuminate\Database\Eloquent\Model;

class Role extends \Spatie\Permission\Models\Role
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'name',
                  'guard_name'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    
    /**
     * Get the modelHasRoles for this model.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function modelHasRoles()
    {
        return $this->hasMany('App\Modules\Access\Entities\ModelHasRole','role_id','id');
    }

    /**
     * Get the roleHasPermission for this model.
     *
     * @return App\Modules\Access\Entities\RoleHasPermission
     */
    public function roleHasPermission()
    {
        return $this->hasOne('App\Modules\Access\Entities\RoleHasPermission','role_id','id');
    }


    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getCreatedAtAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }

    /**
     * Get updated_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getUpdatedAtAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }

}
