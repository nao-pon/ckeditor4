<?php
/**
 * @file
 * @package ckeditor4
 * @version $Id$
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

class ckeditor4_TextFilter extends XCube_ActionFilter
{
	/**
	 * @public
	 */
	function preBlockFilter()
	{
		$this->mRoot->mDelegateManager->add('Legacy_TextFilter.MakeXCodeConvertTable', array(&$this, 'filter'));
	}
	
	function filter(&$patterns, &$replacements)
	{
		// [img align=left width=10 height=10]
		$patterns[] = '/\[img(?:\s+align=([\'"]?)(left|center|right)\1)?(?:\s+w(?:idth)?=([\'"]?)([\d]+?)\3)?(?:\s+h(?:eight)?=([\'"]?)([\d]+?)\5)?]([!~*\'();\/?:\@&=+\$,%#\w.-]+)\[\/img\]/US';
		$replacements[0][] = '<a href="$7" target="_blank">$7</a>';
		$replacements[1][] = '<img src="$7" align="$2" width="$4" height="$6" alt="" />';
		
		// [img align=left title=hoge width=10 height=10]
		$patterns[] = '/\[img(?:\s+align=([\'"]?)(left|center|right)\1)?\s+title=([\'"]?)((?(3).*|[^\]\s]*))\3(?:\s+w(?:idth)?=([\'"]?)([\d]+?)\5)?(?:\s+h(?:eight)?=([\'"]?)([\d]+?)\7)?]([!~*\'();\/?:\@&=+\$,%#\w.-]+)\[\/img\]/USe';
		$replacements[0][] = '\'<a href="$9" target="_blank">$9</a>\'';
		$replacements[1][] = '\'<img src="$9" align="$2" width="$6" height="$8" alt="\'.htmlspecialchars(str_replace(\'\\"\', \'"\', \'$4\')).\'" title="\'.htmlspecialchars(str_replace(\'\\"\', \'"\', \'$4\')).\'" />\'';

		// [siteimg align=left width=10 height=10]
		$patterns[] = '/\[siteimg(?:\s+align=([\'"]?)(left|center|right)\1)?(?:\s+w(?:idth)?=([\'"]?)([\d]+?)\3)?(?:\s+h(?:eight)?=([\'"]?)([\d]+?)\5)?]([!~*\'();\/?:\@&=+\$,%#\w.-]+)\[\/siteimg\]/US';
		$replacements[0][] = 
		$replacements[1][] = '<img src="'.XOOPS_URL.'/$7" align="$2" width="$4" height="$6" alt="" />';
		
		// [siteimg align=left title=hoge width=10 height=10]
		$patterns[] = '/\[siteimg(?:\s+align=([\'"]?)(left|center|right)\1)?\s+title=([\'"]?)((?(3).*|[^\]\s]*))\3(?:\s+w(?:idth)?=([\'"]?)([\d]+?)\5)?(?:\s+h(?:eight)?=([\'"]?)([\d]+?)\7)?]([!~*\'();\/?:\@&=+\$,%#\w.-]+)\[\/siteimg\]/USe';
		$replacements[0][] = 
		$replacements[1][] = '\'<img src="'.XOOPS_URL.'/$9" align="$2" width="$6" height="$8" alt="\'.htmlspecialchars(str_replace(\'\\"\', \'"\', \'$4\')).\'" title="\'.htmlspecialchars(str_replace(\'\\"\', \'"\', \'$4\')).\'" />\'';
	}
}

?>
