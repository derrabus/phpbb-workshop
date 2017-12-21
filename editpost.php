<?php
/***************************************************************************
                            editpost.php  -  description
                             -------------------
    begin                : Sat June 17 2000
    copyright            : (C) 2001 The phpBB Group
    email                : support@phpbb.com

    $Id: editpost.php,v 1.77 2001/05/09 15:58:53 the_systech Exp $

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
include('functions.'.$phpEx);
include('config.'.$phpEx);
require('auth.'.$phpEx);
$pagetitle = "Edit Post";
$pagetype = "index";

if($submit) {
   $sql = "SELECT * FROM posts WHERE post_id = '$post_id'";
   if (!$result = mysql_query($sql, $db)) die($err_db_retrieve_data);
   if (mysql_num_rows($result) <= 0) die($err_db_retrieve_data);
   $myrow = mysql_fetch_array($result);

   $poster_id = $myrow[poster_id];
   $forum_id = $myrow[forum_id];
   $topic_id = $myrow[topic_id];
   $this_post_time = $myrow['post_time'];
   list($day, $time) = split(" ", $myrow[post_time]);

   $posterdata = get_userdata_from_id($poster_id, $db);
   $date = date("Y-m-d H:i");
   if ($user_logged_in) {
      // valid session.. just check it's the right user.
      if($userdata[user_id] != $posterdata[user_id]) {
	 if ($userdata[user_level] == 1) {
	    $die = 1;
	 }
	 else if($userdata[user_level] == 2 && !is_moderator($forum_id, $userdata[user_id], $db)) {
	    include('page_header.'.$phpEx);
	    error_die($l_notedit);
	 }
      }
   }
   else {
      $userdata = get_userdata($username, $db);
      if(is_banned($userdata[user_id], "username", $db)){
			error_die($l_banned);
		}
      $md_passwd = md5($passwd);
      if($posterdata[user_id] == $userdata[user_id]) {
	 		if($md_passwd != $posterdata[user_password]) {
	    		$die = 1;
	 		}
      }
      else if($userdata[user_level] == 2 && is_moderator($forum_id, $userdata[user_id], $db)) {
	 		if($md_passwd != $userdata[user_password]) {
	 	   	$die = 1;
	 		}
      }
      else if($userdata[user_level] > 2) {
	 		if($md_passwd != $userdata[user_password]) {
	    		$die = 1;
	 		}
      }
      else {
	 		$die = 1;
      }
      if($die != 1) {
	 		// You've entered your username and password, and no problems have been found, log you in!
	 		$sessid = new_session($userdata[user_id], $REMOTE_ADDR, $sesscookietime, $db);
	 		set_session_cookie($sessid, $sesscookietime, $sesscookiename, $cookiepath, $cookiedomain, $cookiesecure);
      }
   }
   if($die == 1) {
      include('page_header.' . $phpEx);
      error_die($l_permdeny);
   }
   // IF we made it this far we are allowed to edit this message, yay!
    
   $is_html_disabled = false;
   if($allow_html == 0 || isset($html) )
   {
     $message = htmlspecialchars($message);
     $is_html_disabled = true;
   }
   if($allow_bbcode == 1 && !isset($bbcode))
     $message = bbencode($message, $is_html_disabled);
   if(!$smile) 
     $message = smile($message);

	// MUST do make_clickable() (and smile()) before changing \n into <br>.
	$message = make_clickable($message);
   $message = str_replace("\n", "<BR>", $message);
   $edit_by = get_syslang_string($sys_lang, "l_editedby");
   $on_date = get_syslang_string($sys_lang, "l_ondate");
   
   // If it's been edited more than once, there might be old "edited by" strings with
   // escaped HTML code in them. We want to fix this up right here:
   $message = preg_replace("#&lt;font\ size\=-1&gt;\[\ $edit_by(.*?)\ \]&lt;/font&gt;#si", '<font size=-1>[ ' . $edit_by . '\1 ]</font>', $message);
   
   $message .= "<BR><BR><font size=-1>[ $edit_by $username $on_date $date ]</font>";
   $message = censor_string($message, $db);
   
   $message = addslashes($message);
   if(!$delete) {
      $forward = 1;
      $topic = $topic_id;
      $forum = $forum_id;
      include('page_header.' . $phpEx);
      $sql = "UPDATE posts_text SET post_text = '$message' WHERE (post_id = '$post_id')";
      if(!$result = mysql_query($sql, $db))
			error_die("Unable to update the posting in the database");
		$subject = strip_tags($subject);
      if(isset($subject) && (trim($subject) != '')) {
			 if(!isset($notify))
			   $notify = 0;
			 else
			   $notify = 1;
			 $subject = censor_string($subject, $db);
			 $subject = addslashes($subject);
			 $sql = "UPDATE topics SET topic_title = '$subject', topic_notify = '$notify' WHERE topic_id = '$topic_id'";
			 if(!$result = mysql_query($sql, $db)) {
			 	error_die("Unable to update the topic subject in the database");
			 }
      }
     
      echo "<br><TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACEING=\"0\" ALIGN=\"CENTER\" VALIGN=\"TOP\" WIDTH=\"$tablewidth\">";
      echo "<TR><TD  BGCOLOR=\"$table_bgcolor\"><TABLE BORDER=\"0\" CALLPADDING=\"1\" CELLSPACEING=\"1\" WIDTH=\"100%\">";
      echo "<TR BGCOLOR=\"$color1\" ALIGN=\"LEFT\"><TD><font face=\"Verdana\" size=\"2\"><P>";
      echo "<P><BR><center>$l_stored<ul>$l_click <a href=\"viewtopic.$phpEx?topic=$topic_id&forum=$forum_id\">$l_here</a> $l_viewmsg<P>$l_click <a href=\"viewforum.$phpEx?forum=$forum_id\">$l_here</a> $l_returntopic</ul></center><P></font>";
      echo "</TD></TR></TABLE></TD></TR></TABLE><br>";
   }
   else {
      $now_hour = date("H");
      $now_min = date("i");
      list($hour, $min) = split(":", $time);
      
      // NOT ((time is good) OR (user is supermod/admin) OR (user is moderator of this forum))
		if (!( (($now_hour == $hour && $min_now - 30 < $min) || ($now_hour == $hour +1 && $now_min - 30 > 0)) 
					|| 
					($userdata[user_level] > 2 || is_moderator($forum, $userdata[user_id], $db))  )) 
		{
			include('page_header.' . $phpEx);
			error_die($l_permdeny);
		}

      include('page_header.'.$phpEx);
      $last_post_in_thread = get_last_post($topic_id, $db, "time_fix");

      $sql = "DELETE FROM posts WHERE post_id = '$post_id'";
      if(!$r = mysql_query($sql, $db)){
			error_die("Couldn't delete post from database");
		}
		
		$sql = "DELETE FROM posts_text WHERE post_id = '$post_id'";
      if(!$r = mysql_query($sql, $db)){
			error_die("Couldn't delete post from database");
		}
		
		else if($last_post_in_thread == $this_post_time) {
	     $topic_time_fixed = get_last_post($topic_id, $db, "time_fix");
   	  $sql = "UPDATE topics SET topic_time = '$topic_time_fixed' WHERE topic_id = '$topic_id'";
        if(!$r = mysql_query($sql, $db)) {
			 	error_die("Couldn't update to previous post time - last post has been removed");
		  }
	 	}

      if(get_total_posts($topic_id, $db, "topic") == 0) 
      {
	 		$sql = "DELETE FROM topics WHERE topic_id = '$topic_id'";
	 		if(!$r = mysql_query($sql, $db))
	 			error_die("Couldn't delete topic from database");
	 		$topic_removed = TRUE;
      }
      
      if($posterdata[user_id] != -1) {
	 		$sql = "UPDATE users SET user_posts = user_posts - 1 WHERE user_id = $posterdata[user_id]";
	 		if(!$r = mysql_query($sql, $db))
	 		{
	 			error_die("Couldn't change user post count.");
	 		}
      }
      sync($db, $forum, 'forum');
      if(!$topic_removed)
      {
			sync($db, $topic_id, 'topic');
		}
      
      echo "<br><TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACEING=\"0\" ALIGN=\"CENTER\" VALIGN=\"TOP\" WIDTH=\"$tablewidth\">";
      echo "<TR><TD  BGCOLOR=\"$table_bgcolor\"><TABLE BORDER=\"0\" CALLPADDING=\"1\" CELLSPACEING=\"1\" WIDTH=\"100%\">";
      echo "<TR BGCOLOR=\"$color1\" ALIGN=\"LEFT\"><TD><font face=\"Verdana\" size=\"2\"><P>";
      echo "<P><BR><center>$l_deleted <ul>$l_click <a href=\"viewforum.$phpEx?forum=$forum_id\">$l_here</a> $l_returntopic<p>$l_click <a href=\"index.$phpEx\">$l_here</a>$l_returnindex</ul></center><P></font>";
      echo "</TD></TR></TABLE></TD></TR></TABLE><br>";
   }	
}
else {
	// Gotta handle private forums right here. They're naturally covered on submit, but not in this part.
	$sql = "SELECT f.forum_type, f.forum_name, t.topic_title FROM forums f, topics t WHERE (f.forum_id = '$forum') AND (t.topic_id = $topic) AND (t.forum_id = f.forum_id)";
	if(!$result = mysql_query($sql, $db))
	{
		error_die("Couldn't get forum and topic information from the database.");
	}
	if(!$myrow = mysql_fetch_array($result))
	{
		error_die("Error - The forum/topic you selected does not exist. Please go back and try again.");
	}
	
	if(($myrow[forum_type] == 1) && !$user_logged_in && !$logging_in) 
	{
		// Private forum, no valid session, and login form not submitted...
		require('page_header.'.$phpEx);
?>
<FORM ACTION="<?php echo $PHP_SELF?>" METHOD="POST">
	<TABLE BORDER="0" CELLPADDING="1" CELLSPACING="0" ALIGN="CENTER" VALIGN="TOP" WIDTH="<?php echo $tablewidth?>">
		<TR>
			<TD BGCOLOR="<?php echo $table_bgcolor?>">
				<TABLE BORDER="0" CELLPADDING="1" CELLSPACING="1" WIDTH="100%">
					<TR BGCOLOR="<?php echo $color1?>" ALIGN="LEFT">
						<TD ALIGN="CENTER"><?php echo $l_private?></TD>
					</TR>
					<TR BGCOLOR="<?php echo $color2?>" ALIGN="LEFT">
						<TD ALIGN="CENTER">
							<TABLE BORDER="0" CELLPADDING="1" CELLSPACING="0">
							  <TR>
							    <TD>
							      <FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2?>" COLOR="<?php echo $textcolor?>">
							      <b><?php echo $l_username?>: &nbsp;</b></font></TD><TD><INPUT TYPE="TEXT" NAME="username" SIZE="25" MAXLENGTH="40" VALUE="<?php echo $userdata[username]?>">
							    </TD>
							  </TR><TR>
							    <TD>
							      <FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2?>" COLOR="<?php echo $textcolor?>">
							      <b><?php echo $l_password?>: </b></TD><TD><INPUT TYPE="PASSWORD" NAME="password" SIZE="25" MAXLENGTH="25">
							    </TD>
							  </TR>
							</TABLE>
						</TD>
					</TR>
					<TR BGCOLOR="<?php echo $color1?>" ALIGN="LEFT">
						<TD ALIGN="CENTER">
							<INPUT TYPE="HIDDEN" NAME="forum" VALUE="<?php echo $forum?>">
							<INPUT TYPE="HIDDEN" NAME="topic" VALUE="<?php echo $topic?>">
							<INPUT TYPE="HIDDEN" NAME="post_id" VALUE="<?php echo $post_id?>">
							<INPUT TYPE="SUBMIT" NAME="logging_in" VALUE="<?php echo $l_enter?>">
						</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
	</TABLE>
</FORM>
<?php
	require('page_tail.'.$phpEx);
	exit();
	}
	else 
	{
		if ($logging_in)
		{
			if ($username == '' || $password == '') 
			{
				error_die("$l_userpass $l_tryagain");
			}
			if (!check_username($username, $db)) 
			{
				error_die("$l_nouser $l_tryagain");
			}
			if (!check_user_pw($username, $password, $db)) 
			{
				erroe_die("$l_wrongpass $l_tryagain");
			}
		
			/* if we get here, user has entered a valid username and password combination. */
		
			$userdata = get_userdata($username, $db);
		
			$sessid = new_session($userdata[user_id], $REMOTE_ADDR, $sesscookietime, $db);	
		
			set_session_cookie($sessid, $sesscookietime, $sesscookiename, $cookiepath, $cookiedomain, $cookiesecure);
			
		}
	
		require('page_header.'.$phpEx);
		
		if ($myrow[forum_type] == 1)
		{
			// To get here, we have a logged-in user. So, check whether that user is allowed to post in
			// this private forum.
			
			if (!check_priv_forum_auth($userdata[user_id], $forum, TRUE, $db))
			{
				error_die("$l_privateforum $l_nopost");
			}
			
			// Ok, looks like we're good.
		}
		
	}	
	
   $sql = "SELECT p.*, pt.post_text, u.username, u.user_id, u.user_sig, t.topic_title, t.topic_notify 
   			FROM posts p, users u, topics t, posts_text pt 
   			WHERE (p.post_id = '$post_id') 
   			AND pt.post_id = p.post_id
   			AND (p.topic_id = t.topic_id) 
   			AND (p.poster_id = u.user_id)";
   			
   if(!$result = mysql_query($sql, $db))
		error_die("Couldn't get user and topic information from the database.<br>$sql");
   $myrow = mysql_fetch_array($result);
   // Freekin' ugly but I couldn't get it to work right as 1 big if 
   //          - James
   if ($user_logged_in) {
      if($userdata[user_level] <= 2) {
	 if($userdata[user_level] == 2 && !is_moderator($forum, $userdata[user_id], $db)) {
	    if($userdata[user_level] < 2 && ($userdata[user_id] != $myrow[user_id]))
		 	error_die($l_notedit);
	 }
      }
   }

   $message = $myrow[post_text];
   if(eregi("\[addsig]$", $message))
     $addsig = 1;
   else
     $addsig = 0;
   $message = eregi_replace("\[addsig]$", "\n_________________\n" . $myrow[user_sig], $message);   
   $message = str_replace("<BR>", "\n", $message);
   $message = stripslashes($message);
   $message = desmile($message);
   $message = bbdecode($message);
   $message = undo_make_clickable($message);
   $message = undo_htmlspecialchars($message);
   
   // Special handling for </textarea> tags in the message, which can break the editing form..
   $message = preg_replace('#</textarea>#si', '&lt;/TEXTAREA&gt;', $message);
   
   list($day, $time) = split(" ", $myrow[post_time]);
