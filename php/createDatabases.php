<?php

  $username = "adi";
  $password = "adi";
  $database = "adi";

  // connect to database
  $connection = mysql_connect(localhost, $username, $password);
  if (!$connection) {
    die('Could not connect: ' . mysql_error());
  }
  mysql_select_db($database, $connection) or die( "Unable to select database");

  // create query
  $class_info_query = "CREATE TABLE class_info (
      class_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
      title TEXT,
      number TEXT);";
  print mysql_query($class_info_query, $connection);
  print mysql_error($connection);
  print "<br />";

  $class_books_query = "CREATE TABLE class_books (
      class_id  INT,
      book_id INT);";
  print mysql_query($class_books_query, $connection);
  print mysql_error($connection);
  print "<br />";

  $book_info_query = "CREATE TABLE book_info (
      book_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
      title TEXT,
      author TEXT,
      description TEXT
      );";
  print mysql_query($book_info_query, $connection);
    print mysql_error($connection);
  print "<br />";

  $book_version_info_query = "CREATE TABLE book_version_info (
      book_version_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
      book_id INT,
      version INT,
      isbn_10 TEXT,
      isbn_13 TEXT
      );";
  print mysql_query($book_version_info_query, $connection);
    print mysql_error($connection);
  print "<br />";

  $book_instance_query = "CREATE TABLE book_instance (
       book_instance_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
       price INT,
       seller TEXT
       );";
  print mysql_query($book_instance_query, $connection);
    print mysql_error($connection);
  print "<br />";
       
  
	
	
  mysql_close($connection);





php?>
