USE RobbeGeusens;

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
Drillbit = r
*/
INSERT INTO Products (ProductName, Manufacturer, Descript, Stock, ProductType, WeightG, Resizable, Electrical)
VALUES ('DeWalt 8mm Slotted Screwdriver', 'DeWalt', 'A medium sized slotted screwdriver by DeWalt', 100, 'c', 90, 0, 0);

INSERT INTO Products (ProductName, Manufacturer, Descript, Stock, ProductType, WeightG, Resizable, Electrical)
VALUES ('DeWalt 4mm Slotted Screwdriver', 'DeWalt', 'A small sized slotted screwdriver by DeWalt', 100, 'c', 70, 0, 0);

INSERT INTO Products (ProductName, Manufacturer, Descript, Stock, ProductType, WeightG, Resizable, Electrical)
VALUES ('DeWalt 8mm Phillips Screwdriver', 'DeWalt', 'A medium sized phillips screwdriver by DeWalt', 100, 'c', 90, 0, 0);

INSERT INTO Products (ProductName, Manufacturer, Descript, Stock, ProductType, WeightG, Resizable, Electrical)
VALUES ('DeWalt 4mm Phillips Screwdriver', 'DeWalt', 'A small sized phillips screwdriver by DeWalt', 100, 'c', 70, 0, 0);

INSERT INTO Products (ProductName, Manufacturer, Descript, Stock, ProductType, WeightG, Resizable, Electrical)
VALUES ('BENCHMARK T15 x 4" Torx Screwdriver', 'Benchmark', 'This 4" T15 Torx drive screwdriver is perfect for tightening the job. Make it a great addition or substitute to your set, or hang it on the workshop wall. The red and black rubber grip adds comfort, while its sturdy construction prolongs durability.',
    100, 'c', 90, 0, 0);

INSERT INTO Products (ProductName, Manufacturer, Descript, Stock, ProductType, WeightG, Resizable, Electrical)
VALUES ('Amazon Basics 12-in-1 Magnetic Ratchet Screwdriver', 'AMAZON BASICS', 'Amazon Basics 12-in-1 Magnetic Ratchet Screwdriver',
    100, 'c', 280, 1, 0);

INSERT INTO Products (ProductName, Manufacturer, Descript, Stock, ProductType, WeightG, Resizable, Electrical)
VALUES ('Vevor Cordless Drill 2/5" Brushless Cordless Hammer Drill Set 20v 2ah 2 Speed', 'Vevor', 'VEVOR''s 20V cordless drill is the right choice for your refined drilling and driving tasks. This brushless drill has a 21 adjustable position clutch, with a max torque of 310 in-lbs / 35N.m, which offers you all the daily needs. The high torque and the convenience of 2-speed settings allow the power drill to tackle applications in materials from wood and metal to ceramic and drywall. It''s a very lightweight handy drill, comfortable to hold. You will feel work has become more relaxed by using it. It''s a fantastic tool for DIYers, electricians, or plumbers.',
    100, 'd', 1200, 1, 1);

INSERT INTO Kits(KitName, KitPrice, Descript, WeightG, IsKit)
VALUES ('Dewalt 4-Piece Screwdriver Set Multicolor', 1650, 'Make an excellent addition to your toolbox with the Dewalt 4-Piece Screwdriver Set Multicolor. It includes four screwdrivers for versatile use. The screwdrivers have ergonomically designed quad-lobular handles for maximum tip torque. They have a slip-resistant rubber grip for enhanced user comfort. With their precision machined and sand-blasted tips, these screwdrivers grip faster securely and resist slipping. The screwdrivers have a lacquer-coated bar to resist rust and a magnetic tip to hold screws securely while driving. Each screwdriver in this set has colour-coded handles for easy selection from the toolbox.',
    362, 1);

INSERT INTO Kits(KitName, KitPrice, Descript, WeightG, IsKit)
VALUES ('BENCHMARK T15 x 4" Torx Screwdriver', 1000, 'This 4" T15 Torx drive screwdriver is perfect for tightening the job. Make it a great addition or substitute to your set, or hang it on the workshop wall. The red and black rubber grip adds comfort, while its sturdy construction prolongs durability.',
    90, 0);

INSERT INTO Kits(KitName, KitPrice, Descript, WeightG, IsKit)
VALUES ('Amazon Basics 12-in-1 Magnetic Ratchet Screwdriver', 1500, 'Amazon Basics 12-in-1 Magnetic Ratchet Screwdriver',
    280, 0);

