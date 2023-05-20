create database info;
use info;
drop database info;
-- User table
CREATE TABLE users (
  user_id INT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL,
  role_id INT NOT NULL,
  FOREIGN KEY (role_id) REFERENCES roles(role_id)
);

-- Roles table
CREATE TABLE roles (
  role_id INT PRIMARY KEY,
  role_name VARCHAR(50) NOT NULL
);

-- Faculty table
CREATE TABLE faculty (
  faculty_id INT PRIMARY KEY,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  contact_info VARCHAR(100),
  work_history TEXT,
  degrees TEXT,
  grants_awards TEXT,
  office_id INT,
  FOREIGN KEY (office_id) REFERENCES offices(office_id)
);

-- Publications table
CREATE TABLE publications (
  publication_id INT PRIMARY KEY,
  faculty_id INT,
  title VARCHAR(100) NOT NULL,
  author VARCHAR(100) NOT NULL,
  publication_type_id INT,
  FOREIGN KEY (faculty_id) REFERENCES faculty(faculty_id),
  FOREIGN KEY (publication_type_id) REFERENCES publication_types(publication_type_id)
);

-- Departments table
CREATE TABLE departments (
  department_id INT PRIMARY KEY,
  department_name VARCHAR(100) NOT NULL
);

-- Courses table
CREATE TABLE courses (
  course_id INT PRIMARY KEY,
  course_name VARCHAR(100) NOT NULL,
  department_id INT,
  FOREIGN KEY (department_id) REFERENCES departments(department_id)
);

-- Publication types table
CREATE TABLE publication_types (
  publication_type_id INT PRIMARY KEY,
  publication_type_name VARCHAR(100) NOT NULL
);

-- Job types table
CREATE TABLE job_types (
  job_type_id INT PRIMARY KEY,
  job_type_name VARCHAR(100) NOT NULL
);

-- Offices table
CREATE TABLE offices (
  office_id INT PRIMARY KEY,
  office_address VARCHAR(100) NOT NULL
);



-- Inserting roles
INSERT INTO roles (role_id, role_name)
VALUES
  (1, 'Admin'),
  (2, 'Teacher'),
  (3, 'Regular User');

-- Inserting users
INSERT INTO users (user_id, username, password, role_id)
VALUES
  (1, 'admin', 'adminpassword', 1),
  (2, 'teacher1', 'teacherpassword', 2),
  (3, 'student1', 'studentpassword', 3);

-- Inserting faculty
INSERT INTO faculty (faculty_id, first_name, last_name, contact_info, work_history, degrees, grants_awards, office_id)
VALUES
  (1, 'John', 'Doe', 'john.doe@example.com', 'Work history details', 'Ph.D. in Computer Science', 'Grant A, Award B', 1),
  (2, 'Jane', 'Smith', 'jane.smith@example.com', 'Work history details', 'M.Sc. in Mathematics', 'Award C', 2);

-- Inserting publications
INSERT INTO publications (publication_id, faculty_id, title, author, publication_type_id)
VALUES
  (1, 1, 'Publication Title 1', 'John Doe', 1),
  (2, 1, 'Publication Title 2', 'John Doe', 2),
  (3, 2, 'Publication Title 3', 'Jane Smith', 1);

-- Inserting departments
INSERT INTO departments (department_id, department_name)
VALUES
  (1, 'Computer Science'),
  (2, 'Mathematics');

-- Inserting courses
INSERT INTO courses (course_id, course_name, department_id)
VALUES
  (1, 'Introduction to Computer Science', 1),
  (2, 'Linear Algebra', 2);

-- Inserting publication types
INSERT INTO publication_types (publication_type_id, publication_type_name)
VALUES
  (1, 'Journal Article'),
  (2, 'Conference Paper');

-- Inserting job types
INSERT INTO job_types (job_type_id, job_type_name)
VALUES
  (1, 'Full-time'),
  (2, 'Part-time');

-- Inserting offices
INSERT INTO offices (office_id, office_address)
VALUES
  (1, 'Building A, Room 101'),
  (2, 'Building B, Room 202');
  
  select *from faculty;  
  select *from roles;
  select * from departments;
   select * from users;
   select * from offices;
	select * from job_types;
    select * from courses;
	select * from publication_types;
    select * from publications;
  
  DELETE FROM users WHERE user_id = 1166431053