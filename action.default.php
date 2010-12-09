<?php
if (!isset($gCms)) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Code for simpletagging "default" action

   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
   Typically, this will display something from a template
   or do some other task.
   
*/

$q = "SELECT tag FROM ".cms_db_prefix()."module_simpletagging WHERE page_id = ".$gCms->variables['content_id'];
$result = $db->Execute($q);

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
