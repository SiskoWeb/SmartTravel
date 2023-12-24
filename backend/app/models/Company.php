<?php

namespace app\models;

require 'Model.php';

use app\models\Model;

use PDO;

class Company extends Model
{
    private $id;
    private $name;
    private $img;




    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setImg($img)
    {
        $this->img = $img;
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



    public static function find($id)
    {
        return static::where('id', $id);
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




    public function create()
    {

        $sqlState = static::database()->prepare("INSERT INTO company (name, image) VALUES (?, ?)");
        return $sqlState->execute([$this->name, $this->img]);
    }
    // public function update()
    // {
    //     $sqlState = static::database()->prepare("UPDATE company SET name=?, image=? WHERE id=?");
    //     return $sqlState->execute([$this->name, $this->img, $this->id]);
    // }
    public function update()
    {

        $sql = "UPDATE company SET ";
        $params = [];

        if ($this->name !== null) {
            $sql .= "name=?, ";
            $params[] = $this->name;
        }

        if ($this->img !== null) {
            $sql .= "image=?, ";
            $params[] = $this->img;
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
        $sqlState = self::database()->prepare("DELETE FROM company WHERE id = ?");
        return $sqlState->execute([$id]);
    }
}
