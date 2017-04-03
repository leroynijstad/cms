<?php

use App\Input;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('icon');
            $table->enum('color', ['red', 'purple', 'green'])->default('red');
            $table->enum('active', ['1', '0'])->default('1');
            $table->timestamps();
        });

        $columns = Schema::getColumnListing('modules');
        $columns = array_diff($columns, ['id','created_at', 'updated_at']);
        
        foreach($columns as $column){
            $input = new Input;
            $input->table_name = 'modules';
            $input->column_name = $column;
            $input->save();
        }

        DB::table('modules')->insert(
            array([
                'name' => 'page',
                'icon' => 'page',
                'active' => '1'
            ],[
                'name' => 'banner',
                'icon' => 'banner',
                'active' => '1'
            ],[
                'name' => 'album',
                'icon' => 'album',
                'active' => '1'
            ],[
                'name' => 'user',
                'icon' => 'user',
                'active' => '1'
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
        Schema::dropIfExists('modules');
    }
}
