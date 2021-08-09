<?php 

include("../post_forms/cnf.php");
include("conf.php");

if(!(isset($_SESSION['loged_in']) AND isset($_SESSION['loged_in_t']) AND $_SESSION['loged_in']==true AND $_SESSION['loged_in_t']>=time())){

	header("Location: index.php");
	exit("You are not logged in....<br><a href='index.php'>Dashboard</a>");
}

if(isset($_SESSION['loged_in']) AND isset($_SESSION['loged_in_t']) AND $_SESSION['loged_in']==true AND $_SESSION['loged_in_t']>=time()){
	$_SESSION['loged_in_t'] = time()+time_out;
}

header('Content-Type:application/json;');
$response = array("status"=>false,"message"=>null);

$con = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME, $con) or die(mysql_error());

function GenerateURL($id, $from, $to)
{
	global $con;
	$tmp = array(
		substr(md5($id),8,10),
		substr(md5($from),8,10),
		substr(md5($to),8,10)
	);
	$q = "INSERT INTO `urls` (`ref`, `idHash`, `fromHash`, `toHash`) VALUES ('".$id."', '".$tmp[0]."', '".$tmp[1]."', '".$tmp[2]."');";
	//echo $q."<br>";
	mysql_query($q,$con);
	return "<a href='http://cp.bookingparcel.com/agents.php?Param1=".$tmp[0]."&Param2=".$tmp[1]."&Param3=".$tmp[2]."'>Click here</a><br>or copy and paste the below URL into your browser:<br>http://cp.bookingparcel.com/agents.php?Param1=".$tmp[0]."&Param2=".$tmp[1]."&Param3=".$tmp[2]."";
}


if(isset($_GET['cmd'])){
	switch($_GET['cmd']){
		case 'load_msg':
			if(isset($_POST['item_id']) AND is_numeric($_POST['item_id']) AND $_POST['item_id']>0){
				if(isset($_POST['mid']) AND is_numeric($_POST['mid']) AND $_POST['mid']>0){
					
					$q = "SELECT * FROM `prenotes` WHERE `id`=".$_POST['mid']."";
					$r = mysql_query($q);
					if(mysql_num_rows($r)>0){
						$row1 = mysql_fetch_array($r);
						
						$q = "SELECT * FROM `quote` WHERE `id`=".$_POST['item_id']."";
						$r = mysql_query($q);
						if(mysql_num_rows($r)>0){
							$row2 = mysql_fetch_array($r);
							
							$message = $row1['message'];
							$message = str_replace("{tid}", $row2['tid'], $message);
							$message = str_replace("{GenerateUniqeURL}", GenerateURL($row2['id'], $row2['from_st'] . " - " .$row2['from_location'], $row2['to_st'] . " - " .$row2['to_location']), $message);
							$message = str_replace("{from_country}", $row2['from'], $message);
							$message = str_replace("{to_country}", $row2['to'], $message);
							$message = str_replace("{from_loc}", $row2['from_st'] . " - " .$row2['from_location'], $message);
							$message = str_replace("{to_loc}", $row2['to_st'] . " - " .$row2['to_location'], $message);
							$message = str_replace("{item_count}", $row2['item_c'], $message);
							$message = str_replace("{item_dims}", $row2['dims'], $message);
							$message = str_replace("{item_weight}", $row2['total_weight'], $message);
							$message = str_replace("{item_Desc}", $row2['item_desc'], $message);
							$message = str_replace("{note_value}", $row2['note'], $message);
							if($row2['from'] == 'United States' AND $row2['to'] == 'Iran'){
								$message = str_replace("{usa_iran_transit}", "<br> Your Shipper already obtained OFAC license for Export ? ".$row2['ofac']."<br>Your Shipper already registered with TSA database in USA ? ".$row2['tsa']."<br> Would you prefer to transit this order to the destination Via another country? ".($row2['transit'])."<br>Please Transit Via if possible: ".($row2['transit_country']), $message);
							}
							else{
								$message = str_replace("{usa_iran_transit}", "", $message);
							
							}
							
							$tags = array("{insurance}", "{stackable}", "{chemicals}", "{lithium}", "{dg}", "{shipSubMethod}", "{ship_method}");
							$tags_replacement = array(
								(strtolower($row2['insurance'])=='yes' ? 'Yes, insurance is needed' : 'No'),
								(strtolower($row2['stackable'])=='yes' ? 'Yes, Cargo contains stackable Goods' : 'No'),
								(strtolower($row2['chemical'])=='yes' ? 'Yes, Cargo contains Chemical Goods' : 'No'),
								(strtolower($row2['lithiumb'])=='yes' ? 'Yes, Cargo contains Lithium-ion Battery' : 'No'),
								(strtolower($row2['danger'])=='yes' ? 'Yes, Cargo contains Dangerous Goods' : 'No'),
								$row2['shipping_sub_type'],
								$row2['shipping_type']
							);
							$message = str_replace($tags, $tags_replacement, $message);
							$response['status']=true;
							$response['message'] = $message;
						}
					}
				}
			}
		break;
		case 'load_msg2':
			if(isset($_POST['mid']) AND is_numeric($_POST['mid']) AND $_POST['mid']>0){
				
				$q = "SELECT * FROM `prenotes` WHERE `id`=".$_POST['mid']."";
				$r = mysql_query($q);
				if(mysql_num_rows($r)>0){
					$row1 = mysql_fetch_array($r);
					
					$message = $row1['message'];
					
					$response['status']=true;
					$response['message'] = $message;
				}
			}
		break;
	}
}
$response = json_encode($response);

if(isset($_POST['cmd'])){
	switch($_POST['cmd']){
		case 'load_agent_name':
			if(isset($_POST['q'])){
				$query = sprintf("SELECT id,  `fname` as name from agents WHERE fname LIKE '%%%s%%' ORDER BY id DESC LIMIT 10", mysql_real_escape_string($_POST["q"]));
				$arr = array();
				$rs = mysql_query($query);
				//echo $query;exit;

				# Collect the results
				while($obj = mysql_fetch_object($rs)) {
					$arr[] = $obj;
				}

				# JSON-encode the response
				$response = json_encode($arr);

				# Optionally: Wrap the response in a callback function for JSONP cross-domain support
				if($_GET["callback"]) {
					$response = $_GET["callback"] . "(" . $response . ")";
				}

				
				
			}
		break;
	}
}


mysql_close();



echo $response;










ob_flush();