function validatekey() {
	var securitykey = document.forms["skey"]["securitykey"].value;
	
	if (securitykey == ""){
		jQuery("span[name='skey-error']").addClass('visibility-true')
		return false;
	} else {
		jQuery("span[name='skey-error']").removeClass('visibility-true')
	}

	if (securitykey.length > 16) {
		jQuery("span[name='skey-error']").addClass('visibility-true')
	} else {
		jQuery("span[name='skey-error']").removeClass('visibility-true')
	}

}