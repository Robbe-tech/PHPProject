USE RobbeGeusens

/*
Types
Bolt = b
Nut = n
Wrench = w
Screw = s
ScrewDriver = c
Spike = p
Hammer = h
Drill = d
DrillBit = r

Head Types
Slotted = s
Phillips = p
Mixed = m
Triwing = t
Allen Security = a
Torx Securty = o
Square = q
Pozidriv = z
Allen = l
Clutch = c
Torx = r
Spanner = n
Schrader = h
*/

INSERT INTO Products (ProductName, ProductPrice, Descript, Stock, WeightG, Resizable, Electrical)
VALUES ('DeWalt 8mm Slotted Screwdriver', 800, 'A medium sized slotted screwdriver by DeWalt', 100, 90, 0, 0);

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (1, 8, 'DeWalt', 's', 'c');

INSERT INTO Products (ProductName, ProductPrice, Descript, Stock, WeightG, Resizable, Electrical)
VALUES ('DeWalt 4mm Slotted Screwdriver', 800, 'A small sized slotted screwdriver by DeWalt', 100, 70, 0, 0);

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (2, 4, 'DeWalt', 's', 'c');

INSERT INTO Products (ProductName, ProductPrice, Descript, Stock, WeightG, Resizable, Electrical)
VALUES ('DeWalt 8mm Phillips Screwdriver', 800, 'A medium sized phillips screwdriver by DeWalt', 100, 90, 0, 0);

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (3, 8, 'DeWalt', 'p', 'c')

INSERT INTO Products (ProductName, ProductPrice, Descript, Stock, WeightG, Resizable, Electrical)
VALUES ('DeWalt 4mm Phillips Screwdriver', 800, 'A small sized phillips screwdriver by DeWalt', 100, 70, 0, 0);

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (4, 4, 'DeWalt', 'p', 'c');

INSERT INTO Kits(KitName, KitPrice, Descript, WeightG, IsKit)
VALUES ('Dewalt 4-Piece Screwdriver Set Multicolor', 1650, 'Make an excellent addition to your toolbox with the Dewalt 4-Piece Screwdriver Set Multicolor. It includes four screwdrivers for versatile use. The screwdrivers have ergonomically designed quad-lobular handles for maximum tip torque. They have a slip-resistant rubber grip for enhanced user comfort. With their precision machined and sand-blasted tips, these screwdrivers grip faster securely and resist slipping. The screwdrivers have a lacquer-coated bar to resist rust and a magnetic tip to hold screws securely while driving. Each screwdriver in this set has colour-coded handles for easy selection from the toolbox.',
    362, 1);

INSERT INTO KitProducts (KitID, ProductID, Quantity)
VALUES (1, 1, 1);

INSERT INTO KitProducts (KitID, ProductID, Quantity)
VALUES (1, 2, 1);

INSERT INTO KitProducts (KitID, ProductID, Quantity)
VALUES (1, 3, 1);

INSERT INTO KitProducts (KitID, ProductID, Quantity)
VALUES (1, 4, 1);

INSERT INTO Images (KitID, Link)
VALUES (1, 'Images/DeWaltSet1.jpg');

INSERT INTO Images (KitID, Link)
VALUES (1, 'Images/DeWaltSet2.jpg');

INSERT INTO Images (KitID, Link)
VALUES (1, 'Images/DeWaltSet3.jpg');

INSERT INTO Images (KitID, Link)
VALUES (1, 'Images/DeWaltSet4.jpg');

INSERT INTO Images (KitID, Link)
VALUES (1, 'Images/DeWaltSet5.jpg');

INSERT INTO Products (ProductName, ProductPrice, Descript, Stock, WeightG, Resizable, Electrical)
VALUES ('BENCHMARK T15 x 4" Torx Screwdriver', 1000, 'This 4" T15 Torx drive screwdriver is perfect for tightening the job. Make it a great addition or substitute to your set, or hang it on the workshop wall. The red and black rubber grip adds comfort, while its sturdy construction prolongs durability.',
    100, 90, 0, 0);

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (5, 2, 'BENCHMARK', 't', 'c');

INSERT INTO Kits(KitName, KitPrice, Descript, WeightG, IsKit)
VALUES ('BENCHMARK T15 x 4" Torx Screwdriver', 1000, 'This 4" T15 Torx drive screwdriver is perfect for tightening the job. Make it a great addition or substitute to your set, or hang it on the workshop wall. The red and black rubber grip adds comfort, while its sturdy construction prolongs durability.',
    90, 0);

INSERT INTO KitProducts (KitID, ProductID, Quantity)
VALUES (2, 5, 1);

INSERT INTO Images (KitID, Link)
VALUES (2, 'Images/TorxScrewdriver.jpg');

