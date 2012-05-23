<?php

/**
 * libSimplePie
 *
 * @copyright 2004-2012 Ryan Parman, Geoffrey Sneddon, Ryan McCue
 * @copyright 2012 Ralf Hertsch
 * @author Ryan Parman
 * @author Geoffrey Sneddon
 * @author Ryan McCue
 * @author Ralf Hertsch
 * @link http://simplepie.org/ SimplePie
 * @link https://addons.phpmanufaktur.de/de/addons/libgithubapi.php
 * @license MIT License (MIT) http://www.opensource.org/licenses/MIT
 */

// include class.secure.php to protect this file and the whole CMS!
if (defined('WB_PATH')) {
    if (defined('LEPTON_VERSION')) include(WB_PATH.'/framework/class.secure.php');
} else {
    $oneback = "../";
    $root = $oneback;
    $level = 1;
    while (($level < 10) && (!file_exists($root.'/framework/class.secure.php'))) {
        $root .= $oneback;
        $level += 1;
    }
    if (file_exists($root.'/framework/class.secure.php')) {
        include($root.'/framework/class.secure.php');
    } else {
        trigger_error(sprintf("[ <b>%s</b> ] Can't include class.secure.php!",
                $_SERVER['SCRIPT_NAME']), E_USER_ERROR);
    }
}
// end include class.secure.php

global $admin;

$error = '';

// Prompt Errors
if (!empty($error)) {
  $admin->print_error($error);
}
