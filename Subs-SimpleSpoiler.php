<?php

/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/. */

if (!defined('SMF'))
	die('Hacking attempt...');

function spoiler_bbc_add_code(&$codes)
{
	global $txt;

	loadLanguage('SimpleSpoiler');

	$codes[] = array(
		'tag' => 'spoiler',
		'before' => '<span>' . $txt['spoiler_desc'] . '</span> <div class="spoiler_toggle">',
		'after' => '</div>',
		'block_level' => true,
	);

	spoiler_header();
}

function spoiler_bbc_add_button(&$buttons)
{
	global $txt;

	loadLanguage('SimpleSpoiler');

	$buttons[count($buttons) - 1][] = array(
		'image' => 'spoiler',
		'code' => 'spoiler',
		'before' => '[spoiler]',
		'after' => '[/spoiler]',
		'description' => $txt['spoiler_desc'],
	);
}

function spoiler_header()
{
	global $txt, $settings, $context;
	static $header_done = false;

	if ($header_done)
		return;

	$context['html_headers'] .= '
	<script language="JavaScript" type="text/javascript">
		let simpleSpoilerShow = '. JavaScriptEscape($txt["spoiler_show"]) .';
		let simpleSpoilerHide = '. JavaScriptEscape($txt["spoiler_hide"]) .';
		let simpleSpoilerDesc = '. JavaScriptEscape($txt["spoiler_desc"]) .';
	</script>
	<script defer type="text/javascript" src="' . $settings['default_theme_url'] . '/scripts/simpleSpoiler.js"></script>
	<link rel="stylesheet" href="' . $settings['default_theme_url'] . '/css/simpleSpoiler.css">';

	$header_done = true;
}