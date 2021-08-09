
$heading="prohibited";

sub home{

if( $noimg )
	{
print qq|
<html>
<head></head>
<body>
<div>
|;	
	}
else
	{
	&myheader($heading);

	&topmenu($heading);
	
print qq|

<div class="ha2">
|;	
	}

print qq|

<h1><font color="#000080" size="3">Prohibited Items</font></h1>
<font size="2" face="Arial" color="#000000">
<br>


The following items are strictly prohibited from shipment, and must not be sent through our services under any circumstance. Any of these items being sent may result prosecution, heavy fines and imprisonment.
<ul>
<li>Aerosol cans / sprays</li>
<li>Airbag Modules </li>
<li>Animal skins / Furs / Any Animal Parts including meat / Ivory and ivory products</li>
<li>Any item that is not boxed</li>
<li>Articles of exceptional value (eg, works of art, antiques, precious stones, gold and silver) over £250 NB Gold or Silver over £50</li>
<li>Box with Hazardous label - Items sent with a Hazardous label attached will be classed as such. DO NOT RE USE OLD HAZARDOUS BOXES</li>
<li>Cheques or Tickets that are not named</li>
<li>Dangerous goods - eg Explosives / Fireworks / Christmas Crackers / Radioactive Materials / Deactivated or Replica Weapons and Munitions / Firearms / Swords / Knives / Axe / Weapons</li>
<li>Dry Ice</li>
<li>Engines / Generators / Gearboxes or any part containing or having contained oil/petrol unless flushed through</li>
<li>Fire Extinguishers / Life Jackets</li>
<li>Food items (Perishable) Outside the EU</li>
<li>Goods moving under ATA Carnet and all temporary exports and imports; goods moving under FCR, FCT and CAD (Cash Against Document)</li>
<li>Hazardous materials eg Paint / Adhesives / Chemicals / Flammable resins/ solvents/ liquids / Compressed Air & Empty cylinders / Items containing any gases - See Also Household goods</li>
<li>Household goods containing flammable or corrosive liquids, such as oven or drain cleaners / perfume, aftershave/ hairspray/ nail varnish and remover/ antiseptic wipes ...</li>
<li>Human Remains / Body Fluids</li>
<li>Liquids / Adhesives / Paint / Oil</li>
<li>Live / Dead animals</li>
<li>Magnets or items containing ferro-magnetic material</li>
<li>Mobile Phone with Sim card / Mobile phone with or without Sim to any Residential address in Turkey</li>
<li>Money, Keys, Negotiable items / Payment cards</li>
<li>Passports / Birth Certificates / Driving Licences</li>
<li>Pornographic materials</li>
<li>Prescribed Drugs / Medication / Any Controlled/Illegal substance including 'Khat' to all areas.</li>
<li>Tobacco and tobacco products</li>
<li>Wet or Lithium Batteries (Not including Dry Cell)</li>
</ul>

<br><br>
<h1><font color="#000080" size="3">Restricted Items</font></h1>
<br>
The following items are deemed unsuitable for shipment by our services, and are therefore restricted. Any of these items being sent may result in surcharges, delays or confiscation by authorities where appropriate. No transit cover or guarantees whatsoever will apply to these items. THESE ITEMS ARE SENT AT YOUR OWN RISK.
<ul>
<li>Food items (Perishable) All areas</li>
<li>Furniture (Unless Flatpacked)</li>
<li>Glass / Mirrored items / Crystal / Ceramic / Pottery/ Porcelaine/ Plaster / Marble / China / Stone / Slate / Resin / Granite / Concrete - (or any item containing these matierals)</li>
<li>Laptops / Monitors / Computers</li>
<li>Perishable goods</li>
<li>Personal Affects</li>
<li>Plants / Seeds / Flowers / Plant derivatives </li>
<li>Televisions / Plasma & TFT Screens, Monitors</li>
<li>Unaccompanied baggage / Suitcases</li>
<li>White Goods -fridges, ovens- (also known as range, stove, cooking plate, or cooktop), Microwaves, dishwasher, Washing Machine etc.) </li>
</ul>
<br>
We will not accept any materials and products that may be dangerous or hazardous to handling staff.<br>
<br>
To comply with strict regulations we will not carry any substances classified as dangerous in the latest edition of the IATA publication.<br>
<br>
Also prohibited are: Shipments with inherent vice; Shipments which by their nature are likely to soil, impair or damage persons, merchandise or equipment; Goods the carriage of which is prohibited by law in the country of origin, transit or destination; Goods which attract excise duty or which require special facilities, safety precautions or permits.<br>
<br>
It is the sender’s responsibility to comply with current government regulations or laws applicable in each country. Not all commodities can be shipped to all countries.<br>
<br>

</font>

</div><br />
</body>
</html>

|;

#&footer;

}

1;