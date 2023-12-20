<?php

namespace app\models;
require 'Model.php';

use app\models\Model;

use PDO;

class Road extends Model
{
    private $id;
    private $departure;
    private $destination;
    private $distance_km;
    private $distance_minute;

  
    public function setId($id)
    {
         $this->id = $id;
    }
    public function setDeparture($departure) {
        $this->departure = $departure;
    }

    public function setDestination($destination) {
        $this->destination = $destination;
    }

    public function setDistanceKm($distance_km) {
        $this->distance_km = $distance_km;
    }

    public function setDistanceMinute($distance_minute) {
        $this->distance_minute = $distance_minute;
    }

    public static function latest()
    {
      

            return static::database()->query('SELECT * FROM road order by id DESC')
            ->fetchAll(PDO::FETCH_ASSOC);
   
    }



    public static function all()
    {
        return static::database()
            ->query("SELECT * FROM road")
            ->fetchAll(PDO::FETCH_ASSOC);
    }


    
    public static function find($id)
    {
        return static::where('id', $id);
    }


    //get element from db with condition
    public static function where($column, $value, $operator = '=')
    {
        $sqlState = self::database()->prepare("SELECT * FROM road WHERE $column $operator ?");
        $sqlState->execute([$value]);
        $data = $sqlState->fetchAll(PDO::FETCH_ASSOC);
        if (empty($data)) {
            return null;
        }
        return $data;
    }




    public function create() {
        $sql = "INSERT INTO road (departure, destination, distance_km, distance_minute) VALUES (?, ?, ?, ?)";
        $params = [$this->departure, $this->destination, $this->distance_km, $this->distance_minute];

        $sqlState = static::database()->prepare($sql);
        return $sqlState->execute($params);
    }
 



    public function update() {
        $sql = "UPDATE road SET ";
        $params = [];
    
        if ($this->departure !== null) {
            $sql .= "departure=?, ";
            $params[] = $this->departure;
        }
    
        if ($this->destination !== null) {
            $sql .= "destination=?, ";
            $params[] = $this->destination;
        }
    
        if ($this->distance_km !== null) {
            $sql .= "distance_km=?, ";
            $params[] = $this->distance_km;
        }
    
        if ($this->distance_minute !== null) {
            $sql .= "distance_minute=?, ";
            $params[] = $this->distance_minute;
        }
    
        // Remove the trailing comma and space from the SQL string
        $sql = rtrim($sql, ", ");
    
        $sql .= " WHERE id=?";
        $params[] = $this->id;
    
        $sqlState = static::database()->prepare($sql);
    
        return $sqlState->execute($params);
    }
    


    public static function  destroy($id)
    {

        //remove file image
//     $company =   self::find($id);
   
// if(!unlink($company["image"]))
// {
//     echo "Not Working";
// }
// else {
//     echo " Working";
// }
        $sqlState = self::database()->prepare("DELETE FROM road WHERE id = ?");
        return $sqlState->execute([$id]);
    }
}