<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateRolesAndPermissions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Permission::unguard();
		$edit_users   		= new Permission;
		$edit_users->name 	= 'edit_users';
		$edit_users->display_name   = 'Edit Users';
		$edit_users->save();

		$edit_content   	= new Permission;
		$edit_content->name = 'edit_content';
		$edit_content->display_name = 'Edit Content';
		$edit_content->save();

		Role::unguard();
		$superadmin   = Role::create(['rank'=>1, 'slug'=>'superadmin', 'name' => 'Super Admin']);
		$admin 		  = Role::create(['rank'=>2, 'slug'=>'admin', 'name' => 'Admin']);
		$contributor  = Role::create(['rank'=>3, 'slug'=>'contributor', 'name' => 'Contributor']);

		$superadmin->perms()->sync([$edit_users->id, $edit_content->id]);
		$admin->perms()->sync([$edit_content->id]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
