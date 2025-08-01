-- Create the database 
CREATE DATABASE school;
USE school;

-- Create the users table
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  last_name VARCHAR(50),
  first_name VARCHAR(50),
  birth_date DATE,
  city VARCHAR(100),
  photo VARCHAR(100)
);

-- Insert users
INSERT INTO users (last_name, first_name, birth_date, city, photo) VALUES
('Smith', 'John', '2001-08-15', 'New York', 'img/1.jpg'),
('Müller', 'Anna', '2000-11-03', 'Berlin', 'img/2.jpg'),
('Tanaka', 'Haruki', '1999-04-21', 'Tokyo', 'img/1.jpg'),
('Dubois', 'Claire', '2003-06-30', 'Paris', 'img/2.jpg');
