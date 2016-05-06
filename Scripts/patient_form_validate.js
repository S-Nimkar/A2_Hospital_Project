function validateForm() {
    var age = document.forms["report_form"]["age"].value;
    var date_of_birth = document.forms["report_form"]["date_of_birth"].value;
    var home_number = document.forms["report_form"]["home_number"].value;
    var mobile_number = document.forms["report_form"]["mobile_number"].value;
    var postcode = document.forms["report_form"]["postcode"].value;
    var allergies = document.forms["report_form"]["allergies"].value;
    var past_conditions = document.forms["report_form"]["past_conditions"].value;
    var extra_info = document.forms["report_form"]["extra_info"].value;

    switch (age) {
        case (""):
            jQuery("span[name='age-missing']").addClass('mdl-textfield__error visibility-true-registrationpage ')
            return false;
        default:
            jQuery("span[name='age-missing']").removeClass('mdl-textfield__error visibility-true-registrationpage ')
    }

    switch (date_of_birth) {
        case (""):
            jQuery("span[name='date_of_birth-missing']").addClass('mdl-textfield__error visibility-true-registrationpage ')
            return false;
        default:
            jQuery("span[name='date_of_birth-missing']").removeClass('mdl-textfield__error visibility-true-registrationpage ')
    }
    var res = date_of_birth.charAt(6) + date_of_birth.charAt(7) + date_of_birth.charAt(8) + date_of_birth.charAt(9);
    if (res > 2016){
        jQuery("span[name='date_of_birth-tolarge']").addClass('mdl-textfield__error visibility-true-registrationpage ')
            return false;
    } else {
        jQuery("span[name='date_of_birth-tolarge']").removeClass('mdl-textfield__error visibility-true-registrationpage ')
    }
    if (home_number.length > 14){
    	jQuery("span[name='home_number-length']").addClass('mdl-textfield__error visibility-true-registrationpage mdl-textfield__error')
        return false
    } else {
    	jQuery("span[name='home_number-length']").removeClass('mdl-textfield__error visibility-true-registrationpage mdl-textfield__error')
    }

    if (mobile_number.length > 14){
    	jQuery("span[name='mobile_number-length']").addClass('mdl-textfield__error visibility-true-registrationpage mdl-textfield__error')
        return false
    } else {
    	jQuery("span[name='mobile_number-length']").removeClass('mdl-textfield__error visibility-true-registrationpage mdl-textfield__error')
    }

    if (postcode.length < 6){
    	jQuery("span[name='postcode-length']").addClass('mdl-textfield__error visibility-true-registrationpage mdl-textfield__error')
        return false
    } else {
        if (postcode.length > 12) {
            jQuery("span[name='postcode-length']").addClass('mdl-textfield__error visibility-true-registrationpage mdl-textfield__error')
        return false
        } else {
            jQuery("span[name='postcode-length']").removeClass('mdl-textfield__error visibility-true-registrationpage mdl-textfield__error')
        }	
    }
    if (allergies.length > 500){
        jQuery("span[name='allergies-length']").addClass('mdl-textfield__error visibility-true-registrationpage mdl-textfield__error')
        return false
    } else {
        jQuery("span[name='allergies-length']").removeClass('mdl-textfield__error visibility-true-registrationpage mdl-textfield__error')
    }
    if (past_conditions.length > 1250){
        jQuery("span[name='past_conditions-length']").addClass('mdl-textfield__error visibility-true-registrationpage mdl-textfield__error')
        return false
    } else {
        jQuery("span[name='past_conditions-length']").removeClass('mdl-textfield__error visibility-true-registrationpage mdl-textfield__error')
    }
    if (extra_info.length > 5000){
        jQuery("span[name='extra_info-length']").addClass('mdl-textfield__error visibility-true-registrationpage mdl-textfield__error')
        return false
    } else {
        jQuery("span[name='extra_info-length']").removeClass('mdl-textfield__error visibility-true-registrationpage mdl-textfield__error')
    }

}