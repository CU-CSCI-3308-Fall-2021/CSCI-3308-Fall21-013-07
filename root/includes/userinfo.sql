CREATE TABLE userinfo (
    userID int AUTO_INCREMENT,
    firstName varchar(50),
    lastName varchar(50),
    username varchar(50),
    email varchar(50),
    pwd CHAR(60),
    registrationDate DATETIME,
    lastLoginTime DATETIME,
    dailyStreak int,
    PRIMARY KEY (userID)
);