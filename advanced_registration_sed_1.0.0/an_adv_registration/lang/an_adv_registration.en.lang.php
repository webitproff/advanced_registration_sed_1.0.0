<?PHP
// *********************************************
// *    Plugin:  "AN adv registration"         *
// *      English Language                     *
// *    Alex & Natty studio                    *
// *        http://portal30.ru                 *
// *                                           *
// *            © Alex & Naty Studio  2009     *
// *********************************************

/**
 * Plugin Body
 */
$L['an_adv_registration']['title'] = "Terms of use";
$L['an_adv_registration']['terms_of_use'] = "I have read {link} and I accept them.";
$L['an_adv_registration']['terms_of_use_link'] = "terms of use";
$L['an_adv_registration']['no_terms_configured'] = "Terms of use not configured yet. Set in <a href=\"".sed_url('admin', "m=plug&a=details&pl=an_adv_registration")."\">plugin configuration</a> page with that terms.";
$L['an_adv_registration']['noname'] = "You have to input your login";
$L['an_adv_registration']['nametooshotr'] = "Login too short";
$L['an_adv_registration']['namealredyexists'] = "This login already in use";
$L['an_adv_registration']['noemail'] = "You have to input your e-mail";
$L['an_adv_registration']['emailalredyexists'] = "This e-mail already in the database";
$L['an_adv_registration']['wrongmail'] = "The e-mail is not valid!";
$L['an_adv_registration']['nopass1'] = "You have to input your password";
$L['an_adv_registration']['passtooshotr'] = "Password too short";
$L['an_adv_registration']['wrongpass'] = "The password must consist of alphanumerical characters &laquo;_&raquo; and only.";
$L['an_adv_registration']['nopass2'] = "You must confirm your password";
$L['an_adv_registration']['passwordmismatch'] = 'The password fields do not match!';
$L['an_adv_registration']['termsacc'] = 'You must accept terms of use';

/**
 * Plugin Config
 */

$L['cfg_termsOn'] = array('User must accept terms of use?');
$L['cfg_termsID'] = array('Page Id with terms of use');
$L['cfg_termsAlias'] = array('or It Alias', 'leave it empty if you want to use page ID from field above');
$L['cfg_termsWidth'] = array('Terms of use window width');
$L['cfg_termsHeight'] = array('Terms of use window height');

?>