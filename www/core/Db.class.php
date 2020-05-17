<?php
namespace HotelFactory\core;
use http\Exception;
use PDO;

class Db
{
    private $table;
    private $pdo;

    public function __construct()
    {
        //SINGLETON
        try 
        {
            $this->pdo = new PDO(DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PWD);
        } 
        catch (Exception $e) 
        {
            die("Erreur SQL : ".$e->getMessage());
        }
        
        $this->table =  DB_PREFIXE.get_called_class();
    }


    public function save()
    {
        $propChild = get_object_vars($this);
        $propChild = array_filter($propChild, function($value)
        {
            return null !== $value;
        });
        $propDB = get_class_vars(get_class());
        $columnsData = array_diff_key($propChild, $propDB);
        $columns = array_keys($columnsData);
        if (true) 
        {
            //INSERT
            $sql = "INSERT INTO "."$this->table"."(".implode(",", $columns).") VALUES (:".implode(",:", $columns).");";
        } 
        else 
        {
            //UPDATE
            foreach ($columns as $column) 
            {
                $sqlUpdate[] = $column."=:".$column;
            }

            $sql = "UPDATE ".$this->table." SET ".implode(",", $sqlUpdate)." WHERE id=:id;";
        }

        echo($sql);
        print_r($columnsData);
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($columnsData);
    }

    public function hydrate(array $donnees)
    {
        foreach($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }
}
