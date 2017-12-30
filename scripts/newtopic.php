<?php
/***************************************************************************
                            newtopic.php  -  description
                             -------------------
    begin                : Sat June 17 2000
    copyright            : (C) 2001 The phpBB Group
    email                : support@phpbb.com

    $Id: newtopic.php,v 1.61 2001/06/16 06:05:50 thefinn Exp $

 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
include('extention.inc');
// Set the error reporting to a sane value, 'cause we haven't included auth.php yet..
error_reporting  (E_ERROR | E_WARNING | E_PARSE); // This will NOT report uninitialized variables
if($cancel) {
	header("Location: viewforum.$phpEx?forum=$forum");
}

include('functions.'.$phpEx);
include('config.'.$phpEx);
require('auth.'.$phpEx);
$pagetitle = "New Topic";
$pagetype = "newtopic";
$sql = "SELECT forum_name, forum_access, forum_type FROM forums WHERE (forum_id = '$forum')";
if(!$result = mysql_query($sql, $db))
	error_die("Can't get forum data.");
$myrow = mysql_fetch_array($result);
$forum_name = $myrow[forum_name];
$forum_access = $myrow[forum_access];
$forum_type = $myrow[forum_type];
$forum_id = $forum;

if(!does_exists($forum, $db, "forum")) {
	error_die("The forum you are attempting to post to does not exist. Please try again.");
}

if($HTTP_POST_VARS['submit']) {
	$subject = strip_tags($HTTP_POST_VARS['subject']);
   if(trim($HTTP_POST_VARS['message']) == '' || trim($subject) == '') {
		error_die($l_emptymsg);
	}

   if (!$user_logged_in) {
      if($HTTP_POST_VARS['username'] == '' && $HTTP_POST_VARS['password'] == '' && $forum_access == 2)
	{
	   // Not logged in, and username and password are empty and forum_access is 2 (anon posting allowed)
	   $userdata = array("user_id" => -1);
	}
      else
	{
	   // no valid session, need to check user/pass.
	   if($username == '' || $password == '')
	     {
		error_die("$l_userpass $l_tryagain");
	     }
	   $md_pass = md5($password);
	   $userdata = get_userdata($username, $db);
	   if($userdata[user_level] == -1)
	     {
		error_die($l_userremoved);
	     }
	   if($md_pass != $userdata["user_password"])
	     {
		error_die("$l_wrongpass $l_tryagain");
	     }
	   if($forum_access == 3 && $userdata[user_level] < 2)
	     {
		error_die($l_nopost);
	     }
	   if(is_banned($userdata[user_id], "username", $db))
	     {
		error_die($l_banned);
	     }
	}
      if($userdata[user_id] != -1)
	{
	   // You've entered your password and username, we log you in.
	   $sessid = new_session($userdata[user_id], $REMOTE_ADDR, $sesscookietime, $db);
	   set_session_cookie($sessid, $sesscookietime, $sesscookiename, $cookiepath, $cookiedomain, $cookiesecure);
	}
   }
   else
     {
	if($forum_access == 3 && $userdata[user_level] < 2)
	  {
	     error_die($l_nopost);
	  }

     }
   // Either valid user/pass, or valid session. continue with post.. but first:
   // Check that, if this is a private forum, the current user can post here.

   if ($forum_type == 1)
   {
	   if (!check_priv_forum_auth($userdata[user_id], $forum, TRUE, $db))
	   {
	 		error_die("$l_privateforum $l_nopost");
	   }
	}

	$is_html_disabled = false;
   if($allow_html == 0 || isset($html))
   {
     $message = htmlspecialchars($message);
     $is_html_disabled = true;
   }


   if($allow_bbcode == 1 && !($HTTP_POST_VARS[bbcode]))
     $message = bbencode($message, $is_html_disabled);

   // MUST do make_clickable() and smile() before changing \n into <br>.
   $message = make_clickable($message);
   if(!$smile) {
      $message = smile($message);
   }
   $message = str_replace("\n", "<BR>", $message);

   $message = censor_string($message, $db);
   $message = addslashes($message);
   $subject = strip_tags($subject);
   $subject = censor_string($subject, $db);
   $subject = addslashes($subject);
   $poster_ip = $REMOTE_ADDR;
   $time = date("Y-m-d H:i");

   //to prevent [addsig] from getting in the way, let's put the sig insert down here.
   if($sig && $userdata[user_id] != -1) {
      $message .= "\n[addsig]";
   }
   $sql = "INSERT INTO topics (topic_title, topic_poster, forum_id, topic_time, topic_notify) VALUES ('$subject', '$userdata[user_id]', '$forum', '$time'";
   if(isset($notify) && $userdata[user_id] != -1)
     $sql .= ", '1'";
   else
     $sql .= ", '0'";
   $sql .= ")";
   if(!$result = mysql_query($sql, $db)) {
		error_die("Couldn't enter topic in database.");
   }
   $topic_id = mysql_insert_id();
   $sql = "INSERT INTO posts (topic_id, forum_id, poster_id, post_time, poster_ip) VALUES ('$topic_id', '$forum', '$userdata[user_id]', '$time', '$poster_ip')";
   if(!$result = mysql_query($sql, $db)) {
		error_die("Couldn't enter post in datbase.");
   }
   else
   {
   	$post_id = mysql_insert_id();
   	if($post_id)
   	{
   		$sql = "INSERT INTO posts_text (post_id, post_text) values ($post_id, '$message')";
   		if(!$result = mysql_query($sql, $db))
   		{
   			error_die("Could not enter post text!");
   		}
   		$sql = "UPDATE topics SET topic_last_post_id = $post_id WHERE topic_id = '$topic_id'";
   		if(!$result = mysql_query($sql, $db))
   		{
   			error_die("Could not update topics table!");
   		}
   	}
   }

   if($userdata[user_id] != -1) {
      $sql = "UPDATE users SET user_posts=user_posts+1 WHERE (user_id = $userdata[user_id])";
      $result = mysql_query($sql, $db);
      if (!$result) {
			error_die("Couldn't update users post count.");
      }
   }
   $sql = "UPDATE forums SET forum_posts = forum_posts+1, forum_topics = forum_topics+1, forum_last_post_id = $post_id WHERE forum_id = '$forum'";
   $result = mysql_query($sql, $db);
   if (!$result) {
      error_die("Couldn't update forums post count.");
   }
   $topic = $topic_id;


   $total_forum = get_total_topics($forum, $db);
   $total_topic = get_total_posts($topic, $db, "topic")-1;
   // Subtract 1 because we want the nr of replies, not the nr of posts.

   $forward = 1;
   include('page_header.'.$phpEx);

   echo "<br><TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACEING=\"0\" ALIGN=\"CENTER\" VALIGN=\"TOP\" WIDTH=\"$tablewidth\">";
   echo "<TR><TD  BGCOLOR=\"$table_bgcolor\"><TABLE BORDER=\"0\" CALLPADDING=\"1\" CELLSPACEING=\"1\" WIDTH=\"100%\">";
   echo "<TR BGCOLOR=\"$color1\" ALIGN=\"LEFT\"><TD><font face=\"Verdana\" size=\"2\"><P>";
   echo "<P><BR><center>$l_stored<P>$l_click <a href=\"viewtopic.$phpEx?topic=$topic_id&forum=$forum&$total_topic\">$l_here</a> $l_viewmsg<p>$l_click <a href=\"viewforum.$phpEx?forum=$forum_id&total_forum\">$l_here</a> $l_returntopic</center><P></font>";
   echo "</TD></TR></TABLE></TD></TR></TABLE><br>";


} else {
   include('page_header.'.$phpEx);
?>

	<FORM ACTION="<?php echo $PHP_SELF?>" METHOD="POST">
	<TABLE BORDER="0" CELLPADDING="1" CELLSPACING=0" ALIGN="CENTER" VALIGN="TOP" WIDTH="<?php echo $tablewidth?>"><TR><TD  BGCOLOR="<?php echo $table_bgcolor?>">
	<TABLE BORDER="0" CELLPADDING="1" CELLSPACING=1" WIDTH="100%">
	<TR BGCOLOR="<?php echo $color1?>" ALIGN="LEFT">
		<TD width=25%><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo $l_aboutpost?>:</b></TD>
<?php
	if($forum_access == 1) {
?>
		<TD><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><?php echo "$l_regusers $l_inthisforum"?></TD>
<?php
	}
	else if($forum_access == 2) {
?>
		<TD><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><?php echo "$l_anonusers $l_inthisforum $l_anonhint"?></TD>
<?php
	}
	else if($forum_access == 3) {
?>
		<TD><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><?php echo "$l_modusers $l_inthisforum"?></TD>
<?php
	}
?>
	</TR>
	<TR ALIGN="LEFT">
		<TD  BGCOLOR="<?php echo $color1?>"  width=25%><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo $l_username?>:<b></font></TD>
		<TD  BGCOLOR="<?php echo $color2?>"><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
<?PHP
	if ($user_logged_in) {
		echo $userdata[username] . " \n";
	} else {
		echo "<INPUT TYPE=\"TEXT\" NAME=\"username\" SIZE=\"25\" MAXLENGTH=\"40\" VALUE=\"$userdata[username]\"> \n";
	}
?>
		</font>
		</TD>
	</TR>

<?PHP
	if (!$user_logged_in) {
		// no session, need a password.
		echo "    <TR ALIGN=\"LEFT\"> \n";
		echo "        <TD BGCOLOR=\"$color1\" width=\"25%\"><font size=\"$FontSize2\" face=\"$FontFace\"><b>$l_password:</b></font><BR>";
		echo "        <font size=\"$FontSize3\"><i><a href=\"sendpassword.$phpEx\" target=\"_blank\">$l_passwdlost</a></i></font></TD> \n";
		echo "        <TD BGCOLOR=\"$color2\"><INPUT TYPE=\"PASSWORD\" NAME=\"password\" SIZE=\"25\" MAXLENGTH=\"25\"></TD> \n";
		echo "    </TR> \n";
	}
?>

	<TR ALIGN="LEFT">
		<TD  BGCOLOR="<?php echo $color1?>" width=25%><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo $l_subject?>:</b></TD>
		<TD  BGCOLOR="<?php echo $color2?>"> <INPUT TYPE="TEXT" NAME="subject" SIZE="50" MAXLENGTH="100"></TD>
	</TR>
	<TR ALIGN="LEFT">
		<TD  BGCOLOR="<?php echo $color1?>" width=25%><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo $l_body?>:</b><br><br>
		<?php
		echo "$l_htmlis: ";
		if($allow_html == 1)
			echo "$l_on<BR>\n";
		else
			echo "$l_off<BR>\n";
		echo "$l_bbcodeis: ";
		if($allow_bbcode == 1)
			echo "$l_on<br>\n";
		else
			echo "$l_off<BR>\n";
		?>
		</font></TD>
		<TD  BGCOLOR="<?php echo $color2?>"><TEXTAREA NAME="message" ROWS=10 COLS=45 WRAP="VIRTUAL"></TEXTAREA></TD>
	</TR>
	<TR ALIGN="LEFT">
		<TD  BGCOLOR="<?php echo $color1?>" width=25%><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo $l_options?>:</b></TD>
		<TD  BGCOLOR="<?php echo $color2?>" ><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
		<?php
			if($allow_html == 1) {
			   if($userdata[user_html] == 1)
			     $h = "CHECKED";
		?>
				<INPUT TYPE="CHECKBOX" NAME="html" <?php echo $h?>><?php echo "$l_disable $l_html $l_onthispost"?><BR>
		<?php
			}
		?>
		<?php
			if($allow_bbcode == 1) {
			   if($userdata[user_bbcode] == 1)
			     $b = "CHECKED";
		?>
				<INPUT TYPE="CHECKBOX" NAME="bbcode" <?php echo $b?>><?php echo "$l_disable <a href=\"$bbref_url\" target=\"_blank\"><i>$l_bbcode</i></a> $l_onthispost"?><BR>
		<?php
			}
			if($userdata[user_desmile] == 1){
				$ds = "CHECKED";
			}
		?>

		<INPUT TYPE="CHECKBOX" NAME="smile" <?php echo $ds?>><?php echo "$l_disable <a href=\"$smileref_url\" target=\"_blank\"><i>$l_smilies</i></a> $l_onthispost"?><BR>
		<?php
		if($allow_sig == 1) {
			if($userdata[user_attachsig] == 1) {
				$s = "CHECKED";
			}
		?>
				<INPUT TYPE="CHECKBOX" NAME="sig" <?php echo $s?>><?php echo $l_attachsig?><BR>
		<?php
		}
		?>
		<INPUT TYPE="CHECKBOX" NAME="notify"><?php echo $l_notify?><BR>
		</TD>
	</TR>
	<TR>
		<TD  BGCOLOR="<?php echo $color1?>" colspan=2 ALIGN="CENTER">
		<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
		<INPUT TYPE="HIDDEN" NAME="forum" VALUE="<?php echo $forum?>">
		<INPUT TYPE="SUBMIT" NAME="submit" VALUE="<?php echo $l_submit?>">
		&nbsp;<INPUT TYPE="SUBMIT" NAME="cancel" VALUE="<?php echo $l_cancelpost?>">
		</TD>
	</TR>
	</TABLE>
</TD>
</TR>
</TABLE>
</FORM>

<?php
}
require('page_tail.'.$phpEx);
?>
