<?php
/*****
 *
 * fix.php  v1.38
 * 05/11/01
 *
 * ~Ashe
 *
 * This file is public domain.
 *
 * Go to http://phpbbfix.fr.st  to check for newer versions!
 *
 *
 * History:
 * --------
 * 05/11/01	1.38	Mmh... not much... ;)
 * 03/11/01	1.37	SQL-check has been (very) slightly improved. I don't even know if it was a valid way to spoof data on phpBB.
 * 16/10/01	1.36	Bah, let's correct these stupid typos in 1.4.2 :)
 * 29/09/01	1.34	Small modifications to preserve compatibility with older versions of PHP3.
 * 08/09/01 1.32	Doh, now I do remember why I usually prefix reset() with an @
 *					Slightly improved SQL-check (will have less chances to detect a forged query in error)
 *					[thanks to Nikki @ phpBB forums for finding this one :) ]
 * 04/09/01 1.3		New SQL-check. It fixes two yet-undiscovered exploits (believe it or not... heh) and ensure maximum security.
 *					I dare anyone to defeat it ;)
 * 20/08/01	1.2		Fixed a misfunction with search.php
 *					Corrected a bad misfunction of SQL-check on specific configurations.
 *					[thanks to mmj for spending time on this and pointing it out]
 * 13/08/01 1.11	Now resets variables instead of setting them to null.
 * 10/08/01	1.1 	More efficient SQL-check algorithm
 * 09/08/01	1.02	Changed $user_id var-reset to SQL-check because it was messing up with Profile, doh!
 *					Added $email to SQL-check because of phpBB 1.2.1
 * 09/08/01	1.01	Fixed a mySQL trick for 1.2.1 (get_userdata).
 *					Fixed an eventual trick (any version) with get_userdata_from_id.
 * 09/08/01	1.0 	Initial release
 *
 *****/

/***
 * var-reset
 ***/
$fix_vars = array('userdata', 'user_logged_in', 'user_lang', 'logged_in', 'l_statsblock', 'l_pwdmessage', 'l_privnotify', 'new_name');
for ($n = 0; $n < sizeof($fix_vars); ++$n)
{
	unset($GLOBALS[$fix_vars[$n]]);
	unset($HTTP_GET_VARS[$fix_vars[$n]]);
	unset($HTTP_POST_VARS[$fix_vars[$n]]);
	unset($HTTP_COOKIE_VARS[$fix_vars[$n]]);
}

/***
 * origin-validation
 ***/
$fix_vars = array('submit', 'save');
for ($n = 0; $n < sizeof($fix_vars); ++$n)
{
	if (!isset ($HTTP_POST_VARS[$fix_vars[$n]]) && !stristr($REQUEST_URI, "search.$phpEx"))
	{
		unset($GLOBALS[$fix_vars[$n]]);
		unset($HTTP_GET_VARS[$fix_vars[$n]]);
		unset($HTTP_COOKIE_VARS[$fix_vars[$n]]);
	}
}

/***
 * SQL-check
 ***/
$fix_vars = array('HTTP_GET_VARS', 'HTTP_POST_VARS', 'HTTP_COOKIE_VARS');
for ($n = 0; $n < sizeof($fix_vars); ++$n)
{
	if (is_array($GLOBALS[$fix_vars[$n]]))
	{
		while (list($k, $v) = each($GLOBALS[$fix_vars[$n]]))
		{
			if (($k != 'message') && ($k != 'subject') && ($k != 'username') && ($k != 'sig'))
			{
				while (preg_match("/(.*)'( *)((NOT)?( *))(((!|<|=|>)+)|IS( *)NOT( *)NULL|IN( *)\(|LIKE|BETWEEN(.*)AND|OR|((\|)+)|,(.*)=)(.*)['|\"]/i", $v, $matches))
				{
					$v = $matches[1];
				}
				$GLOBALS[$fix_vars[$n]][$k] = $v;
				$GLOBALS[$k] = $v;
			}
		}
		@reset($GLOBALS[$fix_vars[$n]]);
	}
}

/***
 * Bah, let's correct these stupid typos :]
 ***/
$fviewemail = $viewemail;
$tsig = $sig;
$user_id = $HTTP_COOKIE_VARS['user_id'] = $HTTP_GET_VARS['user_id'] = $HTTP_POST_VARS['user_id'] = intval($user_id);
$post_id = $HTTP_COOKIE_VARS['post_id'] = $HTTP_GET_VARS['post_id'] = $HTTP_POST_VARS['post_id'] = intval($post_id);
$topic_id = $HTTP_COOKIE_VARS['topic_id'] = $HTTP_GET_VARS['topic_id'] = $HTTP_POST_VARS['topic_id'] = intval($topic_id);
?>