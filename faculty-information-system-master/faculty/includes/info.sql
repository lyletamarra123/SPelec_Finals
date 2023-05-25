-- drop database info;
create database  info;
use info;

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
  `faculty_id` varchar(10) PRIMARY KEY,
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
  `faculty_id` varchar(10) NOT NULL,
  `degree` VARCHAR(256) NOT NULL,
  `date_attained` DATE NOT NULL,
  `institution` VARCHAR(256) NOT NULL,
  FOREIGN KEY (`faculty_id`) REFERENCES `faculty`(`faculty_id`)
);

CREATE TABLE `grants_awards` (
  `grant_award_id` INT PRIMARY KEY,
  `faculty_id` varchar(10) NOT NULL,
  `grant_award` VARCHAR(256) NOT NULL,
  `date_attained` DATE NOT NULL,
  FOREIGN KEY (`faculty_id`) REFERENCES `faculty`(`faculty_id`)
);

	CREATE TABLE `work_history` (
	  `work_history_id` INT PRIMARY KEY,
	  `faculty_id` varchar(10) NOT NULL,
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
  `faculty_id` varchar(10) NOT NULL,
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
  (2, 'jovelyn123', 'faculty123', 2),
  (3, 'rabsky123', 'faculty123', 2),
  (4, 'jeoffrey123', 'faculty123', 2),
  (5, 'lorna123', 'faculty123', 2),
  (6, 'gene123', 'faculty123', 2),
  (7, 'josephine123', 'faculty123', 2),
  (8, 'vicente123', 'faculty123', 2),
  (9, 'leeroy123', 'faculty123', 2),
  (10, 'guest_user', 'guest123', 3),
  (11, 'student_user', 'student123', 4);



-- Inserting values into the faculty table
INSERT INTO faculty (faculty_id, faculty_name, position, department, email, phone_number, user_id)
VALUES
('SCS 01', 'Jovelyn Cuizon', 'Dean', 'SCS', 'jovelyn.cuizon@edu.ph', '09062144724', 2),
('SCS 02', 'Roderick Bandalan', 'Chairperson', 'SCS', 'roderick.bandalan@edu.ph', '06418739465', 3),
('SCS 03', 'Jeoffrey Gudio', 'Secretary', 'SCS', 'jeoffrey.gudio@edu.ph', '07193726485', 4),
('SCS 04', 'Lorna Miro', 'Teacher', 'SCS', 'lorna.miro@edu.ph', '09071973642', 5),
('SCS 05', 'Gene Abello', 'Teacher', 'SCS', 'gene.abello@edu.ph', '07094601035', 6),
('SCS 06', 'Josephine Petralba', 'Teacher', 'SCS', 'josephine.petralba@edu.ph', '09060133946', 7),
('SCS 07', 'Vicente Patalita III', 'Teacher', 'SCS', 'vicente.patalita@edu.ph', '09017033694', 8),
('SCS 08', 'Leeroy Gadiane', 'Teacher', 'SCS', 'leeroy.gadiane@edu.ph', '09087033964', 9);

-- Inserting values into the degrees table
INSERT INTO degrees (degree_id, faculty_id, degree, date_attained, institution)
VALUES
(1, 'SCS 01', 'Ph.D. in Computer Science', '2018-01-01', 'Cebu Institute University'),
(2, 'SCS 02', 'M.S. in Web applications development', '2018-01-01', 'University of San-Jose Recoletos'),
(3, 'SCS 03', 'M.S. in Information Technology', '2018-01-01', 'Cebu Institute University'),
(4, 'SCS 04', 'Ph.D. in Computer Science', '2018-01-01', 'University of San-Jose Recoletos'),
(5, 'SCS 05', 'Ph.D. in Computer Science', '2018-01-01', 'Cebu Institute University'),
(6, 'SCS 06', 'M.S. in Computer Science', '2018-01-01', 'University of San-Jose Recoletos'),
(7, 'SCS 07', 'M.S. in Computer Science', '2018-01-01', 'Cebu Institute University'),
(8, 'SCS 08', 'M.S. in Computer Science', '2018-01-01', 'University of San-Jose Recoletos');


-- Inserting values into the grants_awards table
INSERT INTO grants_awards (grant_award_id, faculty_id, grant_award, date_attained)
VALUES
(1, 'SCS 01', 'Best Paper Award', '2018-01-01'),
(2, 'SCS 02', 'Best Paper Award, Outstanding Teaching Award', '2018-01-01'),
(3, 'SCS 03', 'Research Fellowship', '2018-01-01'),
(4, 'SCS 04', 'Outstanding Teaching Award', '2018-01-01'),
(5, 'SCS 05', 'Outstanding Teaching Award', '2018-01-01'),
(6, 'SCS 06', 'Research Fellowship', '2018-01-01'),
(7, 'SCS 07', 'Outstanding Teaching Award', '2018-01-01'),
(8, 'SCS 08', 'Outstanding Teaching Award', '2018-01-01');

-- Inserting values into the work_history table
INSERT INTO work_history (work_history_id, faculty_id, company_name, job_title, start_date, end_date, description)
VALUES
(1, 'SCS 01', 'ABC Company', 'Software Developer', '2020-01-01', '2022-06-30', 'Worked on developing web applications using PHP and MySQL.'),
(2, 'SCS 02', 'ABC Company', 'Software Developer', '2020-01-01', '2022-06-30', 'Worked on developing web applications using PHP and MySQL.'),
(3, 'SCS 03', 'ABC Company', 'Software Developer', '2020-01-01', '2022-06-30', 'Worked on developing web applications using PHP and MySQL.'),
(4, 'SCS 04', 'ABC Company', 'Software Developer', '2020-01-01', '2022-06-30', 'Worked on developing web applications using PHP and MySQL.'),
(5, 'SCS 05', 'ABC Company', 'Software Developer', '2020-01-01', '2022-06-30', 'Worked on developing web applications using PHP and MySQL.'),
(6, 'SCS 06', 'ABC Company', 'Software Developer', '2020-01-01', '2022-06-30', 'Worked on developing web applications using PHP and MySQL.'),
(7, 'SCS 07', 'ABC Company', 'Software Developer', '2020-01-01', '2022-06-30', 'Worked on developing web applications using PHP and MySQL.'),
(8, 'SCS 08', 'ABC Company', 'Software Developer', '2020-01-01', '2022-06-30', 'Worked on developing web applications using PHP and MySQL.');


-- Inserting values into the publications table
INSERT INTO publications (publication_id, title, publication_type, publication_date, faculty_id)
VALUES
(1, 'Advancements in Artificial Intelligence', 'Research Paper', '2021-01-01', 'SCS 01'),
(2, 'Data Mining Techniques', 'Book Chapter', '2024-01-01', 'SCS 02'),
(3, 'Machine Learning Applications', 'Review Article', '2022-01-01', 'SCS 01');
  
-- select * from users;  
select * from publications;
-- select * from work_history;
-- select * from grants_awards;
-- select * from roles;
-- select * from faculty;
--  select * from degrees;
-- select * from faculty;	
SELECT * FROM degrees WHERE faculty_id = 1;
SELECT * FROM work_history WHERE work_history_id = 1;
     
     