<?php

namespace App\Http\Controllers\CrudGenerate;

use Illuminate\Support\Str;

class Meta
{
    
    public $schemaManager;

    public $schema;

    public $tableObjects;

    public $tables;

    
    public function __construct($connection)
    {
        $this->setSchemaManager($connection);
    }

    public function getTableMetadata()
    {
        $this->getTables();

        return $this->tables = $this->setTablesMetadata();
    }

    public function setTablesMetadata()
    {
        foreach ($this->tableObjects as $tableObject) {
            
            $tablename    = $this->getTableName($tableObject->getName());

            $className    = Str::studly($tablename);

            $instanceName = Str::camel($tablename);

            $columns      = $this->getColumnArray($tableObject->getColumns());
    
            $primaryKey   = $this->getPrimaryKey($tableObject);

            $foreingKeys  = $this->getForeignKeys($tableObject);
            
            $tables[$tablename] = [
                    'className'     => $className,
                    'instanceName'  => $instanceName,
                    'columns'       => $columns,
                    'primaryKey'    => $primaryKey,
                    'foreignKeys'   => $foreingKeys
            ];
        }
        return $tables;
    }


    /** tables */

    // exception requiere schema

    public function getTables()
    {
        $allTables = $this->schemaManager->listTables();

        foreach ($allTables as  $table) {

            if($table->getNamespaceName() == $this->schema)
            {
                $this->tableObjects[] = $table;
            }
        }
    }

    public function getTableName($tableFullName)
    {
        return strtolower(
            substr($tableFullName, strpos($tableFullName, '.') + 1)
        );
    }


    /** cols */

    public function getColumnArray($columnObjects)
    {
        $columns = [];

        foreach ($columnObjects as $columnObject) 
        {
            $colsAttr = $this->getColumnsAttributes($columnObject);

            $columns[$colsAttr['name']] = [
                'type'      => $colsAttr['type'],
                'notnull'   => $colsAttr['notnull'],
                'length'    => $colsAttr['length'],
                'precision' => $colsAttr['precision'],
                'comment'   => $colsAttr['comment']
            ];
        }

        return $columns; 
    }

    public function getColumnsAttributes($columnObject)
    {
        $attributes = $columnObject->toArray();

        $attributes['type'] = $attributes['type']->getName();

        return $attributes;
    }


    /** constraints */

    public function getPrimaryKey($tableObject)
    {
        return  $this->schemaManager
                ->listTableIndexes($tableObject->getName())['primary']
                ->getColumns()[0];
    }

    public function getForeignKeys($tableObject)
    {
        $fkObjects = $tableObject->getForeignKeys();

        $foreignKeys = [];
       
        if(count($fkObjects) > 0)
        {
            foreach ($fkObjects as $fkObject) 
            {
                $foreignName   = $fkObject->getName();
                $localColumn   = $fkObject->getLocalColumns()[0];
                $localTable    = $this->getTableName($fkObject->getLocalTableName());
                $foreignColumn = $fkObject->getForeignColumns()[0];
                $foreignTable  = $this->getTableName($fkObject->getForeignTableName());

                $foreignKeys[$foreignName] = [
                    'localTable'    => $localTable,
                    'localColumn'   => $localColumn,
                    'foreignTable'  => $foreignTable,
                    'foreignColumn' => $foreignColumn,
                ];
            }
        }
        return  $foreignKeys;
    }

    //global data

    private function setSchemaManager($connection)
    {
        $this->schemaManager = $connection->getDoctrineSchemaManager();
    }

    public function getDatabases()
    {
        return $this->schemaManager->listDatabases();
    }

    public function getSchemas()
    {
        return $this->schemaManager->getSchemaNames();
    }

    public function setSchema($schema)
    {
        return $this->schema = $schema;
    }

    //array to object
    static public function arrayToObject(array $array)
    {
        foreach($array as $key => $value)
        {
            if(is_array($value))
            {
                $array[$key] = self::arrayToObject($value);
            }
        }
        return (object)$array;
    }
}