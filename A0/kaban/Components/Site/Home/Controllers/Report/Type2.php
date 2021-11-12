<?php

namespace Kaban\Components\Site\Home\Controllers\Report;

use Illuminate\Support\Facades\DB;
use Kaban\Models\AgentsOfficialMeta;
use Kaban\Models\Quote;

class Type2
{
    public function index()
    {
//        $quoteId = $_GET['qid1'] ?? '';
//        $quoteId = $_GET['qid2'] ?? '';

        if (isset($_GET['qid1']) and is_numeric($_GET['qid1']) and $_GET['qid1'] > 0 and isset($_GET['qid2']) and is_numeric($_GET['qid2']) and $_GET['qid2'] > 0) {
//				dd($_GET['qid1'],$_GET['qid2'] );
//            $q = "SELECT count(*) as cc FROM `quote` WHERE `id`>= " . (int)$_GET['qid1'] . " AND  `id`<= " . (int)$_GET['qid2'] . " AND `status` IN (1,2,4)";
//            $quote = Quote::find(54);
//            dd($quote,$quote->urls);
            $quotes = Quote::with(['shipInfo', 'user', 'urls.agent'])
                ->whereBetween('id', [(int)$_GET['qid1'], (int)$_GET['qid2']])
//                ->whereHas('urls')
                ->whereIn('status', [1, 2, 4])
                ->get();
            return $quotes;
            $countOfQuotes = count($quotes);

//            $rr = mysql_fetch_array(mysql_query($q));
            $output = $countOfQuotes . " Reports are listed bellow<br><br><br><br><br>___________________________</b><br>";

            if ($countOfQuotes > 0) {
//                $q = "SELECT id FROM `quote` WHERE `id`>= " . (int)$_GET['qid1'] . " AND  `id`<= " . (int)$_GET['qid2'] . " AND `status` IN (1,2,4)";
//                $ress = mysql_query($q);
//                while ($rrr = mysql_fetch_array($ress)) {

                foreach ($quotes as $quote) {

                    $row = $quote->toArray();

                    $airline = $quote->airline;


                    $shipInfos = $quote->shipInfos->first();


                    $user_info = $quote->user->toArray();

                    $agent = $quote->urls[0]->agent->toArray();

                    $row2 = $shipInfos->toArray();

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

                    $output .= "Item ID : " . $quote->id . "<br>Tracking ID : " . $row['tid'] . "<br><b>___________________________</b><br>";
                    $output .= '<table style="border-collapse: collapse; width: 566pt" border="0" cellpadding="0" cellspacing="0" width="754"><tbody><tr style="height:27.6pt" height="36"><td colspan="3" style="height: 27.6pt;; width: 470pt" height="36" align="left" width="626">Sender (Collection) Information <font color="#ff0000">( Also for HAWB)</font><br></td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt" height="26" align="left"><span style="">&nbsp;</span>Company Name</td><td >&nbsp;</td><td  align="left">' . $row2['scompany'] . '</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Address</td><td  style="border-top: none">&nbsp;</td><td  align="left">' . $row2['saddress'] . '</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Zip Code</td><td  style="border-top: none">&nbsp;</td><td >' . $row2['szipcode'] . '</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Country</td><td  style="border-top: none">&nbsp;</td><td  align="left">' . $row2['scountry'] . '</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Contact Person</td><td  style="border-top: none">&nbsp;</td><td  align="left">' . $row2['scontactp'] . '</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Telephone</td><td  style="border-top: none">&nbsp;</td><td  align="left">' . $row2['stelephone'] . '</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>E-mail</td><td  style="border-top: none">&nbsp;</td><td align="left">' . $row2['semail'] . '</td></tr><tr style="height: 27.6pt" height="36"><td  colspan="3" style="height: 27.6pt;" height="36" align="left">Receiver (Delivery) Information <font color="#ff0000">( Also for HAWB)</font></td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt" height="26" align="left"><span style="">&nbsp;</span>Company Name</td><td >&nbsp;</td><td  align="left">' . $row2['rcompany'] . '</td></tr>';
                    $output .= '<tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Address</td><td  style="border-top: none">&nbsp;</td><td  align="left">' . $row2['raddress'] . '</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Zip Code</td><td  style="border-top: none">&nbsp;</td><td >' . $row2['rpostcode'] . '</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Country</td><td  style="border-top: none">&nbsp;</td><td  align="left">' . $row2['rcountry'] . '</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Contact Person</td><td  style="border-top: none">&nbsp;</td><td  align="left">' . $row2['rcontactp'] . '</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Telephone</td><td  style="border-top: none">&nbsp;</td><td  align="left">' . $row2['rtelephone'] . '</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>E-mail</td><td  style="border-top: none">&nbsp;</td><td align="left">' . $row2['remail'] . '</td></tr></tbody></table><br>';

                    $output .= '<br><br><br><hr><br><br>';
                }
            }
        }
//        echo $output;
        return $quotes;

    }
}
