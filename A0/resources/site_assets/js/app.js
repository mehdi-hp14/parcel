window.$ = window.jquery = require('jquery')

$('#ShipType1').on('click',()=>{
    CountryFunction('from','uk');
})
$('#ShipType2').on('click',()=>{
    CountryFunction('to','uk');
})
$('#ShipType3').on('click',()=>{
    CountryFunction('other','');
})

$('#when_time').on('change',()=>{
    HandleTimeSelection()
})

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

$(document).ready(function () {
    $("#PreviousID").click(function(event) {
        $('#infoi').show();
        var step = parseInt( $("#quote_form input[name=step]").val() ) - 1;

        $.ajax({
            type        : 'POST',
            url         : 'ajax_process.php?cmd=previous',
            data        : "step="+step,
            dataType    : 'json',
            encode          : true
        })

            .done(function(data) {

                //console.log(data);

                if (data.message !='') {
                    $('#forms').replaceWith('' + data.message + '');
                    if (data.status == false) {
                        var html = "<div class=\"row\">";
                        $.each(data.errors, function(key, value)
                        {
                            html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
                            html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
                            html += "<span>"+value+"</span>";
                            html += "</div></div>";
                        });
                        html += "</div>";
                        $('#forms').prepend(html);
                    }
                    $('#infoi').hide();
                }

            });


        event.preventDefault();
    });
    $("#NextID").click(function(event) {
        $('#infoi').show();
        event.preventDefault();
        var formData = $("#quote_form").serialize();

        $.ajax({
            type        : 'POST',
            url         : 'ajax_process.php',
            data        : formData,
            dataType    : 'json',
            encode          : true
        })

            .done(function(data) {

                console.log(data);

                if (data.message !="") {
                    $('#shipper-container').replaceWith('' + data.message + '');

                    if (data.status == false) {
                        var html = "<div class=\"row\">";
                        $.each(data.errors, function(key, value)
                        {
                            html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
                            html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
                            html += "<span>"+value+"</span>";
                            html += "</div></div>";
                        });
                        html += "</div>";
                        $('#shipper-container').prepend(html);
                    }

                }
                $('#infoi').hide();

            });


    });
});
