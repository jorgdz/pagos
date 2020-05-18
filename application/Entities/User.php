<?php
namespace App\Entities;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $table = 'users';

	protected $fillable = [
		'name',
		'lastname',
		'email',
		'password',
		'country',
		'enabled',
		'created_at'
	];

	protected $hidden = [
   	'password'
	];
	
	public function getNameAttribute ($value)
	{
    return ucwords($value);
  }
	
	public function getLastnameAttribute ($value)
	{
    return ucwords($value);
	}
	
	public function setEmailAttribute ($value)
	{
		$this->attributes['email'] = strtolower($value);
	}

	public function roles ()
	{
		return $this->belongsToMany(Role::class);
	}
}
