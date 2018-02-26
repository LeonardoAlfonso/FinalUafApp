<?php

use Illuminate\Database\Seeder;
use App\Models\UafParameter;

class UafParametersTable extends Seeder
{
    public function run()
    {
        DB::table('uafParameters')->delete();
        $json = File::get("database/data/uafParameters.json");
        $data = json_decode($json);

        foreach ($data as $key) {
            UafParameter::create(array(
                'nameParameter' => $key->name,
                'showParameter' => $key->show,
                'valueParameter' => $key->value,
            ));
        }
    }
}
