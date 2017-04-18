<?php

use App\Field;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('photos')) {
          Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('album_id');
            $table->string('image');
            $table->enum('active', ['1', '0'])->default('1');
            $table->integer('sequence');
            $table->timestamps();
          });
        }
        
        for($i = 1; $i <= 10; $i++){
            DB::table('photos')->insert(
                  array([
                      'album_id' => '42',
                      'image' => $i.'.jpg',
                      'active' => '1',
                      'sequence' => $i
                  ])
            );
        }

        for($i = 1; $i <= 10; $i++){
            DB::table('photos')->insert(
                  array([
                      'album_id' => '44',
                      'image' => $i.'.jpg',
                      'active' => '1',
                      'sequence' => $i
                  ])
            );
        }

        for($i = 1; $i <= 10; $i++){
            DB::table('photos')->insert(
                  array([
                      'album_id' => '85',
                      'image' => $i.'.jpg',
                      'active' => '1',
                      'sequence' => $i
                  ])
            );
        }
        for($i = 1; $i <= 10; $i++){
            DB::table('photos')->insert(
                  array([
                      'album_id' => '91',
                      'image' => $i.'.jpg',
                      'active' => '1',
                      'sequence' => $i
                  ])
            );
        }
        for($i = 1; $i <= 10; $i++){
            DB::table('photos')->insert(
                  array([
                      'album_id' => '92',
                      'image' => $i.'.jpg',
                      'active' => '1',
                      'sequence' => $i
                  ])
            );
        }
        for($i = 1; $i <= 10; $i++){
            DB::table('photos')->insert(
                  array([
                      'album_id' => '97',
                      'image' => $i.'.jpg',
                      'active' => '1',
                      'sequence' => $i
                  ])
            );
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albums_photos');
    }
}