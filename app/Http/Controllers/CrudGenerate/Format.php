<?php

namespace App\Http\Controllers\CrudGenerate;

use Illuminate\Support\Str;

define('TAB',   '    '); 

class ModelGenerator
{

    public function __construct($tables)
    {
        $this->tables = $tables;
    }

    public function generate()
    {
        dd($this->tables);
    }

}