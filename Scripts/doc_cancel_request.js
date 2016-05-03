

function validateAssign() {
    var patientid = document.forms["admin_form"]["patientid"].value;

    switch (patientid) {
        case (""):
            jQuery("span[name='pid-missing']").addClass('visibility-true-registrationpage mdl-textfield__error')
            jQuery("span[name='pid-incorrect']").addClass('lower-registration-error')
            return false;
        default:
            jQuery("span[name='pid-missing']").removeClass('mdl-textfield__error visibility-true-registrationpage')
    }
    if (patientid.length > 11){
        jQuery("span[name='pid-length']").addClass('visibility-true-registrationpage relative mdl-textfield__error')
        return false
    } else {
        jQuery("span[name='pid-length']").removeClass('visibility-true-registrationpage relative mdl-textfield__error')
    }

}

