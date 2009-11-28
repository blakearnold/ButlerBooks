<?
/**
* @file api/add/allBookInstances.php
* @author Willi Ballenthin
* @date Nov, 2009
*

sample query:
http://localhost/09/ButlerBooks/api/get/allBookInstances.php

sample output:
<response> 
  <query> 
  	<method>get/allBookInstances</method> 
  </query> 
  <result> 
  	<num_book_instances>3</num_book_instances> 
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
		<book_instance>
			<book_instance_id>3</book_instance_id>
			<seller>wrb2102@columbia.edu</seller>
			<price>8.45</price>
		</book_instance>	
    </book_instances> 
  </result> 
<response>

*/
?>


<?php
  print '<?xml seller="1.0" encoding="UTF-8" ?>';

  $username = "adi";
  $password = "adi";
  $database = "adi";
  
  $connection = mysql_connect(localhost, $username, $password);
  if (!$connection) {
    ?>
      <response>
        <query>
          <method>add/allBookInstances</method>
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

  $query = "SELECT * FROM book_instance_info;";
  $result   = mysql_query($query, $connection);
  $num_rows = mysql_num_rows($result);
  if ($num_rows <= 0) { /* TODO  */}

  ?>
<response>
  <query>
  	<method>get/allBookInstances</method>
  </query>
  <result>
  	<num_book_instances><?=$num_rows?></num_book_instances>
    <book_instances>
    
    <?

	  while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	  	echo "<book_instance>";
		echo "<book_instance_id>$row[book_instance_id]</book_instance_id>";
		echo "<seller>$row[seller]</seller>";
		echo "<price>$row[price]</price>";
		echo "</book_instance>";
	  }
	  
	?>
	
    </book_instances>
  </result>
<response><?
  
  mysql_close($connection);

php?>
