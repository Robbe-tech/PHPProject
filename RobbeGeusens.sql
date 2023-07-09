 DROP DATABASE IF EXISTS RobbeGeusens;
 CREATE DATABASE RobbeGeusens;
 USE RobbeGeusens;

/*
Every product has it's own detailed information. If it is a part of a kit, it's information will be available when asked for.
Weight en diameter zijn in
1g en 1mm respectievelijk
*/
CREATE TABLE Products (
    ProductID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    ProductName VARCHAR(64) NOT NULL,
    Manufacturer VARCHAR(100) NOT NULL,
    Descript TEXT,
    Stock INT UNSIGNED NOT NULL,
    ProductType CHAR NOT NULL,
    WeightG INT UNSIGNED NOT NULL,
    Resizable BIT,
    Electrical BIT,
    PRIMARY KEY (ProductID)
);

CREATE TABLE Heads(
    HeadID BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    ProductID INT UNSIGNED NOT NULL,
    HeadType CHAR,
    Diameter INT UNSIGNED,
    PRIMARY KEY (HeadID),
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID)
);

/*
Dit wordt de ongevere layout van een kit description en default value van de textbox als je een kit aanmaakt
These are the specifications for every item in the kit:
>KitItem1
>KitItem2
Prijs is in 0.01euro
*/
CREATE TABLE Kits (
    KitID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    KitName VARCHAR(64) NOT NULL,
    KitPrice INT UNSIGNED NOT NULL,
    Descript TEXT,
    WeightG INT UNSIGNED NOT NULL,
    IsKit BIT NOT NULL,
    PRIMARY KEY (KitID)
);

CREATE TABLE KitProducts (
    KitID INT UNSIGNED NOT NULL,
    ProductID INT UNSIGNED NOT NULL,
    Quantity INT UNSIGNED NOT NULL DEFAULT 1,
    FOREIGN KEY (KitID) REFERENCES Kits(KitID),
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID),
    PRIMARY KEY (KitID, ProductID)
);

CREATE TABLE Images (
    ImageID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    KitID INT UNSIGNED NOT NULL,
    Link VARCHAR(100) NOT NULL,
    PRIMARY KEY (ImageID),
    FOREIGN KEY (KitID) REFERENCES Kits(KitID)
);

/*
Dit is appart omdat het idee is dat je mogelijk in postkantoren of winkels kan laten afzetten, de feature van winkels is van minimaal belang, eerst komt al de rest
*/
CREATE TABLE Addresses (
    AddressID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    Country VARCHAR(56) NOT NULL,
    PostalCode INT(7) UNSIGNED NOT NULL,
    City VARCHAR(85) NOT NULL,
    Street VARCHAR(100) NOT NULL,
    Nr INT UNSIGNED NOT NULL,
    Appartment VARCHAR(4),
    PRIMARY KEY (AddressID)
);

CREATE TABLE Users (
    UserID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    FirstName VARCHAR(32) NOT NULL,
    LastName VARCHAR(32) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Passwd VARCHAR(64) NOT NULL,
    Phone BIGINT UNSIGNED NOT NULL,
    AddressID INT UNSIGNED NOT NULL,
    BirthDate DATE,
    Administrator BIT NOT NULL DEFAULT 0,
    PRIMARY KEY (UserID),
    FOREIGN KEY (AddressID) REFERENCES Addresses(AddressID)
);

CREATE TABLE Shops (
    ShopID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    ShopName VARCHAR(32),
    AddressID INT UNSIGNED NOT NULL,
    PRIMARY KEY (ShopID),
    FOREIGN KEY (AddressID) REFERENCES Addresses(AddressID)
);

CREATE TABLE ShopSupply (
    ShopID INT UNSIGNED NOT NULL,
    KitID INT UNSIGNED NOT NULL,
    Supply INT UNSIGNED NOT NULL,
    FOREIGN KEY (ShopID) REFERENCES Shops(ShopID),
    FOREIGN KEY (KitID) REFERENCES Kits(KitID),
    PRIMARY KEY (ShopID, KitID)
);

CREATE TABLE Orders (
    OrderID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    UserID INT UNSIGNED NOT NULL,
    Discount INT UNSIGNED,
    PlacementDate DATE,
    DeliveryDate DATE,
    PlacedShop INT UNSIGNED,
    DeliveryAddress INT UNSIGNED NOT NULL,
    HouseDelivery BIT NOT NULL DEFAULT 0,
    DeliveryCost INT UNSIGNED,
    Payed BIT NOT NULL DEFAULT 0,
    Delivered BIT NOT NULL DEFAULT 0,
    PRIMARY KEY (OrderID),
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (PlacedShop) REFERENCES Shops(ShopID),
    FOREIGN KEY (DeliveryAddress) REFERENCES Addresses(AddressID)
);

CREATE TABLE OrderedKits (
    OrderID INT UNSIGNED NOT NULL,
    KitID INT UNSIGNED NOT NULL,
    Quantity INT UNSIGNED NOT NULL,
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
    FOREIGN KEY (KitID) REFERENCES Kits(KitID),
    PRIMARY KEY (OrderID, KitID)
);