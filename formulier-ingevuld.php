<?php

 $Naam =$_POST['naam'];
 $Straat =$_POST['straat'];
 $Huisnummer =$_POST['huisnummer'];
 $Huisnummer_toevoeging =$_POST['huisnummerToevoeging'];
 $Postcode =$_POST['postcode'];
 $Woonplaats =$_POST['woonplaats'];
 $Land =$_POST['land'];
 $eMail =$_POST['email'];
 $Bericht =$_POST['bericht'];

//check of de verplichte velden niet leeg zijn
 if(empty($Naam)||empty($Straat)||empty($Huisnummer)||empty($Postcode)||empty($Woonplaats)||empty($Land)||empty($eMail)||empty($Bericht)){
	 echo("niet alles is ingevuld");
	 die;
 }

 //check of de huisnummer numeriek is
 if(!is_numeric($Huisnummer)){
   echo("Huisnummer is niet numeriek");
   die;
 }

 //check landcode

 if($Land=="NL"){
   $nl_regex = '/^[1-9][0-9]{3}[\s]?[A-Za-z]{2}$/i';
   if(preg_match($nl_regex,$Postcode)){

   }else {
     echo("postcode incorrect");
     die;
   }
 }
 elseif ($Land=="BE") {
   $be_regex = '/^(?:(?:[1-9])(?:\d{3}))$/';
   if(preg_match($be_regex,$Postcode)){

   }else {
     echo("postcode incorrect");
     die;
   }
 }
 else{
   echo("landcode klopt niet");
   die;
 }

if (!filter_var($eMail, FILTER_VALIDATE_EMAIL)) {
  echo("foutieve email format");
  die;
}


$to = "jwwever@hotmail.com"; // email adress waar de mail naar toe moet
$from = $eMail; // email van invullende partijd en is return adres


$subject = "ingevuld formulier";
$message = $Naam. " \n\n" .$Straat." ".$Huisnummer." ".$Huisnummer_toevoeging."\n\n".$Postcode." ".$Woonplaats."\n\n".$Land."\n\n schreef het volgende: ".$Bericht;
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);

echo('<h2 >Uw bericht is verzonden</h2>');
?>
