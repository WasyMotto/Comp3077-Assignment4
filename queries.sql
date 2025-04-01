CREATE TABLE Users (
    userID INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE BuildSubmissions (
    buildID INT AUTO_INCREMENT PRIMARY KEY,
    userID INT,
    buildName VARCHAR(100) NOT NULL,
    subclass ENUM('hunter', 'warlock', 'titan') NOT NULL,
    exoticArmor VARCHAR(100),
    description TEXT,
    FOREIGN KEY (userID) REFERENCES Users(userID) ON DELETE CASCADE
);

CREATE TABLE ContactMessages (
    contactID INT AUTO_INCREMENT PRIMARY KEY,
    userID INT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (userID) REFERENCES Users(userID) ON DELETE CASCADE
);