<?
/**
* @file api/add/bookInstance.php
* @author Willi Ballenthin
* @date Nov, 2009
*

sample query:
http://localhost/09/ButlerBooks/api/add/bookInstance.php?book_version_id=1&seller=wrb2102@columbia.edu&price=8.45

sample output:
      <response> 
        <query> 
          <method>add/bookInstance</method> 
          <book_version_id>1</book_version_id> 
          <seller>wrb2102@columbia.edu</seller> 
          <price>8.45</price> 
        </query> 
        <success></success> 
      </response> 

*/
?>


<?php
  print '<?xml seller="1.0" encoding="UTF-8" ?>';

  $username = "adi";
  $password = "adi";
  $database = "adi";
  $book_version_id  = null;
  $seller   = null;
  $price    = null;
  
  $connection = mysql_connect(localhost, $username, $password);
  if (!$connection) {
    ?>
      <response>
        <query>
          <method>add/bookInstance</method>
          <book_version_id><?=$_GET['book_version_id']?></book_version_id>
          <seller><?=$_GET['seller']?></seller>
          <price><?=$_GET['price']?></price>
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
  if(!isset($_GET['book_version_id']) ||
     !isset($_GET['seller']) || 
  	 !isset($_GET['price']) ) {
  	?>
      <response>
        <query>
          <method>add/bookInstance</method>
          <book_version_id><?=$_GET['book_version_id']?></book_version_id>
          <seller><?=$_GET['seller']?></seller>
          <price><?=$_GET['price']?></price>
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
  	$book_version_id = mysql_real_escape_string($_GET["book_version_id"], $connection);
 	$seller = mysql_real_escape_string($_GET["seller"], $connection);
  	$price = mysql_real_escape_string($_GET["price"], $connection);
  }  


  mysql_select_db($database, $connection) or die( "Unable to select database");

  $query = "INSERT INTO book_instance_info (book_version_id, seller, price) 
  				VALUES ($book_version_id, '$seller', $price);";
  $result = mysql_query($query, $connection);
  if(!$result) {
     ?>
      <response>
        <query>
          <method>add/bookInstance</method>
          <book_version_id><?=$_GET['book_version_id']?></book_version_id>
          <seller><?=$_GET['seller']?></seller>
          <price><?=$_GET['price']?></price>
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
          <method>add/bookInstance</method>
          <book_version_id><?=$_GET['book_version_id']?></book_version_id>
          <seller><?=$_GET['seller']?></seller>
          <price><?=$_GET['price']?></price>
        </query>
        <success></success>
      </response>
    <?   
  }
  
  mysql_close($connection);

php?>
