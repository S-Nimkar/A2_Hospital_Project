
function validateDeleteID() {
    var id = document.forms["admin_form"]["id"].value;

    switch (id) {
        case (""):
            jQuery("span[name='id-missing']").addClass('visibility-true-registrationpage mdl-textfield__error')
            jQuery("span[name='id-incorrect']").addClass('lower-registration-error')
            return false;
        default:
            jQuery("span[name='id-missing']").removeClass('mdl-textfield__error visibility-true-registrationpage')
    }
    if (id.length > 11){
        jQuery("span[name='id-length']").addClass('visibility-true-registrationpage relative mdl-textfield__error')
        return false
    } else {
        jQuery("span[name='id-length']").removeClass('visibility-true-registrationpage relative mdl-textfield__error')
    }
}