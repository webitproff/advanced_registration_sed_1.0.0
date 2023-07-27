<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=an_adv_registration
Part=ajax
File=an_adv_registration.ajax
Hooks=ajax
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */
// *********************************************
// *    Plugin:  "AN adv registration"         *
// *      Ajax                                 *
// *    Alex & Natty studio                    *
// *        http://portal30.ru                 *
// *                                           *
// *            © Alex & Natty Studio  2009    *
// *********************************************
define('SED_CODE', TRUE);
define('SED_AJAX', 1);

// ======== инициализируем Cotonti =============
require_once('../../datas/config.php');
$cfg['system_dir'] = str_replace("./", "../../", $cfg['system_dir']);
$cfg['plugins_dir'] = str_replace("./", "../../", $cfg['plugins_dir']);

require_once($cfg['system_dir'].'/functions.php');

/* ======== Connect to the SQL DB======== */

require_once($cfg['system_dir'].'/database.'.$cfg['sqldb'].'.php');
$sed_dbc = sed_sql_connect($cfg['mysqlhost'], $cfg['mysqluser'], $cfg['mysqlpassword'], $cfg['mysqldb']);
unset($cfg['mysqlhost'], $cfg['mysqluser'], $cfg['mysqlpassword']);

/* ======== Configuration settings (from the DB) ======== */

$sql_config = sed_sql_query("SELECT config_owner, config_cat, config_name, config_value FROM $db_config");

while ($row = sed_sql_fetcharray($sql_config))
{
	if ($row['config_owner']=='core')
	{ $cfg[$row['config_name']] = $row['config_value']; }
	else
	{ $cfg['plugin'][$row['config_cat']][$row['config_name']] = $row['config_value']; }
}

// Mbstring options
mb_internal_encoding($cfg['charset']);

// ======== Конец инициализируем Cotonti =============

/*
* Проверяем имя пользователя
* Вернем массив:
* iserror => 0 (или 1)
* msg = сообщение об ошибке
*/
function an_adv_r_checkUsername($name){
	global $db_users, $L;
	$ret = array();
	$ret['iserror'] = 1;
	$ret['msg'] = '';
	
	if ($name == ''){
		$ret['msg'] = $L['an_adv_registration']['noname'];
		return $ret;
	}
	
	if(mb_strlen($name) >= 2){
		$sql_user = sed_sql_query("SELECT * FROM $db_users WHERE user_name = '".sed_sql_prep($name)."' LIMIT 1");
		if(sed_sql_numrows($sql_user) > 0){
			$ret['msg'] = $L['an_adv_registration']['namealredyexists'];
		}else{
			$ret['msg'] = "Ok";
			$ret['iserror'] = 0;
		}
	}else{
		$ret['msg'] = $L['an_adv_registration']['nametooshotr'];
	}
	
	return $ret;
}

/*
* Проверяем e-mail
* Вернем массив:
* iserror => 0 (или 1)
* msg = сообщение об ошибке
*/
function an_adv_r_checkEmail($mail){
	global $db_banlist, $db_users, $L;
	$ret = array();
	$ret['iserror'] = 1;
	$ret['msg'] = '';
	
	if ($mail == ''){
		$ret['msg'] = $L['an_adv_registration']['noemail'];
		return $ret;
	}
	
	// Проверяем бан-лист
	$sql = sed_sql_query("SELECT banlist_reason, banlist_email FROM $db_banlist WHERE banlist_email!=''");
	while ($row = sed_sql_fetcharray($sql)){
		if (mb_strpos($row['banlist_email'], $mail) !== false) { $bannedreason = $row['banlist_reason']; }
	}
	if (!empty($bannedreason)){
		$ret['msg'] = $L['aut_emailbanned'].$bannedreason;
		return $ret;
	}
	
	if (mb_strlen($mail)<4 || !preg_match('#^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{2,})+$#i', $mail)){
		$ret['msg'] = $L['an_adv_registration']['wrongmail'];
		return $ret;
	}
	
	$sql = sed_sql_query("SELECT COUNT(*) FROM $db_users WHERE user_email='".sed_sql_prep($mail)."'");
	$res2 = sed_sql_result($sql,0,"COUNT(*)");
	if ($res2>0){
		$ret['msg'] = $L['an_adv_registration']['emailalredyexists'];
		return $ret;
	}
	
	$ret['msg'] = "Ok";
	$ret['iserror'] = 0;
	return $ret;
}

