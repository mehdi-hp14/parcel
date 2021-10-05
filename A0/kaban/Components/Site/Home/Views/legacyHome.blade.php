@extends('KabanViews::site.main')


@section('content')

<body bgcolor="#ffffff">
<img src="http://www.bookingparcel.com/logo.gif" alt="europost Express" width="150" height="50">

<ul>
    <li><a href="http://www.cp.bookingparcel.com/">Login</a></li>
    <li><a class="active" href="http://www.bookingparcel.com">Home</a></li>
    <li><a href="http://www.bookingparcel.com/about.html">About us</a></li>
    <li><a href="http://www.bookingparcel.com/services.html">Our Services</a></li>
    <li><a href="http://www.bookingparcel.com/prohibited.html">Prohibited and Dangerous Goods Descriptions</a></li>
    <li><a href="http://www.bookingparcel.com/terms.html">Terms & Conditions</a></li>
    <li><a href="http://bookingparcel.com/contact.html">Contact us</a></li>
</ul>
<!--		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="766" height="650" id="index" align="middle">
					<param name="allowScriptAccess" value="sameDomain" />
					<param name="movie" value="index.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="index.swf" quality="high" bgcolor="#ffffff" width="766" height="650" name="index" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
					</object>
				</div>
			</div>
		</div>-->
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div id="forms">
                <div id="infoi" style="display:none;"><div class="loader"></div></div>
                <div class="progress">
                    <div class="progress-bar  progress-bar-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                        Step #1 - 0% complete
                    </div>
                </div>

                <div class="form_header">
                    <h1 style="font-size:30px;padding:20px 1em ;">Shipping quote</h1>
                </div>
                <div id="form_body">
                    <form id="quote_form" method="post" action="ajax_process.php">
                        <input type="hidden" name="step" value="1">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                <div class="required">Please Select&nbsp;:&nbsp;</div>
                                <div>
                                    <input type="radio" name="ship_type" value="1" id="ShipType1" required="true">&nbsp;<label for="ShipType1">Shipping from the UK</label><br>
                                    <input type="radio" name="ship_type" value="2" id="ShipType2" required="true">&nbsp;<label for="ShipType2">Shipping to the UK</label><br>
                                    <input type="radio" name="ship_type" value="3" id="ShipType3" required="true">&nbsp;<label for="ShipType3">Other</label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                <div class="required">Collection Country&nbsp;:&nbsp;</div>
                                <div>
                                    <select class="drop_down" name="from_country" id="from_country" required="true">
                                        <option>---</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                <div class="required">Destination Country&nbsp;:&nbsp;</div>
                                <div>
                                    <select class="drop_down" name="to_country" id="to_country" required="true">
                                        <option>---</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                <div class="required">Shipping type&nbsp;:&nbsp;</div>
                                <div>
                                    <input type="radio" name="ship_kind" value="1" id="ShipKind1" required="true">&nbsp;<label for="ShipKind1">Comercial</label><br>
                                    <input type="radio" name="ship_kind" value="2" id="ShipKind2" required="true">&nbsp;<label for="ShipKind2">Personal</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                <div class="required"><label for="when_time">When?&nbsp;</label></div>
                                <div>
                                    <select id="when_time" name="time" class="drop_down" OnChange="HandleTimeSelection();" required="true">
                                        <option></option>
                                        <option value="0">ASAP</option>
                                        <option value="1">This week</option>
                                        <option value="2">This month</option>
                                        <option value="3">Enter exact date</option>
                                        <option value="4">Not sure when</option>
                                    </select>
                                </div>
                                <div style="display:none;" id="exact_date">
                                    <div class="required">Please enter a date :</div>
                                    <div><input name="exact_date" type="text"></div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                <div class="required">Collection City&nbsp;:&nbsp;</div>
                                <div>
                                    <input type="text" name="collection_city" required="true">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                <div class="required">Destination City&nbsp;:&nbsp;</div>
                                <div>
                                    <input type="text" name="destination_city" required="true">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                <div class="required">Shipping method&nbsp;:&nbsp;</div>
                                <div>
                                    <input type="radio" name="ship_method" value="1" id="ShipMethod1" required="true">&nbsp;<label for="ShipMethod1">Air</label><br>
                                    <input type="radio" name="ship_method" value="2" id="ShipMethod2" required="true">&nbsp;<label for="ShipMethod2">Sea</label><br>
                                    <input type="radio" name="ship_method" value="3" id="ShipMethod3" required="true">&nbsp;<label for="ShipMethod3">Land</label><br>
                                    <input type="radio" name="ship_method" value="4" id="ShipMethod4" required="true">&nbsp;<label for="ShipMethod4">Rail Way</label><br>
                                    <input type="radio" name="ship_method" value="6" id="ShipMethod6" required="true">&nbsp;<label for="ShipMethod6">Charter</label><br>
                                    <input type="radio" name="ship_method" value="5" id="ShipMethod5" required="true">&nbsp;<label for="ShipMethod5">Not Sure</label>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">

                        </script>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="pull-left" style="min-width:80%;"><button type="button" class="btn btn-primary" style="min-width:80%;" id="PreviousID">I have tracking code</button></div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="pull-right" style="min-width:80%;"><button type="submit" class="btn btn-primary" style="min-width:80%;" id="NextID">Next</button></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Histats.com  START (hidden counter) -->
<img  src="https://sstatic1.histats.com/0.gif?3417786&101" alt="free hit counter code" border="0">
<!-- Histats.com  END  -->

<div class="trustlogo">
    <script language="JavaScript" type="text/javascript">
        TrustLogo("https://bookingparcel.com/comodo_secure_seal_113x59_transp.png", "CL1", "none");
    </script>
    <a  href="https://ssl.comodo.com" id="comodoTL">Comodo SSL</a>
</div>

@endsection

