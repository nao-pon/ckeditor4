<?php
/**
 * @file
 * @package ckeditor4
 * @version $Id$
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

class Ckeditor4_ParentTextArea extends XCube_ActionFilter
{
	/**
	 *	@public
	*/
	public function render(&$html, $params)
	{
		$chandler = xoops_gethandler('config');
		$conf = $chandler->getConfigsByDirname('ckeditor4');
		
		$root =& XCube_Root::getSingleton();
		$renderSystem =& $root->getRenderSystem(XOOPSFORM_DEPENDENCE_RENDER_SYSTEM);
		
		$renderTarget =& $renderSystem->createRenderTarget('main');
		
		$class = strtolower($params['editor']);
		if (! preg_match('/\b'.preg_quote($class).'\b/', $params['class'])) {
			$params['class'] .= $params['class']? ( ' ' . $class ) : $class;
		}
		
		$renderTarget->setAttribute('legacy_module', 'ckeditor4');
		$renderTarget->setTemplateName("ckeditor4_textarea.html");
		$renderTarget->setAttribute("element", $params);
		
		$renderSystem->render($renderTarget);
		
		$html = $renderTarget->getResult();
		
		$this->_addScript($params, $conf);
	}

	protected function _addScript(/*** string[] ***/ $params, $conf)
	{
		$root =& XCube_Root::getSingleton();
		$mUser = $root->mContext->mUser;
		
		// Get X-elFinder module
		$mHandler =& xoops_gethandler('module');
		$finder = $mHandler->getByDirname($conf['xelfinder']);
		
		// Check in a group
		$isAdmin = false;
		$isUser = false;
		$mGroups = array(XOOPS_GROUP_ANONYMOUS);
		if (is_object($mUser) && $mUser->isInRole('Site.RegisteredUser')) {
			$roleManager = new Legacy_RoleManager();
			$roleManager->loadRolesByDirname('ckeditor4');
			if ($mUser->isInRole('Module.ckeditor4.Admin')) {
				$isAdmin = true;
			}
			$isUser = true;
			$mGroups = $root->mContext->mXoopsUser->getGroups();
		}
		$inSpecialGroup = (array_intersect($mGroups, ( !empty($conf['special_groups'])? $config['special_groups'] : array() )));
		
		// Make config
		$config = array();
		
		$config['xoopscodeXoopsUrl'] = XOOPS_URL . '/';
		
		if (is_object($finder)) {
			$config['filebrowserBrowseUrl'] = XOOPS_MODULE_URL . '/' . $conf['xelfinder'] . '/manager.php?cb=ckeditor';
		}
		
		$config['removePlugins'] = 'save,newpage,forms,preview,print';
		if ($params['editor'] === 'bbcode') {
			$conf['extraPlugins'] = $conf['extraPlugins']? 'xoopscode,' . tirm($conf['extraPlugins']) : 'xoopscode';
			$config['fontSize_sizes'] = 'xx-small;x-small;small;medium;large;x-large;xx-large';
			//$config['removePlugins'] .= ',bidi,flash,iframe,indent,justify,list,pagebreak,pastefromword,preview,resize,table,tabletools,templates';
		}
		$config['extraPlugins'] = trim($conf['extraPlugins']);
		
		$config['customConfig'] = trim($conf['customConfig']);
		
		if ($params['editor'] === 'bbcode') {
			$config['toolbar'] = trim($conf['toolbar_bbcode']);
		} else if ($isAdmin) {
			$config['toolbar'] = trim($conf['toolbar_admin']);
		} else if ($inSpecialGroup) {
			$config['toolbar'] = trim($conf['toolbar_special_group']);
		} else if ($isUser) {
			$config['toolbar'] = trim($conf['toolbar_user']);
		} else {
			$config['toolbar'] = trim($conf['toolbar_guest']);
		}
		
		// Make config json
		$config_json = array();
		foreach($config as $key => $val) {
			if ($val[0] !== '[') {
				$val = json_encode($val);
			}
			$config_json[] = '"' . $key . '":' . $val;
		}
		$config_json = '{' .join($config_json, ','). '}';
		
		// Add script into HEAD
		$root = XCube_Root::getSingleton();
		$jQuery = $root->mContext->getAttribute('headerScript');
		$jQuery->addScript('var ckconfig_'.$params['id'].' = '.$config_json.';');
		$jQuery->addScript('CKEDITOR.replace( "'.$params['id'].'", ckconfig_'.$params['id'].');');
		$jQuery->addScript('CKEDITOR.instances.'.$params['id'].'.on("blur", function(e) { e.editor.updateElement(); });');
		$jQuery->addLibrary('/modules/ckeditor4/ckeditor/ckeditor.js');
	}
}

?>
