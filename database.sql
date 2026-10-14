-- Session 6: Relational CRUD & User Management
-- Run in phpMyAdmin. Assumes db_school and the students table from Sessions 1-2 already exist.
USE db_school;

-- 1) Majors table
CREATE TABLE majors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO majors (name) VALUES
('Informatics'), ('Information Systems'), ('Computer Science');

-- 2) Change students: replace the text column 'major' with 'major_id'
TRUNCATE TABLE students;
ALTER TABLE students DROP COLUMN major;
ALTER TABLE students ADD major_id INT NOT NULL;
ALTER TABLE students
  ADD CONSTRAINT fk_students_major
  FOREIGN KEY (major_id) REFERENCES majors(id)
  ON DELETE RESTRICT;

-- 3) Sample data
INSERT INTO students (nim, name, major_id) VALUES
('2301001', 'Andi Pratama', 1),
('2301002', 'Siti Rahma', 2),
('2301003', 'Budi Santoso', 1),
('2301004', 'Dewi Lestari', 3);

-- 4) Users table for login
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin', 'staff') NOT NULL DEFAULT 'staff'
);
