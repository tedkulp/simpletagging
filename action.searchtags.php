<?php
if (!isset($gCms)) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Code for simpletagging "searchtags" action

   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
   Typically, this will display something from a template
   or do some other task.
   
*/

$this->smarty->assign('searchtag', $params[tag]);

$q = "SELECT module, page_id FROM ".cms_db_prefix()."module_simpletagging WHERE tag = '{$params['tag']}'";
$result = $db->Execute($q);

$results = array();
$hm =& $gCms->GetHierarchyManager();

while ($result && !$result->EOF) 
{
	$res = array();
	if ($result->fields['module'] == 'Core')
	{
		$curnode =& $hm->getNodeById($result->fields['page_id']);
		$curcontent =& $curnode->GetContent();
		$res['url'] = $curcontent->GetURL();
		$res['title'] = $curcontent->mName;
	}
	else if ($result->fields['module'] == 'News')
	{
		$row = $db->GetRow('SELECT * FROM ' . cms_db_prefix() . 'module_news WHERE news_id = ?', array($result->fields['page_id']));
		if (!$row)
		{
			continue;
		}
		$res['title'] = $row['news_title'];
		$news = $this->GetModuleInstance('News');
		if ($news)
		{
			$result1 = array();
			//0 position is the prefix displayed in the list results.
			$result1[0] = $news->GetFriendlyName();

			//1 position is the title
			$result1[1] = $row['news_title'];

			//2 position is the URL to the title.
			$aliased_title = munge_string_to_url($row['news_title']);
			$prettyurl = 'news/' . $result->fields['page_id'] . '/' . $returnid . "/$aliased_title";
			if (!empty($row['news_url']))
			{
				$prettyurl = $row['news_url'];
			}
			$result1[2] = $news->CreateLink('cntnt01', 'detail', $returnid, '', array('articleid' => $result->fields['page_id']) ,'', true, false, '', true, $prettyurl);

			$res['url'] = $result1[2];
		}
	}
	$res['othertags'] = array();
	$result1 = $db->Execute("SELECT tag FROM ".cms_db_prefix()."module_simpletagging WHERE page_id = ".$result->fields[page_id]." AND module = ? ORDER BY tag ASC", array($result->fields['module']));
	while ($result1 && !$result1->EOF) 
	{
		if ($result1->fields['tag'] != $params['tag'])
		{
			$taglink = $this->CreateLink($id, 'searchtags', $returnid, '', array('tag'=>$result1->fields['tag']),'', true, false);
			array_push($res['othertags'], "<a href='".$taglink."' class='taglink'>".$result1->fields['tag']."</a>");
		}
		$result1->moveNext();
	}

	array_push($results, $res);
	$result->moveNext();
}

$this->smarty->assign('results', $results);

echo $this->ProcessTemplateFromData($this->GetPreference('searchtemplate', $this->getDefaultSearchTemplate()));

?>
