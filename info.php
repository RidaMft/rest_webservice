<?php
	// Include confi.php
	include_once('confi.php');

	$uid = isset($_GET['uid']) ? mysql_real_escape_string($_GET['uid']) :  "";
	if(!empty($uid)){
		$sql = "select name, email, status, password from `users` where ID='$uid'";
		$fetch = mysql_query($sql);
		$return_arr = array();

		while ($row = mysql_fetch_array($fetch)) {
		    $row_array['ID'] = $row['ID'];
		    $row_array['name'] = $row['name'];
		    $row_array['email'] = $row['email'];
                    $row_array['password'] = $row['password'];
		    array_push($return_arr,$row_array);
		}

		$return = array("status" => 1, "info" => $return_arr);
	}
	else{
		$return = array("status" => 0, "msg" => "User ID not define");
	}
	@mysql_close($link);

	/* Output header */
	header('Content-type: application/json');
	echo json_encode($return);
?>