<?php

namespace app\models;
require 'Model.php';

use app\models\Model;

use PDO;

class Trip extends Model
{
    private $id;
    private $departureTime;
    private $arriveTime;
    private $seatsAvailable;
    private $price;
    private $numberBus;
    private $roadId;

  

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setDepartureTime($departureTime)
    {
        $this->departureTime = $departureTime;
    }

    public function setArriveTime($arriveTime)
    {
        $this->arriveTime = $arriveTime;
    }

    public function setSeatsAvailable($seatsAvailable)
    {
        $this->seatsAvailable = $seatsAvailable;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setNumberBus($numberBus)
    {
        $this->numberBus = $numberBus;
    }

    public function setRoadId($roadId)
    {
        $this->roadId = $roadId;
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
        $sqlState = self::database()->prepare("SELECT * FROM trip WHERE $column $operator ?");
        $sqlState->execute([$value]);
        $data = $sqlState->fetchAll(PDO::FETCH_ASSOC);
        if (empty($data)) {
            return null;
        }
        return $data;
    }




    public function create() {
        $sql = "INSERT INTO trip (departure_time, arrive_time, seats_available,  number_bus, road_id) VALUES (?, ?, ?, ?, ?, ?)";
        $params = [$this->departureTime, $this->arriveTime, $this->seatsAvailable,  $this->numberBus, $this->roadId];
    
        $sqlState = static::database()->prepare($sql);
        return $sqlState->execute($params);
    }
    
 



    public function update() {
        $sql = "UPDATE trip SET ";
        $params = [];
    
        if ($this->departureTime !== null) {
            $sql .= "departure_time=?, ";
            $params[] = $this->departureTime;
        }
    
        if ($this->arriveTime !== null) {
            $sql .= "arrive_time=?, ";
            $params[] = $this->arriveTime;
        }
    
        if ($this->seatsAvailable !== null) {
            $sql .= "seats_available=?, ";
            $params[] = $this->seatsAvailable;
        }
    
        if ($this->price !== null) {
            $sql .= "price=?, ";
            $params[] = $this->price;
        }
    
        if ($this->numberBus !== null) {
            $sql .= "number_bus=?, ";
            $params[] = $this->numberBus;
        }
    
        if ($this->roadId !== null) {
            $sql .= "road_id=?, ";
            $params[] = $this->roadId;
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
        $sqlState = self::database()->prepare("DELETE FROM trip WHERE id = ?");
        return $sqlState->execute([$id]);
    }
}