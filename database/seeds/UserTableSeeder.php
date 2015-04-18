// app/database/seeds/UserTableSeeder.php
<?php
use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
  public function run()
  {
    DB::table('users')->delete();
    
    User::create(array(
    	'name'     => 'Nanda',
      'username' => 'roxin',
      'password' => Hash::make('12345'),
    ));
  }
}