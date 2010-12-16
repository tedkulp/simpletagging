<?php
if (!isset($gCms)) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Code for simpletagging "tagcloud" action

   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
   Typically, this will display something from a template
   or do some other task.
   
*/

$delimiter = $this->GetPreference('delimiter', ', ');

$q = "SELECT tag, count(*) AS count FROM ".cms_db_prefix()."module_simpletagging WHERE module = ? GROUP BY tag ORDER BY count DESC";
$result = $db->Execute($q, array('news'));

$max = $result->fields['count'];
$result->moveLast();
$min = $result->fields['count'];

$field_name = '';
$matches = array();
if (preg_match('/id=\"(.*?)\"/', $params['field_text'], $matches))
{
	if ($matches[1])
		$field_name = $matches[1];
}

//No field?  Bail.
if ($field_name == '')
	return '';

$q = "SELECT tag, count(*) AS count FROM ".cms_db_prefix()."module_simpletagging WHERE module = ? GROUP BY tag ORDER BY tag ASC";
$result = $db->Execute($q, array('news'));

$cloud = "";

while ($result && !$result->EOF)
{
	if ($result->fields['tag'] != '')
	{
		$cloud .= "<a class='tagcloudlink' href='javascript:clickme(\"".$result->fields['tag']."\")'>" . $result->fields['tag'] . "</a>" . $delimiter;
	}
	$result->moveNext();
}

echo "
<script>
	function clickme(tag)
	{
		var current_text = $('input[name=\"" . $field_name . "\"]').val();
		if (current_text != '')
		{
			current_text = current_text + ',';
		}
		current_text = current_text + tag;
		$('input[name=\"" . $field_name . "\"]').val(current_text);
	}
</script>
";

echo substr($cloud, 0, strlen($cloud) - strlen($delimiter));
