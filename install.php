<?php

/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/. */

if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF')) 
	require_once(dirname(__FILE__) . '/SSI.php');
elseif (!defined('SMF'))
	exit('<b>Error:</b> Cannot install - please verify you put this in the same place as SMF\'s index.php.');

$hooks = array(
	'integrate_bbc_codes' => 'spoiler_bbc_add_code',
	'integrate_bbc_buttons' => 'spoiler_bbc_add_button',
	'integrate_pre_include' => '$sourcedir/Subs-SimpleSpoiler.php',
);

foreach ($hooks as $hook => $function)
	add_integration_function($hook, $function);