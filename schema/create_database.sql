{\rtf1\ansi\ansicpg1252\cocoartf2709
\cocoatextscaling0\cocoaplatform0{\fonttbl\f0\fswiss\fcharset0 Helvetica;}
{\colortbl;\red255\green255\blue255;}
{\*\expandedcolortbl;;}
\paperw11900\paperh16840\margl1440\margr1440\vieww11520\viewh8400\viewkind0
\pard\tx720\tx1440\tx2160\tx2880\tx3600\tx4320\tx5040\tx5760\tx6480\tx7200\tx7920\tx8640\pardirnatural\partightenfactor0

\f0\fs24 \cf0 CREATE DATABASE comicsShop;\
\
USE comicsShop;\
\
CREATE TABLE comicBook(\
	cbID INT AUTO_INCREMENT,\
	description VARCHAR(512),\
	issueNumber INT,\
	coverTitle VARCHAR(64),\
	price FLOAT,\
	PRIMARY KEY(cbID)\
	);\
\
CREATE TABLE series(\
	seriesName VARCHAR(32),\
	PRIMARY KEY(seriesName)\
	);\
\
CREATE TABLE belonging(\
	comicBook INT,\
	series VARCHAR(32),\
	PRIMARY KEY(comicBook, series),\
	FOREIGN KEY(comicBook)\
		REFERENCES comicBook(cbID)\
		ON DELETE no action\
		ON UPDATE cascade,\
	FOREIGN KEY(series)\
		REFERENCES series(seriesName)\
		ON DELETE no action\
		ON UPDATE cascade\
	);\
\
CREATE TABLE editor(\
	editorName VARCHAR(64);\
	address VARCHAR(128);\
	PRIMARY KEY(editorName)\
	);\
\
CREATE TABLE publishing(\
	editor VARCHAR(64),\
	series VARCHAR(32),\
	PRIMARY KEY(editor, series),\
	FOREIGN KEY(editor)\
		REFERENCES editor(editorName)\
		ON DELETE no action\
		ON UPDATE cascade,\
	FOREIGN KEY(series)\
		REFERENCES series(seriesName)\
		ON DELETE no action\
		ON UPDATE cascade\
	);\
\
CREATE TABLE writer(\
	writerID INT AUTO_INCREMENT,\
	firstName VARCHAR(24),\
	lastName VARCHAR(24),\
	pseudonym VARCHAR(24),\
	PRIMARY KEY(writerID)\
	);\
\
\pard\tx720\tx1440\tx2160\tx2880\tx3600\tx4320\tx5040\tx5760\tx6480\tx7200\tx7920\tx8640\pardirnatural\partightenfactor0
\cf0 CREATE TABLE artist(\
	artistID INT AUTO_INCREMENT,\
	firstName VARCHAR(24),\
	lastName VARCHAR(24),\
	pseudonym VARCHAR(24),\
	PRIMARY KEY(artistID)\
	);\
\pard\tx720\tx1440\tx2160\tx2880\tx3600\tx4320\tx5040\tx5760\tx6480\tx7200\tx7920\tx8640\pardirnatural\partightenfactor0
\cf0 \
CREATE TABLE AUTHORING(\
	writer INT,\
	artist INT,\
	comicBook INT,\
	PRIMARY KEY(writer, artist, comicBook),\
	FOREIGN KEY(writer)\
		REFERENCES writer(writerID)\
		ON DELETE no action\
		ON UPDATE cascade,\
	FOREIGN KEY(artist)\
		REFERENCES artist(artistID)\
		ON DELETE no action\
		ON UPDATE cascade,\
	FOREIGN KEY(comicBook)\
		REFERENCES comicBook(cbID)\
		ON DELETE no action\
		ON UPDATE cascade\
	);\
\
CREATE TABLE transaction(\
	transactionID INT AUTO_INCREMENT,\
	PRIMARY KEY(transactionID)\
	);\
\
CREATE TABLE buying(\
	transaction INT,\
	comicBook INT,\
	buyingDate VARCHAR(64),\
	discount FLOAT,\
	PRIMARY KEY(transaction, comicBook),\
	FOREIGN KEY(transaction)\
		REFERENCES transaction(transactionID)\
		ON DELETE no action\
		ON UPDATE cascade,\
	FOREIGN KEY(comicBook)\
		REFERENCES comicBook(cbID)\
		ON DELETE no action\
		ON UPDATE cascade\
	);\
	\
}