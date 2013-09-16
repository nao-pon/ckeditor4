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
	private $Legacy_TextareaEditor_delete = false;
	
	public function __construct(&$controler) {
		parent::__construct($controler);
		if (! XC_CLASS_EXISTS('Legacy_TextareaEditor')) {
			$this->Legacy_TextareaEditor_delete = true;
		}
	}
	
	public function preBlockFilter() {
		$this->mRoot->mDelegateManager->reset('Site.TextareaEditor.BBCode.Show');
		$this->mRoot->mDelegateManager->add('Site.TextareaEditor.BBCode.Show',array(&$this, 'render'));
	}
	
	public function postFilter() {
		if ($this->Legacy_TextareaEditor_delete) {
			$this->mRoot->mDelegateManager->delete('Site.TextareaEditor.BBCode.Show', 'Legacy_TextareaEditor::renderBBCode');
		}
	}
}

?>
