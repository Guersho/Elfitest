function setpwd(pass) {
	var val = "";
	var alpha = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

	for(var i = 0; i <3 ; i++)  {
		val = val + alpha.charAt(getRandomInt(26))	;	
	}

	for(var i = 0; i <3 ; i++)  {
		val = val + getRandomInt(10)	;	
	}

	pass.value = val;
}