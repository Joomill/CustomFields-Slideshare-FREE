<?php
/**
 *  package: Custom Fields - Slideshare plugin - FREE Version
 *  copyright: Copyright (c) 2020. Jeroen Moolenschot | Joomill
 *  license: GNU General Public License version 3 or later
 *  link: https://www.joomill-extensions.com
 */

// No direct access.
defined('_JEXEC') or die;

use Joomla\CMS\Factory;

//add stylesheet for responsive container
$document = Factory::getDocument();
$document->addStylesheet('plugins/fields/slideshare/tmpl/style.css');

$value = $field->value;
$width = $fieldParams->get('width','100%');
$height = $fieldParams->get('height','300px');

//116 Extra replace to ensure embed urls transformed to valid xhtml (&amp;) in WISIWYG editor will be handled correctly
$tidiedoriginal = str_replace("&amp;","&", $value);

//Explode embedded code into parts to be able to identify id of various lengths
$embedParts = explode("&", $tidiedoriginal);

//Make sure trailing ] is to be removed from new type embed url without &w=425, and still keep backward compatibility of older embeds
if(isset($embedParts[1])){
	$embedtidyup = explode("]", $embedParts[1]);
}
//Isolate unique id by removing [slideshare id= and store in $cleaned_id
	$cleaned_id = explode("=", $embedParts[0]);

//Unique id is same as isolated cleaned
if(isset($cleaned_id[1])){
	$cleaned_id2 = $cleaned_id[1];
}
else {
	$cleaned_id2 = $cleaned_id;
}

if ($value == '')
{
	return;
}

echo '<div align="left" id="ss_'. $cleaned_id2.'">
<iframe  style="border:1px solid #CCC;border-width:1px 1px 0;margin-bottom:5px" src="//www.slideshare.net/slideshow/embed_code/'. $cleaned_id2.'" width="'.$width.'" height="'.$height.'"  frameborder="0" marginwidth="0" marginheight="0" scrolling="no"> </iframe>
</div>';