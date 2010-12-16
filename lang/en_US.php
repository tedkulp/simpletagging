<?php
$lang['friendlyname'] = 'Simple Tagging';
$lang['postinstall'] = 'Simple Tagging has been successfully installed. Please see the documentation on usage hints!';
$lang['postuninstall'] = 'Simple Tagging has been uninstalled and all tag data has been erased.';
$lang['really_uninstall'] = 'Really? Are you sure
you want to unsinstall this fine module?';
$lang['uninstalled'] = 'Module Uninstalled.';
$lang['installed'] = 'Module version %s installed.';
$lang['upgraded'] = 'Module upgraded to version %s.';
$lang['moddescription'] = 'Simple Tagging adds the ability to link tags to pages and provide links to related pages';

$lang['error'] = 'Error!';
$land['admin_title'] = 'Simple Tagging Admin Panel';
$lang['admindescription'] = 'Allows you to add semantic tags to pages and display a tag cloud and a list of related pages.';
$lang['accessdenied'] = 'Access Denied. Please check your permissions.';
$lang['Tagsearchtemplate'] = 'Templates';
$lang['Tagcloudsettings'] = 'Settings';
$lang['title_tagsearchtemplate'] = 'Templates';
$lang['title_tagcloudsettings'] = 'Settings';

$lang['simpletagging_admin'] = 'Change settings for Simple Tagging';
$lang['simpletagging_admin_header'] = 'Here you can change the settings for your Simple Tagging module and the tag appearance.';
$lang['simpletagging_admin_footer'] = '';
$lang['submit'] = 'Save';
$lang['searchtemplate'] = 'Template for tag search';
$lang['tagstemplate'] = 'Template for tag display';
$lang['relatedtemplate'] = 'Template für verwandte Seiten';
$lang['tagcloud'] = 'Tagcloud settings';
$lang['tagcloud_minfontsize'] = 'Minimum font size (px)';
$lang['tagcloud_maxfontsize'] = 'Maximum font size (px)';
$lang['tagcloud_delimiter'] = 'Tag delimiter';
$lang['relatedpages'] = 'Settings for related pages';
$lang['related_coverage'] = 'Tag coverage for related pages (%)';
$lang['related_max'] = 'Maximum related pages';
$lang['reload_tags'] = 'Reload tags';
$lang['reload_tags_info'] = 'Use this function to reload all page tags, e.g. after an update.';

$lang['templates_saved'] = 'Your templates have been saved.';
$lang['settings_saved'] = 'Your settings have been saved.';
$lang['tags_reloaded'] = 'All tags have been reloaded from the pages.';

$lang['no_tags'] = 'none';

$lang['defaultsearchtemplate'] = '
<h3>Pages containing information about <i>{$searchtag}</i></h3>
<ul>
{foreach from=$results item=result}
  <li><a href="{$result.url}">{$result.title}</a><br />
    <b>Other tags:</b> {foreach from=$result.othertags item=tag}
      {$tag} 
    {/foreach}
  </li>
{/foreach}
</ul>
';

$lang['defaulttagtemplate'] = '
<b>More information on:</b>
  {foreach from=$tags item=tag}
  <a href="{$tag.url}">{$tag.title}</a>
    {if $tag.delimiter == true}, {/if}
  {/foreach}
';

$lang['defaultrelatedtemplate'] = '
<b>Related pages:</b>
<ul>
  {foreach from=$related item=page}
  <li><a href="{$page.url}">{$page.title}</a> ({$page.percentage}%)</li>
  {/foreach}
</ul>
';

$lang['changelog'] = '<ul>
<li>Version 0.2 - 10 June 2008.
	<ul>
	<li><b>FIX:</b> No delimiter is shown as first item in the tag cloud</li>
	<li><b>NEW:</b> The "related pages" feature is introduced</li>
	<li><b>NEW:</b> The page tags list is now customizable by a template</li>
	<li><b>NEW:</b> You can automatically reload all tags after manually upgrading the module or when something breaks.</li>
	<li><b>FIX:</b> Compatibility with 1.3</li>
	<li><b>FIX:</b> Minor fixes and improvements</li>
	</ul>
