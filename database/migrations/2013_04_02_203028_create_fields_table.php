<?php

use App\Input;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('fields')) {
            Schema::create('fields', function (Blueprint $table) {
                $table->increments('id');
                $table->string('table_name');
                $table->string('field_name');
                $table->enum('type', ['text', 'select', 'textarea'])->default('text');
                $table->timestamps();
            });
        }

        DB::table('fields')->insert(
            array(
                ['table_name' => 'users','field_name' => 'name','type' => 'text'],
                ['table_name' => 'users','field_name' => 'email','type' => 'text'],
                ['table_name' => 'users','field_name' => 'password','type' => 'text'],
                ['table_name' => 'modules','field_name' => 'name','type' => 'text'],
                ['table_name' => 'modules','field_name' => 'icon','type' => 'text'],
                ['table_name' => 'modules','field_name' => 'color','type' => 'select'],
                ['table_name' => 'modules','field_name' => 'active','type' => 'select'],
                ['table_name' => 'pages','field_name' => 'name','type' => 'text'],
                ['table_name' => 'pages','field_name' => 'link','type' => 'text'],
                ['table_name' => 'pages','field_name' => 'active','type' => 'select'],
                ['table_name' => 'pages','field_name' => 'type','type' => 'select'],
                ['table_name' => 'pages','field_name' => 'text','type' => 'textarea'],
                ['table_name' => 'banners','field_name' => 'title','type' => 'text'],
                ['table_name' => 'banners','field_name' => 'active','type' => 'select'],
                ['table_name' => 'banners','field_name' => 'image','type' => 'text'],
                ['table_name' => 'banners','field_name' => 'link','type' => 'text'],
                ['table_name' => 'banners','field_name' => 'type','type' => 'select'],
                ['table_name' => 'albums','field_name' => 'name','type' => 'text'],
                ['table_name' => 'albums','field_name' => 'text','type' => 'textarea'],
                ['table_name' => 'albums','field_name' => 'image','type' => 'text'],
                ['table_name' => 'albums','field_name' => 'active','type' => 'select'],
                ['table_name' => 'albums','field_name' => 'tags','type' => 'text'],
                ['table_name' => 'albums','field_name' => 'parent_id','type' => 'text'],
                ['table_name' => 'photos','field_name' => 'album_id','type' => 'text'],
                ['table_name' => 'photos','field_name' => 'image','type' => 'text'],
                ['table_name' => 'photos','field_name' => 'active','type' => 'select'],
                ['table_name' => 'photos','field_name' => 'sequence','type' => 'text']
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
