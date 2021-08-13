<div id="shipper-container">

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
            <div class="row my-5">
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 my-5">
                    <div class="required">Please Select&nbsp;:&nbsp;</div>
                    <div>
                        <input class="form-check-input" type="radio" name="ship_type" value="1" id="ShipType1" required="true">&nbsp;<label for="ShipType1">Shipping from the UK</label><br>
                        <input class="form-check-input" type="radio" name="ship_type" value="2" id="ShipType2" required="true">&nbsp;<label for="ShipType2">Shipping to the UK</label><br>
                        <input class="form-check-input" type="radio" name="ship_type" value="3" id="ShipType3" required="true">&nbsp;<label for="ShipType3">Other</label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 my-5">
                    <div class="required">Collection Country&nbsp;:&nbsp;</div>
                    <div>
                        <select class="drop_down full_width  form-select" style="width: 100%" name="from_country" id="from_country" required="true">
                            <option>---</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 my-5">
                    <div class="required">Destination Country&nbsp;:&nbsp;</div>
                    <div>
                        <select class="drop_down  form-select" style="width: 100%" name="to_country" id="to_country" required="true">
                            <option>---</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 my-5">
                    <div class="required">Shipping type&nbsp;:&nbsp;</div>
                    <div>
                        <input class="form-check-input" type="radio" name="ship_kind" value="1" id="ShipKind1" required="true">&nbsp;<label for="ShipKind1">Comercial</label><br>
                        <input class="form-check-input" type="radio" name="ship_kind" value="2" id="ShipKind2" required="true">&nbsp;<label for="ShipKind2">Personal</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 my-5">
                    <div class="required">When?
                        {{--                                <label for="when_time" class="form-label">When?&nbsp;</label>--}}
                    </div>
                    <div>
                        <select id="when_time" name="time" class="drop_down form-select" required="true">
                            <option>Choose ...</option>
                            <option value="0">ASAP</option>
                            <option value="1">This week</option>
                            <option value="2">This month</option>
                            <option value="3">Enter exact date</option>
                            <option value="4">Not sure when</option>
                        </select>
                    </div>
                    <div style="display:none;" id="exact_date">
                        <div class="required">Please enter a date :</div>
                        <div><input  class="form-control" name="exact_date" type="text"></div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 my-5">
                    <div class="required ">Collection City&nbsp;:&nbsp;</div>
                    <div>
                        <input type="text" class="form-control" name="collection_city" required="true">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 my-5">
                    <div class="required">Destination City&nbsp;:&nbsp;</div>
                    <div>
                        <input type="text" class="form-control" name="destination_city" required="true">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 my-5">
                    <div class="required">Shipping method&nbsp;:&nbsp;</div>
                    <div>
                        <input type="radio" class="form-check-input" name="ship_method" value="1" id="ShipMethod1" required="true">&nbsp;<label for="ShipMethod1">Air</label><br>
                        <input type="radio" class="form-check-input" name="ship_method" value="2" id="ShipMethod2" required="true">&nbsp;<label for="ShipMethod2">Sea</label><br>
                        <input type="radio" class="form-check-input" name="ship_method" value="3" id="ShipMethod3" required="true">&nbsp;<label for="ShipMethod3">Land</label><br>
                        <input type="radio" class="form-check-input" name="ship_method" value="4" id="ShipMethod4" required="true">&nbsp;<label for="ShipMethod4">Rail Way</label><br>
                        <input type="radio" class="form-check-input" name="ship_method" value="6" id="ShipMethod6" required="true">&nbsp;<label for="ShipMethod6">Charter</label><br>
                        <input type="radio" class="form-check-input" name="ship_method" value="5" id="ShipMethod5" required="true">&nbsp;<label for="ShipMethod5">Not Sure</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 my-3">
                    <div class="btn-wrap">
                        <a href="#" class="my-btn"  id="PreviousID">I have tracking code</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 my-3">
                    <a href="#" class="my-btn" id="NextID">Next</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    /* SHAME : in case of fix ajax_process remove THIS*/

    function CountryFunction(a,b)
    {
        //{firstName:"John", lastName:"Doe", age:46}

        switch(a)
        {
            case 'from':
                $('#from_country').find('option').remove().end().append($('<option>', {
                    value: 'GBR',
                    text: 'United Kingdom',
                    selected : true
                }));
                $('#to_country').find('option').remove().end();
                $.each(Countries, function (i, item) {
                    if(item.value === 'GBR')
                    {
                    }
                    else
                    {
                        $('#to_country').append($('<option>', {
                            value: item.value,
                            text : item.text
                        }));
                    }
                });
                break;
            case 'to':
                $('#to_country').find('option').remove().end().append($('<option>', {
                    value: 'GBR',
                    text: 'United Kingdom',
                    selected : true
                }));
                $('#from_country').find('option').remove().end();
                $.each(Countries, function (i, item) {
                    if(item.value === 'GBR')
                    {
                    }
                    else
                    {
                        $('#from_country').append($('<option>', {
                            value: item.value,
                            text : item.text
                        }));
                    }
                });
                break;
            case 'other':
                $('#from_country').find('option').remove().end();
                $('#to_country').find('option').remove().end();
                $.each(Countries, function (i, item) {
                    $('#to_country').append($('<option>', {
                        value: item.value,
                        text : item.text
                    }));
                    $('#from_country').append($('<option>', {
                        value: item.value,
                        text : item.text
                    }));
                });
                break;
        }
    }
    function HandleTimeSelection()
    {
        var value = $("#when_time").val();
        if(value == 3)
        {
            $("#exact_date").show();
        }else{
            $("#exact_date").hide();
        }
    }
    function HandleAirTermSelection()
    {
        var value = $("#terms").val();
        if(value == 3)
        {
            $("#other_term").show();
        }
    }
    function HandleTransitSelection()
    {
        var value = $("#transit").val();
        if(value == "Other")
        {
            $("#other_transit").show();
        }
    }
    function HandleFCLSelection(a)
    {
        if(a == 1)
        {
            $("#fcl_div").show();
        }
        else
        {
            $("#fcl_div").hide();
        }
    }

</script>
