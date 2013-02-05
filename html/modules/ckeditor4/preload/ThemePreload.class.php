<?php
if (!defined('XOOPS_ROOT_PATH')) exit();

/**
 * themes/[theme]/ckeditor4/preload.class.php が存在すれば、それを読み込むプリロード
 * 
 * preload.class.php のクラス名は "ckeditor4_PreloadForTheme" 固定
 * setParams, preSetConfig, postSetConfig の3つの method を持つことができる
 * それぞれの method は必要な物だけでよい
 * 
 * @ param array $params Smarty プラグインから与えられたパラメタ
 * @ param array $config CKEditor に与える config 配列
 *                       key(string): config 名 
 *                       val(mixed) : 値  [] で括った文字列は、JavaScript のオブジェクトとして扱われる 
 *                                      その他の値は json_encode で処理され、 CKEditor に渡される
 * 
 * class ckeditor4_PreloadForTheme
 * {
 *     var $themeName; // 現在のテーマ名がセットされる
 *     
 *     // Smarty プラグインがから渡されたパラメタをカスタムする用
 *     function setParams(& $params) {}
 *     
 *     // ckeditor.config をカスタムする用
 *     // (Params 解釈前: Smarty プラグインで指定した toolbar や管理画面:一般設定の config は上書きできない)
 *     function preSetConfig(& $config, $params) {}
 *     
 *     // ckeditor.config をカスタムする用
 *     // (最終段階: すべての config を上書きできる)
 *     function postSetConfig(& $config, $params) {}
 * }
 * 
 * @author nao-pon
 */

class ckeditor4_ThemePreload extends XCube_ActionFilter
{
	var $preloadTheme = null;
	
	function postFilter() {
		// Smarty プラグインがから渡されたパラメタをカスタムする用
		$this->mRoot->mDelegateManager->add('Ckeditor4.Utils.PreBuild_ckconfig', array(& $this, 'setParams'));
		
		// ckeditor.config をカスタムする用 (Params 解釈前: Smarty プラグインで指定した toolbar や管理画面:一般設定の config は上書きできない)
		$this->mRoot->mDelegateManager->add('Ckeditor4.Utils.PreParseBuild_ckconfig', array(& $this, 'preSetConfig'));
		
		// ckeditor.config をカスタムする用 (最終段階: すべての config を上書きできる)
		$this->mRoot->mDelegateManager->add('Ckeditor4.Utils.PostBuild_ckconfig', array(& $this, 'postSetConfig'));
		
	}
	
	/**
	 * setParams
	 * Smarty プラグインがから渡されたパラメタをカスタムする用
	 * 
	 * @param array $params
	 */
	function setParams(& $params) {
		
		$themeName = $this->mRoot->mContext->mXoopsConfig['theme_set'];
		$_preload = XOOPS_THEME_PATH . '/' . $themeName . '/ckeditor4/preload.class.php';
		@ include_once $_preload;
		
		if (! class_exists('ckeditor4_PreloadForTheme')) return;
		
		$this->preloadTheme = new ckeditor4_PreloadForTheme();
		$this->preloadTheme->themeName = $themeName;
		
		// call setParams()
		if (method_exists($this->preloadTheme, 'setParams')) {
			$this->preloadTheme->setParams($params);
		}
	}
	
	/**
	 * preSetConfig
	 * ckeditor.config をカスタムする用
	 * (Params 解釈前: Smarty プラグインで指定した toolbar や管理画面:一般設定の config は上書きできない)
	 * 
	 * @param array $config
	 * @param array $params
	 */
	function preSetConfig(& $config, $params) {
		if (! $this->preloadTheme) return;
		
		// call preSetConfig()
		if (method_exists($this->preloadTheme, 'preSetConfig')) {
			$this->preloadTheme->preSetConfig($config, $params);
		}
	}
	
	/**
	 * postSetConfig
	 * ckeditor.config をカスタムする用
	 * (最終段階: すべての config を上書きできる)
	 * 
	 * @param array $config
	 * @param array $params
	 */
	function postSetConfig(& $config, $params) {
		if (! $this->preloadTheme) return;
		
		// call postSetConfig()
		if (method_exists($this->preloadTheme, 'postSetConfig')) {
			$this->preloadTheme->postSetConfig($config, $params);
		}
	}
	
}
