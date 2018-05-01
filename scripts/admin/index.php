<?php
/***************************************************************************
                          admin.php  -  description
                             -------------------
    begin                : Sat June 17 2000
    copyright            : (C) 2001 The phpBB Group
    email                : support@phpbb.com

    $Id: index.php,v 1.28 2001/04/13 06:35:18 thefinn Exp $
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
include '../extention.inc';

include '../config.'.$phpEx;
require '../auth.'.$phpEx;

$pagetitle = 'Forum Administration';
$pagetype = 'admin';
include '../page_header.'.$phpEx;

if ($mode) {
} else {
    ?>
<TABLE BORDER="0" CELLPADDING="1" CELLSPACING="0" ALIGN="CENTER" VALIGN="TOP" WIDTH="95%"><TR><TD  BGCOLOR="<?php echo $table_bgcolor; ?>">
<TABLE BORDER="0" CELLPADDING="1" CELLSPACING="1" WIDTH="100%">
<TR BGCOLOR="<?php echo $color1; ?>" ALIGN="LEFT">
	<TD ALIGN="CENTER" COLSPAN="2"><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>"><B>phpBB Forum Administration</B></FONT></FONT></TD>
</TR>
<TR BGCOLOR="<?php echo $color2; ?>" ALIGN="LEFT">
	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>"><a href="<?php echo $url_admin; ?>/admin_forums.<?php echo $phpEx; ?>?mode=addforum">Add a Forum</a></FONT></TD>
	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>">This Link will take you to a page where you can add a forum to the database.</FONT></TD>
</TR>
<TR BGCOLOR="<?php echo $color2; ?>" ALIGN="LEFT">
	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>"><a href="<?php echo $url_admin; ?>/admin_forums.<?php echo $phpEx; ?>?mode=editforum">Edit a Forum</a></FONT></TD>
	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>">This link will allow you to edit an existing forum.</FONT></TD>
</TR>
<TR BGCOLOR="<?php echo $color2; ?>" ALIGN="LEFT">
	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>"><a href="<?php echo $url_admin; ?>/admin_priv_forums.<?php echo $phpEx; ?>?mode=editforum">Set Private Forum Permissions</a></FONT></TD>
	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>">This link will allow you to set the access to an existing private forum.</FONT></TD>
</TR>
<TR BGCOLOR="<?php echo $color2; ?>" ALIGN="LEFT">
	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>"><a href="<?php echo $url_admin; ?>/admin_board.<?php echo $phpEx; ?>?mode=sync">Sync forum/topic index</a></FONT></TD>
	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>">This link will allow you to sync up the forum and topic indexes to fix any descrepancies that might arise</FONT></TD>
</TR>
<TR BGCOLOR="<?php echo $color2; ?>" ALIGN="LEFT">
	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>"><a href="<?php echo $url_admin; ?>/admin_forums.<?php echo $phpEx; ?>?mode=addcat">Add a Category</a></FONT></TD>
	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>">This link will allow you to add a new category to put forums into.</FONT></TD>
</TR>
<TR BGCOLOR="<?php echo $color2; ?>" ALIGN="LEFT">
	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>"><a href="<?php echo $url_admin; ?>/admin_forums.<?php echo $phpEx; ?>?mode=editcat">Edit a Category Title</a></FONT></TD>
	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>">This link will allow you edit the title of a category.</FONT></TD>
</TR>
<TR BGCOLOR="<?php echo $color2; ?>" ALIGN="LEFT">
     <TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>"><a href="<?php echo $url_admin; ?>/admin_forums.<?php echo $phpEx; ?>?mode=remcat">Remove a Category</a></FONT></TD>
     <TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>">This link allows you to remove any cagegories from the database</FONT></TD>
</TR>
<TR BGCOLOR="<?php echo $color2; ?>" ALIGN="LEFT">
     <TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>"><a href="<?php echo $url_admin; ?>/admin_forums.<?php echo $phpEx; ?>?mode=catorder">Re-Order Categories</a></FONT></TD>
     <TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>">This link will allow you to change the order in which your categories display on the index page</font></TD>
</TR>
<TR BGCOLOR="<?php echo $color2; ?>" ALIGN="LEFT">
	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>"><a href="<?php echo $url_admin; ?>/admin_board.<?php echo $phpEx; ?>?mode=setoptions">Set Forum-wide Options</a></FONT></TD>
	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>">This link will allow you to set various forum-wide options such as allowing HTML in posts.</FONT></TD>
</TR>
<TR BGCOLOR="<?php echo $color2; ?>" ALIGN="LEFT">
	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>"><a href="<?php echo $url_admin; ?>/admin_board.<?php echo $phpEx; ?>?mode=rankadmin">Create/Edit User Rankings</a></FONT></TD>
	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>">This link will allow you to add different user rankings. Ranks can be assigned to specific users in the modify user section.</FONT></TD>
</TR>
<TR BGCOLOR="<?php echo $color2; ?>" ALIGN="LEFT">
	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>"><a href="<?php echo $url_admin; ?>/admin_users.<?php echo $phpEx; ?>?mode=moduser">Modify User</a></FONT></TD>
	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>">This link will allow you to modify a user account, including username, level, and rank.</FONT></TD>
</TR>
<TR BGCOLOR="<?php echo $color2; ?>" ALIGN="LEFT">
	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>"><a href="<?php echo $url_admin; ?>/admin_users.<?php echo $phpEx; ?>?mode=remuser">Remove a User</a></FONT></TD>
	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>">This link will allow you to remove any registered user from the database.</FONT></TD>
</TR>
<TR BGCOLOR="<?php echo $color2; ?>" ALIGN="LEFT">
	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>"><a href="<?php echo $url_admin; ?>/admin_users.<?php echo $phpEx; ?>?mode=banuser">Ban a User</a></FONT></TD>
	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>">This link allows you to ban a user account, or to ban by IP.</a></FONT></TD>
</TR>
<TR BGCOLOR="<?php echo $color2; ?>" ALIGN="LEFT">
       	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>"><a href="<?php echo $url_admin; ?>/admin_users.<?php echo $phpEx; ?>?mode=badusernames">Disallow a Username</a></FONT></TD>
       	<TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>">This link allows you to disallow specific usernames. No user will be allowed to register with a disallowed username.</FONT></TD>
</TR>
<TR BGCOLOR="<?php echo $color2; ?>" ALIGN="LEFT">
     <TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>"><a href="<?php echo $url_admin; ?>/admin_users.<?php echo $phpEx; ?>?mode=badwords">Censor Bad Words</a></FONT></TD>
     <TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>">This link allows you to define words that are censored and replace them with whatever you like</a></FONT></TD>
</TR>

<TR BGCOLOR="<?php echo $color2; ?>" ALIGN="LEFT">
     <TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>"><a href="<?php echo $url_admin; ?>/smiles.<?php echo $phpEx; ?>">Edit/Add/Delete Smiles</a></FONT></TD>
     <TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>">This link allows you to edit and delete smiles, and add new ones.</FONT></TD>
</TR>
<TR BGCOLOR="<?php echo $color2; ?>" ALIGN="LEFT">
     <TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>"><a href="<?php echo $url_admin; ?>/admin_themes.<?php echo $phpEx; ?>">Add/Edit/Delete Themes</a></FONT></TD>
     <TD><FONT FACE="<?php echo $FontFace; ?>" SIZE="<?php echo $FontSize2; ?>" COLOR="<?php echo $textcolor; ?>">This link allows you to add, edit, and delete forum themes.</FONT></TD>
</TR>
</TABLE></TD></TR></TABLE>
<?php
}
include '../page_tail.'.$phpEx;
