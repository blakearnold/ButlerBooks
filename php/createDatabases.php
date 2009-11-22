<?php

  var $username = "adi";
  var $password = "adi";
  var $database = "adi";

  // connect to database
  var $connection = mysql_connect(localhost, $username, $password);
  if (!$connection) {
    die('Could not connect: ' . mysql_error());
  }
  mysql_select_db($database, $connection) or die( "Unable to select database");

  // create query
  var $class_info_query = "CREATE TABLE class_info (
      class_id INT NOT NULL PRIMARY KEY AUTO INCREMENT,
      title TEXT,
      number TEXT)";

  var $class_books_query = "CREATE TABLE class_books (
      class_id  INT,
      book INT)";

  var $book_info_query = "CREATE TABLE book_info (
      book_id INT NOT NULL AUTO INCREMENT PRIMARY KEY,
      title TEXT,
      author_id INT,
      description TEXT
      )";

  var $book_version_info_query = "CREATE TABLE book_version_info (
      book_version_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
      book_id INT,
      version INT,
      isbn_10 TEXT,
      isbn_13 TEXT
      )";

  var $book_instance = "CREATE TABLE book_instance(
       boook_version_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
       book_id INT,
       price INT,
       seller TEXT
       )";

       
  
	
	
mysql_close($con);

  // query database
  var $result = mysql_query($class_info_query, $connection);




php?>
