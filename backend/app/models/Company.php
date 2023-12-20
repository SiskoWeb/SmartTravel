<?php

namespace app\models;
require 'Model.php';

use app\models\Model;
use Exception;
use PDO;

class Company extends Model
{
    private $id;
    private $name;
    private $img;
  



    public function setId()
    {
        return $this->id;
    }
    public function setName()
    {
        return $this->name;
    }

    public function setImg()
    {
        return $this->img;
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
        echo 'hello from create model';
        $sqlState = static::database()->prepare("INSERT INTO company VALUES(null,?,?)");
        return $sqlState->execute([
            $this->name,
            $this->img
        ]);
    }
    // public function update($id)
    // {
    
    // }

    public function destroy($id)
    {
        $sqlState = self::database()->prepare("DELETE FROM company WHERE id = ?");
        return $sqlState->execute([$id]);
    }
}