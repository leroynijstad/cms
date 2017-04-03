<?php

use App\Input;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->enum('active', ['1', '0'])->default('1');
            $table->string('image');
            $table->string('link');
            $table->enum('type', ['main', 'small'])->default('main');
            $table->timestamps();
        });

        
        $columns = Schema::getColumnListing('banners');
        $columns = array_diff($columns, ['id','created_at', 'updated_at']);

        foreach($columns as $column){
            $input = new Input;
            $input->table_name = 'banners';
            $input->column_name = $column;
            $input->save();
        }

        DB::table('banners')->insert(
              array([
                  'title' => 'Bali',
                  'active' => '1',
                  'image' => 'cover_bali.jpg',
                  'link' => '/portfolio',
                  'type' => 'main'
              ],[
                  'title' => 'Bali',
                  'active' => '1',
                  'image' => 'cover_bali.jpg',
                  'link' => '/portfolio',
                  'type' => 'main'
              ],[
                  'title' => 'Bali',
                  'active' => '1',
                  'image' => 'cover_bali.jpg',
                  'link' => '/portfolio',
                  'type' => 'main'
              ],[
                  'title' => 'Bali',
                  'active' => '1',
                  'image' => 'cover_bali.jpg',
                  'link' => '/portfolio',
                  'type' => 'main'
              ],[
                  'title' => 'Lesotho',
                  'active' => '1',
                  'image' => 'small_lesotho.jpg',
                  'link' => '/portfolio',
                  'type' => 'small'
              ],[
                  'title' => 'Lesotho',
                  'active' => '1',
                  'image' => 'small_lesotho.jpg',
                  'link' => '/portfolio',
                  'type' => 'small'
              ],[
                  'title' => 'Lesotho',
                  'active' => '1',
                  'image' => 'small_lesotho.jpg',
                  'link' => '/portfolio',
                  'type' => 'small'
              ],[
                  'title' => 'Lesotho',
                  'active' => '1',
                  'image' => 'small_lesotho.jpg',
                  'link' => '/portfolio',
                  'type' => 'small'
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
        //
    }
}
