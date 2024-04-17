<?php
$servername = "localhost";
$username = "3ms";
$password = "password123";
$dbname = "3mscatering";


$conn = new mysqli($servername, $username, $password, $dbname);
$conn -> query("CREATE TABLE IF NOT EXISTS 
utility_table(
        utilityId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        Price INT NOT NULL,
        utilityName VARCHAR(50) NOT NULL
    )
");
$conn -> query(" CREATE TABLE IF NOT EXISTS 
order_table(
        orderId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        utilityID INT NOT NULL,
        quantity INT NOT NULL,
        FOREIGN KEY (utilityID) REFERENCES utility_table(utilityId)
        )
");
$conn -> query("CREATE TABLE IF NOT EXISTS 
package_table(
        packageId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        inclusions TEXT NOT NULL,
        packagePrice INT NOT NULL
    )
");
$conn -> query("CREATE TABLE IF NOT EXISTS 
catering_address_table(
        cateringAddressId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        buildingNumber VARCHAR(50) NOT NULL,
        street VARCHAR(50) NOT NULL,
        barangay VARCHAR (50) NOT NULL,
        city VARCHAR(50) NOT NULL,
        zipcode INT NOT NULL)
");
$conn -> query("CREATE TABLE IF NOT EXISTS
event_table(
        eventId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        cateringAddressId INT NOT NULL,
        eventDate DATE NOT NULL,
        eventTimeSlot VARCHAR (15) NOT NULL,   
        FOREIGN KEY (cateringAddressId) REFERENCES catering_address_table(cateringAddressId)
    
)

");
$conn -> query("CREATE TABLE IF NOT EXISTS
customer_address_table(
        customerAddressId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        buildingNumber VARCHAR(50) NOT NULL,
        street VARCHAR(50) NOT NULL,
        barangay VARCHAR (50) NOT NULL,
        city VARCHAR (50) NOT NULL,
        zipcode INT NOT NULL)
    
");
$conn -> query("CREATE TABLE IF NOT EXISTS
customer_table(
        customerId INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
        customerAddressID INT NOT NULL,
        appointmentDate DATE NOT NULL,
        appointmentTimeSlot VARCHAR (15) NOT NULL,
        firstName VARCHAR (50) NOT NULL,
        lastName VARCHAR (50) NOT NULL,
        phoneNumber INT (11) NOT NULL,
        specifications TEXT NOT NULL,
        FOREIGN KEY (customerAddressId) REFERENCES customer_address_table(customerAddressId)

)
");

$conn -> query("CREATE TABLE IF NOT EXISTS 
catering_appointment_table(
        cateringId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        orderId INT NOT NULL,
        packageId INT NOT NULL,
        customerId INT NOT NULL,
        eventId INT NOT NULL,
        estimatedTotalPrice INT NOT NULL,
        FOREIGN KEY (orderId) REFERENCES order_table(orderId),
        FOREIGN KEY (packageId) REFERENCES package_table(packageId),
        FOREIGN KEY (customerId) REFERENCES customer_table(customerId),
        FOREIGN KEY (eventId) REFERENCES event_table(eventId)       
)

");
?>