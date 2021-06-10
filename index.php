<HTML>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="Formulier">
			<form action="formulier-ingevuld.php" id="edc-assesment" class="edc-assesment" method="post">

				<label for="Naam">Uw naam</label>
				<input type="text" name="Naam" class="Naam" required="true">

				<label for="Straat">Straat:</label>
				<input type="text" name="Straat" class="Straat" required="true">

				<label for="Huisnummer">Huisnummer:</label>
				<input type="text" name="Huisnummer" class="Huisnummer" required="true">

				<label for="Huisnummer-toevoeging">Huisnummer toevoeging (optioneel)</label>
				<input type="text" name="Huisnummer-toevoeging" class="Huisnummer-toevoeging">

				<label for="Postcode">Postcode:</label>
				<input type="text" name="Postcode" class="Postcode" required="true">

				<label for="Woonplaats">Woonplaats:</label>
				<input type="text" name="Woonplaats" class="Woonplaats" required="true">

				<label for="Land">Land:</label>
				<select name="Land" class="Land" id="LandDropdown">'+
						<option value="NL">Nederland</option>
						<option value="BE">België</option>
				</select>

				<label for="email">E-Mail:</label>
				<input type="email" name="E-Mail" class="E-Mail" required="true">

				<label for="Bericht">uw bericht:</label>
				<textarea class="Bericht"placeholder="Type hier uw bericht" ></textarea>
				<input type="submit" name="opslaan" class="opslaan">
				<div class="form-result"></div>
			</form>
		</div>

		<script>
		$(document).ready(function() {
		  $("form").submit(function(event) {
		    event.preventDefault();

				var doorgaan = true;

				//loop door alle inputs
        $("#edc-assesment input[required=true], #edc-assesment textarea[required=true]").each(function(){

            $(this).css('border-color','');
            if(!$.trim($(this).val())){ //als het veld leeg is
                $(this).css('border-color','red'); //maak de border rood
                doorgaan = false; //ga niet door
            }

						//check of huisnummer numeriek is
						if($(this).attr("name")=="Huisnummer"&& !$.isNumeric($(this).val())){
							$(this).css('border-color','red'); //maak de border rood

							doorgaan = false; //ga niet door
						}

						//TODO fix postcode check
						var nlPostcode_reg = /^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i;
						var bePostcode_reg = /^(?:(?:[1-9])(?:\d{3}))$/;
						var landSelectie = $('#LandDropdown').val();
						if($(this).attr("name")=="Postcode"&&landSelectie=="NL"){

							if(!nlPostcode_reg.test($.trim($(this).val()))){
								$(this).css('border-color','red'); //maak de border rood
                doorgaan = false; //ga niet door
							}
						}
						if($(this).attr("name")=="Postcode"&&landSelectie=="BE"){
							if(!bePostcode_reg.test($.trim($(this).val()))){
								$(this).css('border-color','red'); //maak de border rood
								doorgaan = false; //ga niet door
							}
						}

            //check of email opbouw correct is
            var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
                $(this).css('border-color','red'); //maak de border rood

                doorgaan = false; //ga niet door
            }
        });


				if(doorgaan||true){

					var naam = $(".Naam").val();
					var straat = $(".Straat").val();
					var huisnummer = $(".Huisnummer").val();
					var huisnummerToevoeging = $(".Huisnummer-toevoeging").val();
					var postcode = $(".Postcode").val();
					var woonplaats = $(".Woonplaats").val();
					var land = $(".Land").val();
					var email = $(".E-Mail").val();
					var bericht = $(".Bericht").val();


					$(".form-result").load("formulier-ingevuld.php", {
						naam: naam,
						straat: straat,
						huisnummer: huisnummer,
						huisnummerToevoeging: huisnummerToevoeging,
						huisnummerToevoeging: huisnummerToevoeging,
						postcode: postcode,
						woonplaats: woonplaats,
						land: land,
						email: email,
						bericht: bericht,

					});
				}

		  });
		});
		</script>
	</body>
</HTML>
