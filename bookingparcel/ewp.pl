use FileHandle;
use IPC::Open2;
use strict;

# private key file to use
my $MY_KEY_FILE = "private_key_for_europost.pem";

# public certificate file to use - should match the $cert_id
my $MY_CERT_FILE = "public_key_for_europost.pem";

# Paypal's public certificate that they publish on the Profile >
# Website-Certificate page.  Default is to use the sandbox cert.
my $PAYPAL_CERT_FILE = "paypal_sandbox_cert.pem";

# File that holds extra parameters for the paypal transaction.
my $MY_PARAM_FILE = "paypal_params.txt";

# path to the openssl binary
#my $OPENSSL = "/usr/bin/openssl";
#my $OPENSSL = "C:\\OpenSSL\\Bin\\openssl.exe";
my $OPENSSL = "/usr/local/bin/openssl";

# make sure we can execute the openssl utility
die "Could not execute $OPENSSL: $!\n" unless -x $OPENSSL;

###############################################################################

# Send arguments into the openssl commands needed to do the sign,
# encrypt, s/mime magic commands.  This works under FreeBSD with
# OpenSSL '0.9.7e 25 Oct 2004' but segfaults with '0.9.7d 17 Mar
# 2004'.  It also works under OpenBSD with OpenSSL '0.9.7c 30 Sep
# 2003'.
my $pid = open2(*READER, *WRITER,
		"$OPENSSL smime -sign -signer $MY_CERT_FILE " .
		"-inkey $MY_KEY_FILE -outform der -nodetach -binary " .
		"| $OPENSSL smime -encrypt -des3 -binary -outform pem " .
		"$PAYPAL_CERT_FILE")
  || die "Could not run open2 on $OPENSSL: $!\n"; 

# Write our parameters that we need to be encrypted to the openssl
# process.

  print WRITER "cmd=_ext-enter\n";
  print WRITER "redirect_cmd=_xclick\n";
  print WRITER "return=$DomainURL/payok.cgi\n";
  print WRITER "cancel_return=$DomainURL/paycancel.cgi\n";
  print WRITER "receiver_email=$paypal_semail\n";
  print WRITER "business=$paypal_semail\n";
  print WRITER "login_email=$paypal_bemail\n";
  print WRITER "email=$paypal_bemail\n";
  print WRITER "amount=$mytotal_price_pp\n";
  print WRITER "item_name=Booking Order\n";
  print WRITER "item_number=$orderid\n";
  print WRITER "currency_code=GBP\n";
  print WRITER "invoice=$orderid\n";
  print WRITER "address1=$s_add1\n";
  print WRITER "address2=$s_add2\n";
  print WRITER "city=$s_city\n";
  print WRITER "country=$cscountry\n";
  print WRITER "state=$s_state\n";
  print WRITER "zip=$s_postcode\n";
  print WRITER "last_name=$s_contact\n";
  print WRITER "day_phone_a=$tel\n";

# close the writer file-handle
close(WRITER);

# read in the lines from openssl
my @lines = <READER>;

# close the reader file-handle which probably closes the openssl processes
close(READER);

# combine them into one variable
my $encrypted = join('', @lines);

###############################################################################

# print our html page with the encrypted blob in the middle
print qq[
<html>
<head><title> Sample.html </title></head>
<body>
<h1>Donate</h1>
<!-- We are using the sandbox here for testing -->
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="
$encrypted" />
<input type="submit" value="Donate US\$10" />
</form>
</body>
</html>
];
