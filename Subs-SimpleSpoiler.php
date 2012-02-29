<?php

/**
 * @package Simple Spoiler BBC mod
 * @version 1.0.3
 * @author Jessica González <missallsunday@simplemachines.org>
 * @copyright Copyright (c) 2011, Jessica González
 * @license http://www.mozilla.org/MPL/MPL-1.1.html
 */

/*
 * Version: MPL 1.1
 *
 * The contents of this file are subject to the Mozilla Public License Version
 * 1.1 (the "License"); you may not use this file except in compliance with
 * the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 *
 * Software distributed under the License is distributed on an "AS IS" basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
 * for the specific language governing rights and limitations under the
 * License.
 *
 * The Original Code is http://missallsunday.com code.
 *
 * The Initial Developer of the Original Code is
 * Jessica González.
 * Portions created by the Initial Developer are Copyright (C) 2011
 * the Initial Developer. All Rights Reserved.
 *
 * Contributor(s):
 *
 */

if (!defined('SMF'))
	die('Hacking attempt...');

function spoiler_bbc_add_code($codes)
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

function spoiler_bbc_add_button($buttons)
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

	echo = '
<script type="text/javascript">!window.jQuery && document.write(unescape(\'%3Cscript src="http://code.jquery.com/jquery.min.js"%3E%3C/script%3E\'))</script>

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