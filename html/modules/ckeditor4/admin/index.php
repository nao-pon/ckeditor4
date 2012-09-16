<?php

require_once '../../../mainfile.php';
require_once XOOPS_ROOT_PATH . '/header.php';

//redirect_header(XOOPS_MODULE_URL . "/legacy/admin/index.php?action=Help&amp;dirname=ckeditor4", 1, "Loading...!");
$root =& XCube_Root::getSingleton();
$mid = $root->mContext->mModule->mXoopsModule->get('mid');
?>

<h3>CKEditor 4 for XOOPS Cube Legacy</h3>

<hr />

<ul>
<li><a href="<?php echo XOOPS_MODULE_URL ?>/legacy/admin/index.php?action=PreferenceEdit&confmod_id=<?php echo $mid ?>"><?php echo _PREFERENCES ?></a></li>
<li><a href="<?php echo XOOPS_MODULE_URL ?>/legacy/admin/index.php?action=Help&amp;dirname=ckeditor4"><?php echo _HELP ?></a></li>
</ul>

<?php
require_once XOOPS_ROOT_PATH . "/footer.php";

?>