?>
<FORM ACTION="<?php echo $PHP_SELF?>" METHOD="POST">
<TABLE BORDER="0" CELLPADDING="1" CELLSPACING="0" ALIGN="CENTER" VALIGN="TOP" WIDTH="<?php echo $tablewidth?>"><TR><TD  BGCOLOR="<?php echo $table_bgcolor?>">
<TABLE BORDER="0" CELLPADDING="3" CELLSPACING="1" WIDTH="100%">
<TR BGCOLOR="<?php echo $color1?>" ALIGN="LEFT">
	<TD ALIGN="CENTER" COLSPAN="2"><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo $pagetitle?></b></TD>
</TR>
<?php
     if(!$user_logged_in) {
?>
<TR>
	<TD BGCOLOR="<?php echo $color1?>"><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><?php echo $l_username?>:</TD>
	<TD BGCOLOR="<?php echo $color2?>"><input type="text" name="username" value="<?php echo $userdata[username]?>"></TD>
</TR>	  
<?PHP
     }
   else {
?>
	<TD BGCOLOR="<?php echo $color1?>"><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo $l_username?></b>:</TD>
	<TD BGCOLOR="<?php echo $color2?>"><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><?php echo $userdata[username]?></TD>
<?php
   }
	if (!$user_logged_in) {
		// ask for a password..
	   echo "<TR> \n";
	   echo "<TD BGCOLOR=\"$color1\"><font size=\"$FontSize2\" face=\"$FontFace\">$l_password:<BR><font size=\"$FontSize3\"><i><a href=\"sendpassword.$phpEx\" target=\"_blank\">($l_passwdlost)</a></i></font></TD>";
	   echo "<TD BGCOLOR=\"$color2\"><INPUT TYPE=\"PASSWORD\" NAME=\"passwd\" SIZE=\"25\" MAXLENGTH=\"25\"></TD> \n";
	   echo "</TR> \n";
	}
   $first_post = is_first_post($topic, $post_id, $db);
   if($first_post) {
?>
<TR>
	<TD BGCOLOR="<?php echo $color1?>" width=25%><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo $l_subject?>:</b></TD>
	<TD BGCOLOR="<?php echo $color2?>"><INPUT TYPE="TEXT" NAME="subject"  SIZE="50" MAXLENGTH="100" VALUE="<?php echo stripslashes($myrow[topic_title])?>"></TD>
</TR>
<?php
   }