/*
* Проверяем пароль1
* Вернем массив:
* iserror => 0 (или 1)
* msg = сообщение об ошибке
*/
function an_adv_r_checkUserPass1($pass1){
	global $db_users, $L;
	$ret = array();
	$ret['iserror'] = 1;
	$ret['msg'] = '';
	
	if ($pass1 == ''){
		$ret['msg'] = $L['an_adv_registration']['nopass1'];
		return $ret;
	}
	
	if (mb_strlen($pass1)<4){
		$ret['msg'] = $L['an_adv_registration']['passtooshotr'];
		return $ret;
	}
	
	if (sed_alphaonly($pass1)!=$pass1){
		$ret['msg'] = $L['an_adv_registration']['wrongpass'];
		return $ret;
	}
	
	$ret['msg'] = "Ok";
	$ret['iserror'] = 0;
	return $ret;
}

/*
* Проверяем пароль1
* Вернем массив:
* iserror => 0 (или 1)
* msg = сообщение об ошибке
*/
function an_adv_r_checkUserPass2($pass1, $pass2){
	global $db_users, $L;
	$ret = array();
	$ret['iserror'] = 1;
	$ret['msg'] = '';
	
	if ($pass2 == ''){
		$ret['msg'] = $L['an_adv_registration']['nopass2'];
		return $ret;
	}
	
	if ($pass1!=$pass2){
		$ret['msg'] = $L['an_adv_registration']['passwordmismatch'];
		return $ret;
	}
	
	$ret['msg'] = "Ok";
	$ret['iserror'] = 0;
	return $ret;
}

$task = sed_import('task','P','TXT', 100, TRUE);
$lang = sed_import('lang','P','TXT', 10, TRUE);
if (empty($lang) || $lang == '') $lang = $cfg['defaultlang'];

require_once($cfg['plugins_dir']."/an_adv_registration/inc/an_adv_registration.functions.php");
require_once($cfg['plugins_dir']."/an_adv_registration/lang/an_adv_registration.".$lang.".lang.php");
require_once($cfg['system_dir'].'/lang/'.$lang.'/main.lang.php');

sed_sendheaders();

//var_dump($L);

// ===== Выводим условия использования сайта ========
if ($task == 'terms'){
	if (!empty($cfg['plugin']['an_adv_registration']['termsAlias']) && $cfg['plugin']['an_adv_registration']['termsAlias'] != ''){
		$pag = an_adv_r_getPage(0, $cfg['plugin']['an_adv_registration']['termsAlias']);
	}elseif((!empty($cfg['plugin']['an_adv_registration']['termsID']) && $cfg['plugin']['an_adv_registration']['termsID'] != '')){
		$pag = an_adv_r_getPage($cfg['plugin']['an_adv_registration']['termsID']);
	}else{
		$pag['text'] = $L['an_adv_registration']['no_terms_configured'];
	}
	echo $pag['text'];
	die;
}

// ===== Проверяем имя (логин) ========
if ($task == 'checkusername'){
	$rusername = sed_import('rusername','P','TXT', 100, TRUE);
	$rusername = str_replace('&#160;', '', $rusername);
	if (empty($rusername) || $rusername == ''){
		echo "";
		die;	
	}else{
		$tmp = an_adv_r_checkUsername($rusername);
		if ($tmp['iserror']){
			echo "<img src=\"/plugins/an_adv_registration/img/bad.gif\" align=\"absmiddle\" /> <span style=\"color:#FF0000;\">";
		}else{
			echo "<img src=\"/plugins/an_adv_registration/img/good.gif\" align=\"absmiddle\" /> <span style=\"color:#4E9A06;\">";
		}
		echo $tmp['msg']."</span>";
	}
	die;
}

