<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CrudGenerate\CrudGenerate;

class Crud extends Controller
{
    public $crud;

    public function __construct(CrudGenerate $crudGenerate)
    {
        $this->crud = $crudGenerate;
    }

    public function index()
    {
        $schemas = $this->crud->getSchemas();

        return view('crud', compact('schemas'));

    }
    
    public function generate()
    {
        $databases = $this->crud->getDatabases();
        
        

        $schema = 'corpovex_visitas';

        $tables = $this->crud->setSchema($schema)->getTableMetadata();
        
        $this->crud->generate();

        //$object = json_decode(json_encode($array), FALSE);

    }
}
