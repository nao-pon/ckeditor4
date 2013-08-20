<?php
function xoops_module_update_ckeditor4() {
	$module_handler = xoops_gethandler('module');
	$Module = $module_handler->getByDirname('ckeditor4');
	$config_handler = xoops_gethandler('config');
	$ModuleConfig = $config_handler->getConfigsByCat(0, $Module->mid());
	if (substr($ModuleConfig['toolbar_user'], -4) === '""]]') {
		//fix typo '""]]' to '"]]' for version <= 0.37
		$criteria = new CriteriaCompo(new Criteria('conf_modid', $Module->mid()));
		$criteria->add(new Criteria('conf_catid', 0));
		$criteria->add(new Criteria('conf_name', 'toolbar_user'));
		if ($configs = $config_handler->_cHandler->getObjects($criteria)) {
			$val = str_replace('""]]', '"]]', $ModuleConfig['toolbar_user']);
			$configs[0]->setVar('conf_value', $val, true);
			$config_handler->insertConfig($configs[0]);
		}
	}
	return true;
}