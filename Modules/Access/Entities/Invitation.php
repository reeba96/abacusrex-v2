<?php

namespace Modules\Access\Entities;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invitations';

    /**
    * The database primary key value.
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
                  'email',
                  'invitation_token',
                  'expires_at',
                  'registered_at'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['registered_at','expires_at'];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    

    /**
     * Set the registered_at.
     *
     * @param  string  $value
     * @return void
     */
   /* public function setRegisteredAtAttribute($value)
    {
        $this->attributes['registered_at'] = !empty($value) ? \DateTime::createFromFormat('[% date_format %]', $value) : null;
    }
    */
    /**
     * Get registered_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getRegisteredAtAttribute($value)
    {
        if ( !is_null($value) ){ 
            return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
        }
        else 
            return '';
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

    /**
     * Get the invitation link in string format
     *
     * @return string
     */
    public function getLink() {
        return urldecode(route('access.invitation.register') . '?invitation_token=' . $this->invitation_token);
    }

    /**
     * Get the invitation email in string format
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }


}

