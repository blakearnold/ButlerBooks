<?
/**
* @file api/add/bookVersion.php
* @author Willi Ballenthin
* @date Nov, 2009
*

sample query:

sample output:



*/
?>


<?php
  print '<?xml version="1.0" encoding="UTF-8" ?>';

  $username = "adi";
  $password = "adi";
  $database = "adi";
  $book_id  = null;
  $version  = null;
  $isbn_10  = null;
  $isbn_13  = null;
  
  $connection = mysql_connect(localhost, $username, $password);
  if (!$connection) {
    ?>
      <response>
        <query>
          <method>add/book</method>
          <book_id><?=$_GET['book_id']?></book_id>
          <version><?=$_GET['version']?></version>
          <isbn_10><?=$_GET['isbn_10']?></isbn_10>
          <isbn_13><?=$_GET['isbn_13']?></isbn_13>
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
  
  
  
  // parse options
  if(!isset($_GET['book_id']) ||
     !isset($_GET['version']) || 
  	 !isset($_GET['isbn_10']) ||
  	 !isset($_GET['isbn_13']) ) {
  	?>
      <response>
        <query>
          <method>add/book</method>
          <book_id><?=$_GET['book_id']?></book_id>
          <version><?=$_GET['version']?></version>
          <isbn_10><?=$_GET['isbn_10']?></isbn_10>
          <isbn_13><?=$_GET['isbn_13']?></isbn_13>
        </query>
        <error>
          <text>
            Required parameters not present.
          </text>
        </error>
      </response>
      <?
      return;
  } else {
  	$book_id = mysql_real_escape_string($_GET["book_id"], $connection);
 	$title = mysql_real_escape_string($_GET["version"], $connection);
  	$author = mysql_real_escape_string($_GET["isbn_10"], $connection);
    $description = mysql_real_escape_string($_GET["isbn_13"], $connection);
  }  


  mysql_select_db($database, $connection) or die( "Unable to select database");

  $query = "INSERT INTO book_version_info (book_id, version, isbn_10, isbn_13) 
  				VALUES ($book_id, '$version', $isbn_10, $isbn_13);";
  $result = mysql_query($query, $connection);
  if(!$result) {
     ?>
      <response>
        <query>
          <method>add/book</method>
          <book_id><?=$_GET['book_id']?></book_id>
          <version><?=$_GET['version']?></version>
          <isbn_10><?=$_GET['isbn_10']?></isbn_10>
          <isbn_13><?=$_GET['isbn_13']?></isbn_13>
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
          <book_id><?=$_GET['book_id']?></book_id>
          <version><?=$_GET['version']?></version>
          <isbn_10><?=$_GET['isbn_10']?></isbn_10>
          <isbn_13><?=$_GET['isbn_13']?></isbn_13>
        </query>
        <success></success>
      </response>
    <?   
  }
  
  mysql_close($connection);

php?>