INSERT INTO Kits(KitName, KitPrice, Descript, WeightG, IsKit)
VALUES ('Vevor Cordless Drill 2/5" Brushless Cordless Hammer Drill Set 20v 2ah 2 Speed', 1500, 'VEVOR''s 20V cordless drill is the right choice for your refined drilling and driving tasks. This brushless drill has a 21 adjustable position clutch, with a max torque of 310 in-lbs / 35N.m, which offers you all the daily needs. The high torque and the convenience of 2-speed settings allow the power drill to tackle applications in materials from wood and metal to ceramic and drywall. It''s a very lightweight handy drill, comfortable to hold. You will feel work has become more relaxed by using it. It''s a fantastic tool for DIYers, electricians, or plumbers.',
    1200, 0);

INSERT INTO Addresses(Country, PostalCode, City, Street, Nr)
VALUES ('Belgium', 2860, 'SKW', 'JanPieterDeNayerLaan', 5);

/*
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

INSERT INTO Heads (ProductID, HeadType, Diameter)
VALUES (1, 's', 8);

INSERT INTO Heads (ProductID, HeadType, Diameter)
VALUES (2, 's', 4);

INSERT INTO Heads (ProductID, HeadType, Diameter)
VALUES (3, 'p', 8);

INSERT INTO Heads (ProductID, HeadType, Diameter)
VALUES (4, 'p', 4);

INSERT INTO Heads (ProductID, HeadType, Diameter)
VALUES (5, 'r', 8);

INSERT INTO Heads(ProductID, Diameter, HeadType)
VALUES (6, 2, 'r');

INSERT INTO Heads(ProductID, Diameter, HeadType)
VALUES (6, 4, 'r');

INSERT INTO Heads(ProductID, Diameter, HeadType)
VALUES (6, 6, 'r');

INSERT INTO Heads(ProductID, Diameter, HeadType)
VALUES (6, 4, 'p');

INSERT INTO Heads(ProductID, Diameter, HeadType)
VALUES (6, 6, 'p');

INSERT INTO Heads(ProductID, Diameter, HeadType)
VALUES (6, 8, 'p');

INSERT INTO Heads(ProductID, Diameter, HeadType)
VALUES (6, 4, 'l');

INSERT INTO Heads(ProductID, Diameter, HeadType)
VALUES (6, 6, 'l');

INSERT INTO Heads(ProductID, Diameter, HeadType)
VALUES (6, 8, 'l');

INSERT INTO Heads(ProductID, Diameter, HeadType)
VALUES (6, 4, 's');

INSERT INTO Heads(ProductID, Diameter, HeadType)
VALUES (6, 6, 's');

INSERT INTO Heads(ProductID, Diameter, HeadType)
VALUES (6, 8, 's');

INSERT INTO Heads(ProductID, Diameter, HeadType)
VALUES (7, 10, NULL);

INSERT INTO Heads(ProductID, Diameter, HeadType)
VALUES (7, 8, NULL);

INSERT INTO Heads(ProductID, Diameter, HeadType)
VALUES (7, 6, NULL);

INSERT INTO Heads(ProductID, Diameter, HeadType)
VALUES (7, 4, NULL);

INSERT INTO Heads(ProductID, Diameter, HeadType)
VALUES (7, 6, 's');

INSERT INTO Heads(ProductID, Diameter, HeadType)
VALUES (7, 6, 'p');

INSERT INTO Heads(ProductID, Diameter, HeadType)
VALUES (7, 6, 's');

INSERT INTO Heads(ProductID, Diameter, HeadType)
VALUES (7, 6, 'p');

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

INSERT INTO Images (KitID, Link)
VALUES (2, 'Images/TorxScrewdriver.jpg');

INSERT INTO Images (KitID, Link)
VALUES (3, 'Images/ResizableScrewdriver.jpg');

INSERT INTO Images (KitID, Link)
VALUES (4, 'Images/ElectricalDrill.jpg');

INSERT INTO Shops(ShopName, AddressID)
VALUES ('SKW', 1);

INSERT INTO KitProducts (KitID, ProductID)
VALUES (1, 1);

INSERT INTO KitProducts (KitID, ProductID)
VALUES (1, 2);

INSERT INTO KitProducts (KitID, ProductID)
VALUES (1, 3);

INSERT INTO KitProducts (KitID, ProductID)
VALUES (1, 4);

INSERT INTO KitProducts (KitID, ProductID)
VALUES (2, 5);

INSERT INTO KitProducts (KitID, ProductID)
VALUES (3, 6);

INSERT INTO KitProducts (KitID, ProductID)
VALUES (4, 7);

INSERT INTO ShopSupply(ShopID, KitID, Supply)
VALUES (1, 1, 50);

INSERT INTO ShopSupply(ShopID, KitID, Supply)
VALUES (1, 2, 50);

INSERT INTO ShopSupply(ShopID, KitID, Supply)
VALUES (1, 3, 50);

INSERT INTO ShopSupply(ShopID, KitID, Supply)
VALUES (1, 4, 50);