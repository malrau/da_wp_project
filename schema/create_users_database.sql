DROP DATABASE IF EXISTS comicsShopUsers;

CREATE DATABASE comicsShopUsers;

USE comicsShopUsers;

CREATE TABLE userData(
	userID INT AUTO_INCREMENT,
	firstName VARCHAR(24) NOT NULL,
	lastName VARCHAR(24) NOT NULL,
	address VARCHAR(256),
	email VARCHAR(64) NOT NULL,
	pwd VARCHAR(16) NOT NULL,
	lastLogin DATE,
	PRIMARY KEY(userID),
	UNIQUE(email)
	);

CREATE TABLE userRole(
	roleID INT AUTO_INCREMENT,
	roleName ENUM('admin', 'customer') NOT NULL,
	description VARCHAR(128),
	PRIMARY KEY(roleID),
	UNIQUE(roleName),
	UNIQUE(description)
	);

CREATE TABLE establishing(
	aUser INT,
	aUserRole INT,
	dateRegistered DATE,
	PRIMARY KEY(aUser, aUserRole),
	FOREIGN KEY(aUser)
		REFERENCES userData(userID)
		ON DELETE no action
		ON UPDATE cascade,
	FOREIGN KEY(aUserRole)
		REFERENCES userRole(roleID)
		ON DELETE no action
		ON UPDATE cascade
	);

CREATE TABLE permission(
	permissionID INT AUTO_INCREMENT,
	permissionName ENUM('make_changes', 'buy') NOT NULL,
	description VARCHAR(128),
	PRIMARY KEY(permissionID),
	UNIQUE(permissionName),
	UNIQUE(description)
	);

CREATE TABLE giving(
	aUserRole INT,
	aPermission INT,
	PRIMARY KEY(aUserRole, aPermission),
	FOREIGN KEY(aUserRole)
		REFERENCES userRole(roleID)
		ON DELETE no action
		ON UPDATE cascade,
	FOREIGN KEY(aPermission)
		REFERENCES permission(permissionID)
		ON DELETE no action
		ON UPDATE cascade
	);
