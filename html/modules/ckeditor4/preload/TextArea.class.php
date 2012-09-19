<?php
/**
 * @file
 * @package ckeditor4
 * @version $Id$
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once dirname(dirname(__FILE__)) . '/class/Ckeditor4Utiles.class.php';

class ckeditor4_TextArea extends Ckeditor4_ParentTextArea
{
	/**
	 * @public
	 */
	function preBlockFilter()
	{
		$this->mRoot->mDelegateManager->reset('Site.TextareaEditor.HTML.Show');
		$this->mRoot->mDelegateManager->add('Site.TextareaEditor.HTML.Show',array(&$this, 'render'));
	}
}

?>
