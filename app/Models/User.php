<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'username',
        'email',
        'password',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    /**
     * @param $value
     */
    /*public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }*/
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(){
        return $this->hasMany(Post::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions(){
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }
    
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(){
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
    
    /**
     * @return string
     */
    public function getFullNameAttribute(){
        return $this->name . ' ' .$this->surname;
    }
    
    /**
     * @param $role
     * @return bool
     */
    public function hasRole($role){
        
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        
        return false;
    }
    
    /**
     * @param $role
     * @return bool
     */
    public function hasPermission($permission){
        
        if ($this->permissions()->where('name', $permission)->first()) {
            return true;
        }
        
        return false;
    }
    
    /**
     * @param $value
     * @return null|string
     */
    public function getAvatarAttribute($value) {
        
        if(!$value){
            return asset('images/default_profile_avatar.png');
        }
        elseif(strpos($value, 'https://') !== false || strpos($value, 'http://') !== false) {
            return $value;
        }
        
        return asset('storage/' . $value);
    }
}