// ===== Проверяем e-mail ========
if ($task == 'checkuseremail'){
	$ruseremail = sed_import('ruseremail','P','TXT',64, TRUE);
	
	if (empty($ruseremail) || $ruseremail == ''){
		echo "";
		die;	
	}
	$tmp = an_adv_r_checkEmail($ruseremail);
	if ($tmp['iserror']){
		echo "<img src=\"/plugins/an_adv_registration/img/bad.gif\" align=\"absmiddle\" /> <span style=\"color:#FF0000;\">";
	}else{
		echo "<img src=\"/plugins/an_adv_registration/img/good.gif\" align=\"absmiddle\" /> <span style=\"color:#4E9A06;\">";
	}
	echo $tmp['msg']."</span>";	
	die;
}

// ===== Проверяем password1 ========
if ($task == 'checkuserpass1'){
	$rpassword1 = sed_import('rpassword1','P','TXT',16);

	if (empty($rpassword1) || $rpassword1 == ''){
		echo "";
		die;	
	}
	$tmp = an_adv_r_checkUserPass1($rpassword1);
	if ($tmp['iserror']){
		echo "<img src=\"/plugins/an_adv_registration/img/bad.gif\" align=\"absmiddle\" /> <span style=\"color:#FF0000;\">";
	}else{
		echo "<img src=\"/plugins/an_adv_registration/img/good.gif\" align=\"absmiddle\" /> <span style=\"color:#4E9A06;\">";
	}
	echo $tmp['msg']."</span>";
	die;
}

// ===== Проверяем password2 ========
if ($task == 'checkuserpass2'){
	$rpassword1 = sed_import('rpassword1','P','TXT',16);
	$rpassword2 = sed_import('rpassword2','P','TXT',16);

	if (empty($rpassword2) || $rpassword2 == ''){
		echo "";
		die;	
	}
	$tmp = an_adv_r_checkUserPass2($rpassword1, $rpassword2);
	if ($tmp['iserror']){
		echo "<img src=\"/plugins/an_adv_registration/img/bad.gif\" align=\"absmiddle\" /> <span style=\"color:#FF0000;\">";
	}else{
		echo "<img src=\"/plugins/an_adv_registration/img/good.gif\" align=\"absmiddle\" /> <span style=\"color:#4E9A06;\">";
	}
	echo $tmp['msg']."</span>";
	die;
}

// ===== Проверяем всю форму ========
if ($task == 'checkregform'){
	$rusername = sed_import('rusername','P','TXT', 100, TRUE);
	$rusername = str_replace('&#160;', '', $rusername);
	$ruseremail = sed_import('ruseremail','P','TXT',64, TRUE);
	$rpassword1 = sed_import('rpassword1','P','TXT',16);
	$rpassword2 = sed_import('rpassword2','P','TXT',16);
	$ruserterms = sed_import('ruserterms','P','TXT',16);
	
	$usr = an_adv_r_checkUsername($rusername);
	$mail = an_adv_r_checkEmail($ruseremail);
	$pass1 = an_adv_r_checkUserPass1($rpassword1);
	$pass2 = an_adv_r_checkUserPass2($rpassword1, $rpassword2);
	
	if ($cfg['plugin']['an_adv_registration']['termsOn'] == 'Yes' && $ruserterms == 'false'){
		$terms['iserror'] = 1;
		$terms['msg'] = $L['an_adv_registration']['termsacc'];
	}else{
		$terms['iserror'] = 0;
		$terms['msg'] = "";
	}

	
	$error = ($usr['iserror'] || $mail['iserror'] || $pass1['iserror'] || $pass2['iserror'] || $terms['iserror']) ? 1 : 0;
	
	
	echo json_encode(array(
		'error' => $error,
		'rusername' => $usr['msg'],
		'rusername_iserror' => $usr['iserror'],
		'ruseremail' => $mail['msg'],
		'ruseremail_iserror' => $mail['iserror'],
		'rpassword1' => $pass1['msg'],
		'rpassword1_iserror' => $pass1['iserror'],
		'rpassword2' => $pass2['msg'],
		'rpassword2_iserror' => $pass2['iserror'],
		'terms' => $terms['msg'],
		'terms_iserror' => $terms['iserror'],
		));
	die;
}

?>