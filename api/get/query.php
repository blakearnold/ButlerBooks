<?
/**
* @file query.php
* @author Willi Ballenthin
* @date Jan, 2010
*


<response> 
  <query> 
  	<method>get/query</method>
  	<query>programming</query>
  	<resultType>instance</resultType>
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
  $query    = null;
  $resultType = null;

  $connection = mysql_connect(localhost, $username, $password);
  if (!$connection) {
    ?>
      <response>
        <query>
          <method>get/query</method>
          <query><?=$_GET['query']?></query>
          <resultType><?=$_GET['resultType']?></resultType>
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
  if(!isset($_GET['query']) || 
  	 !isset($_GET['resultType']) ){
  	?>
      <response>
        <query>
          <method>get/query</method>
          <query><?=$_GET['query']?></query>
          <resultType><?=$_GET['resultType']?></resultType>
        </query>
        <error>
          <text>
            Required parameters not present.
          </text>
        </error>
      <?
      return;
  } else {
    $query        = mysql_real_escape_string($_GET["query"], $connection);
    $resultType = mysql_real_escape_string($_GET["resultType"], $connection);
  }
  
  if (! mysql_select_db($database, $connection) ) {
  	?>
      <response>
        <query>
          <method>get/query</method>
          <query><?=$_GET['query']?></query>
          <resultType><?=$_GET['resultType']?></resultType>
        </query>
        <error>
          <text>
            Unable to select database
          </text>
        </error>
      <?
      return;  
  }

  if ($resultType == "instanceID") {
  

  $query =     "SELECT book_instance_info.* FROM book_instance_info 
				WHERE book_version_id = ANY (
					SELECT book_version_id FROM book_version_info 
					WHERE book_id = ANY (
						SELECT book_id FROM book_info 
						WHERE title LIKE '%$query%' 
						OR description LIKE '%$query%' 
						OR author LIKE '%$query%') 
					OR isbn_10 LIKE '%$query%' 
					OR isbn_13 LIKE '%$query%'
				);";
echo "$query";

  $result   = mysql_query($query, $connection);
  $num_rows = mysql_num_rows($result);
  if ($num_rows <= 0) { /* TODO  */}
  
  
  // THIS IS VERY BAD...
  $instances = array();
  while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
  	array_push($instances, $row[book_instance_id]);
  }
  
  

  ?>
<response>
	<query>
	  <method>get/query</method>
	  <query><?=$_GET['query']?></query>
	  <resultType><?=$_GET['resultType']?></resultType>
	</query>
  <result>
  	<num_book_instances><?=$num_rows?></num_book_instances>
    <book_instances>
    
  <?  
  
  foreach ($instances as $id) {
	  	$query = "SELECT book_info.*, book_version_info.*, book_instance_info.*
	   FROM book_info, book_version_info, book_instance_info
	   WHERE book_instance_info.book_version_id=book_version_info.book_version_id
	   AND   book_version_info.book_id=book_info.book_id
	   AND   book_instance_info.book_instance_id=$id;";
	  $result   = mysql_query($query, $connection);
	  $num_rows = mysql_num_rows($result);
	  if ($num_rows <= 0) { /* TODO  */} 
	  
	  // there should be only one result
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
	  } // end while result row
  } // end foreach id
  	  
	?>
  </result>
<response>
	<?
	
	}  // end resultType == instanceID
  
  mysql_close($connection);

php?>
