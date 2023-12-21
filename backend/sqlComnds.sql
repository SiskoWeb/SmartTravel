CREATE TABLE Company (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    image VARCHAR(255)
);

CREATE TABLE bus (
    number_bus INT AUTO_INCREMENT PRIMARY KEY,
    companyID INT,
    capacity INT,
    cost_per_km DECIMAL(10, 2),
    FOREIGN KEY (companyID) REFERENCES Company(id)
)

CREATE TABLE road (
    id INT AUTO_INCREMENT PRIMARY KEY,
    departure VARCHAR(255) NOT NULL,
    destination VARCHAR(255) NOT NULL,
    distance_km DECIMAL(10, 2) NOT NULL,
    distance_minute INT NOT NULL,
    UNIQUE KEY unique_departure_destination (departure, destination)
);

-- //srource :https://youtu.be/jVbj72YO-8s

CREATE TABLE trip (
    id INT AUTO_INCREMENT PRIMARY KEY,
    departure_time VARCHAR(255) NOT NULL,
    arrive_time VARCHAR(255) NOT NULL,
    seats_available INT NOT NULL,
    price DECIMAL(10, 2),
    number_bus INT,
    road_id INT,
    timeOfDay ENUM('morning', 'afternoon', 'night') INT NOT NULL,
    FOREIGN KEY (number_bus) REFERENCES bus(number_bus),
    FOREIGN KEY (road_id) REFERENCES road(id)
);

DELIMITER //
CREATE TRIGGER calculate_price
BEFORE INSERT ON trip
FOR EACH ROW
BEGIN
    DECLARE cost DECIMAL(10, 2);
    DECLARE distance DECIMAL(10, 2);

    -- Get cost_per_km from the bus table
    SELECT cost_per_km INTO cost FROM bus WHERE number_bus = NEW.number_bus;

    -- Get distance_km from the road table
    SELECT distance_km INTO distance FROM road WHERE id = NEW.road_id;

    -- Calculate the price
    SET NEW.price = cost * distance;
END;
//

DELIMITER ;




SELECT *
FROM trip
JOIN bus ON trip.number_bus = bus.number_bus
JOIN trip ON trip.road_id = road.id;



-- //join all tables 
SELECT
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
    road.departure = 'safi' 
    AND road.destination = 'casablanca'
    AND DATE(trip.departure_time) = '2023-01-10';
