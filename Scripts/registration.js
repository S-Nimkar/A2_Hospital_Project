function validateForm() {
    var firstname = document.forms["registration_form"]["first_name"].value;
    var surname = document.forms["registration_form"]["surname"].value;
    var username = document.forms["registration_form"]["username"].value;
    var email = document.forms["registration_form"]["email"].value;
    var c_email = document.forms["registration_form"]["c_email"].value;
    var password = document.forms["registration_form"]["password"].value;
    var c_password = document.forms["registration_form"]["check_password"].value;

    switch (firstname) {
        case (""):
            jQuery("span[name='fname-missing']").addClass('visibility-true-registrationpage relative mdl-textfield__error')
            jQuery("span[name='surname-missing']").addClass('relative')
            return false;       	
        default:
            jQuery("span[name='fname-missing']").removeClass('mdl-textfield__error visibility-true-registrationpage')
            jQuery("span[name='surname-missing']").removeClass('relative')
    }
    if (firstname.length > 16){
    	jQuery("span[name='fname-length']").addClass('visibility-true-registrationpage relative mdl-textfield__error')
        jQuery("span[name='surname-missing']").addClass('relative')
        jQuery("span[name='surname-length']").addClass('relative')
        return false
    } else {
    	jQuery("span[name='fname-length']").removeClass('visibility-true-registrationpage relative mdl-textfield__error')
    	 jQuery("span[name='surname-missing']").removeClass('relative')
        jQuery("span[name='surname-length']").removeClass('relative')
    }

    switch (surname) {
        case (""):
            jQuery("span[name='surname-missing']").addClass('visibility-true-registrationpage relative mdl-textfield__error')
            jQuery("span[name='fname-missing']").addClass('relative')
            return false;
        default:
            jQuery("span[name='surname-missing']").removeClass('mdl-textfield__error visibility-true-registrationpage')
            jQuery("span[name='fname-missing']").removeClass('relative')
    }
    if (surname.length > 16){
    	jQuery("span[name='surname-length']").addClass('visibility-true-registrationpage relative mdl-textfield__error')
        jQuery("span[name='fname-missing']").addClass('relative')
        jQuery("span[name='fname-length']").addClass('relative')
        return false
    } else {
    	jQuery("span[name='surname-length']").removeClass('visibility-true-registrationpage relative mdl-textfield__error')
    	 jQuery("span[name='fname-missing']").removeClass('relative')
        jQuery("span[name='fname-length']").removeClass('relative')
    }
    switch (email) {
        case (""):
            jQuery("span[name='email-missing']").addClass('visibility-true-registrationpage')
            return false;
        default:
            jQuery("span[name='email-missing']").removeClass('visibility-true-registrationpage')
    }
    if (email.length > 50){
    	jQuery("span[name='email-length']").addClass('visibility-true-registrationpage relative mdl-textfield__error')
        return false
    } else {
    	jQuery("span[name='email-length']").removeClass('visibility-true-registrationpage relative mdl-textfield__error')
    }

    switch (c_email) {
        case (""):
            jQuery("span[name='c-email-missing']").addClass('visibility-true-registrationpage')
            return false;
        default:
            jQuery("span[name='c-email-missing']").removeClass('visibility-true-registrationpage')
    }
    if (c_email.length > 50){
    	jQuery("span[name='c-email-length']").addClass('visibility-true-registrationpage relative mdl-textfield__error')
        return false
    } else {
    	jQuery("span[name='c-email-length']").removeClass('visibility-true-registrationpage relative mdl-textfield__error')
    }

    if (email != c_email) {
        jQuery("span[name='email-match']").addClass('visibility-true-registrationpage mdl-textfield__error')
        return false;
    } else {
        jQuery("span[name='email-match']").removeClass('visibility-true-registrationpage')
    }

    var emailregex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (emailregex.test(email) == false) {
        jQuery("span[name='email-incorrect']").addClass('visibility-true-registrationpage mdl-textfield__error')
        return false;
    } else {
        jQuery("span[name='email-incorrect']").removeClass('visibility-true-registrationpage')
    }

    if (emailregex.test(c_email) == false) {
        jQuery("span[name='c-email-incorrect']").addClass('visibility-true-registrationpage mdl-textfield__error')
        return false;
    } else {
        jQuery("span[name='c-email-incorrect']").removeClass('visibility-true-registrationpage')
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
    switch (c_password) {
        case (""):
            jQuery("span[name='c-password-missing']").addClass('visibility-true-registrationpage mdl-textfield__error')
            jQuery("span[name='c-password-incorrect']").addClass('lower-registration-error')
            return false;
        default:
            jQuery("span[name='c-password-missing']").removeClass('mdl-textfield__error visibility-true-registrationpage')
    }
    if (c_password.length > 16){
    	jQuery("span[name='c-password-length']").addClass('visibility-true-registrationpage relative mdl-textfield__error')
        return false
    } else {
    	jQuery("span[name='c-password-length']").removeClass('visibility-true-registrationpage relative mdl-textfield__error')
    }

    if (password != c_password) {
        jQuery("span[name='password-match']").addClass('visibility-true-registrationpage mdl-textfield__error')
        return false;
    };

}