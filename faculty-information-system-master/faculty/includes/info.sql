-- drop database info;
-- create database  info;
-- use info;

CREATE TABLE `roles` (
  `role_id` INT PRIMARY KEY,
  `role_name` VARCHAR(50) NOT NULL
);

CREATE TABLE `users` (
  `user_id` INT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(50) NOT NULL,
  `role_id` INT NOT NULL,
  FOREIGN KEY (`role_id`) REFERENCES `roles`(`role_id`)
);

CREATE TABLE `faculty` (
  `faculty_id` INT PRIMARY KEY,
  `faculty_name` VARCHAR(256) NOT NULL,
  `position` VARCHAR(20) NOT NULL,
  `department` VARCHAR(20) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `phone_number` VARCHAR(11) NOT NULL,
  `user_id` INT NOT NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`)
);

CREATE TABLE `degrees` (
  `degree_id` INT PRIMARY KEY,
  `faculty_id` INT NOT NULL,
  `degree` VARCHAR(256) NOT NULL,
  `date_attained` DATE NOT NULL,
  `institution` VARCHAR(256) NOT NULL,
  FOREIGN KEY (`faculty_id`) REFERENCES `faculty`(`faculty_id`)
);

CREATE TABLE `grants_awards` (
  `grant_award_id` INT PRIMARY KEY,
  `faculty_id` INT NOT NULL,
  `grant_award` VARCHAR(256) NOT NULL,
  `date_attained` DATE NOT NULL,
  FOREIGN KEY (`faculty_id`) REFERENCES `faculty`(`faculty_id`)
);

	CREATE TABLE `work_history` (
	  `work_history_id` INT PRIMARY KEY,
	  `faculty_id` INT NOT NULL,
	  `company_name` VARCHAR(256) NOT NULL,
	  `job_title` VARCHAR(200) NOT NULL,
	  `start_date` DATE NOT NULL,
	  `end_date` DATE,
	  `description` TEXT,
	  FOREIGN KEY (`faculty_id`) REFERENCES `faculty`(`faculty_id`)
	);

CREATE TABLE `publications` (
  `publication_id` INT PRIMARY KEY,
  `title` VARCHAR(256) NOT NULL,
  `publication_type` VARCHAR(256) NOT NULL,
  `publication_date` DATE NOT NULL,
  `faculty_id` INT NOT NULL,
  FOREIGN KEY (`faculty_id`) REFERENCES `faculty`(`faculty_id`)
);

-- Inserting values into the roles table
INSERT INTO roles (role_id, role_name)
VALUES
  (1, 'Admin'),
  (2, 'Faculty'),
  (3, 'Guest'),
  (4, 'Students');

-- Inserting values into the users table
INSERT INTO users (user_id, username, password, role_id)
VALUES
  (1, 'admin_user', 'admin123', 1),
  (2, 'faculty_user', 'faculty123', 2),
  (3, 'guest_user', 'guest123', 3),
  (4, 'student_user', 'student123', 4);



-- Inserting values into the faculty table
INSERT INTO faculty (faculty_id, faculty_name, position, department, email, phone_number, user_id)
VALUES
 
  (2, 'Jane Smith', 'Assistant Professor', 'Physics', 'jane.smith@example.com', '9876543210', 3),
  (3, 'Robert Johnson', 'Associate Professor', 'Mathematics', 'robert.johnson@example.com', '4567890123', 4),
  (4, 'Emily Davis', 'Lecturer', 'Chemistry', 'emily.davis@example.com', '7890123456', 5),
  (5, 'Michael Wilson', 'Professor', 'Biology', 'michael.wilson@example.com', '2109876543', 6);

-- Inserting values into the degrees table
INSERT INTO degrees (degree_id, faculty_id, degree, date_attained, institution)
VALUES
  (1, 1, 'Ph.D. in Computer Science', '2020-05-15', 'University of XYZ'),
  (2, 1, 'M.S. in Computer Science', '2015-08-20', 'University of ABC'),
  (3, 2, 'Ph.D. in Physics', '2018-12-10', 'University of XYZ'),
  (4, 3, 'Ph.D. in Mathematics', '2016-06-25', 'University of PQR');


-- Inserting values into the grants_awards table
INSERT INTO grants_awards (grant_award_id, faculty_id, grant_award, date_attained)
VALUES
  (1, 1, 'Research Grant A', '2022-03-01'),
  (2, 1, 'Teaching Excellence Award', '2021-09-10'),
  (3, 2, 'Research Grant B', '2023-01-05'),
  (4, 3, 'Conference Travel Grant', '2022-07-20'),
  (5, 1, 'Outstanding Teacher Award', '2023-04-15');

-- Inserting values into the work_history table
INSERT INTO work_history (work_history_id, faculty_id, company_name, job_title, start_date, end_date, description)
VALUES
  (1, 1, 'ABC Corporation', 'Software Engineer', '2010-01-01', '2014-12-31', 'Worked on software development projects'),
  (2, 2, 'XYZ Corporation', 'Research Assistant', '2015-03-15', '2017-06-30', 'Assisted in physics research'),
  (3, 3, 'DEF Company', 'Data Analyst', '2012-08-10', '2016-11-30', 'Performed data analysis tasks');
  (4, 4, 'GHI Corporation', 'Chemist', '2018-02-01', '2022-05-31', 'Conducted chemical experiments');


-- Inserting values into the publications table
INSERT INTO publications (publication_id, title, publication_type, publication_date, faculty_id)
VALUES
  (1, 'Paper A', 'Journal', '2022-07-15', 1),
  (2, 'Book B', 'Book', '2021-02-20', 1),
  (3, 'Paper C', 'Conference', '2023-04-05', 2),
  (4, 'Paper D', 'Journal', '2023-01-10', 3),
  (5, 'Paper E', 'Conference', '2022-09-25', 2);
  
	-- select * from users;  
	-- select * from publications;
		-- select * from work_history;
		-- select * from grants_awards;
		-- select * from roles;
		-- select * from faculty;
        --  select * from degrees;
     -- select * from faculty;	
     SELECT * FROM degrees WHERE faculty_id = 1;
     SELECT * FROM work_history WHERE work_history_id = 1;
     
     