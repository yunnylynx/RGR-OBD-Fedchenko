create database flowerShop;
use flowerShop;
drop database flowerShop;
CREATE TABLE Customer (
    CustomerID int NOT NULL,
    Name varchar(255) NOT NULL,
    Email varchar(255) NOT NULL,
	PRIMARY KEY (CustomerID)
);
CREATE TABLE OrderDetail (
    OrderID int NOT NULL,
    Date DATETIME NOT NULL,
    Cost int NOT NULL,
    Amount int NOT NULL,
    CustomerID int NOT NULL,
    FOREIGN KEY (CustomerID) references Customer (CustomerID) ON DELETE CASCADE,
    ProductID int,
    FOREIGN KEY (ProductID) references Product (ProductID) ON DELETE SET NULL,
    EmployeeID int,
    FOREIGN KEY (EmployeeID) references Employee (EmployeeID) ON DELETE SET NULL,
    PRIMARY KEY (OrderID)
);
drop table OrderDetail;
CREATE TABLE Product (
    ProductID int NOT NULL,
    ProductName varchar(255) NOT NULL,
    QuantityLeft int NOT NULL, 
    Price int NOT NULL,
    ProviderID int NOT NULL,
    FOREIGN KEY (ProviderID) REFERENCES Provider (ProviderID) ON DELETE CASCADE ,
    PRIMARY KEY (ProductID)
);
CREATE TABLE Provider (
    ProviderID int NOT NULL,
    NameProv varchar(255) NOT NULL,
    HowMany int NOT NULL,
    PRIMARY KEY (ProviderID)
);
CREATE TABLE Employee (
    EmployeeID int NOT NULL,
    NameEmp varchar(255) NOT NULL,
    Specification VARCHAR(255) NOT NULL,
    DateOfBirth DATE NOT NULL,
    Experience int NOT NULL,
    Salary int NOT NULL,
    PRIMARY KEY (EmployeeID)
);
ALTER TABLE OrderDetail
ADD FOREIGN KEY (EmployeeID) REFERENCES Employee(EmployeeID);

