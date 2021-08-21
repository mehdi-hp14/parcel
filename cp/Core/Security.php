<?php

ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

function xss_clean($data)
{
    // global $security;
    // If its empty there is no point cleaning it :\
    if (empty($data)) return $data;
    // Recursive loop for arrays
    if (is_array($data)) {
        // foreach($data as $key => $value){ $data[$key] = $this->xss_clean($data); }
        return $data;
    }
    // Fix &entity\n;
    $data = str_replace(array('<?', '?' . '>'), array('&lt;?', '?&gt;'), $data);
    $data = str_replace(array('>', '<'), array('&gt;', '&lt;'), $data);
    // $data = str_replace(array('&','<','>'), array('&','<','>'), $data);
    $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
    $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
    $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

    //fix href's
    $data = preg_replace('#href=.*?(alert\(|alert&\#40;|javascript\:|livescript\:|mocha\:|charset\=|window\.|document\.|\.cookie|<script|<xss|data\s*:)#si', '', $data);
    // Remove any attribute starting with "on" or xmlns
    $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

    // Remove javascript: and vbscript: protocols
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

    // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

    // Remove namespaced elements (we do not need them)
    $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

    do {
        // Remove really unwanted tags
        $old_data = $data;
        $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
    } while ($old_data !== $data);
    // $data = $security->xss_clean($data);
    return $data;
}

function cleaner($value)
{
    $filchars = array('.tk', '.info', '.ac', '.net', '.org', '{', '}', '\'', '*', "'", '<', '>', '!', '$', '%', '^', '*'
    , '../', 'column_name', 'order', 'information_schema', 'information_schema.tables', 'table_schema', 'table_name', 'group_concat',
        'database()', 'union', 'x:\#', 'delete ', '///', 'from|xp_|execute|exec|sp_executesql|sp_|select| insert|delete|where|drop table|show tables|#|\*|',
        'DELETE', 'insert', "," | "x'; U\PDATE Character S\ET level=99;-\-", "x';U\PDATE Account S\ET ugradeid=255;-\-",
        "x';U\PDATE Account D\ROP ugradeid=255;-\-", "x';U\PDATE Account D\ROP ", ",W\\HERE 1=1;-\\-",
        "z'; U\PDATE Account S\ET ugradeid=char", 'update', 'drop', 'sele', 'memb', 'set', '$', 'res3t', '%',
        '--', '666.php', '/(shutdown|from|select|update|character|clan|set|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/',
        'c99.php', 'shutdown', 'from', 'select', 'update', 'character', 'UPDATE', 'where', 'show tables', 'alter');
    return str_replace($filchars, '', $value);
}
function m_s_q($value){
	
    foreach ($value as $key => $val) {
        $val = preg_replace(sql_regcase("/(ascii|CONCAT|DROP|TABLE_SCHEMA|unhex|group_concat|load_file|information_schma|substring|Union|from|select|insert|delete|where|drop table|show tables|\*|--|\\\\)/"), "", $val);

		if (ini_get('magic_quotes_gpc') == 'off') // check if magic_quotes_gpc is on and if not add slashes
		{
			//Add inverted bars to a string
			$val = addslashes($val);
		}
		// move html tages from inputs
		// $string = htmlentities($string, ENT_QUOTES);
		//removing most known vulnerable words
		$codes = array("load_file", "script", "java", "applet", "iframe", "meta", "object", "html", "<", ">", ";", "'", "");
		$val = str_replace($codes, "", $val);
		
		$val = cleaner($val);
		$val = xss_clean($val);

        // store it back into the array
        $value[$key] = $val;
    }
	return $value;
}
if(isset($_POST) AND count($_POST)>0){
	foreach($_POST as $key=>$value){
		if(is_array($value)){
			foreach($value as $k=>$v){
				$_POST[$key][$k] = m_s_q($v);
			}
		}
		else{
			$_POST[$key] = m_s_q($value);
		}
	}
}

