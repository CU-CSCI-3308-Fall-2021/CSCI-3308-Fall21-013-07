CREATE TABLE userinfo (
    userID int AUTO_INCREMENT,
    firstName varchar(50),
    lastName varchar(50),
    username varchar(50) BINARY,
    email varchar(50),
    pwd CHAR(60),
    drawingCount int,
    registrationDate DATETIME,
    lastLoginTime DATETIME,
    dailyStreak int,
    PRIMARY KEY (userID)
);