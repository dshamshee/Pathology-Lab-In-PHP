-- Creating Admin table
CREATE TABLE Admin (
    Admin_User_Name VARCHAR(20) PRIMARY KEY,
    first_name VARCHAR(15),
    last_name VARCHAR(15),
    password VARCHAR(20),
    email VARCHAR(30)
);
INSERT INTO Admin VALUES ('admin', 'Danish', 'Shamshee', 'admin', 'admin@gmail.com');


-- Creating Employee table
CREATE TABLE Employee (
    Full_Name VARCHAR(30) NOT NULL,
    Phone CHAR(10) PRIMARY KEY,
    AdharNO BIGINT NOT NULL, 
    Gender VARCHAR(20) CHECK (Gender IN ('Male','Female','Transgender')) NOT NULL, 
    address VARCHAR(50) NOT NULL,
    Profession VARCHAR(30) NOT NULL,
    salary DECIMAL(10, 2) NOT NULL
);
INSERT INTO Employee VALUES ('Employee1','9430856365','123456','Male','Patna','developer',15000);
INSERT INTO Employee VALUES ('Employee2','9905135881','55246','Male','Patna','developer',15000);


-- Creating User_SignUp table
CREATE TABLE User_SignUp(
    User_ID CHAR(5) PRIMARY KEY,
    User_Name VARCHAR(20) UNIQUE NOT NULL,
    email_ID VARCHAR(20) UNIQUE NOT NULL, 
    password VARCHAR(20) NOT NULL,
    Phone CHAR(10) REFERENCES Employee(Phone) NOT NULL
);
INSERT INTO User_SignUp VALUES ('u01', 'user1', 'user@gmail.com', 'user123', '9430856365');


-- Creating Pathologist table
CREATE TABLE Pathologist (
    PH_ID CHAR(5) PRIMARY KEY,
    Name VARCHAR(30) NOT NULL, 
    Qualification VARCHAR(20) NOT NULL, 
    Phone BIGINT NOT NULL, 
    AdharNo BIGINT NOT NULL, 
    Address VARCHAR(50) NOT NULL,
    Commission DECIMAL(10, 2) NOT NULL 
);


-- Creating TestCategory table
CREATE TABLE TestCategory (
    Chid CHAR(5) PRIMARY KEY,
    ChName VARCHAR(50)
);
INSERT INTO TestCategory VALUES ('CH01', 'LFT');
INSERT INTO TestCategory VALUES ('CH02', 'KFT');


-- Creating Test table
CREATE TABLE Test (
    Tid CHAR(5) PRIMARY KEY,
    TName VARCHAR(50) NOT NULL, 
    Cost DECIMAL(10, 2) NOT NULL, 
    MinRange DECIMAL(10, 2) NOT NULL, 
    MaxRange DECIMAL(10, 2) NOT NULL,
    Chid CHAR(5),
    FOREIGN KEY (Chid) REFERENCES TestCategory(Chid)
);
INSERT INTO Test VALUES ('T01', 'ALT', 150, 50, 100, 'CH01');
INSERT INTO Test VALUES ('T02', 'AST', 300, 40, 90, 'CH01');
-- Continue with other Test table inserts as above...


-- Creating Patient table
CREATE TABLE Patient (
    Pid CHAR(5) PRIMARY KEY, 
    Name VARCHAR(50) NOT NULL,
    Age INT NOT NULL, 
    Gender VARCHAR(12) CHECK (Gender IN ('Male', 'Female', 'Transgender')), 
    phone CHAR(10) NOT NULL,
    User_ID CHAR(5) REFERENCES User_SignUp(User_ID) NOT NULL,
    pdate DATE NOT NULL,
    refby VARCHAR(30) NOT NULL
);


-- Creating Patient_Test_Observation table
CREATE TABLE Patient_Test_Observation (
    Pid CHAR(5) REFERENCES Patient(Pid) NOT NULL, 
    Tid CHAR(5) REFERENCES Test(Tid) NOT NULL,
    Result DECIMAL(10, 2) NULL,
    PRIMARY KEY (Pid, Tid)
);


-- Creating Bill table
CREATE TABLE Bill (
    b_no CHAR(5) PRIMARY KEY,
    b_date DATE,
    total_amt DECIMAL(7, 2),
    Advance_Payment DECIMAL(7, 2),
    dues DECIMAL(7, 2),
    pid CHAR(5),
    FOREIGN KEY (pid) REFERENCES Patient(pid)
);


-- Creating Bill_Test table
CREATE TABLE Bill_Test (
    s_no INT PRIMARY KEY AUTO_INCREMENT,
    b_no CHAR(5),
    tid CHAR(5),
    FOREIGN KEY (b_no) REFERENCES Bill(b_no),
    FOREIGN KEY (tid) REFERENCES Test(tid)
);