INSERT INTO Products (ProductName, ProductPrice, Descript, Stock, WeightG, Resizable, Electrical)
VALUES ('Amazon Basics 12-in-1 Magnetic Ratchet Screwdriver', 1500, 'Amazon Basics 12-in-1 Magnetic Ratchet Screwdriver',
    100, 280, 1, 0);

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (6, 2, 'AMAZON BASICS', 't', 'c');

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (6, 4, 'AMAZON BASICS', 't', 'c');

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (6, 6, 'AMAZON BASICS', 't', 'c');

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (6, 4, 'AMAZON BASICS', 'p', 'c');

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (6, 6, 'AMAZON BASICS', 'p', 'c');

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (6, 8, 'AMAZON BASICS', 'p', 'c');

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (6, 4, 'AMAZON BASICS', 'a', 'c');

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (6, 6, 'AMAZON BASICS', 'a', 'c');

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (6, 8, 'AMAZON BASICS', 'a', 'c');

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (6, 4, 'AMAZON BASICS', 's', 'c');

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (6, 6, 'AMAZON BASICS', 's', 'c');

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (6, 8, 'AMAZON BASICS', 's', 'c');

INSERT INTO Kits(KitName, KitPrice, Descript, WeightG, IsKit)
VALUES ('Amazon Basics 12-in-1 Magnetic Ratchet Screwdriver', 1500, 'Amazon Basics 12-in-1 Magnetic Ratchet Screwdriver',
    280, 0);

INSERT INTO KitProducts (KitID, ProductID, Quantity)
VALUES (3, 6, 1);

INSERT INTO Images (KitID, Link)
VALUES (2, 'Images/ResizableScrewdriver.jpg');

INSERT INTO Products (ProductName, ProductPrice, Descript, Stock, WeightG, Resizable, Electrical)
VALUES ('Vevor Cordless Drill 2/5" Brushless Cordless Hammer Drill Set 20v 2ah 2 Speed', 1500, 'VEVOR''s 20V cordless drill is the right choice for your refined drilling and driving tasks. This brushless drill has a 21 adjustable position clutch, with a max torque of 310 in-lbs / 35N.m, which offers you all the daily needs. The high torque and the convenience of 2-speed settings allow the power drill to tackle applications in materials from wood and metal to ceramic and drywall. It''s a very lightweight handy drill, comfortable to hold. You will feel work has become more relaxed by using it. It''s a fantastic tool for DIYers, electricians, or plumbers.',
    100, 1200, 1, 1);

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (7, 10, 'Vevor', NULL, 'd');

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (7, 8, 'Vevor', NULL, 'd');

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (7, 6, 'Vevor', NULL, 'd');

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (7, 4, 'Vevor', NULL, 'd');

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (7, 6, 'Vevor', 's', 'c');

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (7, 6, 'Vevor', 'p', 'c');

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (7, 6, 'Vevor', 's', 'c');

INSERT INTO Heads(ProductID, Diameter, Manufacturer, HeadType, ProductType)
VALUES (7, 6, 'Vevor', 'p', 'c');

INSERT INTO Kits(KitName, KitPrice, Descript, WeightG, IsKit)
VALUES ('Vevor Cordless Drill 2/5" Brushless Cordless Hammer Drill Set 20v 2ah 2 Speed', 1500, 'VEVOR''s 20V cordless drill is the right choice for your refined drilling and driving tasks. This brushless drill has a 21 adjustable position clutch, with a max torque of 310 in-lbs / 35N.m, which offers you all the daily needs. The high torque and the convenience of 2-speed settings allow the power drill to tackle applications in materials from wood and metal to ceramic and drywall. It''s a very lightweight handy drill, comfortable to hold. You will feel work has become more relaxed by using it. It''s a fantastic tool for DIYers, electricians, or plumbers.',
    1200, 0);

INSERT INTO KitProducts (KitID, ProductID, Quantity)
VALUES (4, 7, 1);

INSERT INTO Images (KitID, Link)
VALUES (2, 'Images/ElectricalDrill.jpg');


INSERT INTO Addressess(PostalCode, City, Street, Nr)
VALUES (2860, 'SKW', 'JanPieterDeNayerLaan', 5);

INSERT INTO Shops(ShopName, AddressID)
VALUES ('SKW', 1);

INSERT INTO ShopSupply(ShopID, KitID, Supply)
VALUES (1, 1, 50);

INSERT INTO ShopSupply(ShopID, KitID, Supply)
VALUES (1, 2, 50);

INSERT INTO ShopSupply(ShopID, KitID, Supply)
VALUES (1, 3, 50);

INSERT INTO ShopSupply(ShopID, KitID, Supply)
VALUES (1, 4, 50);

INSERT INTO ShopSupply(ShopID, KitID, Supply)
VALUES (1, 5, 50);

INSERT INTO ShopSupply(ShopID, KitID, Supply)
VALUES (1, 6, 50);

INSERT INTO ShopSupply(ShopID, KitID, Supply)
VALUES (1, 7, 50);

INSERT INTO Users(FirstName, LastName, Email, Passwd, AddressID, BirthDate, Administrator)
VALUES ('User', '1', 'User1@gmail.com', 'Password', 1, 1-1-2000, 1);

INSERT INTO Users(FirstName, LastName, Email, Passwd, AddressID, BirthDate, Administrator)
VALUES ('User', '2', 'User2@gmail.com', 'Password', 1, 1-1-2000, 0);