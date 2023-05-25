create database fis;
use fis;
--
-- Database: `fis`
--
-- Roles table
-- Create the roles table
CREATE TABLE `roles` (
  `role_id` INT PRIMARY KEY,
  `role_name` VARCHAR(50) NOT NULL 
);
-- Add an index on the role_name column in the roles table
ALTER TABLE `roles` ADD INDEX `idx_role_name` (`role_name`);

-- Create the users table with the foreign key constraint
CREATE TABLE `users` (
  `user_id` INT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(50) NOT NULL,
  `role_name` VARCHAR(50) NOT NULL,
  FOREIGN KEY (`role_name`) REFERENCES `roles`(`role_name`)
);

-- Table structure for table `staff`
CREATE TABLE `staff` (
  `StaffNo` varchar(12) NOT NULL,
  `Password` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Table structure for table `student`
CREATE TABLE `student` (
  `StudentNo` varchar(11) NOT NULL,
  `Password` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `department` (
  `DepartmentCode` varchar(256) NOT NULL,
  `DepartmentName` varchar(256) NOT NULL,
  `Email` varchar(256) NOT NULL,
  `Phone` varchar(256) NOT NULL,
  `Location` TEXT NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Table structure for table `Faculty`
CREATE TABLE `faculty` (
  `FacultyID` varchar(10) NOT NULL,
  `FacultyName` varchar(256) NOT NULL,
  `Position` varchar(20) NOT NULL,
  `Department` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `PhoneNumber` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `workHistory` (
  `FacultyName` varchar(256) NOT NULL,
  `CompanyName` varchar(256) NOT NULL,
  `JobTitle` varchar(20) NOT NULL,
  `StartDate` DATE NOT NULL,
  `EndDate` DATE,
  `Description` TEXT
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `publications` (
  `Title` varchar(256) NOT NULL,
  `PublicationType` varchar(256) NOT NULL,
  `PublicationDate` DATE NOT NULL,
  `Author` varchar(256) NOT NULL,
  `AuthorType` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `degrees` (
  `FacultyName` varchar(256) NOT NULL,
  `Degree` varchar(256) NOT NULL,
  `DateAttained` DATE NOT NULL,
  `Institution` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `grantsAwards` (
  `FacultyName` varchar(256) NOT NULL,
  `GrantsAwards` varchar(256) NOT NULL,
  `DateAttained` DATE NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `courses` (
  `CourseCode` varchar(256) NOT NULL,
  `CourseName` varchar(256) NOT NULL,
  `FacultyName` varchar(256) NOT NULL,
  `Department` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Table structure for table `faq`
CREATE TABLE `faq` (
  `faqID` int(10) NOT NULL,
  `faqHeading` varchar(256) NOT NULL,
  `faqContent` varchar(1024) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Inserting roles
INSERT INTO `roles` (`role_id`, `role_name`)
VALUES
  (1, 'Admin'),
  (2, 'Faculty'),
  (3, 'Guest'),
  (4, 'Students');

-- Inserting sample users
INSERT INTO `users` (`user_id`, `username`, `password`, `role_name`)
VALUES
  (1, 'Admin', '12345', 'Admin'),
  (2, 'Teacher', '12345', 'Faculty'),
  (3, 'Guest', '12345', 'Guest'),
  (4, 'Student', '12345', 'Students'),
  (5, 'Student2', '12345', 'Students');

-- Dumping data for table `staff`
--
INSERT INTO `staff` (`StaffNo`, `Password`) VALUES
('Admin', '12345');
-- --------------------------------------------------------

--
-- Dumping data for table `student`
--
INSERT INTO `student` (`StudentNo`, `Password`) VALUES
('student', '12345'),
('student2', '12345'),
('Guest', '12345');
-- --------------------------------------------------------

--
-- Dumping data for table `department`
--
INSERT INTO `department` (`DepartmentCode`, `DepartmentName`, `Email`, `Phone`, `Location`) VALUES
('SCS', 'School of Computer Studies', 'scs@edu.ph', '(032) 408 5473', '2nd Floor at SEM building, Basak Campus'),
('SAS', 'School of Arts and Sciences', 'sas@edu.ph', '(032) 417 1438', 'Main Campus'),
('SED', 'School of Education', 'sed@edu.ph', '(032) 412 9512', 'Main Campus'),
('SBM', 'School of Business and Management', 'sas@edu.ph', '(032) 411 0308', 'Main Campus'),
('SOE', 'School of Engineering', 'soe@edu.ph', '(032) 406 7590', 'Main Campus'),
('SAMS', 'School of Allied Medical Sciences', 'sams@edu.ph', '(032) 401 1634', 'Main Campus');
-- --------------------------------------------------------

--
-- Dumping data for table `faculty`
--
INSERT INTO `faculty` (`FacultyID`, `FacultyName`, `Position`, `Department`, `Email`, `PhoneNumber`) VALUES
('SCS 01', 'Jovelyn Cuizon', 'Dean', 'SCS', 'jovelyn.cuizon@edu.ph', '09062144724'),
('SCS 02', 'Roderick Bandalan', 'Chairperson', 'SCS', 'roderick.bandalan@edu.ph', '06418739465'),
('SCS 03', 'Jeoffrey Gudio', 'Secretary', 'SCS', 'jeoffrey.gudio@edu.ph', '07193726485'),
('SCS 04', 'Lorna Miro', 'Teacher', 'SCS', 'lorna.miro@edu.ph', '09071973642'),
('SCS 05', 'Gene Abello', 'Teacher', 'SCS', 'gene.abello@edu.ph', '07094601035'),
('SCS 06', 'Josephine Petralba', 'Teacher', 'SCS', 'josephine.petralba@edu.ph', '09060133946'),
('SCS 07', 'Vicente Patalita III', 'Teacher', 'SCS', 'vicente.patalita@edu.ph', '09017033694'),
('SCS 08', 'Leeroy Gadiane', 'Teacher', 'SCS', 'leeroy.gadiane@edu.ph', '09087033964');
-- --------------------------------------------------------

--
-- Dumping data for table `workHistory`
--
INSERT INTO `workHistory` (`FacultyName`, `CompanyName`, `JobTitle`, `StartDate`, `EndDate`, `Description`) VALUES
('Jovelyn Cuizon', 'ABC Company', 'Software Developer', '2020-01-01', '2022-06-30', 'Worked on developing web applications using PHP and MySQL.'),
('Roderick Bandalan', 'ABC Company', 'Software Developer', '2020-01-01', '2022-06-30', 'Worked on developing web applications using PHP and MySQL.'),
('Jeoffrey Gudio', 'ABC Company', 'Software Developer', '2020-01-01', '2022-06-30', 'Worked on developing web applications using PHP and MySQL.'),
('Lorna Miro', 'ABC Company', 'Software Developer', '2020-01-01', '2022-06-30', 'Worked on developing web applications using PHP and MySQL.'),
('Gene Abello', 'ABC Company', 'Software Developer', '2020-01-01', '2022-06-30', 'Worked on developing web applications using PHP and MySQL.'),
('Josephine Petralba', 'ABC Company', 'Software Developer', '2020-01-01', '2022-06-30', 'Worked on developing web applications using PHP and MySQL.'),
('Vicente Patalita III', 'ABC Company', 'Software Developer', '2020-01-01', '2022-06-30', 'Worked on developing web applications using PHP and MySQL.'),
('Leeroy Gadiane', 'ABC Company', 'Software Developer', '2020-01-01', '2022-06-30', 'Worked on developing web applications using PHP and MySQL.');
-- --------------------------------------------------------

--
-- Dumping data for table `publications`
--
INSERT INTO `publications` (`Title`, `PublicationType`, `PublicationDate`, `Author`, `AuthorType`) VALUES
('Advancements in Artificial Intelligence', 'Research Paper', '2021-01-01', 'Jovelyn Cuizon', 'First Author'),
('Data Mining Techniques', 'Book Chapter', '2024-01-01', 'Roderick Bandalan, Leeroy Gadiane', 'First Author, Co-Author'),
('Machine Learning Applications', 'Review Article', '2022-01-01', 'Josephine Petralba', 'Corresponding Author');
-- --------------------------------------------------------

--
-- Dumping data for table `degrees`
--
INSERT INTO `degrees` (`FacultyName`, `Degree`, `DateAttained`, `Institution`) VALUES
('Jovelyn Cuizon', 'Ph.D. in Computer Science', '2018-01-01', 'Cebu Institute University'),
('Roderick Bandalan', 'M.S. in Web applications development', '2018-01-01', 'University of San-Jose Recoletos'),
('Jeoffrey Gudio', 'M.S. in Information Technology', '2018-01-01', 'Cebu Institute University'),
('Lorna Miro', 'Ph.D. in Computer Science', '2018-01-01', 'University of San-Jose Recoletos'),
('Gene Abello', 'Ph.D. in Computer Science', '2018-01-01', 'Cebu Institute University'),
('Josephine Petralba', 'M.S. in Computer Science', '2018-01-01', 'University of San-Jose Recoletos'),
('Vicente Patalita III', 'M.S. in Computer Science', '2018-01-01', 'Cebu Institute University'),
('Leeroy Gadiane', 'M.S. in Computer Science', '2018-01-01', 'University of San-Jose Recoletos');
-- --------------------------------------------------------

--
-- Dumping data for table `grantsawards`
--
INSERT INTO `grantsAwards` (`FacultyName`, `GrantsAwards`, `DateAttained`) VALUES
('Jovelyn Cuizon', 'Best Paper Award', '2018-01-01'),
('Roderick Bandalan', 'Best Paper Award, Outstanding Teaching Award', '2018-01-01'),
('Jeoffrey Gudio', 'Research Fellowship', '2018-01-01'),
('Lorna Miro', 'Outstanding Teaching Award', '2018-01-01'),
('Gene Abello', 'Outstanding Teaching Award', '2018-01-01'),
('Josephine Petralba', 'Research Fellowship', '2018-01-01'),
('Vicente Patalita III', 'Outstanding Teaching Award', '2018-01-01'),
('Leeroy Gadiane', 'Outstanding Teaching Award', '2018-01-01');
-- --------------------------------------------------------

--
-- Dumping data for table `courses`
--
INSERT INTO `courses` (`CourseCode`, `CourseName`, `FacultyName`, `Department`) VALUES
('SA', 'Systems Administration and Maintenance', 'Jovelyn Cuizon', 'SCS'),
('SP Elec', 'Web Application Development', 'Roderick Bandalan', 'SCS'),
('SEMTOUR', 'Seminars and Tours', 'Jeoffrey Gudio', 'SCS'),
('Data Struct', 'Data Structures and Algorithms', 'Lorna Miro', 'SCS'),
('IM', 'Information Management', 'Gene Abello', 'SCS'),
('Research', 'Methods of Research in Computing', 'Josephine Petralba', 'SCS'),
('DVA', 'Digital Visual Arts', 'Vicente Patalita III', 'SCS'),
('IT Review', '	Certification Exam Review', 'Leeroy Gadiane', 'SCS');
-- --------------------------------------------------------

--
-- Dumping data for table `faq`
--
INSERT INTO `faq` (`faqID`, `faqHeading`, `faqContent`) VALUES
(1, 'Is this all the faculty members?', '<p>No! The system will generate new information once there is a new faculty member that will be added by the admin(s)</p>'),
(2, 'Can the students or general users edit information here?', '<p>Sadly no, only the faculty members or admins can edit the information on this website.</p>'),
(3, 'When does the system updates new information?', '<p>The system will always be updated every new semester to keep up with the new informations or changes.</p>'),
(4, 'How can I create an account?', '<p>You can create an account by filling up the form in the Registrar\'\s office. The admin will create the account for you with the password and assigned Role and those information will be emailed to you.</p>');
-- --------------------------------------------------------
--
--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
-- ALTER TABLE `course`
--   ADD PRIMARY KEY (`CourseId`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faqID`,`faqHeading`);

--
-- Indexes for table `marks`
--
-- ALTER TABLE `marks`
--   ADD PRIMARY KEY (`SubjectId`,`StudentNo`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffNo`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`StudentNo`);

--
-- Indexes for table `subject`
--
-- ALTER TABLE `subject`
--   ADD PRIMARY KEY (`SubjectCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faqID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

-- select * from `roles`;
-- select * from `student`;
-- select * from `staff`;
-- select * from `users`;