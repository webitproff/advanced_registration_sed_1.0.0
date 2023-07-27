<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=an_adv_registration
Part=register.add.first
File=an_adv_registration.register.add.first
Hooks=users.register.add.first
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

// *********************************************
// *    Plugin:  "AN adv registration"         *
// *      Check form after sending             *
// *    Alex & Natty studio                    *
// *        http://portal30.ru                 *
// *                                           *
// *            © Alex & Natty Studio  2009    *
// *********************************************

defined('SED_CODE') or die('Wrong URL');
require_once(sed_langfile('an_adv_registration'));

// Проверим на согласие с правилами при регистрации
if ($cfg['plugin']['an_adv_registration']['termsOn'] == 'Yes'){
	$ruserterms = sed_import('ruserterms','P','ARR', 6, TRUE);
	if ($ruserterms[0] != 'accept') $error_string .= $L['an_adv_registration']['termsacc']."<br />";
}
?>