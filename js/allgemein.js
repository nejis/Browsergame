function check()
    {
      if(document.anmelden.username.value.length < 4)
      {
        alert("Der Benutzername muss 4-12 Zeichen haben!");
      }
      else if (document.anmelden.passwort.value.length < 4)
      {
        alert("Das Passwort muss 4-8 Zeichen haben!");
        return(false);
      }
      return true;
    }
    
function UHR_Start() 
    {
    	UR_Nu = new Date;
    	UR_Indhold = showFilled(UR_Nu.getHours()) + ":" + showFilled(UR_Nu.getMinutes()) + ":" + showFilled(UR_Nu.getSeconds());
    	document.getElementById("ur").innerHTML = UR_Indhold;
    	setTimeout("UHR_Start()",1000);
    }
    function showFilled(Value) 
    {
    	return (Value > 9) ? "" + Value : "0" + Value;
    }
    
    function test() 
    {
    	var ergebnis = confirm("Sind Sie sicher!");
    } 