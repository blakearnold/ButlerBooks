<?

	function api_server_test() {
		$test_file = $api_server_base_url . "test.php";
		$test      = file_get_contents($test_file);
		print $test;
	}
	
	function api_method($method) {
		$api_server_base_url = "http://localhost/09/ButlerBooks/";
		$api_url = $api_server_base_url . "api/";
		$url     = $api_url . $method;
		$text    = file_get_contents($url);
		$xml     = simplexml_load_string($text);
		return $xml;
	}
	
	/**
	*	applies a given field value from xml to an array/hash/map
	* 	
	*	$array should be a reference
	*/
	function array_field_from_xml($array, $xml, $field) {
		$arr = $xml->xpath($field);
		$array[$field] = $arr[0];
	}
	
	/**
	*	applies a given set of field values from xml to an array/hash/map
	* 	
	*	$array should be a reference
	*/
	function array_fields_from_xml($array, $xml, $fields) {
		foreach($fields as $field) {
			array_field_from_xml(&$array, $xml, $field);
		}
	}
	
	/**
	* returns an array indexed by fields of a book instance
	*/
	function book_instance_array_from_xml($xml) {
		$book_instance = array();
		
		$fields = array('title', 'author', 'description', 
			'book_id', 'version', 'version_id', 'isbn_10', 
			'isbn_13', 'seller', 'price', 'book_instance_id');
		
		array_fields_from_xml(&$book_instance, $xml, $fields);
		return $book_instance;
	}
	
	/**
	*	returns an array of arrays, each sub array indexed by fields
	* 	in a book_instance
	*/
	function book_instances($xml) {
		$xml_book_instances = 
				$xml->xpath('/response/result/book_instances/book_instance');
	
		$book_instances = array();
		while(list( , $xml_book_instance) = each($xml_book_instances)) {
							
			array_push($book_instances, 
						book_instance_array_from_xml($xml_book_instance));
		}
		return $book_instances;
	}
	
	function get_all_book_instances() {
		return book_instances(api_method("get/allBookInstances.php"));
	}



?>
