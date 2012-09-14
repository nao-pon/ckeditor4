<?php
/**
 * @file
 * @package ckeditor4
 * @version $Id$
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

class ckeditor4_TextArea extends XCube_ActionFilter
{
	/**
	 * @public
	 */
	function preBlockFilter()
	{
		$this->mRoot->mDelegateManager->reset('Site.TextareaEditor.HTML.Show');
		$this->mRoot->mDelegateManager->add('Site.TextareaEditor.HTML.Show',array(&$this, 'render'));
	}

	/**
	 *	@public
	*/
	public function render(&$html, $params)
	{
		$root =& XCube_Root::getSingleton();
		$renderSystem =& $root->getRenderSystem(XOOPSFORM_DEPENDENCE_RENDER_SYSTEM);
		
		$renderTarget =& $renderSystem->createRenderTarget('main');
		
		$renderTarget->setAttribute('legacy_module', 'ckeditor4');
		$renderTarget->setTemplateName("ckeditor4_textarea.html");
		$renderTarget->setAttribute("element", $params);
		
		$renderSystem->render($renderTarget);
		
		$html = $renderTarget->getResult();
		
		$this->_addScript($params);
	}

	protected function _addScript(/*** string[] ***/ $params)
	{

		$xelfinder = 'xelfinder';
		$mHandler =& xoops_gethandler('module');
		$finder = $mHandler->getByDirname($xelfinder);
		
		$config = array();
		if (is_object($finder)) {
			$config['filebrowserBrowseUrl'] = XOOPS_MODULE_URL . '/' . $xelfinder . '/manager.php?cb=ckeditor';
		}
		$config['toolbar'] = 'Basic';
		//$config['uiColor'] = '#E4E4E4';
		$config_json = json_encode($config);
		
		$root = XCube_Root::getSingleton();
		$jQuery = $root->mContext->getAttribute('headerScript');
		$jQuery->addScript('var ckconfig_'.$params['id'].' = '.$config_json.';');
		$jQuery->addScript('CKEDITOR.replace( "'.$params['id'].'", ckconfig_'.$params['id'].');');
		$jQuery->addLibrary('/modules/ckeditor4/ckeditor/ckeditor.js');
	}
}

?>