CREATE TABLE `usertbl` (
`id` int(11) NOT NULL auto_increment,
`full_name` varchar(32) collate utf8_unicode_ci NOT NULL default '',
`email` varchar(32) collate utf8_unicode_ci NOT NULL default '',
`username` varchar(20) collate utf8_unicode_ci NOT NULL default '',
`password` varchar(32) collate utf8_unicode_ci NOT NULL default '',
`level` varchar(32) collate utf8_unicode_ci default '',
PRIMARY KEY  (`id`),
UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO Customer VALUES (1, "Anna", "anna@gmail.com");
INSERT INTO Customer  VALUES (2, "Emma", "emm123@gmail.com");
INSERT INTO Customer  VALUES (3, "Charie", "chwills@gmail.com");
INSERT INTO Customer  VALUES (4, "Xedos", "xxx1233432@gmail.com");
INSERT INTO Customer  VALUES (5, "Faradey", "cper43@gmail.com");
INSERT INTO Customer  VALUES (6, "Aston", "am000@gmail.com");
INSERT INTO Customer  VALUES (7, "Sasha", "potat@gmail.com");
INSERT INTO Customer  VALUES (8, "Amie", "iamie67@gmail.com");
INSERT INTO Customer  VALUES (9, "Jane", "janerw9@gmail.com");
INSERT INTO Customer  VALUES (10, "Endo", "endow@gmail.com");
select * from Customer;

INSERT INTO Employee  VALUES (1, "Andrew", "Cashier", "1998-10-12", 3, 3500);
INSERT INTO Employee  VALUES (2, "Cassini", "Cleaner", "1997-11-01", 1, 1500);
INSERT INTO Employee  VALUES (3, "Cassandra", "Cashier", "1986-07-21", 2, 5500);
INSERT INTO Employee  VALUES (4, "Luna", "Customer Service", "1982-01-09", 8, 5000);
INSERT INTO Employee  VALUES (5, "Mars", "Manager", "1977-03-05", 9, 10000);
INSERT INTO Employee  VALUES (6, "Meadow", "Cashier", "1993-08-27", 4, 7800);
INSERT INTO Employee  VALUES (7, "Sunny", "Cashier", "1999-09-09", 6, 6300);
INSERT INTO Employee  VALUES (8, "Lonya", "Assitant", "1956-05-06", 7, 2500);
INSERT INTO Employee  VALUES (9, "Asmodeus", "Customer Service", "2000-06-05", 5, 7700);
INSERT INTO Employee  VALUES (10, "Crew", "Administrator", "1996-10-16", 11, 100000);
select * from Employee;

INSERT INTO Provider  VALUES (1, "FlowerIntUA", 25);
INSERT INTO Provider  VALUES (2, "FloweryPlace", 35);
INSERT INTO Provider  VALUES (3, "OOO FLOW ER", 45);
INSERT INTO Provider  VALUES (4, "RARESTflower", 10);
INSERT INTO Provider  VALUES (5, "SucculentTIME", 80);
INSERT INTO Provider  VALUES (6, "EATFLOW", 6);
INSERT INTO Provider  VALUES (7, "FLWR", 11);
INSERT INTO Provider  VALUES (8, "QQQ FLOW", 140);
INSERT INTO Provider  VALUES (9, "FLOWER 24/7", 20);
INSERT INTO Provider  VALUES (10, "CHARLOTTE FLOWER", 30);
select * from Provider;


INSERT INTO Product  VALUES (1, "Fern (small)", 21, 140, 1);
INSERT INTO Product  VALUES (2, "Ficus whiteleaf", 20, 100, 2);
INSERT INTO Product  VALUES (3, "Monstera", 43, 300, 3);
INSERT INTO Product  VALUES (4, "Money Tree", 4, 1000, 4);
INSERT INTO Product  VALUES (5, "Cactus", 2, 25, 5);
INSERT INTO Product  VALUES (6, "Vener FLycatch", 1, 250, 6);
INSERT INTO Product  VALUES (7, "Lily", 5, 120, 7);
INSERT INTO Product  VALUES (8, "Plusch", 112, 80, 8);
INSERT INTO Product  VALUES (9, "Bonsai tree", 15, 1200, 9);
INSERT INTO Product  VALUES (10, "Fern+succulent in one", 30, 165, 10);
select * from Product;

INSERT INTO OrderDetail  VALUES (1, "2022-11-02 11:12:01", 140, 2, 1, 1, 1);
INSERT INTO OrderDetail  VALUES (2, "2022-10-31 10:00:39", 300, 3, 2, 2, 1);
INSERT INTO OrderDetail  VALUES (3, "2022-10-15 20:01:45", 300, 1, 3, 3, 3);
INSERT INTO OrderDetail  VALUES (4, "2022-09-14 14:54:01", 5000, 5, 4, 4, 4);
INSERT INTO OrderDetail  VALUES (5, "2022-09-25 12:00:00", 50, 5, 5, 6, 9);
INSERT INTO OrderDetail  VALUES (6, "2022-09-11 23:54:11", 1000, 4, 6, 7, 6);
INSERT INTO OrderDetail  VALUES (7, "2022-10-12 06:36:26", 720, 7, 7, 5, 7);
INSERT INTO OrderDetail  VALUES (8, "2022-11-01 07:09:11", 640, 1, 8, 9, 1);
INSERT INTO OrderDetail  VALUES (9, "2022-11-03 15:05:15", 1200, 1, 9, 10, 4);
INSERT INTO OrderDetail  VALUES (10, "2022-10-02 13:14:15", 1650, 3, 10, 8, 9);
select * from OrderDetail;

use flowershop;
create user 'yunny'@'127.0.0.1' identified by'123456Qq';
grant all privileges on flowershop.* to 'yunny'@'127.0.0.1';
