<?php
namespace HotelFactory\models;
use HotelFactory\core\Db;

class model extends Db
{
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