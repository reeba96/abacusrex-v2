<?php

namespace Modules\Access\Entities;

use Spatie\Permission\Traits\HasRole;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Dialect\Gdpr\Portable;
use Illuminate\Database\Eloquent\SoftDeletes;

//use Laravel\Passport\HasApiTokens;
//use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasRoles, Notifiable, SoftDeletes;//, HasApiTokens;
    use Portable;
    protected $gdprHidden = ['password', 'id', 'confirmed', 'is_admin', 'confirmation_code', 'remember_token', 'updated_at', 'image', 'country_id', 'isAnonymized', 'accepted_gdpr'];


    public function toPortableArray()
    {
        $array = $this->toArray();
        // You can change the exported data here
        return $array;
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

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
    protected $guarded = ['id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at'];

     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    /**
     * Set the email_verified_at.
     *
     * @param  string  $value
     * @return void
     */
    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = !empty($value) ? \DateTime::createFromFormat('[% date_format %]', $value) : null;
    }

    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getCreatedAtAttribute($value)
    {

        if ( !is_null($value) ){
            return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
        }
        else
            return '';
    }

    /**
     * Get email_verified_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getEmailVerifiedAtAttribute($value)
    {

        if ( !is_null($value) ){
            \Log::info([$this->getDateFormat(),$value]);
           // return \DateTime::createFromFormat((string) $this->getDateFormat(), $value)->format('j/n/Y g:i A');
        }
        else
            return '';
    }

    /**
     * Get updated_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getUpdatedAtAttribute($value)
    {

        if ( !is_null($value) ){
            return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
        }
        else
            return '';
    }

    /**
     * Delete the personal data before soft deleting the model.
     */
    public function archiveUser() {
        try {

            $props_to_archive = [
                'firstname' => 'DELETED_USER_' . $this->id,
                'lastname'  => 'DELETED_USER_' . $this->id,
                'email'     => 'DELETED_USER_' . $this->id,
                'password'  => 'DELETED_USER_' . $this->id,
                'firm'      => 'DELETED_USER_' . $this->id,
                'mobile'    => 'DELETED_USER_' . $this->id,
                'phone'     => 'DELETED_USER_' . $this->id,
                'title'     => 'DELETED_USER_' . $this->id,
                'image'     => 'DELETED_USER_' . $this->id,
                'skype'     => 'DELETED_USER_' . $this->id,
            ];

            $this->update($props_to_archive);

            return true;
        } catch (\Exception $e) {

            \Log::error("Can't archive user with id: " . $this->id);
            \Log::error($e);

            return false;
        }
    }

    /**
     * Override the model's delete method
     */
    public function delete() {
        if ($this->archiveUser()) {
            parent::delete();
            return true;
        }

        return false;
    }

}
