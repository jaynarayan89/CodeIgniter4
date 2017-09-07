<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Parser test</title>
</head>
<body>

	{total|localizednumber(currency,default,fr)}         </br>
	<!-- 456,00 ¤ -->
	{total|localizednumber(currency)}         </br>
	<!-- $456.00 -->
	{total|localizednumber(percent)}         </br>
	<!-- 45,600% -->
	{total|localizednumber(scientific)}         </br>
	<!-- 4.56E2 -->
	{total|localizednumber(spellout,default,fr)}         </br>
	<!-- quatre cent cinquante-six -->
	{totald|localizednumber(spellout)}         </br>
	<!-- four hundred fifty-six -->
	{total|localizednumber(ordinal)}         </br>
	<!-- 456th -->
	{total|localizednumber(duration)}         </br>	
	<!-- 7:35 -->
	
	{price|localizedcurrency(EUR)}         </br>	
	<!-- €89.00 -->
	{price|localizedcurrency(INR)}         </br>	
	<!-- ₹89.00 -->
	{price|localizedcurrency(GBP)}         </br>	
	<!-- £89.00 -->


</body>
</html>





