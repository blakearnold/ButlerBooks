<?
/**
* @file classes.php
* @author Willi Ballenthin
* @date Nov, 2009
*

sample output:

<response> 
  <query> 
  	<method>get/classes</method> 
  </query> 
  <result> 
  	<number>1</number> 
    <classes> 
	  <class>
	  	<class_id>1</class_id>
	  	<title>Object Oriented Design</title>
	  	<number>1007</number>
	  	</class>      
	 </classes> 
  </result> 
<response> 



*/
?>


<?php
  print '<?xml version="1.0" encoding="UTF-8" ?>';

  $username = "adi";
  $password = "adi";
  $database = "adi";

  $connection = mysql_connect(localhost, $username, $password);
  if (!$connection) {
    ?>
      <response>
        <query>
          <method>get/classes</method>
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

  $query = "SELECT * FROM class_info;";
  $result   = mysql_query($query, $connection);
  $num_rows = mysql_num_rows($result);
  if ($num_rows <= 0) { /* TODO  */}

  ?>
<response>
  <query>
  	<method>get/classes</method>
  </query>
  <result>
  	<num_classes><?=$num_rows?></num_classes>
    <classes>
    
    <?

	  while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	  	echo "<class>";
		echo "<class_id>$row[class_id]</class_id>";
		echo "<title>$row[title]</title>";
		echo "<number>$row[number]</number>";
		echo "</class>";
	  }
	  
	?>
	
    </classes>
  </result>
<response><?
  
  mysql_close($connection);

php?>
