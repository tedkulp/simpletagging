<?php
if (!isset($gCms)) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Code for simpletagging "tagcloud" action

   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
   Typically, this will display something from a template
   or do some other task.
   
*/

$min_fontsize = $this->GetPreference('minfontsize', 8);
$max_fontsize =	$this->GetPreference('maxfontsize', 16);
$delimiter = $this->GetPreference('delimiter', ', ');

$q = "SELECT tag, count(*) AS count FROM ".cms_db_prefix()."module_simpletagging GROUP BY tag ORDER BY count DESC";
$result = $db->Execute($q);

$max = $result->fields[count];
$result->moveLast();
$min = $result->fields[count];

$diff = $max - $min;
$diff = max(1, $diff);

$font_diff = $max_fontsize - $min_fontsize;
$step = round($font_diff / $diff);

$q = "SELECT tag, count(*) AS count FROM ".cms_db_prefix()."module_simpletagging GROUP BY tag ORDER BY tag ASC";
$result = $db->Execute($q);

$cloud = "";

while ($result && !$result->EOF)
{
	if ($result->fields[tag] != '') {
		$fontsize = $min_fontsize + ($result->fields[count] - 1) * $font_diff;
		$taglink = $this->CreateLink($id, 'searchtags', $returnid, '', array('tag'=>$result->fields[tag]),'', true, false);
		$cloud .= "<a class='tagcloudlink' href='" . $taglink . "' style='font-size: " . $fontsize . "px;'>" . $result->fields[tag] . "</a>" . $delimiter;
	}
	$result->moveNext();
}

echo substr($cloud, 0, strlen($cloud) - strlen($delimiter));
?>