<?php
if (!isset($gCms)) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Code for simpletagging "default" action

   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
   Typically, this will display something from a template
   or do some other task.
   
*/

$content_id = $gCms->variables['content_id'];
if (isset($params['content_id']))
	$content_id = $params['content_id'];

$module_name = 'Core';
if (isset($params['module_name']))
	$module_name = $params['module_name'];

$q = "SELECT tag FROM ".cms_db_prefix()."module_simpletagging WHERE page_id = ? AND module = ?";
$result = $db->Execute($q, array($content_id, $module_name));

$taglist = "";
$tags = array();

while ($result && !$result->EOF) 
{
	$tmp = array();
	$tmp['url'] = $this->CreateLink($id, 'searchtags', $returnid, '', array('tag'=>$result->fields['tag']),'', true, false);
	$tmp['title'] = $result->fields['tag'];
	$tmp['delimiter'] = true;
	array_push($tags, $tmp);
	$result->moveNext();
}

if (count($tags) > 0) {
	$tags[count($tags) - 1]['delimiter'] = false;
	$smarty->assign('tags', $tags);
	echo $this->ProcessTemplateFromData($this->GetPreference('tagtemplate', $this->getDefaultTagTemplate()));
}
