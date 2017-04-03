<?php

use App\Input;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inputs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table_name');
            $table->string('column_name');
            $table->enum('type', ['text', 'select', 'textarea'])->default('text');
            $table->timestamps();
        });

        // $columns = Schema::getColumnListing('inputs');
        // $columns = array_diff($columns, ['id','created_at', 'updated_at']);
        
        // foreach($columns as $column){
        //     $input = new Input;
        //     $input->table_name = 'inputs';
        //     $input->column_name = $column;
        //     $input->save();
        // }

        DB::table('inputs')->insert(
            array(
                ['table_name' => 'users','column_name' => 'name','type' => 'text'],
                ['table_name' => 'users','column_name' => 'email','type' => 'text'],
                ['table_name' => 'users','column_name' => 'password','type' => 'text'],
                ['table_name' => 'modules','column_name' => 'name','type' => 'text'],
                ['table_name' => 'modules','column_name' => 'icon','type' => 'text'],
                ['table_name' => 'modules','column_name' => 'color','type' => 'select'],
                ['table_name' => 'modules','column_name' => 'active','type' => 'select'],
                ['table_name' => 'pages','column_name' => 'name','type' => 'text'],
                ['table_name' => 'pages','column_name' => 'link','type' => 'text'],
                ['table_name' => 'pages','column_name' => 'active','type' => 'select'],
                ['table_name' => 'pages','column_name' => 'type','type' => 'select'],
                ['table_name' => 'pages','column_name' => 'text','type' => 'textarea'],
                ['table_name' => 'banners','column_name' => 'title','type' => 'text'],
                ['table_name' => 'banners','column_name' => 'active','type' => 'select'],
                ['table_name' => 'banners','column_name' => 'image','type' => 'text'],
                ['table_name' => 'banners','column_name' => 'link','type' => 'text'],
                ['table_name' => 'banners','column_name' => 'type','type' => 'select'],
                ['table_name' => 'albums','column_name' => 'name','type' => 'text'],
                ['table_name' => 'albums','column_name' => 'text','type' => 'textarea'],
                ['table_name' => 'albums','column_name' => 'image','type' => 'text'],
                ['table_name' => 'albums','column_name' => 'active','type' => 'select'],
                ['table_name' => 'albums','column_name' => 'tags','type' => 'text'],
                ['table_name' => 'albums','column_name' => 'parent_id','type' => 'text'],
                ['table_name' => 'photos','column_name' => 'album_id','type' => 'text'],
                ['table_name' => 'photos','column_name' => 'image','type' => 'text'],
                ['table_name' => 'photos','column_name' => 'active','type' => 'select'],
                ['table_name' => 'photos','column_name' => 'sequence','type' => 'text']
                )
        );

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
