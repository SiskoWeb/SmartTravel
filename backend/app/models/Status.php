<?php

namespace app\models;

require 'Model.php';

use app\models\Model;

use PDO;

class Status extends Model
{


    public static function latest()
    {


        return static::database()->query('SELECT  (
            SELECT COUNT(*)
            FROM   bus
            ) AS bus_status,
            (
            SELECT COUNT(*)
            FROM   trip
            ) AS trip_status,
             (
            SELECT COUNT(*)
            FROM   road
            ) AS road_status,
            (SELECT COUNT(*)
             FROM company)
             AS company_status
    FROM    dual')
            ->fetch(PDO::FETCH_ASSOC);
    }
}
