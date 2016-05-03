
function validateAdminentry() {
    var name = document.forms["admin_form"]["wholename"].value;
    var username = document.forms["admin_form"]["username"].value;
    var password = document.forms["admin_form"]["password"].value;
    var securitykey = document.forms["admin_form"]["skey"].value;


    switch (name) {
        case (""):
            jQuery("span[name='name-missing']").addClass('visibility-true-registrationpage mdl-textfield__error')
            jQuery("span[name='name-incorrect']").addClass('lower-registration-error')
            return false;
        default:
            jQuery("span[name='name-missing']").removeClass('mdl-textfield__error visibility-true-registrationpage')
    }
    if (name.length > 37){
        jQuery("span[name='name-length']").addClass('visibility-true-registrationpage relative mdl-textfield__error')
        return false
    } else {
        jQuery("span[name='name-length']").removeClass('visibility-true-registrationpage relative mdl-textfield__error')
    }

    switch (username) {
        case (""):
            jQuery("span[name='username-missing']").addClass('visibility-true-registrationpage mdl-textfield__error')
            jQuery("span[name='username-incorrect']").addClass('lower-registration-error')
            return false;
        default:
            jQuery("span[name='username-missing']").removeClass('mdl-textfield__error visibility-true-registrationpage')
    }
    if (username.length > 16){
    	jQuery("span[name='username-length']").addClass('visibility-true-registrationpage relative mdl-textfield__error')
        return false
    } else {
    	jQuery("span[name='username-length']").removeClass('visibility-true-registrationpage relative mdl-textfield__error')
    }

    switch (password) {
        case (""):
            jQuery("span[name='password-missing']").addClass('visibility-true-registrationpage mdl-textfield__error')
            jQuery("span[name='password-incorrect']").addClass('lower-registration-error')
            return false;
        default:
            jQuery("span[name='password-missing']").removeClass('mdl-textfield__error visibility-true-registrationpage')
    }

    if (password.length > 16){
    	jQuery("span[name='password-length']").addClass('visibility-true-registrationpage relative mdl-textfield__error')
        return false
    } else {
    	jQuery("span[name='password-length']").removeClass('visibility-true-registrationpage relative mdl-textfield__error')
    }

     switch (securitykey) {
        case (""):
            jQuery("span[name='skey-missing']").addClass('visibility-true-registrationpage mdl-textfield__error')
            jQuery("span[name='skey-incorrect']").addClass('lower-registration-error')
            return false;
        default:
            jQuery("span[name='skey-missing']").removeClass('mdl-textfield__error visibility-true-registrationpage')
    }

    if (securitykey.length > 16){
        jQuery("span[name='skey-length']").addClass('visibility-true-registrationpage relative mdl-textfield__error')
        return false
    } else {
        jQuery("span[name='skey-length']").removeClass('visibility-true-registrationpage relative mdl-textfield__error')
    }



}