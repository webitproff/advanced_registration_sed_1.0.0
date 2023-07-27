<!-- BEGIN: MAIN -->

<div class="mboxHD">
	<a href="{PHP.cfg.mainurl}" title="{PHP.skinlang.header.Home}">
    	<img src="skins/{PHP.skin}/img/system/icon-home.gif" alt="{PHP.cfg.maintitle}" align="absmiddle" width="16" height="16" />
	</a>&nbsp;{PHP.cfg.separator}
	{USERS_REGISTER_TITLE}
</div>

<div id="subtitle">
	<h1>{USERS_REGISTER_TITLE}</h1>
	<strong>{USERS_REGISTER_SUBTITLE}</strong>
</div>

<!-- BEGIN: USERS_REGISTER_ERROR -->
<div class="error">{USERS_REGISTER_ERROR_BODY}</div>
<!-- END: USERS_REGISTER_ERROR -->

<form name="register" id="register" action="{USERS_REGISTER_SEND}" method="post">
	<div class="tCap2"></div>
	<table class="cells" border="0" cellspacing="1" cellpadding="2">
		<tr>
			<td style="width:176px;">{PHP.L.Username} ({PHP.skinlang.usersregister.Login}):</td>
			<td>{USERS_REGISTER_USER} * {USERS_REGISTER_USER_MSG}</td>
		</tr>
		<tr>
			<td>{PHP.skinlang.usersprofile.realname}:</td>
			<td><input type="text" maxlength="100" size="24" value="" name="ruserextra2" class="text"/></td>
		</tr>
		<tr>
			<td>{PHP.skinlang.usersregister.Validemail}:</td>
			<td>{USERS_REGISTER_EMAIL} * {USERS_REGISTER_EMAIL_MSG}<br />
			{PHP.skinlang.usersregister.Validemailhint}</td>
		</tr>
		<tr>
			<td>{PHP.L.Password}:</td>
			<td>{USERS_REGISTER_PASSWORD} * {USERS_REGISTER_PASSWORD_MSG}</td>
		</tr>
		<tr>
			<td>{PHP.skinlang.usersregister.Confirmpassword}:</td>
			<td>{USERS_REGISTER_PASSWORDREPEAT} * {USERS_REGISTER_PASSWORDREPEAT_MSG}</td>
		</tr>
		<tr>
			<td>{PHP.L.Country}:</td>
			<td>{USERS_REGISTER_COUNTRY}</td>
		</tr>
		<tr>
			<td>{PHP.L.Location}:</td>
			<td><input type="text" maxlength="100" size="24" value="" name="rlocation" class="text"/></td>
		</tr>
		<tr>
			<td>{PHP.skinlang.usersregister.Captcha}:</td>
			<td>
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td style="border:none">{USERS_REGISTER_VERIFYIMG}</td>
						<td style="border:none; vertical-align:middle" valign="middle">{USERS_REGISTER_VERIFYINPUT}</td>
					</tr>
				</table>
		</tr>
		<!-- IF {USERS_REGISTER_TERMS} -->
		<tr>
			<td colspan="2" align="center">{USERS_REGISTER_TERMS_CHK}<br />{USERS_REGISTER_TERMS_MSG}</td>
		</tr>
		<!-- ENDIF -->
		<tr>
			<td colspan="2">{PHP.skinlang.usersregister.Formhint}</td>
		</tr>
		<tr>
			<td colspan="2" class="valid">{USERS_REGISTER_SEND_MSG} <input type="submit" value="{PHP.L.Submit}" /> </td>
		</tr>
	</table>
	<div class="bCap"></div>
</form>

<!-- END: MAIN -->
