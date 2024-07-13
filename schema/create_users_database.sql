DROP DATABASE IF EXISTS comicsShopUsers;

CREATE DATABASE comicsShopUsers;

USE comicsShopUsers;

CREATE TABLE userData(
	userID INT AUTO_INCREMENT,
	firstName VARCHAR(24),
	lastName VARCHAR(24),
	address VARCHAR(256),
	email VARCHAR(64),
	pwd VARCHAR(16),
	lastLogin DATE,
	PRIMARY KEY(userID)
	);

CREATE TABLE userRole(
	roleID INT AUTO_INCREMENT,
	roleName VARCHAR(16),
	description VARCHAR(128),
	PRIMARY KEY(roleID)
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
	permissionID INT,
	permissionName VARCHAR(16),
	description VARCHAR(128),
	PRIMARY KEY(permissionID)
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
