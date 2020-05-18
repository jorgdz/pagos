<?php
namespace App\Entities;
use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
	protected $table = 'access';

	protected $fillable = [
		'name'
	];

	public function getNameAttribute ($value)
	{
    return ucfirst($value);
  }
	
	public function roles ()
	{
		return $this->belongsToMany (Role::class);
	}
}
