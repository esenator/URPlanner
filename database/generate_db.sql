



-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'Course'
-- Course Database
-- ---

DROP TABLE IF EXISTS `Course`;
		
CREATE TABLE `Course` (
  `CRN` INTEGER NOT NULL COMMENT 'Course Registration Number',
  `CourseNumber` VARCHAR(8) NOT NULL COMMENT 'Course Number',
  `CourseTitle` VARCHAR(30) NOT NULL COMMENT 'Full Course Title/Name',
  `Term` VARCHAR(20) NOT NULL COMMENT 'Course Term',
  `Department` VARCHAR(20) NOT NULL COMMENT 'Department',
  `Credits` INT NOT NULL COMMENT 'Course Credits',
  PRIMARY KEY (`CRN`)
) COMMENT 'Course Database';

-- ---
-- Table 'Prerequisites'
-- Course and Prerequisite Relation. Exists a relation for every prerequisite to a course
-- ---

DROP TABLE IF EXISTS `Prerequisites`;
		
CREATE TABLE `Prerequisites` (
  `CRN` INTEGER NOT NULL COMMENT 'Course Registration Number',
  `PrereqCRN` INTEGER NOT NULL COMMENT 'Course Prerequisite''s CRN',
  PRIMARY KEY (`CRN`)
) COMMENT 'Course and Prerequisite Relation. Exists a relation for ever';

-- ---
-- Table 'Schedule'
-- Relation for storing personal schedules based on NetID
-- ---

DROP TABLE IF EXISTS `Schedule`;
		
CREATE TABLE `Schedule` (
  `NetID` VARCHAR(20) NOT NULL COMMENT 'NetID or Username of Student',
  `Schedule` VARCHAR(200) NOT NULL COMMENT 'Schedule stored as a JSON string',
  `Name` VARCHAR(30) NOT NULL COMMENT 'Student''s Name',
  `Date` DATE NOT NULL COMMENT 'Date schedule editted',
  PRIMARY KEY (`NetID`)
) COMMENT 'Relation for storing personal schedules based on NetID';

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `Course` ADD FOREIGN KEY (CRN) REFERENCES `Prerequisites` (`CRN`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `Course` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Prerequisites` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Schedule` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `Course` (`CRN`,`CourseNumber`,`CourseTitle`,`Term`,`Department`,`Credits`) VALUES
-- ('','','','','','');
-- INSERT INTO `Prerequisites` (`CRN`,`PrereqCRN`) VALUES
-- ('','');
-- INSERT INTO `Schedule` (`NetID`,`Schedule`,`Name`,`Date`) VALUES
-- ('','','','');

