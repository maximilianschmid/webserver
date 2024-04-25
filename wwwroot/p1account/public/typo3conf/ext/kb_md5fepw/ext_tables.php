<?php
if (!defined ("TYPO3_MODE")) 	die ("Access denied.");

t3lib_div::loadTCA('fe_users');
$TCA['fe_users']['columns']['password']['config']['eval'] .= ',md5,password';

?>
