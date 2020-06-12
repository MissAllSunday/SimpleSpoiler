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
		'before' => '<span>' . $txt['spoiler_desc'] . '</span><div class="spoiler_toggle">',
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
	global $txt, $context;
	static $header_done = false;

	if ($header_done)
		return;

	echo '
<script type="text/javascript">!window.jQuery && document.write(unescape(\'%3Cscript src="//code.jquery.com/jquery.min.js"%3E%3C/script%3E\'))</script>

	<script language="JavaScript" type="text/javascript"><!-- // --><![CDATA[
		jQuery(document).ready(function() {
			var is_visible = false;

			jQuery(\'.spoiler_toggle\').prev().append(\' [<a href="#" class="spoiler_toggle_link">\' + ' . JavaScriptEscape($txt['spoiler_show']) . ' + \'</a>]\');
			jQuery(\'.spoiler_toggle\').hide();

			jQuery(\'a.spoiler_toggle_link\').click(function() {
				is_visible = !is_visible;

				jQuery(this).html((!is_visible) ? ' . JavaScriptEscape($txt['spoiler_show']) . ' : ' . JavaScriptEscape($txt['spoiler_hide']) . ');
				jQuery(this).parent().next(\'.spoiler_toggle\').toggle(\'slow\');

				return false;
			});
		});
	// ]]></script>';

	$header_done = true;
}