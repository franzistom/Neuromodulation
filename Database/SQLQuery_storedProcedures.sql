-- Stored Procedure to Insert a Patient
CREATE PROCEDURE InsertPatient
    @FirstName NVARCHAR(50),
    @Surname NVARCHAR(50),
    @DateOfBirth DATE,
    @Age INT
AS
BEGIN
    INSERT INTO Patients (FirstName, Surname, DateOfBirth, Age)
    VALUES (@FirstName, @Surname, @DateOfBirth, @Age);
    
    SELECT SCOPE_IDENTITY() AS NewPatientID;
END
GO

-- Stored Procedure to Insert Pain Inventory
CREATE PROCEDURE InsertPainInventory
    @PatientID INT,
    @Question1 INT,
    @Question2 INT,
    @Question3 INT,
    @Question4 INT,
    @Question5 INT,
    @Question6 INT,
    @Question7 INT,
    @Question8 INT,
    @Question9 INT,
    @Question10 INT,
    @Question11 INT,
    @Question12 INT
AS
BEGIN
    INSERT INTO PainInventory (PatientID, Question1, Question2, Question3, Question4, Question5, Question6, Question7, Question8, Question9, Question10, Question11, Question12)
    VALUES (@PatientID, @Question1, @Question2, @Question3, @Question4, @Question5, @Question6, @Question7, @Question8, @Question9, @Question10, @Question11, @Question12);
END
GO

-- Stored Procedure to Get All Patients and Pain Inventory
CREATE PROCEDURE GetAllPatients
AS
BEGIN
    SELECT 
        p.PatientID, 
        p.FirstName, 
        p.Surname, 
        p.DateOfBirth, 
        p.Age, 
        pi.PainInventoryID,
        pi.TotalScore,
        pi.DateOfSubmission
    FROM Patients p
    JOIN PainInventory pi ON p.PatientID = pi.PatientID;
END
GO

-- Stored Procedure to Get Pain Inventory by ID
CREATE PROCEDURE GetPainInventoryByID
    @PainInventoryID INT
AS
BEGIN
    SELECT 
        p.PatientID, 
        p.FirstName, 
        p.Surname, 
        p.DateOfBirth, 
        p.Age, 
        pi.*
    FROM Patients p
    JOIN PainInventory pi ON p.PatientID = pi.PatientID
    WHERE pi.PainInventoryID = @PainInventoryID;
END
GO

-- Stored Procedure to Update Pain Inventory
CREATE PROCEDURE UpdatePainInventory
    @PainInventoryID INT,
    @Question1 INT,
    @Question2 INT,
    @Question3 INT,
    @Question4 INT,
    @Question5 INT,
    @Question6 INT,
    @Question7 INT,
    @Question8 INT,
    @Question9 INT,
    @Question10 INT,
    @Question11 INT,
    @Question12 INT
AS
BEGIN
    UPDATE PainInventory
    SET 
        Question1 = @Question1,
        Question2 = @Question2,
        Question3 = @Question3,
        Question4 = @Question4,
        Question5 = @Question5,
        Question6 = @Question6,
        Question7 = @Question7,
        Question8 = @Question8,
        Question9 = @Question9,
        Question10 = @Question10,
        Question11 = @Question11,
        Question12 = @Question12
    WHERE PainInventoryID = @PainInventoryID;
END
GO

-- Stored Procedure to Delete Pain Inventory
CREATE PROCEDURE DeletePainInventory
    @PainInventoryID INT
AS
BEGIN
    DELETE FROM PainInventory
    WHERE PainInventoryID = @PainInventoryID;
END
GO
