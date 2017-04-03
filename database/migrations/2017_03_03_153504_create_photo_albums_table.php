<?php

use App\Input;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('text');
            $table->string('image');
			$table->enum('active', ['1', '0'])->default('1');
            $table->string('tags');
			$table->integer('parent_id');
            $table->timestamps();
        });
        
        $columns = Schema::getColumnListing('albums');
        $columns = array_diff($columns, ['id','created_at', 'updated_at']);

        foreach($columns as $column){
            $input = new Input;
            $input->table_name = 'albums';
            $input->column_name = $column;
            $input->save();
        } 

        DB::table('albums')->insert(
              array([
                  'id' => '42',
                  'name' => 'Lesotho',
                  'text' => 'Lesotho is een prachtig klein landje in het midden van Zuid-Afrika. De mensen voorzien volledig in hun eigen levensonderhoud; ze wonen in eigen gebouwde kleien hutjes, verbouwen hun eigen eten en brouwen hun eigen bier. Het landschap is waanzinnig en de mensen zijn erg gastvrij.',
                  'image' => 'main.jpg',
                  'active' => '1',
                  'tags' => 'Lesotho, Landschap, Primitief, Reizen, Natuur',
                  'parent_id' => '0'
              ],[
                  'id' => '44',
                  'name' => 'Zuid-Afrika',
                  'text' => 'Zuid-Afrika is uniek. Er is hier ontzettend veel wildleven te bewonderen. Dit heb ik dan ook gedaan door als een soort wildlife fotograaf met een eigen gehuurde auto door de nationale parken te crossen. Hoe gaaf het dan is om olifanten, giraffen, nijlpaarden, zebra&#39;s en ga zo maar door tegen te komen, snap je alleen als je het zelf hebt gedaan. Mijn camera maakte in ieder geval overuren!<br />
                  Naast al die mooie dieren, wonen er ook mooie mensen, maar ook het landschap is geweldig.',
                  'image' => 'main.jpg',
                  'active' => '1',
                  'tags' => 'Zuid-Afrika, Krugerpark, Wildlife, Big five, Reizen',
                  'parent_id' => '0'
              ],[
                  'id' => '85',
                  'name' => 'Singapore',
                  'text' => 'Dit jaar ga ik afstuderen als Sociaal Juridisch Dienstverlener en ik mag zelf kiezen waar en hoe ik dit ga doen. Omdat ik heel erg van reizen en van fotograferen hou, heb ik bedacht om dit allemaal te combineren en daarom te gaan afstuderen in... Singapore! Ik ga hier drie maanden en zal door de weeks niet veel tijd hebben om te fotograferen, maar in de weekenden gelukkig wel. Misschien inspireren de foto&#39;s jou wel en wil je ook Singapore een bezoekje brengen... :)',
                  'image' => 'main.jpg',
                  'active' => '1',
                  'tags' => 'Singapore, Reizen, Azië',
                  'parent_id' => '0'
              ],[
                  'id' => '91',
                  'name' => 'Dieren',
                  'text' => '',
                  'image' => 'main.jpg',
                  'active' => '1',
                  'tags' => '',
                  'parent_id' => '85'
              ],[
                  'id' => '92',
                  'name' => 'Natuur',
                  'text' => '',
                  'image' => 'main.jpg',
                  'active' => '1',
                  'tags' => '',
                  'parent_id' => '85'
              ],[
                  'id' => '97',
                  'name' => 'Stad & Cultuur',
                  'text' => '',
                  'image' => 'main.jpg',
                  'active' => '1',
                  'tags' => 'Singapore, Reizen, Azië',
                  'parent_id' => '85'
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
        Schema::dropIfExists('albums');
    }
}
?>