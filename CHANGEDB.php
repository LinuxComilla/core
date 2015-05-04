<?php

/*
Gibbon, Flexible & Open School System
Copyright (C) 2010, Ross Parker

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/


//USE ;end TO SEPERATE SQL STATEMENTS. DON'T USE ;end IN ANY OTHER PLACES!

$sql=array() ;
$count=0 ;

//v7.1.02 and earlier removed to reduce file size

//v8.0.00
$count++ ;
$sql[$count][0]="8.0.00" ;
$sql[$count][1]="
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='User Admin' AND gibbonAction.name='Manage Districts'));end
ALTER TABLE `gibbonDistrict` ENGINE=MYISAM ;end
CREATE TABLE `gibboni18n` (  `gibboni18nID` int(4) unsigned zerofill NOT NULL AUTO_INCREMENT,  `code` varchar(5) NOT NULL,  `name` varchar(50) NOT NULL,  `systemDefault` enum('Y','N') NOT NULL DEFAULT 'N',  `maintainerName` varchar(100) NOT NULL,  `maintainerWebsite` varchar(255) NOT NULL,  `dateFormat` varchar(20) NOT NULL,  `currencyCode` varchar(3) NOT NULL COMMENT '3-char',  `currencySymbol` varchar(1) NOT NULL,  PRIMARY KEY (`gibboni18nID`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;end
INSERT INTO `gibboni18n` (`gibboni18nID`, `code`, `name`, `systemDefault`, `maintainerName`, `maintainerWebsite`, `dateFormat`, `currencyCode`, `currencySymbol`) VALUES(0001, 'en-GB', 'English - United Kingdom', 'Y', 'Gibbon', 'http://gibbonedu.org', 'd-m-Y', 'GBP', '£'),(0002, 'en-US', 'English - United States', 'N', 'Gibbon', 'http://gibbonedu.org', 'm-d-Y', 'USD', '$'),(0003, 'es', 'Español', 'N', 'International College Hong Kong (ICHK)', 'http://www.ichk.edu.hk', 'd-m-Y', 'EUR', '€'),(0004, 'zh-CN', '汉语 - 中国', 'N', 'International College Hong Kong (ICHK)', 'http://www.ichk.edu.hk', 'Y-m-d', 'CNY', '¥');end
INSERT INTO `gibbonAction` (`gibbonActionID`, `gibbonModuleID`, `name`, `precedence`, `category`, `description`, `URLList`, `entryURL`, `entrySidebar`, `defaultPermissionAdmin`, `defaultPermissionTeacher`, `defaultPermissionStudent`, `defaultPermissionParent`, `defaultPermissionSupport`, `categoryPermissionStaff`, `categoryPermissionStudent`, `categoryPermissionParent`, `categoryPermissionOther`) VALUES (NULL, (SELECT gibbonModuleID FROM gibbonModule WHERE name='System Admin'), 'Language Settings', 0, '', 'Allows administrators to control system-wide language and localisation settings.', 'i18n_manage.php', 'i18n_manage.php', 'Y', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N');end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='System Admin' AND gibbonAction.name='Language Settings'));end
ALTER TABLE `gibbonPerson` ADD `gibboni18nIDPersonal` INT( 4 ) UNSIGNED ZEROFILL NULL DEFAULT NULL ;end
UPDATE gibboni18n SET dateFormat='d/m/Y' WHERE code='en-GB';end
UPDATE gibboni18n SET dateFormat='m/d/Y' WHERE code='en-US';end
UPDATE gibboni18n SET dateFormat='d/m/Y' WHERE code='es';end
INSERT INTO `gibboni18n` (`code`, `name`, `systemDefault`, `maintainerName`, `maintainerWebsite`, `dateFormat`, `currencyCode`, `currencySymbol`) VALUES ('zh-HK', '體字 - 香港', 'N', 'International College Hong Kong (ICHK)', 'http://www.ichk.edu.hk', 'Y-m-d', 'HKD', '$');end
ALTER TABLE `gibboni18n` CHANGE `dateFormat` `dateFormatPHP` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;end
ALTER TABLE `gibboni18n` ADD `dateFormat` VARCHAR( 20 ) NOT NULL AFTER maintainerWebsite ,ADD `dateFormatRegEx` VARCHAR( 255 ) NOT NULL AFTER dateFormat ;end
UPDATE gibboni18n SET dateFormat='dd/mm/yyyy' WHERE code='en-GB';end
UPDATE gibboni18n SET dateFormat='mm/dd/yyyy' WHERE code='en-US';end
UPDATE gibboni18n SET dateFormat='dd/mm/yyyy' WHERE code='es';end
UPDATE gibboni18n SET dateFormat='yyyy-mm-dd' WHERE code='zh-CN';end
UPDATE gibboni18n SET dateFormat='dd/mm/yyyy' WHERE code='zh-HK';end
UPDATE gibboni18n SET dateFormatRegEx='/^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$/i' WHERE code='en-GB';end
UPDATE gibboni18n SET dateFormatRegEx='/^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$/i' WHERE code='es';end
UPDATE gibboni18n SET dateFormatRegEx='/^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$/i' WHERE code='zh-HK';end
UPDATE gibboni18n SET dateFormatRegEx='/(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20\d\d)/' WHERE code='en-US';end
UPDATE gibboni18n SET dateFormatRegEx='/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/' WHERE code='zh-CN';end
UPDATE gibboni18n SET dateFormatPHP='d/m/Y' WHERE code='zh-HK';end
ALTER TABLE `gibboni18n` CHANGE `dateFormatRegEx` `dateFormatRegEx` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;end
UPDATE gibboni18n SET dateFormatRegEx='/^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\\d\\d$/i' WHERE code='en-GB';end
UPDATE gibboni18n SET dateFormatRegEx='/^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\\d\\d$/i' WHERE code='es';end
UPDATE gibboni18n SET dateFormatRegEx='/^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\\d\\d$/i' WHERE code='zh-HK';end
UPDATE gibbonAction SET URLList='markbook_edit.php, markbook_edit_add.php, markbook_edit_edit.php, markbook_edit_delete.php,markbook_edit_data.php,markbook_edit_targets.php' WHERE name='Edit Markbook_singleClass' AND gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE gibbonModule.name='Markbook') ;end
UPDATE gibbonAction SET URLList='markbook_edit.php, markbook_edit_add.php,markbook_edit_addMulti.php,markbook_edit_edit.php, markbook_edit_delete.php,markbook_edit_data.php,markbook_edit_targets.php' WHERE name LIKE 'Edit Markbook%' AND NOT name='Edit Markbook_singleClass' AND gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE gibbonModule.name='Markbook') ;end
ALTER TABLE `gibbonMarkbookEntry` CHANGE `gibbonPersonIDStudent` `gibbonPersonIDStudent` INT( 10 ) UNSIGNED ZEROFILL NOT NULL ;end
CREATE TABLE `gibbonMarkbookTarget` (  `gibbonMarkbookTargetID` int(14) unsigned zerofill NOT NULL AUTO_INCREMENT,  `gibbonCourseClassID` int(8) unsigned zerofill NOT NULL,  `gibbonPersonIDStudent` int(10) unsigned zerofill NOT NULL,  `gibbonScaleGradeID` int(7) NOT NULL,  PRIMARY KEY (`gibbonMarkbookTargetID`),  UNIQUE KEY `coursePerson` (`gibbonCourseClassID`,`gibbonPersonIDStudent`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID`, `scope`, `name`, `nameDisplay`, `description`, `value`) VALUES (NULL, 'Markbook', 'personalisedWarnings', 'Personalised Warnings', 'Should markbook warnings be based on personal targets, if they are available?', 'Y');end
ALTER TABLE `gibbonActivity` ADD `provider` ENUM( 'School', 'External' ) NOT NULL DEFAULT 'School' AFTER `name` ;end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID`, `scope`, `name`, `nameDisplay`, `description`, `value`) VALUES (NULL, 'Activities', 'disableExternalProviderSignup', 'Disable External Provider Signup', 'Should we turn off the option to sign up for activities provided by an outside agency?', 'N');end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID`, `scope`, `name`, `nameDisplay`, `description`, `value`) VALUES (NULL, 'Activities', 'hideExternalProviderCost', 'Hide External Provider Cost', 'Should we hide the cost of activities provided by an outside agency from the Activities View?', 'N');end
INSERT INTO `gibbonAction` (`gibbonActionID`, `gibbonModuleID`, `name`, `precedence`, `category`, `description`, `URLList`, `entryURL`, `entrySidebar`, `defaultPermissionAdmin`, `defaultPermissionTeacher`, `defaultPermissionStudent`, `defaultPermissionParent`, `defaultPermissionSupport`, `categoryPermissionStaff`, `categoryPermissionStudent`, `categoryPermissionParent`, `categoryPermissionOther`) VALUES (NULL, (SELECT gibbonModuleID FROM gibbonModule WHERE name='Students'), 'Privacy Choices by Student', 0, 'Reports', 'Shows privacy options selected, for those students with a selection made.', 'report_privacy_student.php', 'report_privacy_student.php', 'Y', 'Y', 'Y', 'N', 'N', 'N', 'Y', 'N', 'N', 'N');end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Students' AND gibbonAction.name='Privacy Choices by Student'));end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '2', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Students' AND gibbonAction.name='Privacy Choices by Student'));end
ALTER TABLE `gibbonMarkbookEntry` CHANGE `attainmentConcern` `attainmentConcern` ENUM( 'N', 'Y', 'P' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '''P'' denotes that student has exceed their personal target';end
ALTER TABLE `gibbonMarkbookTarget` CHANGE `gibbonScaleGradeID` `gibbonScaleGradeID` INT( 7 ) NULL DEFAULT NULL ;end
ALTER TABLE `gibbonMarkbookEntry` CHANGE `attainmentDescriptor` `attainmentDescriptor` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , CHANGE `effortDescriptor` `effortDescriptor` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;end
UPDATE gibboni18n SET name='Español - España', code='es_ES' WHERE code='ES';end
UPDATE gibboni18n SET code='en_GB' WHERE code='en-GB';end
UPDATE gibboni18n SET code='en_US' WHERE code='en-US';end
UPDATE gibboni18n SET code='zh_CN' WHERE code='zh-CN';end
UPDATE gibboni18n SET code='zh_HK' WHERE code='zh-HK';end
UPDATE gibboni18n SET dateFormatRegEx='/(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20\\d\\d)/' WHERE code='en_US';end
ALTER TABLE `gibbonApplicationForm` CHANGE `status` `status` ENUM( 'Pending', 'Waiting List', 'Accepted', 'Rejected', 'Withdrawn' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Pending';end
UPDATE gibbonAction SET category='User Management' WHERE name='Student Enrolment' AND gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE gibbonModule.name='User Admin') ;end
UPDATE gibbonModule SET category='Assessment' WHERE category='ARR';end
UPDATE gibbonModule SET category='Learning' WHERE category='T&L';end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID`, `scope`, `name`, `nameDisplay`, `description`, `value`) VALUES (NULL, 'System', 'cuttingEdgeCode', 'Cutting Edge Code', 'Are you running cutting edge code, instead of stable versions?', 'N');end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID`, `scope`, `name`, `nameDisplay`, `description`, `value`) VALUES (NULL, 'System', 'cuttingEdgeCodeLine', 'Cutting Edge Code Line', 'What line of SQL code did the last cutting edge update hit?', '');end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID`, `scope`, `name`, `nameDisplay`, `description`, `value`) VALUES (NULL, 'System', 'gibboneduComOrganisationName', 'gibbonedu.com Organisation Name', 'Name of organisation, as registered with gibbonedu.com, for access to value-added services.', '');end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID`, `scope`, `name`, `nameDisplay`, `description`, `value`) VALUES (NULL, 'System', 'gibboneduComOrganisationKey', 'gibbonedu.com Organisation Key', 'Organisation\'s private key, as registered with gibbonedu.com, for access to value-added services.', '');end
ALTER TABLE `gibbonCourseClassPerson` ADD `reportable` ENUM('Y','N') NOT NULL DEFAULT 'Y' ;end
ALTER TABLE `gibboni18n` CHANGE `currencySymbol` `currencySymbol` VARCHAR(3) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;end
INSERT INTO `gibboni18n` (`gibboni18nID`, `code`, `name`, `systemDefault`, `maintainerName`, `maintainerWebsite`, `dateFormat`, `dateFormatRegEx`, `dateFormatPHP`, `currencyCode`, `currencySymbol`) VALUES (NULL, 'pl_PL', 'Język Polski - Polska', 'N', 'Arek Gladki', '', 'dd/mm/yyyy', '/^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\\\\d\\\\d$/i', 'd/m/Y', 'PLN', 'zł');end
UPDATE gibboni18n SET name='Język polski - Polska' WHERE code='pl_PL';end
CREATE TABLE `gibbonPayment` (  `gibbonPaymentID` int(14) unsigned zerofill NOT NULL AUTO_INCREMENT,  `foreignTable` varchar(50) NOT NULL,  `foreignTableID` int(14) unsigned zerofill NOT NULL,  `gateway` enum('Paypal') NOT NULL,  `paymentToken` varchar(50) NOT NULL,  `paymentPayerID` varchar(50) NOT NULL,  `paymentTransactionID` varchar(50) NOT NULL,  `paymentReceiptID` varchar(50) NOT NULL,  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,  PRIMARY KEY (`gibbonPaymentID`)) DEFAULT CHARSET=utf8 ;end
ALTER TABLE `gibbonApplicationForm`  DROP `paypalPaymentToken`,  DROP `paypalPaymentPayerID`,  DROP `paypalPaymentTransactionID`,  DROP `paypalPaymentReceiptID`;end
ALTER TABLE `gibbonApplicationForm` ADD `gibbonPaymentID` INT(14) UNSIGNED ZEROFILL NULL DEFAULT NULL AFTER `paymentMade`;end
ALTER TABLE `gibbonPayment` ADD `status` ENUM('Success','Failure') NOT NULL DEFAULT 'Success' AFTER `gateway`;end
INSERT INTO `gibbonAction` (`gibbonModuleID` ,`name` ,`precedence` ,`category` ,`description` ,`URLList` ,`entryURL` ,`defaultPermissionAdmin` ,`defaultPermissionTeacher` ,`defaultPermissionStudent` ,`defaultPermissionParent` ,`defaultPermissionSupport` ,`categoryPermissionStaff` ,`categoryPermissionStudent` ,`categoryPermissionParent` ,`categoryPermissionOther`) VALUES ((SELECT gibbonModuleID FROM gibbonModule WHERE name='Timetable'), 'View Available Teachers', 0, 'Reports', 'View unassigned teachers by timetable.', 'report_viewAvailableTeachers.php', 'report_viewAvailableTeachers.php', 'Y', 'N', 'N', 'N', 'N', 'Y', 'Y', 'Y', 'Y');end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Timetable' AND gibbonAction.name='View Available Teachers'));end
ALTER TABLE `gibboni18n` ADD `active` ENUM('Y','N') NOT NULL DEFAULT 'Y' AFTER `name`;end
UPDATE gibboni18n SET active='N' WHERE NOT code='en_GB';end
INSERT INTO `gibbonAction` (`gibbonActionID`, `gibbonModuleID`, `name`, `precedence`, `category`, `description`, `URLList`, `entryURL`, `entrySidebar`, `defaultPermissionAdmin`, `defaultPermissionTeacher`, `defaultPermissionStudent`, `defaultPermissionParent`, `defaultPermissionSupport`, `categoryPermissionStaff`, `categoryPermissionStudent`, `categoryPermissionParent`, `categoryPermissionOther`) VALUES (NULL, (SELECT gibbonModuleID FROM gibbonModule WHERE name='Activities'), 'Copy Activities', 0, 'Actions', 'This action copies all current activities, slots and staff into a specified year.', 'activities_copy.php', 'activities_copy.php', 'Y', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N');end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Activities' AND gibbonAction.name='Copy Activities'));end
ALTER TABLE `gibbonPayment` CHANGE `paymentPayerID` `paymentPayerID` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;end
UPDATE gibbonAction SET category='Assessment' WHERE category='ARR';end
ALTER TABLE `gibbonPayment` CHANGE `paymentToken` `paymentToken` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `paymentTransactionID` `paymentTransactionID` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `paymentReceiptID` `paymentReceiptID` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;end
UPDATE gibboni18n SET active='Y' WHERE code='en_US';end
ALTER TABLE `gibboni18n` DROP `currencyCode`, DROP `currencySymbol`;end
UPDATE `gibbonAction` SET `name` = 'Activity Enrolment Summary', `description` = 'View summary enrolment information for all activities in the current year.' WHERE `gibbonAction`.`name` = 'Activity Enrollment Summary';end
UPDATE gibbonModule SET description='Allows a school to issue invoices and track payments.' WHERE name='Finance';end
";

//v8.0.01
$count++ ;
$sql[$count][0]="8.0.01" ;
$sql[$count][1]="" ;

//v8.0.02
$count++ ;
$sql[$count][0]="8.0.02" ;
$sql[$count][1]="" ;

//v8.0.03
$count++ ;
$sql[$count][0]="8.0.03" ;
$sql[$count][1]="" ;

//v8.0.04
$count++ ;
$sql[$count][0]="8.0.04" ;
$sql[$count][1]="" ;

//v8.0.05
$count++ ;
$sql[$count][0]="8.0.05" ;
$sql[$count][1]="
UPDATE `gibbonAction` SET entrySidebar='N' WHERE gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='User Admin') AND gibbonAction.name='Manage Permissions';end
UPDATE `gibbonAction` SET URLList='role_manage.php,role_manage_add.php,role_manage_edit.php,role_manage_delete.php,role_manage_duplicate.php' WHERE gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='User Admin') AND gibbonAction.name='Manage Roles';end
" ;

//v8.0.06
$count++ ;
$sql[$count][0]="8.0.06" ;
$sql[$count][1]="" ;

//v8.1.00
$count++ ;
$sql[$count][0]="8.1.00" ;
$sql[$count][1]="
CREATE TABLE `gibbonPlannerEntryStudentHomework` (  `gibbonPlannerEntryStudentHomeworkID` int(14) unsigned zerofill NOT NULL AUTO_INCREMENT,  `gibbonPlannerEntryID` int(14) unsigned zerofill NOT NULL,  `gibbonPersonID` int(10) NOT NULL,  `homeworkDueDateTime` datetime NOT NULL,  `homeworkDetails` mediumtext NOT NULL,  `homeworkComplete` enum('Y','N') NOT NULL DEFAULT 'N',  PRIMARY KEY (`gibbonPlannerEntryStudentHomeworkID`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Allows students to add homework deadlines themselves' ;end
ALTER TABLE `gibbonPlannerEntryStudentHomework` ADD INDEX( `gibbonPlannerEntryID`, `gibbonPersonID`);end
UPDATE gibboni18n SET dateFormatRegEx='/(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20\\\d\\\d)/' WHERE code='en_US';end
INSERT INTO `gibboni18n` (`code`, `name`, `active`, `systemDefault`, `maintainerName`, `maintainerWebsite`, `dateFormat`, `dateFormatRegEx`, `dateFormatPHP`) VALUES ('it_IT', 'Italiano - Italia', 'Y', 'N', 'Carmine Sirignano', '', 'dd/mm/yyyy', '/^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\\\d\\\d$/i', 'd/m/Y');end
CREATE TABLE `gibbonPlannerParentWeeklyEmailSummary` (  `gibbonPlannerParentWeeklyEmailSummaryID` int(14) unsigned zerofill NOT NULL AUTO_INCREMENT,  `gibbonSchoolYearID` int(3) unsigned zerofill NOT NULL,  `gibbonPersonIDParent` int(10) unsigned zerofill NOT NULL,  `gibbonPersonIDStudent` int(10) unsigned zerofill NOT NULL,  `weekOfYear` int(2) NOT NULL,  `key` varchar(40) NOT NULL,  `confirmed` enum('N','Y') NOT NULL DEFAULT 'Y',  PRIMARY KEY (`gibbonPlannerParentWeeklyEmailSummaryID`),  UNIQUE KEY `key` (`key`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;end
INSERT INTO `gibbonAction` (`gibbonActionID`, `gibbonModuleID`, `name`, `precedence`, `category`, `description`, `URLList`, `entryURL`, `entrySidebar`, `defaultPermissionAdmin`, `defaultPermissionTeacher`, `defaultPermissionStudent`, `defaultPermissionParent`, `defaultPermissionSupport`, `categoryPermissionStaff`, `categoryPermissionStudent`, `categoryPermissionParent`, `categoryPermissionOther`) VALUES (NULL, (SELECT gibbonModuleID FROM gibbonModule WHERE name='Planner'), 'Parent Weekly Email Summary', 0, 'Reports', 'This report shows responses to the weekly summary email, organised by calendar week and role group.', 'report_parentWeeklyEmailSummaryConfirmation.php', 'report_parentWeeklyEmailSummaryConfirmation.php', 'Y', 'Y', 'Y', 'N', 'N', 'N', 'Y', 'N', 'N', 'N');end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Planner' AND gibbonAction.name='Parent Weekly Email Summary'));end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '2', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Planner' AND gibbonAction.name='Parent Weekly Email Summary'));end
ALTER TABLE `gibbonPlannerParentWeeklyEmailSummary` CHANGE `confirmed` `confirmed` ENUM('N','Y') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'N';end
ALTER TABLE `gibbonPlannerEntry` DROP `twitterSearch`;end
ALTER TABLE `gibbonPerson` CHANGE `username` `username` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'Application Form', 'studentDefaultEmail', 'Student Default Email', 'Set default email for students on acceptance, using [username] to insert username.', '');end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'Application Form', 'studentDefaultWebsite', 'Student Default Website', 'Set default website for students on acceptance, using [username] to insert username.', '');end
" ;

//v8.2.00
$count++ ;
$sql[$count][0]="8.2.00" ;
$sql[$count][1]="
CREATE TABLE `gibbonNotification` (`gibbonNotificationID` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,  `gibbonPersonID` int(10) unsigned zerofill NOT NULL,  `gibbonModuleID` int(4) unsigned zerofill DEFAULT NULL,  `text` text NOT NULL, `actionLink` varchar(255) NOT NULL COMMENT 'Relative to absoluteURL, start with a forward slash', `actionText` varchar(255) NOT NULL,  `timestamp` datetime NOT NULL,  PRIMARY KEY (`gibbonNotificationID`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;end
ALTER TABLE `gibbonNotification` DROP `actionText`;end
ALTER TABLE `gibbonNotification` ADD `count` INT(4) NOT NULL DEFAULT '1' AFTER `gibbonModuleID`;end
ALTER TABLE `gibbonActivity` ADD `registration` ENUM('Y','N') NOT NULL DEFAULT 'Y' COMMENT 'Can a parent/student select this for registration?' AFTER `active`;end
ALTER TABLE `gibbonMessengerTarget` CHANGE `type` `type` ENUM('Class','Course','Roll Group','Year Group','Activity','Role','Applicants','Individuals','Houses','Role Category') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;end
ALTER TABLE `gibbonMessengerTarget` CHANGE `id` `id` VARCHAR(30) NOT NULL;end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'School Admin', 'studentAgreementOptions', 'Student Agreement Options', 'Comma-separated list of agreements that students might be asked to sign in school (e.g. ICT Policy).', '');end
ALTER TABLE `gibbonPerson` ADD `studentAgreements` TEXT NOT NULL ;end
UPDATE gibbonAction SET entrySidebar='N' WHERE name='Age & Gender Summary' AND gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='Students');end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'Markbook', 'attainmentAlternativeName', 'Attainment Alternative Name', 'A name to use isntead of \"Attainment\" in the first grade column of the markbook.', '');end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'Markbook', 'effortAlternativeName', 'Effort Alternative Name', 'A name to use isntead of \"Effort\" in the second grade column of the markbook.', '');end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'Markbook', 'attainmentAlternativeNameAbrev', 'Attainment Alternative Name Abbreviation', 'A short name to use isntead of \"Attainment\" in the first grade column of the markbook.', '');end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'Markbook', 'effortAlternativeNameAbrev', 'Effort Alternative Name Abbreviation', 'A short name to use isntead of \"Effort\" in the second grade column of the markbook.', '');end
INSERT INTO `gibbonAction` (`gibbonModuleID` ,`name` ,`precedence` ,`category` ,`description` ,`URLList` ,`entryURL` ,`defaultPermissionAdmin` ,`defaultPermissionTeacher` ,`defaultPermissionStudent` ,`defaultPermissionParent` ,`defaultPermissionSupport` ,`categoryPermissionStaff` ,`categoryPermissionStudent` ,`categoryPermissionParent` ,`categoryPermissionOther`) VALUES ((SELECT gibbonModuleID FROM gibbonModule WHERE name='External Assessment'), 'Import Assessment Results', 0, '', 'Import CSV file of results, to update matching records and create new records where none exist.', 'import_results.php', 'import_results.php', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N');end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='External Assessment' AND gibbonAction.name='Import Assessment Results'));end
UPDATE gibbonAction SET entryURL='externalAssessment.php' WHERE name='External Assessment Data_manage' AND gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='External Assessment');end
ALTER TABLE `gibbonPerson` CHANGE `studentAgreements` `studentAgreements` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;end
CREATE TABLE `gibbonTTSpaceChange` (  `gibbonTTSpaceChangeID` int(12) unsigned zerofill NOT NULL AUTO_INCREMENT,  `gibbonTTDayRowClassID` int(12) unsigned zerofill NOT NULL,  `gibbonSpaceID` int(5) unsigned zerofill DEFAULT NULL,  `date` date NOT NULL,  `gibbonPersonID` int(12) unsigned zerofill NOT NULL,  PRIMARY KEY (`gibbonTTSpaceChangeID`),  KEY `gibbonTTDayRowClassID` (`gibbonTTDayRowClassID`),  KEY `date` (`date`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;end
INSERT INTO `gibbonAction` (`gibbonActionID`, `gibbonModuleID`, `name`, `precedence`, `category`, `description`, `URLList`, `entryURL`, `entrySidebar`, `defaultPermissionAdmin`, `defaultPermissionTeacher`, `defaultPermissionStudent`, `defaultPermissionParent`, `defaultPermissionSupport`, `categoryPermissionStaff`, `categoryPermissionStudent`, `categoryPermissionParent`, `categoryPermissionOther`) VALUES (NULL, (SELECT gibbonModuleID FROM gibbonModule WHERE name='Timetable'), 'Manage Space Changes_allClasses', 0, 'Spaces', 'Allows a user to create and manage one-off location changes for all classes within the timetable.', 'spaceChange_manage.php,spaceChange_manage_add.php,spaceChange_manage_edit.php,spaceChange_manage_delete.php','spaceChange_manage.php', 'Y', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N');end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Timetable' AND gibbonAction.name='Manage Space Changes_allClasses'));end
INSERT INTO `gibbonAction` (`gibbonActionID`, `gibbonModuleID`, `name`, `precedence`, `category`, `description`, `URLList`, `entryURL`, `entrySidebar`, `defaultPermissionAdmin`, `defaultPermissionTeacher`, `defaultPermissionStudent`, `defaultPermissionParent`, `defaultPermissionSupport`, `categoryPermissionStaff`, `categoryPermissionStudent`, `categoryPermissionParent`, `categoryPermissionOther`) VALUES (NULL, (SELECT gibbonModuleID FROM gibbonModule WHERE name='Timetable'), 'Manage Space Changes_myClasses', 0, 'Spaces', 'Allows a user to create and manage one-off location changes for their own classes within the timetable.', 'spaceChange_manage.php,spaceChange_manage_add.php,spaceChange_manage_edit.php,spaceChange_manage_delete.php','spaceChange_manage.php', 'Y', 'N', 'Y', 'N', 'N', 'N', 'Y', 'N', 'N', 'N');end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '2', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Timetable' AND gibbonAction.name='Manage Space Changes_myClasses'));end
CREATE TABLE `gibbonTTSpaceBooking` (  `gibbonTTSpaceBookingID` int(12) unsigned zerofill NOT NULL AUTO_INCREMENT,  `gibbonSpaceID` int(5) unsigned zerofill NOT NULL,  `gibbonPersonID` int(10) unsigned zerofill NOT NULL,  `date` date NOT NULL,  `timeStart` time NOT NULL,  `timeEnd` time NOT NULL,  PRIMARY KEY (`gibbonTTSpaceBookingID`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;end
ALTER TABLE `gibbonPerson` ADD `viewCalendarSpaceBooking` ENUM('Y','N') NOT NULL DEFAULT 'N' AFTER `viewCalendarPersonal`;end
INSERT INTO `gibbonAction` (`gibbonActionID`, `gibbonModuleID`, `name`, `precedence`, `category`, `description`, `URLList`, `entryURL`, `entrySidebar`, `defaultPermissionAdmin`, `defaultPermissionTeacher`, `defaultPermissionStudent`, `defaultPermissionParent`, `defaultPermissionSupport`, `categoryPermissionStaff`, `categoryPermissionStudent`, `categoryPermissionParent`, `categoryPermissionOther`) VALUES (NULL, (SELECT gibbonModuleID FROM gibbonModule WHERE name='Timetable'), 'Manage Space Bookings_allBookings', 0, 'Spaces', 'Allows a user to book a room for on-off use, and manage bookings made by all other users.', 'spaceBooking_manage.php,spaceBooking_manage_add.php,spaceBooking_manage_edit.php,spaceBooking_manage_delete.php','spaceBooking_manage.php', 'Y', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N');end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Timetable' AND gibbonAction.name='Manage Space Bookings_allBookings'));end
INSERT INTO `gibbonAction` (`gibbonActionID`, `gibbonModuleID`, `name`, `precedence`, `category`, `description`, `URLList`, `entryURL`, `entrySidebar`, `defaultPermissionAdmin`, `defaultPermissionTeacher`, `defaultPermissionStudent`, `defaultPermissionParent`, `defaultPermissionSupport`, `categoryPermissionStaff`, `categoryPermissionStudent`, `categoryPermissionParent`, `categoryPermissionOther`) VALUES (NULL, (SELECT gibbonModuleID FROM gibbonModule WHERE name='Timetable'), 'Manage Space Bookings_myBookings', 0, 'Spaces', 'Allows a user to book a room for on-off use, and manage their own bookings.', 'spaceBooking_manage.php,spaceBooking_manage_add.php,spaceBooking_manage_edit.php,spaceBooking_manage_delete.php','spaceBooking_manage.php', 'Y', 'N', 'Y', 'N', 'N', 'N', 'Y', 'N', 'N', 'N');end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '2', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Timetable' AND gibbonAction.name='Manage Space Bookings_myBookings'));end
INSERT INTO `gibboni18n` (`code`, `name`, `active`, `systemDefault`, `maintainerName`, `maintainerWebsite`, `dateFormat`, `dateFormatRegEx`, `dateFormatPHP`) VALUES ('es_MX', 'Español - México', 'Y', 'N', 'Guillermo Bautista Fuerte.', '', 'dd/mm/yyyy', '/^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\\\d\\\d$/i', 'd/m/Y');end
DELETE FROM gibboni18n WHERE code='es_MX';end
UPDATE `gibboni18n` SET `code` = 'es', `name` = 'Español', active='Y' WHERE `code`='es_ES';end
UPDATE `gibboni18n` SET `code` = 'es_ES' WHERE `code`='es';end
" ;

//v8.3.00
$count++ ;
$sql[$count][0]="8.3.00" ;
$sql[$count][1]="
ALTER TABLE `gibbonRollGroup` ADD `website` VARCHAR(255) NOT NULL ;end
INSERT INTO `gibboni18n` (`code`, `name`, `active`, `systemDefault`, `maintainerName`, `maintainerWebsite`, `dateFormat`, `dateFormatRegEx`, `dateFormatPHP`) VALUES ('id_ID', 'Bahasa Indonesia - Indonesia', 'N', 'N', 'Adrian Hodson', '', 'dd/mm/yyyy', '/^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\\\d\\\d$/i', 'd/m/Y');end
UPDATE gibbonAction SET URLList='planner.php, planner_view_full.php, planner_deadlines.php, planner_view_full_post.php, planner_unitOverview.php' WHERE name='Lesson Planner_viewMyChildrensClasses' AND gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='Planner');end
UPDATE gibbonAction SET URLList='planner.php, planner_view_full.php, planner_add.php, planner_edit.php, planner_delete.php, planner_deadlines.php, planner_duplicate.php, planner_view_full_post.php, planner_view_full_submit_edit.php, planner_bump.php, planner_unitOverview.php' WHERE name='Lesson Planner_viewAllEditMyClasses' AND gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='Planner');end
UPDATE gibbonAction SET URLList='planner.php, planner_view_full.php, planner_deadlines.php, planner_view_full_post.php, planner_unitOverview.php' WHERE name='Lesson Planner_viewMyClasses' AND gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='Planner');end
UPDATE gibbonAction SET URLList='planner.php, planner_view_full.php, planner_add.php, planner_edit.php, planner_delete.php, planner_deadlines.php, planner_duplicate.php, planner_view_full_post.php, planner_view_full_submit_edit.php, planner_bump.php, planner_unitOverview.php' WHERE name='Lesson Planner_viewEditAllClasses' AND gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='Planner');end
INSERT INTO `gibbonAction` (`gibbonActionID`, `gibbonModuleID`, `name`, `precedence`, `category`, `description`, `URLList`, `entryURL`, `entrySidebar`, `defaultPermissionAdmin`, `defaultPermissionTeacher`, `defaultPermissionStudent`, `defaultPermissionParent`, `defaultPermissionSupport`, `categoryPermissionStaff`, `categoryPermissionStudent`, `categoryPermissionParent`, `categoryPermissionOther`) VALUES (NULL, (SELECT gibbonModuleID FROM gibbonModule WHERE name='Library'), 'Import Records', 0, 'Catalog', 'Import records of different types (e.g. Print Publications, Computer, etc)', 'library_import.php','library_import.php', 'Y', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N');end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Library' AND gibbonAction.name='Import Records'));end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'Planner', 'parentWeeklyEmailSummaryIncludeBehaviour', 'Parent Weekly Email Summary Include Behaviour', 'Should behaviour information be included in the weekly planner email summary that goes out to parents?', 'Y');end
INSERT INTO `gibbonLibraryType` (`gibbonLibraryTypeID`, `name`, `active`, `fields`) VALUES (NULL, 'Software', 'Y', 'a:7:{i:0;a:6:{s:4:\"name\";s:7:\"Version\";s:11:\"description\";s:0:\"\";s:4:\"type\";s:4:\"Text\";s:7:\"options\";s:2:\"50\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}i:1;a:6:{s:4:\"name\";s:16:\"Operating System\";s:11:\"description\";s:0:\"\";s:4:\"type\";s:4:\"Text\";s:7:\"options\";s:2:\"50\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}i:2;a:6:{s:4:\"name\";s:12:\"License Type\";s:11:\"description\";s:48:\"E.g. Open Source, Site License, number of users.\";s:4:\"type\";s:4:\"Text\";s:7:\"options\";s:3:\"255\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}i:3;a:6:{s:4:\"name\";s:12:\"License Name\";s:11:\"description\";s:55:\"If the software is registered, who is it registered to?\";s:4:\"type\";s:4:\"Text\";s:7:\"options\";s:3:\"255\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}i:4;a:6:{s:4:\"name\";s:21:\"License Serial Number\";s:11:\"description\";s:0:\"\";s:4:\"type\";s:4:\"Text\";s:7:\"options\";s:3:\"255\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}i:5;a:6:{s:4:\"name\";s:14:\"License Expiry\";s:11:\"description\";s:19:\"Format: dd/mm/yyyy.\";s:4:\"type\";s:4:\"Date\";s:7:\"options\";s:0:\"\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}i:6;a:6:{s:4:\"name\";s:23:\"License Management Link\";s:11:\"description\";s:34:\"Link to web-based management tool.\";s:4:\"type\";s:3:\"URL\";s:7:\"options\";s:3:\"255\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}}');end
UPDATE gibbonModule SET category='Assess' WHERE category='Assessment';end
UPDATE gibbonModule SET category='Learn' WHERE category='Learning';end
ALTER TABLE `gibbonUnitBlock` ADD `gibbonOutcomeIDList` TEXT NOT NULL ;end
ALTER TABLE `gibboni18n` ADD `rtl` ENUM('Y','N') NOT NULL DEFAULT 'N' ;end
ALTER TABLE `gibboni18n` CHANGE `name` `name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;end
INSERT INTO `gibboni18n` (`gibboni18nID`, `code`, `name`, `active`, `systemDefault`, `maintainerName`, `maintainerWebsite`, `dateFormat`, `dateFormatRegEx`, `dateFormatPHP`, `rtl`) VALUES (NULL, 'ar_SA', 'Arabic (العربية) - Saudi Arabia (المملكة العربية السعودية)', 'N', 'N', 'Abdul Rahman Yousef', '', 'dd/mm/yyyy', '/^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\\\d\\\d$/i', 'd/m/Y', 'Y');end
UPDATE `gibboni18n` SET `name` = 'العربية - المملكة العربية السعودية' WHERE `code`='ar_SA';end
ALTER TABLE `gibbonUnitClassBlock` ADD `gibbonOutcomeIDList` TEXT NOT NULL ;end
INSERT INTO `gibbonAction` (`gibbonActionID`, `gibbonModuleID`, `name`, `precedence`, `category`, `description`, `URLList`, `entryURL`, `entrySidebar`, `defaultPermissionAdmin`, `defaultPermissionTeacher`, `defaultPermissionStudent`, `defaultPermissionParent`, `defaultPermissionSupport`, `categoryPermissionStaff`, `categoryPermissionStudent`, `categoryPermissionParent`, `categoryPermissionOther`) VALUES (NULL, (SELECT gibbonModuleID FROM gibbonModule WHERE name='Planner'), 'Outcomes By Course', 0, 'Curriculum Mapping', 'This view gives an overview of which whole school and learning area outcomes are covered by classes in a given course, allowing for curriculum mapping by outcome and course.', 'curriculumMapping_outcomesByCourse.php','curriculumMapping_outcomesByCourse.php', 'Y', 'Y', 'N', 'N', 'N', 'N', 'Y', 'Y', 'Y', 'N');end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Planner' AND gibbonAction.name='Outcomes By Course'));end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '2', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Planner' AND gibbonAction.name='Outcomes By Course'));end
UPDATE gibbonAction SET name='Manage Finance Settings', gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='School Admin'), category='Other' WHERE name='Invoice & Receipt Settings' AND gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='Finance');end
UPDATE gibbonAction SET URLList='financeSettings.php', entryURL='financeSettings.php' WHERE name='Manage Finance Settings' AND gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='School Admin');end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'Finance', 'financeOnlinePaymentEnabled', 'Enable Online Payment', 'Should invoices be payable online, via an encrypted link in the invoice? Requires correctly configured payment gateway in System Settings.', 'N');end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'Finance', 'financeOnlinePaymentThreshold', 'Online Payment Threshold', 'If invoices are payable online, what is the maximum payment allowed? Useful for controlling payment fees. No value means unlimited.', '');end
ALTER TABLE `gibbonFinanceInvoice` ADD `key` VARCHAR(40) NOT NULL AFTER `notes`;end
ALTER TABLE `gibbonFinanceInvoice` ADD `gibbonPaymentID` INT(14) UNSIGNED ZEROFILL NULL DEFAULT NULL AFTER `paidAmount`;end
";

//v9.0.00
$count++ ;
$sql[$count][0]="9.0.00" ;
$sql[$count][1]="
UPDATE gibboni18n SET maintainerName='Guillermo Bautista Fuerte', maintainerWebsite='' WHERE code='es_ES';end
ALTER TABLE `gibbonStudentNote` ADD `title` VARCHAR(50) NOT NULL AFTER `gibbonStudentNoteCategoryID`;end
INSERT INTO `gibboni18n` (`code`, `name`, `active`, `systemDefault`, `maintainerName`, `maintainerWebsite`, `dateFormat`, `dateFormatRegEx`, `dateFormatPHP`) VALUES ('fr_FR', 'Français - France', 'N', 'N', 'Jean-Baptiste Tamegnon', '', 'dd/mm/yyyy', '/^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\\\d\\\d$/i', 'd/m/Y');end
ALTER TABLE `gibbonExternalAssessment` ADD `allowFileUpload` ENUM('Y','N') NOT NULL DEFAULT 'N' ;end
ALTER TABLE `gibbonExternalAssessmentStudent` ADD `attachment` VARCHAR(255) NOT NULL ;end
ALTER TABLE `gibbonStudentEnrolment` ADD `rollOrder` INT(2) NULL DEFAULT NULL ;end
ALTER TABLE `gibbonMarkbookColumn` CHANGE `description` `description` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;end
DELETE FROM gibbonTheme WHERE name='Default' OR name='Olden';end
INSERT INTO `gibbonTheme` (`gibbonThemeID` ,`name` ,`description` ,`active` ,`version` ,`author` ,`url`)VALUES (NULL , 'Default', 'Gibbon\'s 2015 look and feel.', 'Y', '1.0.00', 'Ross Parker', 'http://rossparker.org');end
UPDATE gibbonSetting SET description='Relative path to site logo (400 x 100px)' WHERE scope='System' AND name='organisationLogo' ;end
DELETE FROM gibbonTheme WHERE NOT name='Default';end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'Departments', 'makeDepartmentsPublic', 'Make Departments Public', 'Should department information be made available to the public, via the Gibbon homeoage?', 'N');end
ALTER TABLE `gibbonFamilyUpdate` ADD `gibbonSchoolYearID` INT(3) UNSIGNED ZEROFILL NULL DEFAULT NULL AFTER `gibbonFamilyUpdateID`;end
ALTER TABLE `gibbonFinanceInvoiceeUpdate` ADD `gibbonSchoolYearID` INT(3) UNSIGNED ZEROFILL NULL DEFAULT NULL AFTER `gibbonFinanceInvoiceeUpdateID`;end
ALTER TABLE `gibbonPersonMedicalUpdate` ADD `gibbonSchoolYearID` INT(3) UNSIGNED ZEROFILL NULL DEFAULT NULL AFTER `gibbonPersonMedicalUpdateID`;end
ALTER TABLE `gibbonPersonUpdate` ADD `gibbonSchoolYearID` INT(3) UNSIGNED ZEROFILL NULL DEFAULT NULL AFTER `gibbonPersonUpdateID`;end
UPDATE gibbonFamilyUpdate SET gibbonSchoolYearID=(SELECT gibbonSchoolYearID FROM gibbonSchoolYear WHERE status='Current') WHERE timestamp>='2014-07-01 00:00:00';end
UPDATE gibbonFamilyUpdate SET gibbonSchoolYearID=(SELECT gibbonSchoolYearID FROM gibbonSchoolYear WHERE status='Past' ORDER BY sequenceNumber DESC LIMIT 0,1) WHERE timestamp<'2014-07-01 00:00:00';end
UPDATE gibbonFinanceInvoiceeUpdate SET gibbonSchoolYearID=(SELECT gibbonSchoolYearID FROM gibbonSchoolYear WHERE status='Current') WHERE timestamp>='2014-07-01 00:00:00';end
UPDATE gibbonFinanceInvoiceeUpdate SET gibbonSchoolYearID=(SELECT gibbonSchoolYearID FROM gibbonSchoolYear WHERE status='Past' ORDER BY sequenceNumber DESC LIMIT 0,1) WHERE timestamp<'2014-07-01 00:00:00';end
UPDATE gibbonPersonMedicalUpdate SET gibbonSchoolYearID=(SELECT gibbonSchoolYearID FROM gibbonSchoolYear WHERE status='Current') WHERE timestamp>='2014-07-01 00:00:00';end
UPDATE gibbonPersonMedicalUpdate SET gibbonSchoolYearID=(SELECT gibbonSchoolYearID FROM gibbonSchoolYear WHERE status='Past' ORDER BY sequenceNumber DESC LIMIT 0,1) WHERE timestamp<'2014-07-01 00:00:00';end
UPDATE gibbonPersonUpdate SET gibbonSchoolYearID=(SELECT gibbonSchoolYearID FROM gibbonSchoolYear WHERE status='Current') WHERE timestamp>='2014-07-01 00:00:00';end
UPDATE gibbonPersonUpdate SET gibbonSchoolYearID=(SELECT gibbonSchoolYearID FROM gibbonSchoolYear WHERE status='Past' ORDER BY sequenceNumber DESC LIMIT 0,1) WHERE timestamp<'2014-07-01 00:00:00';end
UPDATE gibbonPerson SET calendarFeedPersonal='';end
UPDATE gibbonSetting SET scope='System' WHERE name LIKE 'google%';end
UPDATE gibbonSetting SET nameDisplay='Google Integration', description='Enable Gibbon-wide integration with the Google APIs?' WHERE name='googleOAuth' AND scope='System';end
UPDATE gibbonSetting SET nameDisplay='School Google Calendar ID', description='Google Calendar ID for your school calendar. Only enables timetable integration when logging in via Google.' WHERE name='calendarFeed' AND scope='System';end
ALTER TABLE `gibbonPerson` CHANGE `ethnicity` `ethnicity` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;end
ALTER TABLE `gibbonPersonUpdate` CHANGE `ethnicity` `ethnicity` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;end
ALTER TABLE `gibbonPerson` ADD `nationalIDCardScan` VARCHAR(255) NOT NULL AFTER `nationalIDCardNumber`;end
ALTER TABLE `gibbonPerson` ADD `citizenship1PassportScan` VARCHAR(255) NOT NULL AFTER `citizenship1Passport`;end
ALTER TABLE `gibbonPerson` ADD `googleAPIRefreshToken` VARCHAR(255) NOT NULL ;end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'System', 'sessionDuration', 'Session Duration', 'Time, in seconds, before system logs a user out. Should be less than PHP\'s session.gc_maxlifetime option.', '1200');end
UPDATE gibbonSetting SET value='themes/Default/img/logo.png' WHERE value='themes/Default/img/logo.jpg' AND scope='System' AND name='organisationLogo';end
ALTER TABLE `gibbonPerson` ADD `receiveNoticiationEmails` ENUM('N','Y') NOT NULL DEFAULT 'N' ;end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'Planner', 'makeUnitsPublic', 'Make Units Public', 'Enables a public listing of units, with teachers able to opt in to share units.', 'N');end
ALTER TABLE `gibbonUnit` ADD `license` VARCHAR(50) NULL DEFAULT NULL AFTER `embeddable`, ADD `sharedPublic` ENUM('Y','N') NULL DEFAULT NULL AFTER `license`;end
UPDATE gibboni18n SET maintainerName='Jasmine Chan & Charlie Chow' WHERE code='zh_HK';end
ALTER TABLE `gibbonHook` CHANGE `type` `type` ENUM('Public Home Page','Student Profile','Unit') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;end
UPDATE gibboni18n SET maintainerName='Dicky Widhyatmoko' WHERE code='id_ID';end
ALTER TABLE gibbonSetting DROP INDEX name;end
ALTER TABLE gibbonSetting DROP INDEX nameDisplay;end
ALTER TABLE gibbonSetting ADD UNIQUE (scope, nameDisplay) COMMENT '';end
ALTER TABLE gibbonSetting ADD UNIQUE (scope,name) COMMENT '';end
ALTER TABLE `gibbonModule` CHANGE `description` `description` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;end
UPDATE gibbonSetting SET value='strong,em,span,p,address,pre,h1,h2,h3,h4,h5,h6,table,thead,tbody,tfoot,tr,td,ol,ul,li,blockquote,a,img,video,source,hr,iframe,embed' WHERE name='allowableHTML' AND scope='System';end
UPDATE gibbonSetting SET value='br,strong[*],em[*],span[*],p[*],address[*],pre[*],h1[*],h2[*],h3[*],h4[*],h5[*],h6[*],table[*],thead[*],tbody[*],tfoot[*],tr[*],td[*],ol[*],ul[*],li[*],blockquote[*],a[*],img[*],video[*],source[*],hr[*],iframe[*],embed[*]' WHERE name='allowableHTML' AND scope='System';end
UPDATE gibboni18n SET active='Y' WHERE code='zh_HK';end
";

//v9.1.00
$count++ ;
$sql[$count][0]="9.1.00" ;
$sql[$count][1]="
ALTER TABLE `gibbonLibraryItem` ADD `replacementCost` DECIMAL(10,2) NULL DEFAULT NULL AFTER `gibbonDepartmentID`, ADD `gibbonSchoolYearIDReplacement` INT(3) UNSIGNED ZEROFILL NULL DEFAULT NULL AFTER `replacementCost`;end
UPDATE gibbonAction SET name='Manage Messenger Settings', URLList='messengerSettings.php', entryURL='messengerSettings.php' WHERE name='Manage SMS Settings' AND gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='School Admin');end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'Messenger', 'messageBubbleWidthType', 'Message Bubble Width Type', 'Should the message bubble be regular or wide?', 'Regular');end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'Messenger', 'messageBubbleBGColor', 'Message Bubble Background Color', 'Message bubble background color in RGBA (e.g. 100,100,100,0.50). If blank, theme default will be used.', '');end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'Messenger', 'messageBubbleAutoHide', 'Message Bubble Auto Hide', 'Should message bubble fade out automatically?', 'Y');end
INSERT INTO `gibbonAction` (`gibbonActionID`, `gibbonModuleID`, `name`, `precedence`, `category`, `description`, `URLList`, `entryURL`, `entrySidebar`, `defaultPermissionAdmin`, `defaultPermissionTeacher`, `defaultPermissionStudent`, `defaultPermissionParent`, `defaultPermissionSupport`, `categoryPermissionStaff`, `categoryPermissionStudent`, `categoryPermissionParent`, `categoryPermissionOther`) VALUES (NULL, (SELECT gibbonModuleID FROM gibbonModule WHERE name='Messenger'), 'New Quick Wall Message', 0, '', 'Allows for the quick posting of a Message Wall message to all users.', 'messenger_postQuickWall.php','messenger_postQuickWall.php', 'Y', 'Y', 'Y', 'N', 'N', 'Y', 'Y', 'Y', 'Y', 'N');end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Messenger' AND gibbonAction.name='New Quick Wall Message'));end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '2', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Messenger' AND gibbonAction.name='New Quick Wall Message'));end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '6', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Messenger' AND gibbonAction.name='New Quick Wall Message'));end
UPDATE gibbonAction SET category='Curriculum Mapping' WHERE name LIKE 'Manage Outcomes%' AND gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='Planner');end
INSERT INTO `gibbonAction` (`gibbonActionID`, `gibbonModuleID`, `name`, `precedence`, `category`, `description`, `URLList`, `entryURL`, `entrySidebar`, `defaultPermissionAdmin`, `defaultPermissionTeacher`, `defaultPermissionStudent`, `defaultPermissionParent`, `defaultPermissionSupport`, `categoryPermissionStaff`, `categoryPermissionStudent`, `categoryPermissionParent`, `categoryPermissionOther`) VALUES (NULL, (SELECT gibbonModuleID FROM gibbonModule WHERE name='Planner'), 'Import Outcomes', 0, 'Curriculum Mapping', 'Allows a user to import outcomes into the system, based on their Manage Outcomes rights.', 'outcomes_import.php','outcomes_import.php', 'Y', 'Y', 'Y', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N');end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Planner' AND gibbonAction.name='Import Outcomes'));end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '2', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Planner' AND gibbonAction.name='Import Outcomes'));end
CREATE TABLE `gibbonUnitBlockStar` (`gibbonUnitBlockStarID` int(14) unsigned zerofill NOT NULL AUTO_INCREMENT,  `gibbonUnitBlockID` int(12) unsigned zerofill NOT NULL,  `gibbonPersonID` int(10) unsigned zerofill NOT NULL,    PRIMARY KEY (`gibbonUnitBlockStarID`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;end
UPDATE gibbonAction SET entrySidebar='N' WHERE name LIKE 'Manage Messages%' AND gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='Messenger');end
UPDATE gibbonPerson SET title=RTRIM(title);end
UPDATE gibbonPersonUpdate SET title=RTRIM(title);end
UPDATE gibbonApplicationForm SET parent1title=RTRIM(parent1title), parent2title=RTRIM(parent2title);end
ALTER TABLE `gibbonFamilyUpdate` ADD `languageHome` VARCHAR(30) NOT NULL AFTER `homeAddressCountry`;end
UPDATE gibbonSetting SET description='System-wde currency for financial transactions. Support for online payment in this currency depends on your credit card gateway: please consult their support documentation.' WHERE scope='System' AND name='currency';end
UPDATE gibbonLibraryType SET fields='a:17:{i:0;a:6:{s:4:\"name\";s:11:\"Form Factor\";s:11:\"description\";s:0:\"\";s:4:\"type\";s:6:\"Select\";s:7:\"options\";s:50:\"Desktop, Laptop, Tablet, Phone, Set-Top Box, Other\";s:7:\"default\";s:6:\"Laptop\";s:8:\"required\";s:1:\"Y\";}i:1;a:6:{s:4:\"name\";s:16:\"Operating System\";s:11:\"description\";s:0:\"\";s:4:\"type\";s:4:\"Text\";s:7:\"options\";s:2:\"50\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}i:2;a:6:{s:4:\"name\";s:13:\"Serial Number\";s:11:\"description\";s:0:\"\";s:4:\"type\";s:4:\"Text\";s:7:\"options\";s:2:\"50\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}i:3;a:6:{s:4:\"name\";s:10:\"Model Name\";s:11:\"description\";s:0:\"\";s:4:\"type\";s:4:\"Text\";s:7:\"options\";s:2:\"50\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}i:4;a:6:{s:4:\"name\";s:8:\"Model ID\";s:11:\"description\";s:0:\"\";s:4:\"type\";s:4:\"Text\";s:7:\"options\";s:2:\"50\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}i:5;a:6:{s:4:\"name\";s:8:\"CPU Type\";s:11:\"description\";s:0:\"\";s:4:\"type\";s:4:\"Text\";s:7:\"options\";s:2:\"50\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}i:6;a:6:{s:4:\"name\";s:9:\"CPU Speed\";s:11:\"description\";s:7:\"In GHz.\";s:4:\"type\";s:4:\"Text\";s:7:\"options\";s:1:\"6\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}i:7;a:6:{s:4:\"name\";s:6:\"Memory\";s:11:\"description\";s:17:\"Total RAM, in GB.\";s:4:\"type\";s:4:\"Text\";s:7:\"options\";s:1:\"6\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}i:8;a:6:{s:4:\"name\";s:12:\"Storage Type\";s:11:\"description\";s:30:\"Primary internal storage type.\";s:4:\"type\";s:6:\"Select\";s:7:\"options\";s:24:\",HDD, SSD, Hybrid, Other\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}i:9;a:6:{s:4:\"name\";s:7:\"Storage\";s:11:\"description\";s:30:\"Total HDD/SDD capacity, in GB.\";s:4:\"type\";s:4:\"Text\";s:7:\"options\";s:1:\"6\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}i:10;a:6:{s:4:\"name\";s:20:\"Wireless MAC Address\";s:11:\"description\";s:0:\"\";s:4:\"type\";s:4:\"Text\";s:7:\"options\";s:2:\"17\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}i:11;a:6:{s:4:\"name\";s:17:\"Wired MAC Address\";s:11:\"description\";s:0:\"\";s:4:\"type\";s:4:\"Text\";s:7:\"options\";s:2:\"17\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}i:12;a:6:{s:4:\"name\";s:11:\"Accessories\";s:11:\"description\";s:43:\"Any chargers, display dongles, remotes etc?\";s:4:\"type\";s:4:\"Text\";s:7:\"options\";s:3:\"255\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}i:13;a:6:{s:4:\"name\";s:15:\"Warranty Number\";s:11:\"description\";s:0:\"\";s:4:\"type\";s:4:\"Text\";s:7:\"options\";s:2:\"50\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}i:14;a:6:{s:4:\"name\";s:15:\"Warranty Expiry\";s:11:\"description\";s:19:\"Format: dd/mm/yyyy.\";s:4:\"type\";s:4:\"Date\";s:7:\"options\";s:0:\"\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}i:15;a:6:{s:4:\"name\";s:19:\"Last Reinstall Date\";s:11:\"description\";s:19:\"Format: dd/mm/yyyy.\";s:4:\"type\";s:4:\"Date\";s:7:\"options\";s:0:\"\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}i:16;a:6:{s:4:\"name\";s:16:\"Repair Log/Notes\";s:11:\"description\";s:0:\"\";s:4:\"type\";s:8:\"Textarea\";s:7:\"options\";s:2:\"10\";s:7:\"default\";s:0:\"\";s:8:\"required\";s:1:\"N\";}}' WHERE name='Computer';end
UPDATE gibboni18n SET active='Y' WHERE code='fr_FR';end
";

//v9.2.00
$count++ ;
$sql[$count][0]="9.2.00" ;
$sql[$count][1]="
INSERT INTO `gibboni18n` (`code`, `name`, `active`, `systemDefault`, `maintainerName`, `maintainerWebsite`, `dateFormat`, `dateFormatRegEx`, `dateFormatPHP`,`rtl`) VALUES ('ur_IN', 'اُردُو', 'N', 'N', 'Rizwan Mohammad', '', 'dd/mm/yyyy', '/^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\\\d\\\d$/i', 'd/m/Y', 'Y');end
INSERT INTO `gibbonAction` (`gibbonModuleID` ,`name` ,`precedence` ,`category` ,`description` ,`URLList` ,`entryURL` ,`defaultPermissionAdmin` ,`defaultPermissionTeacher` ,`defaultPermissionStudent` ,`defaultPermissionParent` ,`defaultPermissionSupport` ,`categoryPermissionStaff` ,`categoryPermissionStudent` ,`categoryPermissionParent` ,`categoryPermissionOther`) VALUES ((SELECT gibbonModuleID FROM gibbonModule WHERE name='Messenger'), 'New Message_transport_any', 0, '', 'Send messages users by transport field.', 'messenger_post.php', 'messenger_post.php', 'Y', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N');end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Messenger' AND gibbonAction.name='New Message_transport_any'));end
INSERT INTO `gibbonAction` (`gibbonModuleID` ,`name` ,`precedence` ,`category` ,`description` ,`URLList` ,`entryURL` ,`defaultPermissionAdmin` ,`defaultPermissionTeacher` ,`defaultPermissionStudent` ,`defaultPermissionParent` ,`defaultPermissionSupport` ,`categoryPermissionStaff` ,`categoryPermissionStudent` ,`categoryPermissionParent` ,`categoryPermissionOther`) VALUES ((SELECT gibbonModuleID FROM gibbonModule WHERE name='Messenger'), 'New Message_transport_parents', 0, '', 'Send messages parents of users by transport field.', 'messenger_post.php', 'messenger_post.php', 'Y', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N');end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Messenger' AND gibbonAction.name='New Message_transport_parents'));end
ALTER TABLE `gibbonMessengerTarget` CHANGE `type` `type` ENUM('Class','Course','Roll Group','Year Group','Activity','Role','Applicants','Individuals','Houses','Role Category','Transport') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;end
ALTER TABLE `gibbonPerson` ADD `transportNotes` TEXT NOT NULL AFTER `transport`;end
UPDATE gibbonAction SET URLList='units.php, units_add.php, units_delete.php, units_edit.php, units_duplicate.php, units_edit_deploy.php, units_edit_working.php, units_edit_working_copyback.php, units_edit_working_add.php, units_edit_copyBack.php, units_edit_copyForward.php, units_dump.php,units_edit_smartBlockify.php' WHERE name LIKE 'Manage Units%' AND gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='Planner');end
UPDATE gibbonAction SET category='Individual Needs' WHERE gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='Individual Needs') AND name LIKE 'Individual Needs Records%';end
UPDATE gibbonAction SET category='Individual Needs' WHERE gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='Individual Needs') AND name='Individual Needs Summary';end
INSERT INTO `gibbonAction` (`gibbonModuleID` ,`name` ,`precedence` ,`category` ,`description` ,`URLList` ,`entryURL` ,`defaultPermissionAdmin` ,`defaultPermissionTeacher` ,`defaultPermissionStudent` ,`defaultPermissionParent` ,`defaultPermissionSupport` ,`categoryPermissionStaff` ,`categoryPermissionStudent` ,`categoryPermissionParent` ,`categoryPermissionOther`) VALUES ((SELECT gibbonModuleID FROM gibbonModule WHERE name='Individual Needs'), 'Archive Records', 0, 'Other', 'Allows for current records to be archived for viewing in the future.', 'in_archive.php', 'in_archive.php', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N');end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Individual Needs' AND gibbonAction.name='Archive Records'));end
CREATE TABLE `gibbonINArchive` (`gibbonINArchiveID` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,  `gibbonPersonID` int(10) unsigned zerofill NOT NULL,  `strategies` text NOT NULL,  `targets` text NOT NULL,  `notes` text NOT NULL,  `archiveTitle` varchar(50) NOT NULL,  `archiveTimestamp` timestamp NULL DEFAULT NULL, PRIMARY KEY (`gibbonINArchiveID`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;end
ALTER TABLE `gibbonNotification` ENGINE = MyISAM;end
ALTER TABLE `gibbonUnitBlockStar` ENGINE = MyISAM;end
INSERT INTO `gibbonAction` (`gibbonModuleID` ,`name` ,`precedence` ,`category` ,`description` ,`URLList` ,`entryURL` ,`defaultPermissionAdmin` ,`defaultPermissionTeacher` ,`defaultPermissionStudent` ,`defaultPermissionParent` ,`defaultPermissionSupport` ,`categoryPermissionStaff` ,`categoryPermissionStudent` ,`categoryPermissionParent` ,`categoryPermissionOther`) VALUES ((SELECT gibbonModuleID FROM gibbonModule WHERE name='Timetable'), 'View Timetable by Person_allYears', 0, 'View Timetables', 'Allows users to view timetables in all school years.', 'tt.php, tt_view.php', 'tt.php', 'Y', 'N', 'N', 'N', 'N', 'Y', 'Y', 'Y', 'N');end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Timetable' AND gibbonAction.name='View Timetable by Person_allYears'));end
ALTER TABLE `gibbonRole` ADD `nonCurrentYearLogin` ENUM('Y','N') NOT NULL DEFAULT 'Y' ;end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'Students', 'enableStudentNotes', 'Enable Student Notes', 'Should student notes be turned on?', 'Y');end
ALTER TABLE `gibbonBehaviour` ADD `followup` TEXT NOT NULL AFTER `comment`;end
CREATE TABLE `gibbonFinanceBudget` (  `gibbonFinanceBudgetID` int(4) unsigned zerofill NOT NULL,  `name` varchar(30) NOT NULL,  `nameShort` varchar(8) NOT NULL,  `active` enum('Y','N') NOT NULL DEFAULT 'Y',  `category` varchar(255) NOT NULL,  `gibbonPersonIDCreator` int(10) unsigned zerofill NOT NULL,  `timestampCreator` timestamp NULL DEFAULT NULL,  `gibbonPersonIDUpdate` int(10) unsigned zerofill DEFAULT NULL,  `timestampUpdate` timestamp NULL DEFAULT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8;end
ALTER TABLE `gibbonFinanceBudget` ADD PRIMARY KEY (`gibbonFinanceBudgetID`), ADD UNIQUE KEY `name` (`name`), ADD UNIQUE KEY `nameShort` (`nameShort`);end
ALTER TABLE `gibbonFinanceBudget` MODIFY `gibbonFinanceBudgetID` int(4) unsigned zerofill NOT NULL AUTO_INCREMENT;end
CREATE TABLE `gibbonFinanceBudgetPerson` (  `gibbonFinanceBudgetPersonID` int(8) unsigned zerofill NOT NULL,  `gibbonFinanceBudgetID` int(4) unsigned zerofill NOT NULL,  `gibbonPersonID` int(10) unsigned zerofill NOT NULL,  `access` enum('Full','Write','Read') NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8;end
ALTER TABLE `gibbonFinanceBudgetPerson` ADD PRIMARY KEY `gibbonFinanceBudgetPersonID` (`gibbonFinanceBudgetPersonID`);end
ALTER TABLE `gibbonFinanceBudgetPerson` MODIFY `gibbonFinanceBudgetPersonID` int(8) unsigned zerofill NOT NULL AUTO_INCREMENT;end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'Finance', 'budgetCategories', 'Budget Categories', 'Comma-separated list of budget categories.', 'Academic, Administration, Capital');end
UPDATE gibbonAction SET categoryPermissionStudent='N', categoryPermissionParent='N', categoryPermissionOther='N'  WHERE name='View Behaviour Records' AND gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='Behaviour');end
UPDATE gibbonAction SET category='Billing' WHERE category='Admin' AND gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='Finance');end
INSERT INTO `gibbonAction` (`gibbonModuleID`, `name`, `precedence`, `category`, `description`, `URLList`, `entryURL`, `defaultPermissionAdmin`, `defaultPermissionTeacher`, `defaultPermissionStudent`, `defaultPermissionParent`, `defaultPermissionSupport`, `categoryPermissionStaff`, `categoryPermissionStudent`, `categoryPermissionParent`, `categoryPermissionOther`) VALUES ((SELECT gibbonModuleID FROM gibbonModule WHERE name='Finance'), 'Manage Budgets', 0, 'Expenses', 'Allows users to create, edit and delete budgets.', 'budgets_manage.php,budgets_manage_add.php,budgets_manage_edit.php,budgets_manage_delete.php', 'budgets_manage.php', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N') ;end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Finance' AND gibbonAction.name='Manage Budgets'));end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'Finance', 'budgetStartDate', 'Budget Start Date', 'Initial start date of your first budget. Will be used as start of budget each year.', '');end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'Finance', 'expenseApprovalType', 'Expense Approval Type', 'How should expense approval be dealt with?', 'One Of');end
INSERT INTO `gibbonAction` (`gibbonModuleID`, `name`, `precedence`, `category`, `description`, `URLList`, `entryURL`, `defaultPermissionAdmin`, `defaultPermissionTeacher`, `defaultPermissionStudent`, `defaultPermissionParent`, `defaultPermissionSupport`, `categoryPermissionStaff`, `categoryPermissionStudent`, `categoryPermissionParent`, `categoryPermissionOther`) VALUES ((SELECT gibbonModuleID FROM gibbonModule WHERE name='Finance'), 'Manage Expense Approvers', 0, 'Expenses', 'Determines who can approve expense requests, in accordance to the Expense Approval Type setting in School Admin.', 'expenseApprovers_manage.php,expenseApprovers_manage_add.php,expenseApprovers_manage_edit.php,expenseApprovers_manage_delete.php', 'expenseApprovers_manage.php', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N') ;end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Finance' AND gibbonAction.name='Manage Expense Approvers'));end
CREATE TABLE `gibbonFinanceExpenseApprover` (  `gibbonFinanceExpenseApproverID` int(4) unsigned zerofill NOT NULL,  `gibbonPersonID` int(10) unsigned zerofill NOT NULL, `sequenceNumber` int(4) NULL DEFAULT NULL,    `gibbonPersonIDCreator` int(10) unsigned zerofill NOT NULL,  `timestampCreator` timestamp NULL DEFAULT NULL,  `gibbonPersonIDUpdate` int(10) unsigned zerofill DEFAULT NULL,  `timestampUpdate` timestamp NULL DEFAULT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8;end
ALTER TABLE `gibbonFinanceExpenseApprover`  ADD PRIMARY KEY (`gibbonFinanceExpenseApproverID`);end
ALTER TABLE `gibbonFinanceExpenseApprover`  MODIFY `gibbonFinanceExpenseApproverID` int(4) unsigned zerofill NOT NULL AUTO_INCREMENT;end
DELETE FROM `gibbonSetting` WHERE scope='Finance' AND name='budgetStartDate';end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'Finance', 'budgetLevelExpenseApproval', 'Budget Level Expense Approval', 'Should approval from a budget member with Full access be required?', 'Y');end
CREATE TABLE `gibbonSchoolYear` (  `gibbonSchoolYearID` int(6) unsigned zerofill NOT NULL,  `name` varchar(7) NOT NULL,   `status` ENUM('Past','Current','Upcoming') NOT NULL DEFAULT 'Upcoming', `dateStart` date NOT NULL,  `dateEnd` date NOT NULL,  `sequenceNumber` int(6) NOT NULL,  `gibbonPersonIDCreator` int(10) unsigned zerofill NOT NULL,  `timestampCreator` timestamp NULL DEFAULT NULL,  `gibbonPersonIDUpdate` int(10) unsigned zerofill DEFAULT NULL,  `timestampUpdate` timestamp NULL DEFAULT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8;end
ALTER TABLE `gibbonSchoolYear`  ADD PRIMARY KEY (`gibbonSchoolYearID`),  ADD UNIQUE KEY `name` (`name`);end
ALTER TABLE `gibbonSchoolYear`  MODIFY `gibbonSchoolYearID` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT;end
INSERT INTO `gibbonAction` (`gibbonModuleID`, `name`, `precedence`, `category`, `description`, `URLList`, `entryURL`, `defaultPermissionAdmin`, `defaultPermissionTeacher`, `defaultPermissionStudent`, `defaultPermissionParent`, `defaultPermissionSupport`, `categoryPermissionStaff`, `categoryPermissionStudent`, `categoryPermissionParent`, `categoryPermissionOther`) VALUES ((SELECT gibbonModuleID FROM gibbonModule WHERE name='Finance'), 'Manage Budget Cycles', 0, 'Expenses', 'Allows a sufficiently priviledged user to create and manage budget cycles.', 'budgetCycles_manage.php,budgetCycles_manage_add.php,budgetCycles_manage_edit.php,budgetCycles_manage_delete.php', 'budgetCycles_manage.php', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N') ;end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Finance' AND gibbonAction.name='Manage Budget Cycles'));end
INSERT INTO `gibbonAction` (`gibbonModuleID`, `name`, `precedence`, `category`, `description`, `URLList`, `entryURL`, `defaultPermissionAdmin`, `defaultPermissionTeacher`, `defaultPermissionStudent`, `defaultPermissionParent`, `defaultPermissionSupport`, `categoryPermissionStaff`, `categoryPermissionStudent`, `categoryPermissionParent`, `categoryPermissionOther`) VALUES ((SELECT gibbonModuleID FROM gibbonModule WHERE name='Finance'), 'Manage My Expense Requests', 0, 'Expenses', 'Allows a user to request expenses from budgets they have access to.', 'expenseRequest_manage.php,expenseRequest_manage_add.php,expenseRequest_manage_view.php', 'expenseRequest_manage.php', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N') ;end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Finance' AND gibbonAction.name='Manage My Expense Requests'));end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '2', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Finance' AND gibbonAction.name='Manage My Expense Requests'));end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '6', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Finance' AND gibbonAction.name='Manage My Expense Requests'));end
CREATE TABLE `gibbonFinanceExpense` (  `gibbonFinanceExpenseID` int(14) unsigned zerofill NOT NULL,  `gibbonFinanceBudgetID` int(4) unsigned zerofill NOT NULL,  `gibbonSchoolYearID` int(6) unsigned zerofill NOT NULL,  `title` varchar(60) NOT NULL,  `body` text NOT NULL,  `status` enum('Requested','Approved','Rejected','Cancelled','Ordered','Paid') NOT NULL,  `cost` decimal(12,2) NOT NULL,  `gibbonPersonIDCreator` int(10) unsigned zerofill NOT NULL,  `timestampCreator` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) ENGINE=MyISAM DEFAULT CHARSET=utf8;end
ALTER TABLE `gibbonFinanceExpense` ADD PRIMARY KEY (`gibbonFinanceExpenseID`);end
ALTER TABLE `gibbonFinanceExpense` MODIFY `gibbonFinanceExpenseID` int(14) unsigned zerofill NOT NULL AUTO_INCREMENT;end
CREATE TABLE `gibbonFinanceExpenseLog` (  `gibbonFinanceExpenseLogID` int(16) unsigned zerofill NOT NULL,  `gibbonFinanceExpenseID` int(14) unsigned zerofill NOT NULL,  `gibbonPersonID` int(10) unsigned zerofill NOT NULL,  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  `status` enum('Request','Approval - Partial - Budget','Approval - Partial - School','Approval - Final','Rejection','Cancellation','Order','Payment') NOT NULL,  `comment` text NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8;end
ALTER TABLE `gibbonFinanceExpenseLog`  ADD PRIMARY KEY (`gibbonFinanceExpenseLogID`);end
ALTER TABLE `gibbonFinanceExpenseLog` MODIFY `gibbonFinanceExpenseLogID` int(16) unsigned zerofill NOT NULL AUTO_INCREMENT;end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'Finance', 'expenseRequestTemplate', 'Expense Request Template', 'An HTML template to be used in the description field of expense requests.', '');end
ALTER TABLE `gibbonFinanceExpenseLog` CHANGE `status` `action` ENUM('Request','Approval - Partial','Approval - Final','Rejection','Cancellation','Order','Payment') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;end
ALTER TABLE `gibbonFinanceExpense` ADD `purchaseBy` ENUM('School','Self') NOT NULL DEFAULT 'School' AFTER `cost`, ADD `purchaseDetails` TEXT NOT NULL AFTER `purchaseBy`;end
INSERT INTO `gibbonAction` (`gibbonModuleID`, `name`, `precedence`, `category`, `description`, `URLList`, `entryURL`, `defaultPermissionAdmin`, `defaultPermissionTeacher`, `defaultPermissionStudent`, `defaultPermissionParent`, `defaultPermissionSupport`, `categoryPermissionStaff`, `categoryPermissionStudent`, `categoryPermissionParent`, `categoryPermissionOther`) VALUES ((SELECT gibbonModuleID FROM gibbonModule WHERE name='Finance'), 'Manage Expenses_all', 0, 'Expenses', 'Gives access to full control all expenses across all budgets.', 'expenses_manage.php, expenses_manage_add.php, expenses_manage_edit.php, expenses_manage_delete.php, expenses_manage_approve.php, expenses_manage_view.php', 'expenses_manage.php', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N') ;end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Finance' AND gibbonAction.name='Manage Expenses_all'));end
INSERT INTO `gibbonAction` (`gibbonModuleID`, `name`, `precedence`, `category`, `description`, `URLList`, `entryURL`, `defaultPermissionAdmin`, `defaultPermissionTeacher`, `defaultPermissionStudent`, `defaultPermissionParent`, `defaultPermissionSupport`, `categoryPermissionStaff`, `categoryPermissionStudent`, `categoryPermissionParent`, `categoryPermissionOther`) VALUES ((SELECT gibbonModuleID FROM gibbonModule WHERE name='Finance'), 'Manage Expenses_myBudgets', 0, 'Expenses', 'Gives access to control expenses, according to budget-level access rights.', 'expenses_manage.php, expenses_manage_edit.php, expenses_manage_delete.php, expenses_manage_approve.php, expenses_manage_view.php', 'expenses_manage.php', 'N', 'Y', 'N', 'N', 'Y', 'Y', 'N', 'N', 'N') ;end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '2', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Finance' AND gibbonAction.name='Manage Expenses_myBudgets'));end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '6', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Finance' AND gibbonAction.name='Manage Expenses_myBudgets'));end
ALTER TABLE `gibbonFinanceExpense` ADD `statusApprovalBudgetCleared` ENUM('N','Y') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'N';end
UPDATE gibbonAction SET name='My Expense Requests' WHERE name='Manage My Expense Requests' AND gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='Finance');end
CREATE TABLE `gibbonFinanceBudgetCycleAllocation` (  `gibbonFinanceBudgetCycleAllocationID` int(10) unsigned zerofill NOT NULL,  `gibbonFinanceBudgetID` int(5) unsigned zerofill NOT NULL,  `gibbonFinanceBudgetCycleID` int(6) unsigned zerofill NOT NULL,  `value` decimal(14,2) NOT NULL DEFAULT '0.00') ENGINE=InnoDB DEFAULT CHARSET=utf8;end
ALTER TABLE `gibbonFinanceBudgetCycleAllocation`  ADD PRIMARY KEY (`gibbonFinanceBudgetCycleAllocationID`);end
ALTER TABLE `gibbonFinanceBudgetCycleAllocation` MODIFY `gibbonFinanceBudgetCycleAllocationID` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT;end
UPDATE gibbonAction SET URLList='expenses_manage.php, expenses_manage_add.php, expenses_manage_edit.php, expenses_manage_print.php, expenses_manage_approve.php, expenses_manage_view.php' WHERE name='Manage Expenses_all' AND gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='Finance');end
UPDATE gibbonAction SET URLList='expenses_manage.php, expenses_manage_edit.php, expenses_manage_print.php, expenses_manage_approve.php, expenses_manage_view.php' WHERE name='Manage Expenses_myBudgets' AND gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='Finance');end
ALTER TABLE `gibbonFinanceExpenseLog` CHANGE `action` `action` ENUM('Request','Approval - Partial - Budget','Approval - Partial - School','Approval - Final','Approval - Exempt','Rejection','Cancellation','Order','Payment') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;end
ALTER TABLE `gibbonFinanceExpense` ADD `paymentMethod` ENUM('Cash','Cheque','Credit Card','Bank Transfer','Other') NULL DEFAULT NULL AFTER `purchaseDetails`, ADD `paymentDate` DATE NULL DEFAULT NULL AFTER `paymentMethod`, ADD `paymentAmount` DECIMAL(12,2) NULL DEFAULT NULL AFTER `paymentDate`, ADD `gibbonPersonIDPayment` INT(10) UNSIGNED ZEROFILL NULL DEFAULT NULL AFTER `paymentAmount`, ADD `paymentID` VARCHAR(100) NULL DEFAULT NULL AFTER `gibbonPersonIDPayment`;end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'Finance', 'purchasingOfficer', 'Purchasing Officer', 'User responsible for purchasing for the school.', '');end
INSERT INTO `gibbonSetting` (`gibbonSystemSettingsID` ,`scope` ,`name` ,`nameDisplay` ,`description` ,`value`)VALUES (NULL , 'Finance', 'reimbursementOfficer', 'Reimbursement Officer', 'User responsible for reimbursing expenses.', '');end
UPDATE gibbonAction SET URLList='expenseRequest_manage.php,expenseRequest_manage_add.php,expenseRequest_manage_view.php,expenseRequest_manage_reimburse.php' WHERE name='My Expense Requests' AND gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE name='Finance');end
ALTER TABLE `gibbonFinanceExpense` ADD `paymentReimbursementReceipt` VARCHAR(255) NOT NULL AFTER `paymentID`, ADD `paymentReimbursementStatus` ENUM('Requested','Complete') NULL DEFAULT NULL AFTER `paymentReimbursementReceipt`;end
ALTER TABLE `gibbonFinanceExpenseLog` CHANGE `action` `action` ENUM('Request','Approval - Partial - Budget','Approval - Partial - School','Approval - Final','Approval - Exempt','Rejection','Cancellation','Order','Payment','Reimbursement Request','Reimbursement Completion') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;end
";

//v10.0.00
$count++ ;
$sql[$count][0]="10.0.00" ;
$sql[$count][1]="
ALTER TABLE `gibbonMarkbookColumn` ADD `uploadedResponse` ENUM('Y','N') NOT NULL DEFAULT 'Y' AFTER `comment`;end
ALTER TABLE `gibbonMarkbookColumn` CHANGE `gibbonScaleIDAttainment` `gibbonScaleIDAttainment` INT(5) UNSIGNED ZEROFILL NULL DEFAULT NULL, CHANGE `gibbonScaleIDEffort` `gibbonScaleIDEffort` INT(5) UNSIGNED ZEROFILL NULL DEFAULT NULL;end
ALTER TABLE `gibbonMarkbookEntry` CHANGE `attainmentDescriptor` `attainmentDescriptor` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `attainmentConcern` `attainmentConcern` ENUM('N','Y','P') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '''P'' denotes that student has exceed their personal target', CHANGE `effortDescriptor` `effortDescriptor` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `effortConcern` `effortConcern` ENUM('N','Y') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `comment` `comment` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;end
ALTER TABLE `gibbonMarkbookEntry` CHANGE `attainmentValue` `attainmentValue` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `effortValue` `effortValue` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;end


" ;

?>