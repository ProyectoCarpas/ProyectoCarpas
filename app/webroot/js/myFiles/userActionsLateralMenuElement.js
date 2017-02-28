$(document).ready(function () {

	var actualView = $("#userActionsLateralMenu").attr("data-actual-view");

	switch(actualView){
		
		case "viewUser":
        	 $("#view-user-option").addClass("active");
        break;
    	
    	case "editUser":
        	$("#edit-user-option").addClass("active");
        break;

        case "editUserPassword":
        	$("#edit-user-pass-option").addClass("active");
        break;
	}
});