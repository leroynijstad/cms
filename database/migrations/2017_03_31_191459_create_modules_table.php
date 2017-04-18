<?php

use App\Field;
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
        if (! Schema::hasTable('modules')) {
            Schema::create('modules', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('icon');
                $table->enum('color', ['red', 'purple', 'green'])->default('red');
                $table->enum('active', ['1', '0'])->default('1');
                $table->timestamps();
            });
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
