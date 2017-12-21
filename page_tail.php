<?php
/***************************************************************************
  	                        page_tail.php  -  description
 	                        -------------------    
	begin                : Sat June 17 2000    
	copyright            : (C) 2001 The phpBB Group
	email                : support@phpbb.com
 
    $Id: page_tail.php,v 1.29 2001/03/28 08:02:20 thefinn Exp $
 
***************************************************************************/

/*************************************************************************** *                                         				                                 
 *   This program is free software; you can redistribute it and/or modify  	 
 *   it under the terms of the GNU General Public License as published by   
 *   the Free Software Foundation; either version 2 of the License, or	    	 
 *   (at your option) any later version. * 
 ***************************************************************************/
if($user_logged_in && $userdata[user_level] == 4) {
	
?>
     <FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize3?>" COLOR="<?php echo $textcolor?>">
     <CENTER><a href="<?php echo $url_admin_index?>"><?php echo $l_adminpanel?></a></CENTER><BR>
     </FONT>
<?php
}
?>
<FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize3?>" COLOR="<?php echo $textcolor?>">
<CENTER><?php echo $l_poweredby?> <a href="http://www.phpbb.com/" target="_blank">phpBB</a> <?php echo "$l_version $phpbbversion"?><BR>
<?php
  /* Please Note!
   * This is a notice to anyone who is using phpBB and altering this file.
   * PLEASE do not remove the following copyright notice. All we ask in return
   * for the use of this software is that you leave the copyright notice on here.
   * Credit where credit is due, alot of people have put alot of hard work
   * into this. :)
   * Thank you.
   * - The phpBB Group
   */
?>
Copyright &copy; 2000 - 2001 <a href="http://www.phpbb.com/credits.php" target="_blank">The phpBB Group</a>
</CENTER>
</font><BR>

<?php
showfooter($db);
$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$endtime = $mtime;
$totaltime = ($endtime - $starttime);
printf("<center><font size=-2>phpBB Created this page in %f seconds.</font></center>", $totaltime);

?>

</FONT>
</BODY>
</HTML>
