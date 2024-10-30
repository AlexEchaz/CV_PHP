ALTER TABLE User
    MODIFY Name VARCHAR(100) NOT NULL,
    MODIFY password VARCHAR(255) NOT NULL,
    MODIFY email VARCHAR(255) NOT NULL,
    MODIFY id INT PRIMARY KEY AUTO_INCREMENT,
    MODIFY role VARCHAR(50) DEFAULT 'user';
    INSERT INTO User (userName, password, email, role) 
    VALUES ('Test User', 'password', 'test@test.com', 'user');

ALTER TABLE CV
    MODIFY name VARCHAR(100) NOT NULL,
    MODIFY job VARCHAR(100) NOT NULL,
    MODIFY age INT,
    MODIFY email VARCHAR(255) NOT NULL,
    MODIFY description TEXT,
    MODIFY competences TEXT,
    MODIFY experience TEXT,
    MODIFY education TEXT,
    MODIFY id INT PRIMARY KEY AUTO_INCREMENT,
    MODIFY user_id INT,
    ADD FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE;

ALTER TABLE Projets
    MODIFY id INT PRIMARY KEY AUTO_INCREMENT,
    MODIFY user_id INT,
    MODIFY titre VARCHAR(255) NOT NULL,
    MODIFY description TEXT,
    ADD FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE;