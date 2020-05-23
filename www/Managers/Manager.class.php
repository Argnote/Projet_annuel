<?php
namespace HotelFactory\Managers;
use http\Exception;
use PDO;

class Manager
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
            throw new Exeption($e);
        }
        
        $this->table =  DB_PREFIXE.(new \ReflectionClass(get_called_class()))->getShortName();
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
    public function find(int $id)
    {

    }
    public function findAll()
    {
    }

    public function findBy(array $params, array $order = null): ?array
    {
        $results = array();
        $sql = "SELECT * FROM $this->table WHERE";
        foreach ($params as $key => $value)
        {
            if(is_string($value))
                $comparator = 'LIKE';
            else
                $comparator = '=';
            $sql .="$key $comparator :$key and";
            $params[":$key"] = $value;
            unset($params[$key]);
        }
        $sql = rtrim($sql, 'and');
        if($order)
        {
            $sql .= "ORDER BY ". key($order)." ". $order[$key($order)];
        }
        $result = $this -> sql($sql, $params);
        $rows = $result -> fetchAll();

        foreach($rows as $row)
        {
            $object = new $this->class();
            array_push($result, $object->hydrate($row));
        }
        return $results;
    }

    public function count(array $params)
    {

    }

    public function delete(int $id)
    {

    }

/*    public function hydrate(array $donnees)
    {
        foreach($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }*/
}
