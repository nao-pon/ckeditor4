<?php

if ( !defined('XOOPS_ROOT_PATH') ) exit;

class ckeditor4_myConfig extends XCube_ActionFilter
{
	public function postFilter() {
		$this->mRoot->mDelegateManager->add('Ckeditor4.Utils.PreBuild_ckconfig',      array($this, 'PreBuild'));
		$this->mRoot->mDelegateManager->add('Ckeditor4.Utils.PreParseBuild_ckconfig', array($this, 'PreParseBuild'));
		$this->mRoot->mDelegateManager->add('Ckeditor4.Utils.PostBuild_ckconfig',     array($this, 'PostBuild'));
	}

	public function PreBuild(&$params) {
		/******************************
		 * ckeditor 用の JavaScript を生成するのに先立ち、
		 * Smarty プラグインなどから得られた params を変更できます。
		 * 
		 * $params['id']     : <textarea> の id 属性
		 * $params['name']   : <textarea> の name 属性
		 * $params['class']  : <textarea> の class 属性
		 * $params['style']  : <textarea> の style 属性
		 * $params['cols']   : <textarea> の cols 属性
		 * $params['rows']   : <textarea> の rows 属性
		 * $params['value']  : <textarea> の 値
		 * $params['editor'] : ckeditor4 のエディアモード "html" 又は "bbcode"
		 * $params['toolbar']: 表示するツールバー(JavaScript の配列表記)
		 *
		 ******************************/
		 
	}

	public function PreParseBuild(&$config, $params) {
		/******************************
		 * ckeditor 用の JavaScript を生成するのに先立ち、
		 * ckeditor の config 値を変更できます。
		 * $config 配列のキー名が ckeditor.config のキー名に対応しています。
		 * ここでの設定は、ckeditor4 モジュールの一般設定の値で上書きされます。
		 * また、['toolbar'] は $params['toolbar'] で上書きされます。
		 * 
		 ******************************/
		
		// 例: config.removePlugins を "save,forms" に設定する
		$config['removePlugins'] = 'save,forms';
		
	}

	public function PostBuild(&$config, $params) {
		/******************************
		 * ckeditor 用の JavaScript を生成するのに先立ち、
		 * ckeditor の config 値を変更できます。
		 * $config 配列のキー名が ckeditor.config のキー名に対応しています。
		 * この設定のタイミングは、ckeditor4 モジュールの一般設定の値を評価後に
		 * なりますので、一般設定の値を上書きできます。
		 * また、モード毎の設定が $config['_modeconf'] に
		 * モード("html", "bbcode")をキーとして保存されているので、モード別の値は
		 * $config['_modeconf']['html']['toolbar'] などを変更する必要があります。
		 * モード別に予め設定されているものは次の通りです。
		 * ['fontSize_sizes'], ['extraPlugins'], ['enterMode'], ['shiftEnterMode'], ['toolbar']
		 * 
		 ******************************/
		
		// 例: カレントモジュールが d3forum の場合の html モードのツールバーを設定する
		if ($this->mRoot->mContext->mXoopsModule->get('trust_dirname') === 'd3forum') {
			$config['_modeconf']['html']['toolbar'] = '[["PasteText","-","Undo","Redo"],["Bold","Italic","Underline","Strike","-","TextColor","-","RemoveFormat","FontSize"],["NumberedList","BulletedList","Outdent","Indent","Blockquote"],["Link","Image","Smiley","PageBreak"],["Maximize", "ShowBlocks","-","About"]]';
		}
		
	}
}

