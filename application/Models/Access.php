<?php
namespace App\Models;
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
