DROP DATABASE IF EXISTS `sql_apotek`;
CREATE DATABASE `sql_apotek`; 
USE `sql_apotek`;

SET NAMES utf8 ;
SET character_set_client = utf8mb4 ;

CREATE TABLE `Staff` (
  `Staff_ID` char(10) NOT NULL,
  `Staff_Name` varchar(50) NOT NULL,
  `Staff_Address` varchar(200) NOT NULL,
  `Staff_Shift` varchar(10) NOT NULL,
  `Staff_Salary` int NOT NULL,
  `Staff_Gender` varchar(10) NOT NULL,
  `Staff_Phone` varchar(50) NOT NULL,
  PRIMARY KEY (`Staff_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
INSERT INTO `Staff` VALUES ('SI0001','Renardo Tunggara','UNVILL C27','day','4000000','male','001-001-0001');
INSERT INTO `Staff` VALUES ('SI0002','Gracio Elika .E .T','Kalimantan','night','4500000','male','002-002-0002');
INSERT INTO `Staff` VALUES ('SI0003','Josesdio','UNVILL C6','night','4000000','male','003-003-0003');
INSERT INTO `Staff` VALUES ('SI0004','Athallah Y.A.N','Malang','day','4500000','male','004-004-0004');

CREATE TABLE `Customer` (
  `Customer_ID` char(10) NOT NULL,
  `Customer_Name` varchar(50) NOT NULL,
  `Customer_Address` varchar(50) NOT NULL,
  `Customer_Gender` varchar(50) NOT NULL,
  `Customer_phone` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Customer_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
INSERT INTO `Customer` VALUES ('CI0001','Udin','Indonesia','Male','100-100-1000');
INSERT INTO `Customer` VALUES ('CI0002','Oodeen','London','Male','200-200-2000');
INSERT INTO `Customer` VALUES ('CI0003','Bacchus','Indonesia','Male','300-300-3000');
INSERT INTO `Customer` VALUES ('CI0004','Quama','Indonesia','Male','400-400-4000');
INSERT INTO `Customer` VALUES ('CI0005','Shoesss','Antartika','Male','500-500-5000');


CREATE TABLE `Supplier` (
  `Supplier_ID` char(10) NOT NULL,
  `Supplier_Name` varchar(50) NOT NULL,
  `Supplier_Address` varchar(50) NOT NULL,
  PRIMARY KEY (`Supplier_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
INSERT INTO `Supplier` VALUES ('SUP0001','Pfizer','Indonesia');
INSERT INTO `Supplier` VALUES ('SUP0002','Phapros','Malaysia');
INSERT INTO `Supplier` VALUES ('SUP0003','GetWellSoom','Indonesia');

CREATE TABLE `Medicine` (
  `Medicine_ID` char(10) NOT NULL,
  `Suplier_ID` char(10) NOT NULL,
  `Medicine_Name` varchar(50) NOT NULL,
  `Medicine_Description` varchar(200) NOT NULL,
  `Medicine_Date` date NOT NULL,
  `Medicine_Price` int NOT NULL,
  `Medicine_Stock` int NOT NULL,
  PRIMARY KEY (`Medicine_ID`),
  KEY `fk_suplier_ID_idx` (`Suplier_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
INSERT INTO `Medicine` VALUES ('MED0001','SUP0001','Antibiotic','Bertesktur padat, Obat keras, perlu anjuran dokter untuk membeli','2025-01-01','1000000','10');
INSERT INTO `Medicine` VALUES ('MED0002','SUP0002','Mylanta','Obat cair, Obat penetralisir asam, diperjual belikan bebas','2025-01-01','450000','30');
INSERT INTO `Medicine` VALUES ('MED0003','SUP0002','Xepavit','Vitamin kapsul, untuk memenuhhi kebutuhan vitamin dan mineral untuk tubuh','2025-01-01','150000','10');
INSERT INTO `Medicine` VALUES ('MED0004','SUP0003','Paracetamol','Obat tablet, Meredakan nyeri dan demam,Diperjual belikan bebas','2025-01-01','750000','22');
INSERT INTO `Medicine` VALUES ('MED0005','SUP0001','ProMag','Obat tablet, penetralisir asam, diperjual belikan bebas','2025-01-01','500000','25');

CREATE TABLE `Work` (
  `Work_ID` char(10) NOT NULL,
  `Staff_ID` char(10) NOT NULL,
  `Shift_Time` varchar(100) NOT NULL,
  PRIMARY KEY (`Work_ID`),
  KEY `fk_Staff_ID_idx` (`Staff_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
INSERT INTO `Work` VALUES ('WI0001','SI0001','09:00 – 16:30');
INSERT INTO `Work` VALUES ('WI0002','SI0002','16:31 – 00:00');
INSERT INTO `Work` VALUES ('WI0003','SI0004','09:00 – 16:30');
INSERT INTO `Work` VALUES ('WI0004','SI0003','16:31 – 00:00');

CREATE TABLE `Kasir` (
  `Kasir_ID` char(10) NOT NULL,
  `Staff_ID` char(10) NOT NULL,
  PRIMARY KEY (`Kasir_ID`),
  KEY `fk_Staff_ID_idx` (`Staff_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
INSERT INTO `Kasir` VALUES ('KI0001','SI0001');
INSERT INTO `Kasir` VALUES ('KI0002','SI0003');
INSERT INTO `Kasir` VALUES ('KI0003','SI0004');
INSERT INTO `Kasir` VALUES ('KI0004','SI0002');	

CREATE TABLE `Transaction` (
  `Transaction_ID` char(10) NOT NULL,
  `Kasir_ID` char(10) NOT NULL,
  `Customer_ID` char(10) NOT NULL,
  `Medicine_ID` char(10) NOT NULL,
  `Price`	INT NOT NULL,
  `Transaction_Date` date NULL,
  PRIMARY KEY (`Transaction_ID`),
  KEY `fk_Staff_ID_idx` (`Kasir_ID`),
  KEY `fk_Customer_ID_idx` (`Customer_ID`),
  KEY `fk_Medicine_ID_idx` (`Medicine_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `Transaction` (Transaction_ID, Kasir_ID, Customer_ID, Medicine_ID, Price, Transaction_Date)
SELECT 'TI0001', 'KI0002', 'CI0002', 'MED0001', Medicine_Price+50000+(Medicine_Price*0.1), '2022-01-01'
FROM Medicine
WHERE Medicine_ID = 'MED0001';
Update Medicine
SET Medicine_Stock = Medicine_Stock-1
Where Medicine_ID = 'MED0001';

INSERT INTO `Transaction` (Transaction_ID, Kasir_ID, Customer_ID, Medicine_ID, Price, Transaction_Date)
SELECT 'TI0002', 'KI0002', 'CI0002', 'MED0002', Medicine_Price+50000+(Medicine_Price*0.1), '2022-01-02'
FROM Medicine
WHERE Medicine_ID = 'MED0002';
Update Medicine
SET Medicine_Stock = Medicine_Stock-1
Where Medicine_ID = 'MED0002';

INSERT INTO `Transaction` (Transaction_ID, Kasir_ID, Customer_ID, Medicine_ID, Price, Transaction_Date)
SELECT 'TI0003','KI0003','CI0003','MED0003', Medicine_Price+50000+(Medicine_Price*0.1), '2022-01-03'
FROM Medicine
WHERE Medicine_ID = 'MED0003';
Update Medicine
SET Medicine_Stock = Medicine_Stock-1
Where Medicine_ID = 'MED0003';

INSERT INTO `Transaction` (Transaction_ID, Kasir_ID, Customer_ID, Medicine_ID, Price, Transaction_Date)
SELECT 'TI0004','KI0001','CI0001','MED0004', Medicine_Price+50000+(Medicine_Price*0.1), '2022-01-04'
FROM Medicine
WHERE Medicine_ID = 'MED0004';
Update Medicine
SET Medicine_Stock = Medicine_Stock-1
Where Medicine_ID = 'MED0004';

INSERT INTO `Transaction` (Transaction_ID, Kasir_ID, Customer_ID, Medicine_ID, Price, Transaction_Date)
SELECT 'TI0005','KI0003','CI0004','MED0005', Medicine_Price+50000+(Medicine_Price*0.1), '2022-01-04'
FROM Medicine
WHERE Medicine_ID = 'MED0005';
Update Medicine
SET Medicine_Stock = Medicine_Stock-1
Where Medicine_ID = 'MED0005';

INSERT INTO `Transaction` (Transaction_ID, Kasir_ID, Customer_ID, Medicine_ID, Price, Transaction_Date)
SELECT 'TI0006','KI0002','CI0002', 'MED0002', Medicine_Price+50000+(Medicine_Price*0.1), '2022-01-03'
FROM Medicine
WHERE Medicine_ID = 'MED0002';
Update Medicine
SET Medicine_Stock = Medicine_Stock-1
Where Medicine_ID = 'MED0002';

INSERT INTO `Transaction` (Transaction_ID, Kasir_ID, Customer_ID, Medicine_ID, Price, Transaction_Date)
SELECT 'TI0007','KI0004','CI0003','MED0001', Medicine_Price+50000+(Medicine_Price*0.1), '2022-01-04'
FROM Medicine
WHERE Medicine_ID = 'MED0001';
Update Medicine
SET Medicine_Stock = Medicine_Stock-1
Where Medicine_ID = 'MED0001';

INSERT INTO `Transaction` (Transaction_ID, Kasir_ID, Customer_ID, Medicine_ID, Price, Transaction_Date)
SELECT 'TI0008','KI0003','CI0002','MED0003', Medicine_Price+50000+(Medicine_Price*0.1), '2022-01-04'
FROM Medicine
WHERE Medicine_ID = 'MED0003';
Update Medicine
SET Medicine_Stock = Medicine_Stock-1
Where Medicine_ID = 'MED0003';

INSERT INTO `Transaction` (Transaction_ID, Kasir_ID, Customer_ID, Medicine_ID, Price, Transaction_Date)
SELECT 'TI0009','KI0004','CI0001','MED0001', Medicine_Price+50000+(Medicine_Price*0.1), '2022-01-04'
FROM Medicine
WHERE Medicine_ID = 'MED0001';
Update Medicine
SET Medicine_Stock = Medicine_Stock-1
Where Medicine_ID = 'MED0001';

INSERT INTO `Transaction` (Transaction_ID, Kasir_ID, Customer_ID, Medicine_ID, Price, Transaction_Date)
SELECT 'TI0010','KI0001','CI0003','MED0005', Medicine_Price+50000+(Medicine_Price*0.1), '2022-01-02'
FROM Medicine
WHERE Medicine_ID = 'MED0005';
Update Medicine
SET Medicine_Stock = Medicine_Stock-1
Where Medicine_ID = 'MED0005';

INSERT INTO `Transaction` (Transaction_ID, Kasir_ID, Customer_ID, Medicine_ID, Price, Transaction_Date)
SELECT 'TI0011','KI0002','CI0005','MED0005', Medicine_Price+50000+(Medicine_Price*0.1), '2022-01-01'
FROM Medicine
WHERE Medicine_ID = 'MED0005';
Update Medicine
SET Medicine_Stock = Medicine_Stock-1
Where Medicine_ID = 'MED0005';

INSERT INTO `Transaction` (Transaction_ID, Kasir_ID, Customer_ID, Medicine_ID, Price, Transaction_Date)
SELECT 'TI0012','KI0004','CI0002','MED0004', Medicine_Price+50000+(Medicine_Price*0.1), '2022-01-13'
FROM Medicine
WHERE Medicine_ID = 'MED0004';
Update Medicine
SET Medicine_Stock = Medicine_Stock-1
Where Medicine_ID = 'MED0004';

INSERT INTO `Transaction` (Transaction_ID, Kasir_ID, Customer_ID, Medicine_ID, Price, Transaction_Date)
SELECT 'TI0013','KI0003','CI0001','MED0001', Medicine_Price+50000+(Medicine_Price*0.1), '2022-01-23'
FROM Medicine
WHERE Medicine_ID = 'MED0001';
Update Medicine
SET Medicine_Stock = Medicine_Stock-1
Where Medicine_ID = 'MED0001';

INSERT INTO `Transaction` (Transaction_ID, Kasir_ID, Customer_ID, Medicine_ID, Price, Transaction_Date)
SELECT 'TI0014','KI0004','CI0004','MED0002', Medicine_Price+50000+(Medicine_Price*0.1), '2022-01-23'
FROM Medicine
WHERE Medicine_ID = 'MED0002';
Update Medicine
SET Medicine_Stock = Medicine_Stock-1
Where Medicine_ID = 'MED0002';

INSERT INTO `Transaction` (Transaction_ID, Kasir_ID, Customer_ID, Medicine_ID, Price, Transaction_Date)
SELECT 'TI0015','KI0001','CI0005','MED0003', Medicine_Price+50000+(Medicine_Price*0.1), '2022-01-13'
FROM Medicine
WHERE Medicine_ID = 'MED0003';
Update Medicine
SET Medicine_Stock = Medicine_Stock-1
Where Medicine_ID = 'MED0003';
