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
		// [img align=left title=hoge width=10 height=10]
		$patterns[] = '/\[img(?:\s+align=(&quot;|&#039;)?(left|center|right)(?(1)\1))?(?:\s+title=(&quot;|&#039;)?((?(3)[^]]*|[^\]\s]*))(?(3)\3))?(?:\s+w(?:idth)?=(&quot;|&#039;)?([\d]+?)(?(5)\5))?(?:\s+h(?:eight)?=(&quot;|&#039;)?([\d]+?)(?(7)\7))?]([!~*\'();\/?:\@&=+\$,%#\w.-]+)\[\/img\]/US';
		$replacements[0][] = '<a href="$9" title="$4" target="_blank">$9</a>';
		$replacements[1][] = '<img src="$9" align="$2" width="$6" height="$8" alt="$4" title="$4" />';

		// [siteimg align=left title=hoge width=10 height=10]
		$patterns[] = '/\[siteimg(?:\s+align=(&quot;|&#039;)?(left|center|right)(?(1)\1))?(?:\s+title=(&quot;|&#039;)?((?(3)[^]]*|[^\]\s]*))(?(3)\3))?(?:\s+w(?:idth)?=(&quot;|&#039;)?([\d]+?)(?(5)\5))?(?:\s+h(?:eight)?=(&quot;|&#039;)?([\d]+?)(?(7)\7))?]([!~*\'();\/?:\@&=+\$,%#\w.-]+)\[\/siteimg\]/US';
		$replacements[0][] = 
		$replacements[1][] = '<img src="'.XOOPS_URL.'/$9" align="$2" width="$6" height="$8" alt="$4" title="$4" />';
	}
}

?>