?>
<TR>
     <TD  BGCOLOR="<?php echo $color1?>" width=25%><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo $l_body?>:</b><br><br>
     <font size=-1>
<?php
     echo "$l_htmlis: ";
   if($allow_html == 1)
     echo "$l_on<BR>\n";
   else
     echo "$l_off<BR>\n";
   echo "$l_bbcodeis:";
   if($allow_bbcode == 1)
     echo "$l_on<br>\n";
   else
     echo "$l_off<BR>\n";
?>
     </font></TD>
     <TD BGCOLOR="<?php echo $color2?>"><TEXTAREA NAME="message" ROWS=10 COLS=45 WRAP="VIRTUAL"><?php echo $message?></TEXTAREA></TD>
</TR>
<TR ALIGN="LEFT">
		<TD  BGCOLOR="<?php echo $color1?>" width=25%><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo $l_options?>:</b></TD>
		<TD  BGCOLOR="<?php echo $color2?>" ><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
		<?php
			$now_hour = date("H");
			$now_min = date("i");
			list($hour, $min) = split(":", $time);
			if((($now_hour == $hour && $min_now - 30 < $min) || ($now_hour == $hour +1 && $now_min - 30 > 0)) || ($userdata[user_level] > 2 || is_moderator($forum, $userdata[user_id], $db))) {
		?>
				<INPUT TYPE="CHECKBOX" NAME="delete"><?php echo $l_delete?><BR>
		<?php
			}
		
			if($allow_html == 1) {
			   if($userdata[user_html] == 1) {
			     $h = "CHECKED";
				}
				echo "<INPUT TYPE=\"CHECKBOX\" NAME=\"html\" $n>$l_disable $l_html $l_onthispost<BR>";
			}
		
			if($allow_bbcode == 1) {
			   if($userdata[user_bbcode] == 1)
			     $b = "CHECKED";
				echo "<INPUT TYPE=\"CHECKBOX\" NAME=\"bbcode\" $b>$l_disable <a href=\"$bbref_url\" target=\"_blank\"><i>$l_bbcode</i></a> $l_onthispost<BR>";
			}
			
			if($userdata[user_desmile] == 1){
				$ds = "CHECKED";
			}
			echo "<INPUT TYPE=\"CHECKBOX\" NAME=\"smile\" $ds>$l_disable <a href=\"$smileref_url\" target=\"_blank\"><i>$l_smilies</i></a> $l_onthispost.<BR>";
			
			if($first_post) {
				if($myrow[topic_notify] == 1){
		      	$chk = "CHECKED";
				}
		 		?>
				<INPUT TYPE="CHECKBOX" NAME="notify" <?php echo $chk?>> <?php echo $l_notify?>
				<?php
			}
                 ?>
            </TD>
	</TR>
