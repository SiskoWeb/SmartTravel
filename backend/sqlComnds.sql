CREATE Company tale (
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


CREATE TABLE trip (
    id INT AUTO_INCREMENT PRIMARY KEY,
    departure_time VARCHAR(255) NOT NULL,
    arrive_time VARCHAR(255) NOT NULL,
    seats_available INT NOT NULL,
    price DECIMAL(10, 2),
    number_bus INT,
    road_id INT,
    FOREIGN KEY (number_bus) REFERENCES bus(number_bus),
    FOREIGN KEY (road_id) REFERENCES road(id)
);

DELIMITER //
-- //srource :https://youtu.be/jVbj72YO-8s
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


