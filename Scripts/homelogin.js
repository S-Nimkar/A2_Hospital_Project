
$(document).ready(function(){
	$('select').material_select();
    $('.modal-trigger').leanModal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      in_duration: 300, // Transition in duration
      out_duration: 200, // Transition out duration
     });
    $('.tooltipped').tooltip({delay: 50});
});
	
function loginalert() {
	var select = document.forms["test"]["login_type"].value;
	if (select == ""){
		jQuery("span[name='noselect']").addClass('visibility-true')
		return false;
	} else {
		jQuery("div[name='selectbox']").removeClass('visibility-true')
	}

}


