<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $table = 'roles';

	protected $fillable = [
		'name'
	];

	public function getNameAttribute ($value)
	{
    return strtoupper($value);
  }
	
	public function users ()
	{
		return $this->belongsToMany (User::class);
	}
	
	public function access ()
	{
		return $this->belongsToMany (Access::class);
	}
}