<TR>
	<TD  BGCOLOR="<?php echo $color1?>" colspan=2 ALIGN="CENTER">
<?php if($user_logged_in) {
?>
     <INPUT TYPE="HIDDEN" NAME="username" VALUE="<?php echo $userdata[username]?>">
<?php
}
?>
	<INPUT TYPE="HIDDEN" NAME="post_id" VALUE="<?php echo $post_id?>">
	<INPUT TYPE="HIDDEN" NAME="forum" VALUE="<?php echo $forum?>">
	<!--<INPUT TYPE="HIDDEN" NAME="topic_id" VALUE="<?php echo $topic?>">
	<INPUT TYPE="HIDDEN" NAME="poster_id" VALUE="<?php echo $myrow[poster_id]?>">-->
	<INPUT TYPE="SUBMIT" NAME="submit" VALUE="<?php echo $l_submit?>">
	</TD>
</TR>
</TABLE></TD></TR></TABLE>
<?php
	// Topic review
	echo "<font size=\"$FontSize2\" face=\"$FontFace\">";
	echo "<BR><CENTER>";
	echo "<a href=\"viewtopic.$phpEx?topic=$topic&forum=$forum\" target=\"_blank\"><b>$l_topicreview</b></a>";
	echo "</CENTER><BR>";
	       
}
include('page_tail.'.$phpEx);
?>
