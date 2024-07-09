
CREATE DATABASE Neuromodulation;


USE Neuromodulation;


CREATE TABLE Patients (
    PatientID INT PRIMARY KEY IDENTITY(1,1),
    FirstName NVARCHAR(50),
    Surname NVARCHAR(50),
    DateOfBirth DATE,
    Age INT
);

CREATE TABLE PainInventory (
    PainInventoryID INT PRIMARY KEY IDENTITY(1,1),
    PatientID INT FOREIGN KEY REFERENCES Patients(PatientID),
    Question1 INT CHECK (Question1 BETWEEN 0 AND 100),
    Question2 INT CHECK (Question2 BETWEEN 0 AND 10),
    Question3 INT CHECK (Question3 BETWEEN 0 AND 10),
    Question4 INT CHECK (Question4 BETWEEN 0 AND 10),
    Question5 INT CHECK (Question5 BETWEEN 0 AND 10),
    Question6 INT CHECK (Question6 BETWEEN 0 AND 10),
    Question7 INT CHECK (Question7 BETWEEN 0 AND 10),
    Question8 INT CHECK (Question8 BETWEEN 0 AND 10),
    Question9 INT CHECK (Question9 BETWEEN 0 AND 10),
    Question10 INT CHECK (Question10 BETWEEN 0 AND 10),
    Question11 INT CHECK (Question11 BETWEEN 0 AND 10),
    Question12 INT CHECK (Question12 BETWEEN 0 AND 10),
    TotalScore AS (Question2 + Question3 + Question4 + Question5 + Question6 + Question7 + Question8 + Question9 + Question10 + Question11 + Question12) PERSISTED,
    DateOfSubmission DATETIME DEFAULT GETDATE()
);
