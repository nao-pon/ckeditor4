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

		// [pagebreak]
		$patterns[] = '/\[pagebreak\]/';
		$replacements[0][] = '<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>';
		
		// [list] nested allow
		/// list style
		$list_open = '("$1"=="1"?"ol":
		("$1"=="a"?"ol style=\"list-style-type:lower-alpha\"":
		("$1"=="A"?"ol style=\"list-style-type:upper-alpha\"":
		("$1"=="r"?"ol style=\"list-style-type:lower-roman\"":
		("$1"=="R"?"ol style=\"list-style-type:upper-roman\"":
		("$1"=="d"?"ol style=\"list-style-type:decimal\"":
		("$1"=="D"?"ul style=\"list-style-type:disc\"":
		("$1"=="C"?"ul style=\"list-style-type:circle\"":
		("$1"=="S"?"ul style=\"list-style-type:square\"":"ul")))))))))';
		$list_close = '(("$1"=="1"||"$1"=="a"||"$1"=="A"||"$1"=="r"||"$1"=="R"||"$1"=="d")?"ol":"ul")';
		/// pre convert
		$patterns[] = '/\[list/';
		$replacements[0][] = "\x01";
		$patterns[] = '/\[\/list\]/';
		$replacements[0][] = "\x02";
		/// outer matting
		$patterns[] = '/\x01(?:\=([^\]]+))?\](?:\r\n|[\r\n])((?:(?>[^\x01\x02]+)|(?R))*)\x02(?:\r\n|[\r\n]|$)/eS';
		$replacements[0][] = '"<".'.$list_open.'.">$2</".'.$list_close.'.">"';
		/// [*] to <li></li>
		$patterns[] = '/\[\*\](.*?)(?:\r\n|[\r\n])([\r\n]*)(?=(?:\\[\*\]|<\/[uo]l>|[\x01\x02]))/sS';
		$replacements[0][] = '<li>$1$2</li>';
		/// post convert 1
		$patterns[] = '/<\/li>\x01[^\]]*\](?:\r\n|[\r\n])/';
		$replacements[0][] = '<ul>';
		/// post convert 2
		$patterns[] = '/\x02(?:\r\n|[\r\n])/';
		$replacements[0][] = '</ul></li>';
	}
}

?>
