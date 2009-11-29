<?
/**
* @file bookVersion.php
* @author Willi Ballenthin
* @date Nov, 2009
*

sample query:http://localhost/09/ButlerBooks/api/get/bookVersion.php?version=1

sample output:
<response> 
  <query> 
  	<method>get/bookVersion</method> 
  	<book_version>1</book_instance> 
  </query> 
  <result> 
  	<num_book_versions>1</num_book_versions> 
    <book_versions> 
    
    	  	
<book_version> 
	<book_id>1</book_id> 
	<title>big java book</title> 
	<author>cs dude</author> 
	<description>some big book about java</description> 
	<book_version_id>1</book_version_id> 
	<version>1</version> 
	<isbn_10>1234567890</isbn_10> 
	<isbn_13>1234567890123</isbn_13> 
</book_version> 
	  	
	  		
    </book_versions> 
  </result> 
<response>



*/
?>
<?php
  print '<?xml version="1.0" encoding="UTF-8" ?>';

  $username = "adi";
  $password = "adi";
  $database = "adi";
  $id       = null;


  $connection = mysql_connect(localhost, $username, $password);
  if (!$connection) {
    ?>
      <response>
        <query>
          <method>get/bookVersion</method>
          <id><?=$_GET['version']?></id>
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
  // TODO 
  // generalize option selection
  if(!isset($_GET['version'])){
  	?>
      <response>
        <query>
          <method>get/bookVersion</method>
          <id><?=$_GET['version']?></id>
        </query>
        <error>
          <text>
            Required parameters not present.
          </text>
        </error>
      <?
      return;
  } else {
    $id = mysql_real_escape_string($_GET["version"]);
  }
  

  mysql_select_db($database, $connection) or die( "Unable to select database");

  $query = "SELECT book_info.*, book_version_info.* 
  FROM book_info, book_version_info 
  WHERE book_info.book_id=book_version_info.book_id 
  AND book_version_info.book_version_id=$id;";

  $result   = mysql_query($query, $connection);
  $num_rows = mysql_num_rows($result);
  if ($num_rows <= 0) { /* TODO  */}

  ?>
<response>
  <query>
  	<method>get/bookVersion</method>
  	<book_version><?=$id?></book_instance>
  </query>
  <result>
  	<num_book_versions><?=$num_rows?></num_book_versions>
    <book_versions>
    
    <?

	  while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	  	?>
	  	
<book_version>
	<book_id><?=$row[book_id]?></book_id>
	<title><?=$row[title]?></title>
	<author><?=$row[author]?></author>
	<description><?=$row[description]?></description>
	<book_version_id><?=$row[book_version_id]?></book_version_id>
	<version><?=$row[version]?></version>
	<isbn_10><?=$row[isbn_10]?></isbn_10>
	<isbn_13><?=$row[isbn_13]?></isbn_13>
</book_version>
	  	
	  	<?
	  }
	  
	?>
	
    </book_versions>
  </result>
<response><?
  
  mysql_close($connection);

php?>
