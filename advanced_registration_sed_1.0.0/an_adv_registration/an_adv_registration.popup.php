<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=an_adv_registration
Part=popup
File=an_adv_registration.popup
Hooks=popup
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

// *********************************************
// *    Plugin:  "AN adv registration"         *
// *      Popup Part                           *
// *    Alex & Natty studio                    *
// *        http://portal30.ru                 *
// *                                           *
// *            © Alex & Natty Studio  2009    *
// *********************************************

if ( !defined('SED_CODE') OR !defined('SED_PLUG') ) { die("Wrong URL."); }
require_once(sed_langfile('an_adv_registration'));
//var_dump($cfg);
require_once($cfg['plugins_dir']."/an_adv_registration/inc/an_adv_registration.functions.php");

$popup_header1 .= "<title>".$L['an_adv_registration']['title']." - ".$cfg["maintitle"]."</title>";

if (!empty($cfg['plugin']['an_adv_registration']['termsAlias']) && $cfg['plugin']['an_adv_registration']['termsAlias'] != ''){
	$pag = an_adv_r_getPage(0, $cfg['plugin']['an_adv_registration']['termsAlias']);
}elseif((!empty($cfg['plugin']['an_adv_registration']['termsID']) && $cfg['plugin']['an_adv_registration']['termsID'] != '')){
	$pag = an_adv_r_getPage($cfg['plugin']['an_adv_registration']['termsID']);
}else{
	$pag['text'] = $L['an_adv_registration']['no_terms_configured'];
}

$popup_body .= "<div>".$pag['text']."</div>";
//$popup_body .= "<div>".$pag['admin_edit'].$pag['validation']."</div>";

?>