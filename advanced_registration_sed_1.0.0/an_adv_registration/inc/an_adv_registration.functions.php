<?PHP
// *********************************************
// *    Скин:  "Alex-Natty-2"                  *
// *        JavaScript                         *
// *    Alex & Natty studio                    *
// *        http://portal30.ru                 *
// *                                           *
// *            © Alex & Naty Studio  2009     *
// *********************************************

defined('SED_CODE') or die('Wrong URL.');

/*
* Получим содержимое страницы по ее id или Alias
*/
function an_adv_r_getPage($id = 0, $al = ''){
	global $db_pages, $cfg, $usr;
	$sql = false;
	if ($al != ''){
		$sql= sed_sql_query("SELECT page_id, page_state, page_title, page_desc, page_text, page_alias, page_html, page_count, page_type, page_ownerid
			FROM $db_pages WHERE page_alias='".$al."' LIMIT 1");
	}elseif($id > 0){
		$sql = sed_sql_query("SELECT page_id, page_state, page_title, page_desc, page_text, page_alias, page_html, page_count, page_type, page_ownerid
			 FROM $db_pages WHERE page_id='".$id."'");
	}else{
		return false;
	}
	
	if ($sql){
		$pag = sed_sql_fetchassoc($sql);
		
		if (!$pag) return false;
		if ($pag['page_state'] == 1) return false;  // Не опубликовано
		
		// Увеличиваем счетчик просмотров
		if(!$usr['isadmin'] || $cfg['count_admin']){
			sed_sql_query("UPDATE $db_pages SET page_count=".($pag['page_count'] + 1)." WHERE page_id = ".$pag['page_id']);
		}
		
		if ($cfg['parser_cache']){
			// Парсим BB-код
			if ($pag['page_type'] == 0){
				// Кешируем страницу
				if (empty($pag['page_html'])&&!empty($pag['page_text'])){
					$pag['page_html'] = sed_parse(sed_cc($pag['page_text']), $cfg['parsebbcodepages'], $cfg['parsesmiliespages'], 1);
					sed_sql_query("UPDATE $db_pages SET page_html = '".sed_sql_prep($pag['page_html'])."' WHERE page_id = ".$pag['page_id']);
				}
				$html = $cfg['parsebbcodepages'] ? sed_post_parse($pag['page_html']) : sed_cc($pag['page_text']);
				$pag['text'] = $html;
			}else{
				$pag['text'] = sed_post_parse($pag['page_text']);
			}
		}else{
			// Парсим BB-код
			if ($pag['page_type'] == 0){
				$pag['text'] = sed_parse(sed_cc($pag['page_text']), $cfg['parsebbcodepages'], $cfg['parsesmiliespages'], 1);
				$pag['text'] = sed_post_parse($text, 'pages');
			}else{
				$pag['text'] = sed_post_parse($pag['page_text']);
			}
		} // if ($cfg['parser_cache']){
		unset($pag['page_text']);
		unset($pag['page_html']);
		
		// Ссылка на редактирование
		if ($usr['isadmin'] || $usr['id'] == $pag['page_ownerid']){
			$pag['admin_edit'] = "<a href=\"".sed_url('page', 'm=edit&id='.$pag['page_id'].'&r=list')."\">".$L['Edit']."</a>";
		}else{
			$pag['admin_edit'] = '';
		}
		
		// Ссылка на снятие с публикации / утверждение 
		
		if ($usr['isadmin']){
			if($pag['page_state'] == 1){
				$pag['validation'] = "<a href=\"".sed_url('admin', "m=page&s=queue&a=validate&id=".$pag['page_id']."&amp;".sed_xg())."\">".$L['Validate']."</a>";
			}else{
				$pag['validation'] = "<a href=\"".sed_url('admin', "m=page&s=queue&a=unvalidate&id=".$pag['page_id']."&amp;".sed_xg())."\">".$L['Putinvalidationqueue']."</a>";
			}
		}else{
			$pag['validation'] = '';
		}
	return $pag;
	}
	
	return false;
}

?>