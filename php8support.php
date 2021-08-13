<?php
function mysql_connect(){ return mysqli_connect(...func_get_args()); }
function mysql_error(){ return mysqli_error(...func_get_args()); }
function mysql_select_db(){ return mysqli_select_db(...func_get_args()); }
function mysql_fetch_array(){ return mysqli_fetch_array(...func_get_args()); }
function mysql_fetch_assoc(){ return mysqli_fetch_assoc(...func_get_args()); }
function mysql_query(){ return mysqli_query(...func_get_args()); }
function mysql_insert_id(){ return mysqli_insert_id(...func_get_args()); }
function mysql_num_rows(){ return mysqli_num_rows(...func_get_args()); }
function mysql_close(){ return mysqli_close(...func_get_args()); }
function sql_regcase($string){ return $string.'i'; }
