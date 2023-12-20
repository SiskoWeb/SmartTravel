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