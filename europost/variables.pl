
#################### GOOGLE SETUP ####################
sub se_setup{
	$SQL = "SELECT * FROM settings";  #  WHERE name like 'google_%'
	&my_sql;
	&setting_variables;
	$sth->finish;
}

#################### GOOGLE VARIABLES ####################
sub setting_variables{
	while ($column = $sth->fetchrow_hashref){
		if( $column->{'name'} eq "vattext" ) { $s_vattext = $column->{'value'}; }
		elsif( $column->{'name'} eq "fueltext" ) { $s_fueltext = $column->{'value'}; }
		elsif( $column->{'name'} eq "duttext" ) { $s_duttext = $column->{'value'}; }
		elsif( $column->{'name'} eq "wartext" ) { $s_wartext = $column->{'value'}; }
		elsif( $column->{'name'} eq "remotetext" ) { $s_remotetext = $column->{'value'}; }
		elsif( $column->{'name'} eq "satdelexttext" ) { $s_satdelexttext = $column->{'value'}; }
		elsif( $column->{'name'} eq "satcolexttext" ) { $s_satcolexttext = $column->{'value'}; }
		elsif( $column->{'name'} eq "custtext" ) { $s_custtext = $column->{'value'}; }
		elsif( $column->{'name'} eq "invtext" ) { $s_invtext = $column->{'value'}; }
		elsif( $column->{'name'} eq "booktext" ) { $s_booktext = $column->{'value'}; }
		elsif( $column->{'name'} eq "profit" ) { $s_profit = $column->{'value'}; }
		elsif( $column->{'name'} eq "fuelextra" ) { $s_fuelextra = $column->{'value'}; }
		elsif( $column->{'name'} eq "vatno" ) { $s_vatno = $column->{'value'}; }
		elsif( $column->{'name'} eq "usd" ) { $s_usd = $column->{'value'}; }
		elsif( $column->{'name'} eq "euro" ) { $s_euro = $column->{'value'}; }
		elsif( $column->{'name'} eq "paypal" ) { $s_paypal = $column->{'value'}; }
	}
}

1;
