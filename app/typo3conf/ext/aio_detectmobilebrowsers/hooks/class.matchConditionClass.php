<?php
/**
 * Hook T3 class matchConditionClass
 *
 * load my script, so we can call
 * matchCondition function from extension
 *
 * normal T3 loading
 * 1. T3 load ext_localconf
 * 2. T3 load matchConditionClass
 * 3. T3 t3lib_matchCondition function_exists, required php script not loaded - FALSE
 *
 * mod T3 loading (by this class/hook)
 * 1. T3 LOAD ext_localconf
 * 2. T3 ext_localconf hook matchConditionClass constructor (hook t3lib_matchCondition)
 * 3. T3 matchConditionClass hook include required php script
 * 4. T3 t3lib_matchCondition function_exists, YES script loaded, functions exists all fine - TRUE
 *
 * Don'T try this at home!
 */
class user_matchConditionClass {
	function __construct()	{
		require_once(t3lib_extMgm::extPath('aio_detectmobilebrowsers', 'functions/user_isMobileBrowser.php'));
	}
}
?>