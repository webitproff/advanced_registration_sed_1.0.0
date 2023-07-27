<?PHP
// *********************************************
// *    Plugin:  "AN adv registration"         *
// *      Russian Language                     *
// *    Alex & Natty studio                    *
// *        http://portal30.ru                 *
// *                                           *
// *            © Alex & Naty Studio  2009     *
// *********************************************

/**
 * Plugin Body
 */
$L['an_adv_registration']['title'] = "Правила использования";
$L['an_adv_registration']['terms_of_use'] = "Я прочитал(а) {link} данного ресурса и принимаю их.";
$L['an_adv_registration']['terms_of_use_link'] = "правила использования";
$L['an_adv_registration']['no_terms_configured'] = "Пока правила регистрации не сконфигурированы. Укажите в <a href=\"".sed_url('admin', "m=plug&a=details&pl=an_adv_registration")."\">настройках плагина</a> страницу с правилами";
$L['an_adv_registration']['noname'] = "Вы должны указать Ваше имя";
$L['an_adv_registration']['nametooshotr'] = "Имя слишком короткое";
$L['an_adv_registration']['namealredyexists'] = "Это имя уже занято";
$L['an_adv_registration']['noemail'] = "Вы должны указать Ваш e-mail";
$L['an_adv_registration']['emailalredyexists'] = "Этот e-mail уже есть в базе";
$L['an_adv_registration']['wrongmail'] = "Ошибочный e-mail";
$L['an_adv_registration']['nopass1'] = "Вы должны указать пароль";
$L['an_adv_registration']['passtooshotr'] = "Пароль слишком короткий";
$L['an_adv_registration']['wrongpass'] = "Пароль может состоять только из букв, цифр и символа &laquo;_&raquo;";
$L['an_adv_registration']['nopass2'] = "Вы должны подтвердить пароль";
$L['an_adv_registration']['passwordmismatch'] = 'Введенные пароли не совпадают';
$L['an_adv_registration']['termsacc'] = 'Вы должны принять правила';

/**
 * Plugin Config
 */

$L['cfg_termsOn'] = array('Пользователь должен согласиться с правилами регистрации?');
$L['cfg_termsID'] = array('Id страницы содержащей правила пользования рессурсом');
$L['cfg_termsAlias'] = array('Или ее Alias (псевдоним)', 'оставте пустым, если Вы хотите использовать ID из поля выше');
$L['cfg_termsWidth'] = array('Ширина окна с правилами');
$L['cfg_termsHeight'] = array('Высота окна с правилами');
?>