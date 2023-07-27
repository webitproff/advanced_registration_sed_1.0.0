<?PHP
/* ====================

[BEGIN_SED_EXTPLUGIN]
Code=an_adv_registration
Name=AN adv registration
Description=Advansed user registration system
Version=1.0.0
Date=2009-nov-14
Author=Alex
Copyright=http://portal30.ru (Alex-Natty studio)
Notes= Ajax registration form check, terms of use
SQL=
Auth_guests=R
Lock_guests=W12345A
Auth_members=R
Lock_members=W12345A
[END_SED_EXTPLUGIN]

[BEGIN_SED_EXTPLUGIN_CONFIG]
termsOn=10:select:No,Yes:No:User must accept terms of use?
termsID=11:string::1:Page Id with terms of use
termsAlias=12:string::terms_of_use:or It Alias
termsWidth=13:string::640:Terms of use window width
termsHeight=14:string::480:Terms of use window height

[END_SED_EXTPLUGIN_CONFIG]
==================== */

// *********************************************
// *    Plugin:  "AN adv registration"         *
// *      Setup File                           *
// *    Alex & Natty studio                    *
// *        http://portal30.ru                 *
// *                                           *
// *            © Alex & Natty Studio  2009    *
// *********************************************

if (!defined('SED_CODE')) { die('Wrong URL.'); }
?>