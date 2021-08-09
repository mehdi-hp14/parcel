
use CGI; ## load the cgi module

$heading="logout";

sub home{

		$SQL2 = "DELETE FROM users WHERE userid=$isUser";
		&my_sql2;
		$sth2->finish;

		$sessioncookie1 = $form->cookie(-name=>userid, -value=>'', -expires=>'expires=Thu, 01-Jan-1970 00:00:01 GMT;');
		$sessioncookie2 = $form->cookie(-name=>fullname, -value=>'', -expires=>'expires=Thu, 01-Jan-1970 00:00:01 GMT;');
		$sessioncookie3 = $form->cookie(-name=>uid, -value=>'', -expires=>'expires=Thu, 01-Jan-1970 00:00:01 GMT;');
		$logouturl ="$script?cf=home&logedout=1";
		print $form->redirect(-url=>$logouturl, -cookie=>[$sessioncookie1, $sessioncookie2, $sessioncookie3]);
}

1;