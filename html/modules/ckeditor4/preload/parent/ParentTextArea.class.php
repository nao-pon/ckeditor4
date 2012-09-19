<?php
/**
 * @file
 * @package ckeditor4
 * @version $Id$
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once dirname(dirname(dirname(__FILE__))) . '/class/Ckeditor4Utiles.class.php';

class Ckeditor4_ParentTextArea extends XCube_ActionFilter
{
	/**
	 *	@public
	*/
	public function render(&$html, $params)
	{
		$js = Ckeditor4_Utils::getJS($params);
		
		$root =& XCube_Root::getSingleton();
		$renderSystem =& $root->getRenderSystem(XOOPSFORM_DEPENDENCE_RENDER_SYSTEM);
		
		$renderTarget =& $renderSystem->createRenderTarget('main');
		$renderTarget->setAttribute('legacy_module', 'ckeditor4');
		$renderTarget->setTemplateName("ckeditor4_textarea.html");
		$renderTarget->setAttribute("element", $params);
		
		$renderSystem->render($renderTarget);
		
		$html = $renderTarget->getResult();

		// Add script into HEAD
		$jQuery = $root->mContext->getAttribute('headerScript');
		$jQuery->addScript($js);
		$jQuery->addLibrary('/modules/ckeditor4/ckeditor/ckeditor.js');
	}
}
?>