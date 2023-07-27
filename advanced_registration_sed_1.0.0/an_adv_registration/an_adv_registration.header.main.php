<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=an_adv_registration
Part=header.main
File=an_adv_registration.header.main
Hooks=header.main
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

if (!defined('SED_CODE')) { die('Wrong URL.'); }

if ($location == "Users" && $m == 'register'){
	$out['compopup'] .= "\n".'<script type="text/javascript" src="'.$cfg['plugins_dir'].'/an_adv_registration/js/an_adv_registration.min.js"></script>
	<script>
		var lang = "'.$usr['lang'].'";
	</script>';
}
?>