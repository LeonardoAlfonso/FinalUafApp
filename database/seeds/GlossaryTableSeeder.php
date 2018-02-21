<?php

use Illuminate\Database\Seeder;
use App\Models\Glossary;

class GlossaryTableSeeder extends Seeder
{
    public function run()
    {
          DB::table('glossary')->delete(); 
          $json = File::get("database/data/glossary.json");
          $data = json_decode($json);

          foreach ($data as $key) {
              Glossary::create(array(
                  'group' => substr($key->word, 0, 1),
                  'word' => $key->word,
                  'definition' => $key->definition,
              ));
          }
    }
}
