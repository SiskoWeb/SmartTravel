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
    private $timeOfDay;




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
    public function setTimeOfDay($timeOfDay)
    {
        $this->timeOfDay = $timeOfDay;
    }

    public static function latest()
    {


        return static::database()->query('SELECT * FROM trip order by id DESC')
            ->fetchAll(PDO::FETCH_ASSOC);
    }



    public static function all()
    {
        return static::database()
            ->query("SELECT * FROM trip")
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


    //get element from db with condition
    public static function filter($departure, $destination, $Date, $timeOfDay, $minPrice = null, $maxPrice = null,  $order = null, $company)
    {
        $sql = "SELECT
                trip.id AS trip_id,
                trip.departure_time,
                trip.arrive_time,
                trip.seats_available,
                trip.price,
                trip.number_bus,
                trip.road_id,
                trip.timeOfDay,
                company.id AS company_id,
                company.name AS company_name,
                company.image AS company_image,
                bus.capacity AS bus_capacity,
                road.departure AS road_departure,
                road.destination AS road_destination,
                road.distance_km AS road_distance_km,
                road.distance_minute AS road_distance_minute
            FROM
                trip
            JOIN bus ON trip.number_bus = bus.number_bus
            JOIN road ON trip.road_id = road.id
            JOIN Company ON bus.companyID = Company.id
            WHERE
                road.departure = ? 
                AND road.destination = ?
                AND DATE(trip.departure_time) = ?";

        $params = [$departure, $destination, $Date];

        // Add conditions for optional parameters
        if ($minPrice !== null) {
            $sql .= " AND trip.price >= ?";
            $params[] = $minPrice;
        }

        if ($maxPrice !== null) {
            $sql .= " AND trip.price <= ?";
            $params[] = $maxPrice;
        }

        if ($timeOfDay !== null) {
            $sql .= " AND trip.timeOfDay = ?";
            $params[] = $timeOfDay;
        }
        if ($company !== null) {
            $sql .= " AND company.name = ?";
            $params[] = $company;
        }

        // Add order by clause based on users choice
        $sql .= " ORDER BY trip.price " . ($order ? $order :  'DESC');

        $sqlState = self::database()->prepare($sql);
        $sqlState->execute($params);

        $data = $sqlState->fetchAll(PDO::FETCH_ASSOC);

        if (empty($data)) {
            return $data;
        }

        return $data;
    }



    public function create()
    {
        $sql = "INSERT INTO trip (departure_time, arrive_time, seats_available,  number_bus, road_id,timeOfDay) VALUES (?, ?, ?, ?, ?.?)";
        $params = [$this->departureTime, $this->arriveTime, $this->seatsAvailable,  $this->numberBus, $this->roadId, $this->timeOfDay];

        $sqlState = static::database()->prepare($sql);
        return $sqlState->execute($params);
    }





    public function update()
    {
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

        if ($this->timeOfDay !== null) {
            $sql .= "timeOfDay=?, ";
            $params[] = $this->timeOfDay;
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


    public static function isDuplicateTrip($roadId, $departureTime)
    {
        $sql = "SELECT departure_time FROM trip WHERE road_id = ?";

        $params = [$roadId];

        $sqlState = self::database()->prepare($sql);
        $sqlState->execute($params);

        $existingDepartureTimes = $sqlState->fetchAll(PDO::FETCH_COLUMN);

        foreach ($existingDepartureTimes as $roadDepartureTime) {
            // Check if the new departure time is more than 1 hour later than any existing departure time
            if (strtotime($departureTime) <= strtotime($roadDepartureTime) + 3600) {
                return true; // Duplicate trip
            }
        }

        return false; // Not a duplicate trip
    }
}
