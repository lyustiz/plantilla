<?php

namespace App\Http\Controllers\CrudGenerate;

use Illuminate\Support\Str;

class ControllerGenerator
{
    public $tables;

    //CONFIG

    private $controllerPath;

    private $templatePath;

    private $hiddenCols;

    private $actions;


    public function __construct($tables)
    {
        $this->tables  = $tables;

        $this->config();
    }

    public function config()
    {
        $conf  = \Config::get('crudgenerate');

        $paths = $conf['paths'];

        $cols  = $conf['cols'];

        $this->controllerPath = $paths['controllers'];

        $this->templatePath   = $paths['templates'] . 'controller/';

        $this->hiddenCols     = $cols['hiddenCols'];

        $this->actions        = $conf['actions'];
    }

    public function generate()
    {
        foreach ($this->tables as $tableName => $table) 
        {
            $cruds = $this->definition($tableName, $table);
 
            $this->compile($cruds, $table);
        }
    }

    public function definition($tableName, $table)
    {
        $foreingnsTables  = $this->foreignsTables($table->foreignKeys);

        foreach ($this->actions as $action) 
        {
            $validateFields  = $this->getValidateFields( $action, $table );
            
            $cruds[$action]  =  $this->getCrudActions(
                                            $action, 
                                            $table->instanceName, 
                                            $table->className, 
                                            $foreingnsTables, 
                                            $validateFields
                                        );
        }
        
        return $cruds;
    }

    public function compile($cruds, $table)
    {
        $compiled =  str_replace(
            [ '//index', '//show', '//store', '//edit', '//update', '//destroy'],
            [ $cruds['index'], $cruds['show'], $cruds['store'], $cruds['edit'], $cruds['update'], $cruds['destroy'] ],
            file_get_contents(app_path($this->controllerPath . $table->className . 'Controller.php'))
        );
        
        file_put_contents(
            app_path($this->controllerPath . $table->className . 'Controller.php'),
            $compiled
        );
    }

    public function getValidateFields( $action, $table )
    {
        $validateFields = [];

        $validators     = null;
        
        foreach ($table->columns as $columnName => $column) {

            if( $action == 'store' && $columnName == $table->primaryKey)
            {
                continue;
            }

            if( in_array($action, ['store', 'update'])  && in_array($columnName, $this->hiddenCols))
            {
                continue;
            }

            switch ( true ) 
            {
                case in_array( $column->type, [ 'string', 'text' ] ):

                    $validators = [ 'required', 'alpha_num', 'max:' . $column->length ];
                    break;

                case $column->type == 'datetime':

                    $validators = [ 'required', 'date'];
                    break;
        
                case $column->type == 'integer':

                    $validators = [ 'required', 'integer', 'max:' . $column->precision ];
                    break;
            
                case $column->type == 'decimal':

                    $validators = [ 'required', 'numeric', 'max:' . $column->precision ];
                    break;

                case $column->type == 'boolean':

                    $validators = [ 'required', 'boolean'];
                    break; 
                            
                default:

                    $validators = ['required', 'alpha_num', 'max:' . $column->length ];
                    break;
            }

            $colSpace   = (( 18 - strlen($columnName) ) < 0) ? 0 : 18 - strlen($columnName);
            
            $arowSpaces = str_repeat(' ', $colSpace ) ."=> \t";

            $validateFields[] = "'" . $columnName . "'" . $arowSpaces . 
                                "'" . implode( "|", $validators ) . "'" . "," ;
        }
        
        return  implode( PHP_EOL ."\t\t\t" , $validateFields );
    }

    public function foreignsTables($foreignKeys)
    {
        $foreignTable = null;

        if( $foreignKeys != [] )
        {
            foreach ($foreignKeys as $foreignKey) 
            {
                $foreignTable[]  =  Str::studly($foreignKey->foreignTable);
            }
        }

        return ($foreignTable == null ) ? null : "'".implode("', '", $foreignTable)."'";
    }

    public function getCrudActions( $action, $modelInstance, $modelName, $foreingnsTables, $validateFields )
    {
        return str_replace(
            [ '{{modelInstance}}', '{{modelName}}', '{{foreingnsTables}}', '{{validateFields}}'],
            [ $modelInstance, $modelName, $foreingnsTables, $validateFields ],
            file_get_contents(base_path($this->templatePath . "crud/controller.$action.template"))
        );
    }
}