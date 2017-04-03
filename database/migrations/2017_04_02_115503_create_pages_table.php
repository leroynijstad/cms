<?php

use App\Input;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('link');
            $table->enum('active', ['1', '0'])->default('1');
            $table->enum('type', ['include', 'text'])->default('include');
            $table->text('text');
            $table->timestamps();
        });
        
        $columns = Schema::getColumnListing('pages');
        $columns = array_diff($columns, ['id','created_at', 'updated_at']);
        
        foreach($columns as $column){
            $input = new Input;
            $input->table_name = 'pages';
            $input->column_name = $column;
            $input->save();
        }

          DB::table('pages')->insert(
              array([
                  'name' => 'portfolio',
                  'link' => 'portfolio',
                  'active' => '1',
                  'type' => 'include',
                  'text' => ''
              ],[
                  'name' => 'over Ruth',
                  'link' => 'over',
                  'active' => '1',
                  'type' => 'include',
                  'text' => ''
              ],[
                  'name' => 'contact',
                  'link' => 'contact',
                  'active' => '1',
                  'type' => 'include',
                  'text' => ''
              ])
          );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
