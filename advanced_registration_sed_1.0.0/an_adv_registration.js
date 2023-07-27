// *********************************************
// *    Plugin:  "AN adv registration"         *
// *      Java Script                          *
// *    Alex & Natty studio                    *
// *        http://portal30.ru                 *
// *                                           *
// *            © Alex & Natty Studio  2009    *
// *********************************************

var img = new Object();
img["good"] = new Image();
img["good"].src = "plugins/an_adv_registration/img/good.gif";
img["bad"] = new Image();
img["bad"].src = "plugins/an_adv_registration/img/bad.gif";

var formValid = false;
var termsHeader = '';

function checkRegForm(){
	var usr = $("#rusername").val();
	var mail = $("#ruseremail").val();
	var pass1 = $("#rpassword1").val();
	var pass2 = $("#rpassword2").val();
	var rules = '';
	if ($("#ruserterms")[0]) rules = $("#ruserterms")[0].checked;
	$.post("plugins/an_adv_registration/an_adv_registration.ajax.php", { task: "checkregform", lang: lang, rusername: usr, ruseremail: mail, rpassword1: pass1, rpassword2: pass2, ruserterms: rules},
		function(data){
			
			if(data.rusername_iserror){
				$("#rusername_msg").html("<img src=\"/plugins/an_adv_registration/img/bad.gif\" align=\"absmiddle\" /> <span style=\"color:#FF0000;\">" + data.rusername + "</span>");
				$("#rusername").css({'background-color' : '#fed2d2', 'border' : '#C24949 1px solid'});
			}else{
				$("#rusername_msg").html("<img src=\"/plugins/an_adv_registration/img/good.gif\" align=\"absmiddle\" /> <span style=\"color:#4E9A06;\">" + data.rusername + "</span>");
				$("#rusername").css({'background-color' : '#ddfcdc', 'border' : '#82ee80 1px solid'});
			}
			
			if(data.ruseremail_iserror){
				$("#ruseremail_msg").html("<img src=\"/plugins/an_adv_registration/img/bad.gif\" align=\"absmiddle\" /> <span style=\"color:#FF0000;\">" + data.ruseremail + "</span>");
				$("#ruseremail").css({'background-color' : '#fed2d2', 'border' : '#C24949 1px solid'});
			}else{
				$("#ruseremail_msg").html("<img src=\"/plugins/an_adv_registration/img/good.gif\" align=\"absmiddle\" /> <span style=\"color:#4E9A06;\">" + data.ruseremail + "</span>");
				$("#ruseremail").css({'background-color' : '#ddfcdc', 'border' : '#82ee80 1px solid'});
			}
			
			if(data.rpassword1_iserror){
				$("#rpassword1_msg").html("<img src=\"/plugins/an_adv_registration/img/bad.gif\" align=\"absmiddle\" /> <span style=\"color:#FF0000;\">" + data.rpassword1 + "</span>");
				$("#rpassword1").css({'background-color' : '#fed2d2', 'border' : '#C24949 1px solid'});
			}else{
				$("#rpassword1_msg").html("<img src=\"/plugins/an_adv_registration/img/good.gif\" align=\"absmiddle\" /> <span style=\"color:#4E9A06;\">" + data.rpassword1 + "</span>");
				$("#rpassword1").css({'background-color' : '#ddfcdc', 'border' : '#82ee80 1px solid'});
			}
			
			if(data.rpassword2_iserror){
				$("#rpassword2_msg").html("<img src=\"/plugins/an_adv_registration/img/bad.gif\" align=\"absmiddle\" /> <span style=\"color:#FF0000;\">" + data.rpassword2 + "</span>");
				$("#rpassword2").css({'background-color' : '#fed2d2', 'border' : '#C24949 1px solid'});
			}else{
				$("#rpassword2_msg").html("<img src=\"/plugins/an_adv_registration/img/good.gif\" align=\"absmiddle\" /> <span style=\"color:#4E9A06;\">" + data.rpassword2 + "</span>");
				$("#rpassword2").css({'background-color' : '#ddfcdc', 'border' : '#82ee80 1px solid'});
			}
			
			if(data.terms_iserror){
				$("#terms_msg").html("<img src=\"/plugins/an_adv_registration/img/bad.gif\" align=\"absmiddle\" /> <span style=\"color:#FF0000;\">" + data.terms + "</span>");
			}else{
				$("#terms_msg").html(data.terms);
			}
			if (data.error == '0'){
				formValid = true;
				$("#register").submit();
			}
			$("#send_msg").html('');
		}, "json"); //$.post
} // function checkRegForm(){

/*
*  Инициализация страницы
*/
$(function() {
	
	$("#rusername").change(function(){
		$("#rusername_msg").html('<img src="plugins/an_adv_registration/img/loading.gif" />');
		var usr = $("#rusername").val();
		$.post("plugins/an_adv_registration/an_adv_registration.ajax.php", { task: "checkusername", lang: lang, rusername: usr },
			  function(data){
				$("#rusername_msg").html(data);
				$("#rusername").css({'background-color' : '', 'border' : ''});
			  }, "html");
	});
	
	$("#ruseremail").change(function(){
		$("#ruseremail_msg").html('<img src="plugins/an_adv_registration/img/loading.gif" />');
		var mail = $("#ruseremail").val();
		$.post("plugins/an_adv_registration/an_adv_registration.ajax.php", { task: "checkuseremail", lang: lang, ruseremail: mail },
			  function(data){
				$("#ruseremail_msg").html(data);
				$("#ruseremail").css({'background-color' : '', 'border' : ''});
			  }, "html");
	});
	
	$("#rpassword1").change(function(){
		$("#rpassword1_msg").html('<img src="plugins/an_adv_registration/img/loading.gif" />');
		var pass = $("#rpassword1").val();
		$.post("plugins/an_adv_registration/an_adv_registration.ajax.php", { task: "checkuserpass1", lang: lang, rpassword1: pass },
			  function(data){
				$("#rpassword1_msg").html(data);
				$("#rpassword1").css({'background-color' : '', 'border' : ''});
			  }, "html");
	});
	
	$("#rpassword2").change(function(){
		$("#rpassword2_msg").html('<img src="plugins/an_adv_registration/img/loading.gif" />');
		var pass1 = $("#rpassword1").val();
		var pass2 = $("#rpassword2").val();
		$.post("plugins/an_adv_registration/an_adv_registration.ajax.php", { task: "checkuserpass2", lang: lang, rpassword1: pass1, rpassword2: pass2 },
			  function(data){
				$("#rpassword2_msg").html(data);
				$("#rpassword2").css({'background-color' : '', 'border' : ''});
			  }, "html");
	});
	
	$("#register").submit(function() {
		$("#send_msg").html('<img src="plugins/an_adv_registration/img/loading.gif" />');
		if (formValid == true){
			return true;
		}else{
			checkRegForm();
		}
		return false;
    });

	// Используем jQuery UI Dialog
    if (jQuery.ui && $("#terms_dlg") && termsHeader != ''){
		if (jQuery.ui.dialog){
			$("#terms_dlg").dialog({
				title: termsHeader,
				autoOpen: false,
				bgiframe: true,
				resizable: true,
				width: termsWidht,
				height: termsHeight,
				buttons: {
					"Ok": function() { $(this).dialog("close"); }
				}
			});
			// Убираем все из аттрибута onClick
			$("#an_urterms").attr("onClick","return false");
			
			$("#an_urterms").click(function(){
				$("#terms_dlg").dialog( 'open' );
				return false;
			});
		}
	}
});