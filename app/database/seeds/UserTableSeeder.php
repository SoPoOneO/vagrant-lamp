<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        $password = 'password';

        foreach(Role::all() as $role)
        {
            $user = User::create([
                'first_name' => 'test',
                'last_name'  => $role->slug,
                'email'      => "{$role->slug}@example.com",
                'role_id'    => $role->id,
                'password'   => Hash::make($password)
            ]);

            $this->command->comment("Created dummy {$role->name} user: {$user->email} / {$password}");

        }
    }

}