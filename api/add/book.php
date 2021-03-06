<?
/**
* @file api/add/book.php
* @author Willi Ballenthin
* @date Nov, 2009
*

sample query:
http://localhost/09/ButlerBooks/api/add/book.php?title=The Mythical Man-Month&author=Fred Brooks&description=A book about the difficulties of software engineering

sample output:
      <response> 
        <query> 
          <method>add/book</method> 
          <title>The Mythical Man-Month</title> 
          <author>Fred Brooks</author> 
          <description>A book about the difficulties of software engineering</description> 
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
  $title    = null;
  $author   = null;
  $description = null;
  
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
      </response>
      <?
      return;
  } else {
 	$title = mysql_real_escape_string($_GET["title"], $connection);
  	$author = mysql_real_escape_string($_GET["author"], $connection);
    $description = mysql_real_escape_string($_GET["description"], $connection);
  }  


  mysql_select_db($database, $connection) or die( "Unable to select database");

  $query = "INSERT INTO book_info (title, author, description) 
  				VALUES ('$title', '$author', '$description');";
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
  
  	$query = "SELECT book_id FROM book_info 
  	WHERE title='$title'
  	AND   author='$author'
  	AND   description='$description'";
  	$result = mysql_query($query, $connection);
  	// there better be a result
  	// TODO handle error case here...
  	
  	$row = mysql_fetch_array($result, MYSQL_ASSOC);
  
  
     ?>
      <response>
        <query>
          <method>add/book</method>
          <title><?=$_GET['title']?></title>
          <author><?=$_GET['author']?></author>
          <description><?=$_GET['description']?></description>
        </query>
        <success>
        	<book_id><?=$row['book_id']?></book_id>
        </success>
      </response>
    <?   
  }
  
  mysql_close($connection);

php?>
