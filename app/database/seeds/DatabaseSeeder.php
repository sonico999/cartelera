<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
        $this->call('PerfilesTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('ModulosTableSeeder');
        $this->call('PermisosTableSeeder');

        // $this->call('UserTableSeeder');
	}

}
