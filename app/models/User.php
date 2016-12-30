<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, HasRole;

	protected $fillable = array('first_name', 'last_name', 'email');

	protected $appends = ['role_id'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function getRoleIdAttribute()
	{
		// if the user has at least one role attached...
		if($this->roles->count())
		{
			return $this->roles->first()->id;
		}
	}

	public function setRoleIdAttribute($role_id)
	{
		// if they're not save yet... save so that attachment can be made
		if(!$this->id){$this->save();}
		$this->roles()->sync([$role_id]);
	}

}