</li>
<li>Version 0.1 - 3 June 2008. Initial Release.</li>
</ul>';
$lang['help'] = '<h3>What Does This Do?</h3>
<p>Adds the ability to link tags to pages and provide links to related pages</p>
<h3>How Do I Use It</h3>
<p>Before you can start adding tags to your content pages, you need to include a content block for the tags into all templates for pages that use tags. Edit your template and insert the following line into the template code, preferably after the last content block used in this template:<br /><br />
<i>&lt;!-- {content block="Tags" wysiwyg="false" oneline="true"} --&gt;</i><br /><br />
This will add another (hidden) content block to the page which you can edit from your "Content" admin module. Simple Tagging will automatically index your pages according to the tags you enter there. As a side effect, those tags will also be indexed by the default search engine.</p>
<p>To add tags to your page, edit the page as you are used to and enter a list of tags separated by commas into the input field labelled "Tags".</p>
<h3>How do I embed the tag list, a list of related pages or a tag cloud into a page?</h3>
<p>It is recommended to add the call to the tag list and the related pages list directly into the template. Insert the following tag to display a list of tags assigned to the current page:
<br /><br />
<i>{cms_module module="simpletagging"}</i></p>
<p>To display a list of related pages (based on tag coverage), insert the following tag into your page or template:
<br /><br />
<i>{cms_module module="simpletagging" action="related"}</i></p>
<p>To embed a tag cloud somewhere in your page, enter the following tag into your page or template:<br /><br />
<i>{cms_module module="simpletagging" action="tagcloud"}</i></p>
<h3>How can I change the apperance of the Simple Tagging module?</h3>
<p>To style the tag links, create a css class for <i>a.taglink</i> (used in the tag list and the tag search results) and <i>a.tagcloudlink</i> (used in the tag cloud).</p>
<p>To change the appearance of the tag search results, change the "Tag search template" in the administration panel. To change the minimum and maximum font sizes used in the tag cloud, change the values in the "Tag cloud settings" administration panel.</p>
<p>To adjust the settings for your related pages, edit the settings in the administration panel and change the values for related pages to your likings. The "tag coverage" is a percentage to determine if a page is really related - the default is 50 which means that a related page must contain at least half of the tags that have been used in the original page. The "Maximum related pages" option determines how many related pages (that match the tag coverage) shoud be displayed.
<h3>Special Feature: News Editing Cloud</h3>
<p>For a client, I\'ve added the ability to show a list of the current tags right under your Tags field when editing News articles.  However, it does require hacking
a file in News. This will break everytime you upgrade CMSMS, so please take that into consideration when using this feature.  Still interested?</p>
<p>Find the templates/editarticle.tpl file in News and open it in your favorite editor.  After <em>&lt;p class="pageinput"&gt;{$field->field}&lt;/p&gt;</em>. After it, add the following code:</p>
<p>
{if $field->prompt == \'Tags\' || $field->prompt == \'tags\'}<br />
    &lt;p class="pageinput" style="padding: 1em;"&gt;<br />
        {cms_module module=\'simpletagging\' action=\'newscloud\' field_text=$field-&gt;field}<br />
    &lt;/p&gt;<br />
{/if}
</p>
<p>Then save the file. You\'re done.</p>
<h3>Support</h3>
<p>As per the GPL, this software is provided as-is. Please read the text of the license for the full disclaimer.</p>
<h3>Copyright and License</h3>
<p>Copyright &copy; 2008, Henning Schaefer <a href="mailto:henning.schaefer@gmail.com">&lt;henning.schaefer@gmail.com&gt;</a>. All Rights Are Reserved.</p>
<p>This module has been released under the <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU Public License</a>. You must agree to this license before using the module.</p>';
?>
