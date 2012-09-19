<?php
/**
 * @file
 * @package ckeditor4
 * @version $Id$
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once dirname(dirname(__FILE__)) . '/class/Ckeditor4Utiles.class.php';

class ckeditor4_TextAreaBBCode extends Ckeditor4_ParentTextArea
{
	/**
	 * @public
	 */
	function preBlockFilter()
	{
		$this->mRoot->mDelegateManager->reset('Site.TextareaEditor.BBCode.Show');
		$this->mRoot->mDelegateManager->add('Site.TextareaEditor.BBCode.Show',array(&$this, 'render'));
	}
}

?>
