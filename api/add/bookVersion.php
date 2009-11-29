<?
/**
* @file api/add/bookVersion.php
* @author Willi Ballenthin
* @date Nov, 2009
*

sample query:
http://localhost/09/ButlerBooks/api/add/bookVersion.php?book_id=1&version=3&isbn_10=0987654321&isbn_13=3210987654321


sample output:
	  <response> 
        <query> 
          <method>add/book</method> 
          <book_id>1</book_id> 
          <version>3</version> 
          <isbn_10>0987654321</isbn_10> 
          <isbn_13>3210987654321</isbn_13> 
        </query> 
        <success></success> 
      </response> 


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
          <method>add/bookVersion</method>
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
          <method>add/bookVersion</method>
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
 	$version = mysql_real_escape_string($_GET["version"], $connection);
  	$isbn_10 = mysql_real_escape_string($_GET["isbn_10"], $connection);
    $isbn_13 = mysql_real_escape_string($_GET["isbn_13"], $connection);
  }  


  mysql_select_db($database, $connection) or die( "Unable to select database");

  $query = "INSERT INTO book_version_info (book_id, version, isbn_10, isbn_13) 
  				VALUES ($book_id, $version, '$isbn_10', '$isbn_13');";
  $result = mysql_query($query, $connection);
  if(!$result) {
     ?>
      <response>
        <query>
          <method>add/bookVersion</method>
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
  
    $query = "SELECT book_version_id FROM book_version_info 
  	WHERE version='$version'
  	AND   isbn_10='$isbn_10'
  	AND   isbn_13='$isbn_13'
  	AND   book_id='$book_id'";
  	$result = mysql_query($query, $connection);
  	// there better be a result
  	// TODO handle error case here...
  	
  	$row = mysql_fetch_array($result, MYSQL_ASSOC);
  
  
     ?>
      <response>
        <query>
          <method>add/bookVersion</method>
          <book_id><?=$_GET['book_id']?></book_id>
          <version><?=$_GET['version']?></version>
          <isbn_10><?=$_GET['isbn_10']?></isbn_10>
          <isbn_13><?=$_GET['isbn_13']?></isbn_13>
        </query>
        <success>
        	<book_version_id><?=$row['book_version_id']?></book_version_id>
        </success>
      </response>
    <?   
  }
  
  mysql_close($connection);

php?>
