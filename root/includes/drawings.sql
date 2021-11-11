CREATE TABLE drawings (
    drawingID int AUTO_INCREMENT,
    username varchar(50),
    drawingName varchar(50),
    dateModified DATETIME,
    filePath varchar(50),
    PRIMARY KEY (drawingID)
);