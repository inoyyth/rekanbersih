<?php
/*
#
# Example PHP server-side script for generating
# responses suitable for use with jquery-tokeninput
#

# Connect to the database
mysql_pconnect("host", "username", "password") or die("Could not connect");
mysql_select_db("database") or die("Could not select database");

# Perform the query
$query = sprintf("SELECT id, name from mytable WHERE name LIKE '%%%s%%' ORDER BY popularity DESC LIMIT 10", mysql_real_escape_string($_GET["q"]));
$arr = array();
$rs = mysql_query($query);

# Collect the results
while($obj = mysql_fetch_object($rs)) {
    $arr[] = $obj;
}
$arr=
# JSON-encode the response
$json_response = json_encode($arr);*/

$arr=array(array("id"=>"856","name"=>"Manoj"),array("id"=>"857","name"=>"Ravi"));
$json_response = json_encode($arr);
# Optionally: Wrap the response in a callback function for JSONP cross-domain support


# Return the response
echo $json_response;

?>
