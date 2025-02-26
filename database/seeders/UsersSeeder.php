<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->insert([
			[
				'role' => UserRole::Admin->value,
				'name' => 'Mark Dickens',
				'email' => 'mark@precisioncrystal.com',
				'password' => bcrypt('Mdd09051956'),
			],
			[
				'role' => UserRole::Admin->value,
				'name' => 'William Dickens',
				'email' => 'william@precisioncrystal.com',
				'password' => bcrypt('Wdd08211987'),
			]
		]);
	}
}
