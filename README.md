ckeditor4
=========

CKEditor 4 for XOOPS

CKEditor 4 を XOOPS で利用可能にするモジュールです。

HTMLエディタ、BBCode(XOOPS Code)エディタが使用可能です。

BBCode(XOOPS Code)エディタは、CKEditor標準の bbcode プラグインを拡張し、XOOPS Code に対応した xoopscode プラグインを新たに作成し、そのプラグインを使用しています。

## 使用方法

XOOPS Cube Legacy 2.2 以上の場合は、インストールするだけで、XCL 2.2 仕様のリッチエディタに対応したテンプレートを持つモジュール(bulletin, d3forum, pico など)で、状況に応じたエディタが利用できます。

### XOOPS Cube Legacy 2.2 以前の環境下で、リッチエディタを使用するためにはテンプレートの変更が必要です。

``<{xoops_dhtmltarea value=VALUE}>`` -> ``<{ck4dhtmltarea value=VALUE|escape editor=html}>``

``<{xoops_dhtmltarea value=VALUE}>`` -> ``<{ck4dhtmltarea value=VALUE|escape editor=bbcode}>``

 * ``xoops_dhtmltarea`` を使用している箇所は value を escape する必要があります。

``<{xoopsdhtmltarea value=VALUE}>`` -> ``<{ck4dhtmltarea value=VALUE editor=html}>``

``<{xoopsdhtmltarea value=VALUE}>`` -> ``<{ck4dhtmltarea value=VALUE editor=bbcode}>``

 * ``xoopsdhtmltarea`` を使用している箇所は value はそのままにします。

### パラメーター

* ``editor``: 使用するエディタ
* ``toolbar``: 表示するツールバーを JSON 形式で指定できます。