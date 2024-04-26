<?php
/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

class ValidateHashHandler {

    /**
     * Handles the hash validation.
     * @return void
     */
    static public function execute() {
        $value = t3lib_div::_GET('value');
        $addition = t3lib_div::_GET('addition');
        $scope = t3lib_div::_GET('scope');

        $content = t3lib_div::hmac($value, $addition);

        if ($scope === 'flashvars') {
            header('Content-type: application/x-www-form-urlencoded');
            $content = 'hash=' . $content;
        } else {
            header('Content-type: text/plain');
        }

        header('Pragma: no-cache');
        header('Cache-control: no-cache');

        echo $content;
    }
}

ValidateHashHandler::execute();
