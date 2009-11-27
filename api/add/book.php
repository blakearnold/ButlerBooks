<?
/**
* @file api/add/book.php
* @author Willi Ballenthin
* @date Nov, 2009
*

sample output:



*/
?>


<?php
  print '<?xml version="1.0" encoding="UTF-8" ?>';

  $username = "adi";
  $password = "adi";
  $database = "adi";
  $title    = null;
  $author   = null;
  $description = null;
  
  
  // parse options
  if(!isset($_GET['title']) || 
  	 !isset($_GET['author']) ||
  	 !isset($_GET['description']) ) {
  	?>
      <response>
        <query>
          <method>add/book</method>
          <title><?=$_GET['title']?></title>
          <author><?=$_GET['author']?></author>
          <description><?=$_GET['description']?></description>
        </query>
        <error>
          <text>
            Required parameters not present.
          </text>
        </error>
      <?
      return;
  } else {
 	$title = mysql_real_escape_string($_GET["title"]);
  	$author = mysql_real_escape_string($_GET["author"]);
    $description = mysql_real_escape_string($_GET["description"]);
  }  

  $connection = mysql_connect(localhost, $username, $password);
  if (!$connection) {
    ?>
      <response>
        <query>
          <method>add/book</method>
          <title><?=$_GET['title']?></title>
          <author><?=$_GET['author']?></author>
          <description><?=$_GET['description']?></description>
        </query>
        <error>
          <text>
            Could not connect to database.
          </text>
        </error>
      </response>
    <?

    return;
  }
  mysql_select_db($database, $connection) or die( "Unable to select database");

  $query = "INSERT INTO book_info (title, author, description) 
  				VALUES ($title, $author, $description);";
  $result = mysql_query($query, $connection);
  if(!$result) {
     ?>
      <response>
        <query>
          <method>add/book</method>
          <title><?=$_GET['title']?></title>
          <author><?=$_GET['author']?></author>
          <description><?=$_GET['description']?></description>
        </query>
        <error>
          <text>
            MYSQL error: <?=mysql_error($connection)?>
          </text>
        </error>
      </response>
    <? 
  
  }
  else {
     ?>
      <response>
        <query>
          <method>add/book</method>
          <title><?=$_GET['title']?></title>
          <author><?=$_GET['author']?></author>
          <description><?=$_GET['description']?></description>
        </query>
        <success></success>
    <?   
  }
  
  mysql_close($connection);

php?>
