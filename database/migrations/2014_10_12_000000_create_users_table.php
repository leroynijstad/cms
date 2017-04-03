<?php

use App\Input;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        
        $columns = Schema::getColumnListing('users');
        $columns = array_diff($columns, ['id','created_at', 'updated_at']);
        foreach($columns as $column){
            $input = new Input;
            $input->table_name = 'users';
            $input->column_name = $column;
            $input->save();
        }
        DB::table('users')->insert(
              array([
                  'name' => 'test test',
                  'email' => 'test@testing.nl',
                  'password' => bcrypt('test')
              ]
          ));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
