<?php

namespace app\models;
require 'Model.php';

use app\models\Model;

use PDO;

class Bus extends Model
{
    private $number_bus;
    private $companyID;
    private $capacity;
    private $cost_per_km;
  



    public function setNumberBus($number_bus) {
        $this->number_bus = $number_bus;
    }

    public function setCompanyID($companyID) {
        $this->companyID = $companyID;
    }

    public function setCapacity($capacity) {
        $this->capacity = $capacity;
    }

    public function setCostPerKm($cost_per_km) {
        $this->cost_per_km = $cost_per_km;
    }

    public static function latest()
    {
      

            return static::database()->query('SELECT * FROM company order by id DESC')
            ->fetchAll(PDO::FETCH_ASSOC);
   
    }



    public static function all()
    {
        return static::database()
            ->query("SELECT * FROM company")
            ->fetchAll(PDO::FETCH_ASSOC);
    }


    
    public static function find($number_bus)
    {
        return static::where('number_bus', $number_bus);
    }


    //get element from db with condition
    public static function where($column, $value, $operator = '=')
    {
        $sqlState = self::database()->prepare("SELECT * FROM company WHERE $column $operator ?");
        $sqlState->execute([$value]);
        $data = $sqlState->fetchAll(PDO::FETCH_ASSOC);
        if (empty($data)) {
            return null;
        }
        return $data;
    }




    public function create() {
        $sqlState = static::database()->prepare("INSERT INTO bus (number_bus, companyID, capacity, cost_per_km) VALUES (?, ?, ?, ?)");
        return $sqlState->execute([$this->number_bus, $this->companyID, $this->capacity, $this->cost_per_km]);
    }
    // public function update()
    // {
    //     $sqlState = static::database()->prepare("UPDATE company SET name=?, image=? WHERE id=?");
    //     return $sqlState->execute([$this->name, $this->img, $this->id]);
    // }
    public function update()
    {
       
        // $sql = "UPDATE company SET ";
        // $params = [];

        // if ($this->name !== null) {
        //     $sql .= "name=?, ";
        //     $params[] = $this->name;
        // }

        // if ($this->img !== null) {
        //     $sql .= "image=?, ";
        //     $params[] = $this->img;
        // }

        // // Remove the trailing comma and space from the SQL string
        // $sql = rtrim($sql, ", ");

        // $sql .= " WHERE id=?";
        // $params[] = $this->id;

        // $sqlState = static::database()->prepare($sql);

        // return $sqlState->execute($params);
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
        $sqlState = self::database()->prepare("DELETE FROM company WHERE id = ?");
        return $sqlState->execute([$id]);
    }
}