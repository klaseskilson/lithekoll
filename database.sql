-- database.sql

DROP TABLE IF EXISTS `transactions`;
DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `balance`;
DROP TABLE IF EXISTS `admin`;
DROP TABLE IF EXISTS `users`;


CREATE TABLE IF NOT EXISTS `users` (
	`uid` INT(6) NOT NULL AUTO_INCREMENT,
	`email` CHAR(255) NOT NULL,
	`fname` CHAR(60) NOT NULL,
	`sname` CHAR(100) NOT NULL,
	`password` CHAR(130) NOT NULL,
	`active` BOOL default 0,
	`hash` CHAR(10) NOT NULL,
	`udate` DATE,
	PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE IF NOT EXISTS `admin` (
	`uid` INT(6) NOT NULL,
	`privil` TINYINT(1) NOT NULL,
	PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

ALTER TABLE `admin`
	ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

CREATE TABLE IF NOT EXISTS `balance` (
	`uid` INT(6) NOT NULL,
	`amount` INT(10) DEFAULT 0,
	`period` INT(6) NOT NULL,
	PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

ALTER TABLE `balance`
	ADD CONSTRAINT `balance_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

CREATE TABLE IF NOT EXISTS `categories` (
	`uid` INT(6) default 0,
	`catid` INT(10) AUTO_INCREMENT,
	`catname` CHAR(100) NOT NULL,
	PRIMARY KEY (`uid`, `catid`),
	KEY `catid` (`catid`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

ALTER TABLE `categories`
	ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

CREATE TABLE IF NOT EXISTS `transactions` (
	`transid` INT(6) AUTO_INCREMENT,
	`uid` INT(6) NOT NULL,
	`catid` INT(6) NOT NULL,
	`description` CHAR(100) DEFAULT NULL,
	`plus` INT(10) DEFAULT 0,
	`minus` INT(10) DEFAULT 0,
	`date` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
	`location` CHAR(100) DEFAULT NULL,
	PRIMARY KEY (`uid`, `transid`, `catid`),
	KEY `transid` (`transid`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

ALTER TABLE `transactions`
	ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`),
	ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`catid`) REFERENCES `categories` (`catid`);

