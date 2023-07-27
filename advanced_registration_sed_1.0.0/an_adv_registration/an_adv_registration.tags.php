<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=an_adv_registration
Part=tags
File=an_adv_registration.tags
Hooks=users.register.tags
Tags=users.register.tpl:{USERS_REGISTER_USER_MSG},{USERS_REGISTER_EMAIL_MSG}, {USERS_REGISTER_PASSWORD_MSG}, {USERS_REGISTER_PASSWORDREPEAT_MSG}, {USERS_REGISTER_TERMS}, {USERS_REGISTER_TERMS_CHK}, {USERS_REGISTER_TERMS_MSG},  {USERS_REGISTER_SEND_MSG}
Order=10
[END_SED_EXTPLUGIN]
==================== */

// *********************************************
// *    Plugin:  "AN adv registration"         *
// *      Form Tags part                       *
// *    Alex & Natty studio                    *
// *        http://portal30.ru                 *
// *                                           *
// *            © Alex & Natty Studio  2009     *
// *********************************************

defined('SED_CODE') or die('Wrong URL');
require_once(sed_langfile('an_adv_registration'));

$Width = $cfg['plugin']['an_adv_registration']['termsWidth'];
$Height = $cfg['plugin']['an_adv_registration']['termsHeight'];

if ($cfg['plugin']['an_adv_registration']['termsOn'] == 'Yes'){

	$terms = "<a href=\"#\" id=\"an_urterms\" title=\"\" onClick=\"popup('an_adv_registration', ".$Width.", ".$Height."); return false\" >".$L['an_adv_registration']['terms_of_use_link']."</a>";
	
	$termsChk = "<input type=\"checkbox\" name=\"ruserterms[]\" id=\"ruserterms\" value=\"accept\">".$L['an_adv_registration']['terms_of_use']."<div id=\"terms_dlg\" style=\"display:none;\"><iframe src=\"".sed_url('plug', 'o=an_adv_registration','' , TRUE)."\" width=\"100%\" height=\"98%\" frameborder=\"no\" ><img src=\"/images/spinner_bigger.gif\"/></iframe></div>";
	$termsChk = str_replace("{link}", $terms, $termsChk);
	
	$termsChk .= "<script>
					termsHeader = \"".$L['an_adv_registration']['title']."\";
					var termsWidht = ".$Width.";
					var termsHeight = ".$Height.";
				</script>";
}else{
	$terms = '';
	$termsChk = '';
}
$t->assign(array(
	"USERS_REGISTER_TERMS" => $terms,
	"USERS_REGISTER_TERMS_CHK" => $termsChk,
	"USERS_REGISTER_USER_MSG" => "<span id=\"rusername_msg\" ></span>",
	"USERS_REGISTER_EMAIL_MSG" => "<span id=\"ruseremail_msg\" ></span>",
	"USERS_REGISTER_PASSWORD_MSG" => "<span id=\"rpassword1_msg\" ></span>",
	"USERS_REGISTER_PASSWORDREPEAT_MSG" => "<span id=\"rpassword2_msg\" ></span>",
	"USERS_REGISTER_USER" => "<input type=\"text\" class=\"text\" id=\"rusername\" name=\"rusername\" value=\"".htmlspecialchars($rusername)."\" size=\"24\" maxlength=\"100\" />",
	"USERS_REGISTER_EMAIL" => "<input type=\"text\" class=\"text\" id=\"ruseremail\" name=\"ruseremail\" value=\"".htmlspecialchars($ruseremail)."\" size=\"24\" maxlength=\"64\" />",
	"USERS_REGISTER_PASSWORD" => "<input type=\"password\" class=\"password\" id=\"rpassword1\" name=\"rpassword1\" size=\"24\" maxlength=\"16\" />",
	"USERS_REGISTER_PASSWORDREPEAT" => "<input type=\"password\" class=\"password\" id=\"rpassword2\" name=\"rpassword2\" size=\"24\" maxlength=\"16\" />",
	"USERS_REGISTER_TERMS_MSG" => "<span id=\"terms_msg\" ></span>",
	"USERS_REGISTER_SEND_MSG" => "<span id=\"send_msg\" ></span>",
	));

?>
