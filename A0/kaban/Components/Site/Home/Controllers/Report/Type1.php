<?php

namespace Kaban\Components\Site\Home\Controllers\Report;

use Illuminate\Support\Facades\DB;
use Kaban\Models\AgentsOfficialMeta;
use Kaban\Models\Quote;

class Type1
{
    public function index()
    {
        $quoteId = $_GET['qid'] ?? '';

//        $quote = Quote::with(['shipInfos', 'user', 'urls.agent'])->where('id', 503)->first();

        if (isset($_GET['qid']) and is_numeric($_GET['qid']) and $_GET['qid'] > 0) {
            $quote = Quote::with(['shipInfos', 'user', 'urls.agent'])->where('id', $quoteId)->first();
//                $q = "SELECT count(*) as cc FROM `quote` WHERE `id`=".$_GET['qid']."";
//                $rr = mysql_fetch_array(mysql_query($q));
            if (!empty($quote)) {
                $id = $_GET['qid'];
                $airline = "";
//                    $row = mysql_fetch_array(mysql_query("SELECT * FROM `quote` WHERE `id`=".$id.""));
                $airline = $quote->airline;

                $shipInfos = $quote->shipInfos->first();
//dd($shipInfos->toArray());
//                $res = mysql_query("SELECT * FROM `ship_info` WHERE `ref`=" . $id . "");
//                if (mysql_num_rows($res) > 0) {
//                    $row2 = mysql_fetch_array($res);
//                } else {
//                    $row2 = array();
//                }
//                DB::enableQueryLog();

                $official_agent = AgentsOfficialMeta::
                when($quote->from != 'iran', function ($query) use ($quote) {
                    $query->where('cover_counteries', 'like', "%$quote->from%");
                })
                    ->where('cover_counteries', 'like', "%$quote->to%")
                    ->get()
                    ->toArray();

                /*
                    $log = DB::getQueryLog();

                $res = mysql_query("SELECT * FROM `agents_official_meta` WHERE `cover_counteries` LIKE
                                           '%" . $row['from'] . "%' OR (" . ($row['from'] == 'Iran' ? 'true' : 'false') . " AND `cover_counteries` LIKE '%" . $row['to'] . "%') ORDER by `id` DESC");
                if (mysql_num_rows($res) > 0) {
                    $official_agent = mysql_fetch_array($res);
                } else {
                    $official_agent = array();
                }
                */
                $user_info = $quote->user->toArray();
                /*                if ($row['uname'] != "" and $row['uname'] != null) {
                                    $res = mysql_query("SELECT `company`,`address`,`phone` FROM `users` WHERE `uname`='" . $row['uname'] . "'");
                                    if (mysql_num_rows($res) > 0) {
                                        $user_info = mysql_fetch_array($res);
                                    }
                                }*/

                $agent = $quote->urls[0]->agent->toArray();

                /*$res = mysql_query("SELECT * FROM `agents` WHERE `id` IN (SELECT `aref` as id FROM `urls` WHERE `ref`=" . $id . ")");
                if (mysql_num_rows($res) > 0) {
                    $agent = mysql_fetch_array($res);
                }*/
                $output = '';
                $row = $quote->toArray();

                $output .= "Item ID : " . $id . "<br>Tracking ID : " . $row['tid'] . "<br><b>___________________________</b><br>";
                if (isset($agent) and $agent != null and is_array($agent)) {
                    $emails = explode("\n", $agent['emails']);
                    $output .= "Agent ID : " . $agent['id'] . "<br>";
                    $output .= "Agent Email : " . $emails[0] . "<br>";
                    $output .= "Agent Name : " . $agent['fname'] . "<br>";
                    $output .= "Agent Company : " . $agent['cname'] . "<br><b>___________________________</b><br>";
                    $output .= 'Dear ' . $agent['fname'] . ',<br><br>';

                } else {
                    $output .= "<span style='color:#ff0000;'>Note</span> : No Agent is connected to this quote.<br>";
                    $output .= "Agent ID : --<br>";
                    $output .= "Agent Email : --<br>";
                    $output .= "Agent Name : --<br>";
                    $output .= "Agent Company : --<br><b>___________________________</b><br>";
                }
                $row2 = $shipInfos->toArray();
//dd($row2);
                $row2['scompany'] = $row2['scompany'] ?? '';
                $row2['saddress'] = $row2['saddress'] ?? '';
                $row2['szipcode'] = $row2['szipcode'] ?? '';
                $row2['scountry'] = $row2['scountry'] ?? '';
                $row2['scontactp'] = $row2['scontactp'] ?? '';
                $row2['stelephone'] = $row2['stelephone'] ?? '';
                $row2['semail'] = $row2['semail'] ?? '';
                $row2['rcompany'] = $row2['rcompany'] ?? '';
                $row2['raddress'] = $row2['raddress'] ?? '';
                $row2['rpostcode'] = $row2['rpostcode'] ?? '';
                $row2['rcountry'] = $row2['rcountry'] ?? '';
                $row2['rcontactp'] = $row2['rcontactp'] ?? '';
                $row2['rtelephone'] = $row2['rtelephone'] ?? '';
                $row2['remail'] = $row2['remail'] ?? '';

                $output .= 'This order (Ref. ' . $row['tid'] . ') Confirmed by <span style="font-weight:bold;color:#ff0000;">' . $airline . '</span>. Please arrange collection as following instruction and update us <b>ASAP</b>:<br>';
                $output .= '<span style="color:#ff0000;font-weight:bold;">Very Important Note:<br>Please make sure and write in Manifest  following information for this cargo as well:<br>Full address of sender and receiver<br>Full description of goods<br>Weight and value<br>HS code /Codes</span><br><br>';
                $output .= '<table style="border-collapse: collapse; width: 566pt" border="0" cellpadding="0" cellspacing="0" width="754"><tbody><tr style="height:27.6pt" height="36"><td colspan="3" style="height: 27.6pt;; width: 470pt" height="36" align="left" width="626">Sender (Collection) Information <font color="#ff0000">( Also for HAWB)</font><br></td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt" height="26" align="left"><span style="">&nbsp;</span>Company Name</td><td >&nbsp;</td><td  align="left">' . $row2['scompany'] . '</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Address</td><td  style="border-top: none">&nbsp;</td><td  align="left">' . $row2['saddress'] . '</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Zip Code</td><td  style="border-top: none">&nbsp;</td><td >' . $row2['szipcode'] . '</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Country</td><td  style="border-top: none">&nbsp;</td><td  align="left">' . $row2['scountry'] . '</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Contact Person</td><td  style="border-top: none">&nbsp;</td><td  align="left">' . $row2['scontactp'] . '</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Telephone</td><td  style="border-top: none">&nbsp;</td><td  align="left">' . $row2['stelephone'] . '</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>E-mail</td><td  style="border-top: none">&nbsp;</td><td align="left">' . $row2['semail'] . '</td></tr><tr style="height: 27.6pt" height="36"><td  colspan="3" style="height: 27.6pt;" height="36" align="left">Receiver (Delivery) Information <font color="#ff0000">( Also for HAWB)</font></td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt" height="26" align="left"><span style="">&nbsp;</span>Company Name</td><td >&nbsp;</td><td  align="left">' . $row2['rcompany'] . '</td></tr>';
                $output .= '<tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Address</td><td  style="border-top: none">&nbsp;</td><td  align="left">' . $row2['raddress'] . '</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Zip Code</td><td  style="border-top: none">&nbsp;</td><td >' . $row2['rpostcode'] . '</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Country</td><td  style="border-top: none">&nbsp;</td><td  align="left">' . $row2['rcountry'] . '</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Contact Person</td><td  style="border-top: none">&nbsp;</td><td  align="left">' . $row2['rcontactp'] . '</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Telephone</td><td  style="border-top: none">&nbsp;</td><td  align="left">' . $row2['rtelephone'] . '</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>E-mail</td><td  style="border-top: none">&nbsp;</td><td align="left">' . $row2['remail'] . '</td></tr><tr style="height: 27.6pt" height="36"><td colspan="2" style="height: 27.6pt;" height="36">Shipment Information</td><td>&nbsp;</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt" height="26" align="left"><span style="">&nbsp;</span>Contents</td><td >&nbsp;</td><td align="left"  style="margin: 0px; height: 150px;"></td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Document Info./No.</td>';
                $output .= '<td  style="border-top: none">&nbsp;</td><td ></td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Gross Weight (kg)</td><td  style="border-top: none">&nbsp;</td><td >' . $row['total_weight'] . '</td></tr><tr style="height: 20.1pt" height="26"><td class="xl75" style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Dimensions (cm)</td><td class="xl76" style="border-top: none">&nbsp;</td><td align="left">' . str_replace(" | ", "\n", $row['dims']) . '</td></tr></tbody></table><br>';
                $output .= 'Please note, use above information for Collection and instruction  for HAWB.<br>and following information for MAWB;<br><br>Shipper:<br>Europost Express (UK) Ltd.<br>4 Corringham Road,<br>Wembley - Middlesex<br>HA9 9QA- London , UK<br>Tel : +44(0) 7886105417<br><br>And Consignee in MAWB will be:<br>';
                if ($user_info != null and is_array($user_info)) {
                    $output .= $user_info['company'] . "\n" . $user_info['address'] . "\nTel : " . $user_info['phone'];
                }
                $output .= '<br><br>Please confirm that you have received this confirmation order.<br><br>Best Regards<br>Fazel Zohrabpour<br><br><div style=\'font-size:80%;color:#0033cc;\'><img src="https://bookingparcel.com/logo.gif" style="width:215px;height:50px;"><br>Europost Express (UK) Ltd.<br>4 Corringham Road,<br>Wembley - Middlesex<br>HA9 9QA- London , UK<br>Tel : +44(0) 7886105417<br></div>';

                $output .= '<br><br><br><hr><br><br>';
                echo $output;
                return $output;
            }
        }
    }
}
