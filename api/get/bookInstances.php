<?
/**
* @file bookInstances.php
* @author Willi Ballenthin
* @date Nov, 2009
*


<response> 
  <query> 
  	<method>get/bookInstances</method> 
  	<book_version>1</book_instance> 
  </query> 
  <result> 
  	<num_book_instances>2</num_book_instances> 
    <book_instances> 
		<book_instance>
			<book_instance_id>1</book_instance_id>
			<seller>wrb2102@columbia.edu</seller>
			<price>12</price>
		</book_instance>
		<book_instance>
			<book_instance_id>2</book_instance_id>
			<seller>wrb2102@columbia.edu</seller>
			<price>11.5</price>
		</book_instance>	
    </book_instances> 
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
          <method>get/bookInstances</method>
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
          <method>get/bookInstances</method>
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
    $id = mysql_real_escape_string($_GET["version"], $connection);
  }
  

  mysql_select_db($database, $connection) or die( "Unable to select database");

  $query = "SELECT book_info.*, book_version_info.*, book_instance_info.*
   FROM book_info, book_version_info, book_instance_info
   WHERE book_instance_info.book_version_id=book_version_info.book_version_id
   AND            book_version_info.book_id=book_info.book_id
   AND   book_instance_info.book_version_id=$id;";
  $result   = mysql_query($query, $connection);
  $num_rows = mysql_num_rows($result);
  if ($num_rows <= 0) { /* TODO  */}

  ?>
<response>
  <query>
  	<method>get/bookInstances</method>
  	<book_version><?=$id?></book_instance>
  </query>
  <result>
  	<num_book_instances><?=$num_rows?></num_book_instances>
    <book_instances>
    
    <?

	  while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	  	?>
	  	
<book_instance>
	<book_id><?=$row[book_id]?></book_id>
	<title><?=$row[title]?></title>
	<author><?=$row[author]?></author>
	<description><?=$row[description]?></description>
	<book_version_id><?=$row[book_version_id]?></book_version_id>
	<version><?=$row[version]?></version>
	<isbn_10><?=$row[isbn_10]?></isbn_10>
	<isbn_13><?=$row[isbn_13]?></isbn_13>
	<book_instance_id><?=$row[book_instance_id]?></book_instance_id>
	<seller><?=$row[seller]?></seller>
	<price><?=$row[price]?></price>
</book_instance>
	  	
	  	<?
	  }
	  
	?>
	
    </book_instances>
  </result>
<response><?
  
  mysql_close($connection);

php?>
