// *********************************************
// *    Plugin:  "AN adv registration"         *
// *                                           *
// *    Alex & Natty studio                    *
// *        http://portal30.ru                 *
// *                                           *
// *            © Alex & Naty Studio  2009     *
// *********************************************

Plug-in for user registration form check with Ajax. Users can see registration errors  without page reboot. Also allows to output the requirement to user to accept a registration terms before form sending.

If you have jQuery UI.dialog installed on your site, terms of use displays with it. If you have not jQuery UI.dialog, registration terms of use displays through simple popup browser window.

Easy localisation with the the lang - files. Included: english, russian

Requirements: jQuery

Installation:
- copy "an_adv_registration" folder from archive into "plugins" folder on your server.
- Correct registration form in the users.register.tpl, form header:

<form name="register" id="register" action="{USERS_REGISTER_SEND}" method="post">

(important: name="register" id="register" ) 

- In the same file place next tags:
{USERS_REGISTER_USER_MSG}    - the message about login is outputs here.
{USERS_REGISTER_EMAIL_MSG}   - here message about e-mail
{USERS_REGISTER_PASSWORD_MSG} - here message about password
{USERS_REGISTER_PASSWORDREPEAT_MSG} - here message about password confirm
{USERS_REGISTER_TERMS_CHK}   - registration terms
{USERS_REGISTER_TERMS_MSG}   - registration terms message
{USERS_REGISTER_SEND_MSG}    - Send Form preloader. You can place it before

<input type="submit" value="{PHP.L.Submit}" />

You can find the sample of the users.register.tpl file this in archive.
Not minifed JS file also included.

- Install plugin in the administrator panel