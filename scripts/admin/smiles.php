<?php
/***************************************************************************
                            admin.php  -  description
                               -------------------
      begin                : Sat Oct 28 2000
      copyright            : (C) 2001 The phpBB Group
      email                : support@phpbb.com

      $Id: smiles.php,v 1.9 2001/07/07 11:14:18 blackpuma Exp $

 ***************************************************************************/
/****************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
  /*
   * This file was created by Viceroy (http://www.youdotheweb.com) as part of
   * a 'Smile Control Panel' hack for phpBB. It was later imported into the
   * official phpBB distribution.
   */
include '../extention.inc';

include '../config.'.$phpEx;
require '../auth.'.$phpEx;
    $pagetitle = 'Smiles Control';
    $pagetype = 'admin';
    include '../page_header.'.$phpEx;

    echo "<font face=\"$FontFace\" size=\"$FontSize2\">";
    echo "<TABLE width=\"45%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bordercolor=\"$table_bgcolor\">";
    echo "<tr><td align=\"center\" width=\"100%\" bgcolor=\"$color1\"><font face=\"$FontFace\" size=\"$FontSize4\" color=\"$textcolor\"><B>Smilies Utility.</B></font></td></TR>";
    echo "<tr><td align=\"center\" width=\"100%\" bgcolor=\"$color1\"><font face=\"$FontFace\" size=\"$FontSize2\" color=\"$textcolor\"><a href=\"$PHP_SELF?mode=add\">Add Smile</a></TD></TR>";
    echo '</TR></table></TD></TR></TABLE><BR><BR><center>';

    if ('' == $mode) {
        $mode = 'view';
    }

    switch ($mode) {
 case 'view':
   if ($getsmiles = mysql_query('SELECT * FROM smiles')) {
       if ('0' == ($numsmiles = $getsmiles->rowCount())) {
           echo "<font face=\"$FontFace\" size=2>No smiles currently. <a href='$PHP_SELF?mode=add'>Click here</a> to add some.</font>";
       } else {
           echo "<table border=0 cellspacing=1 cellpadding=3><tr><td bgcolor=\"$color1\"><font face=\"$FontFace\" size=2>Code</font></td><td bgcolor='$color2'><font face=\"$FontFace\" size=2>Smile</font></td><td bgcolor='$color1'>&nbsp;</td><td bgcolor='$color2'>&nbsp;</td></tr>";
           while ($smiles = $getsmiles->fetch(\PDO::FETCH_BOTH)) {
               echo "<tr><td bgcolor='$color1'><font face=\"$FontFace\" size=2>$smiles[code]</font></td><td bgcolor='$color2'><img src=\"$url_smiles/$smiles[smile_url]\"></td><td bgcolor='$color1'><a href=\"$PHP_SELF?mode=edit&id=$smiles[id]\">Edit</a></td><td bgcolor='$color2'><a href=\"$PHP_SELF?mode=delete&id=$smiles[id]\">Delete</a></td></tr>";
           }
           echo '</table>';
       }
   } else {
       echo 'Could not retrieve from the smile database.';
   }
   break;

 case 'add':
   if (!isset($submit)) {
       echo "<TABLE width=\"45%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bordercolor=\"$table_bgcolor\">";
       echo "<tr><td align=\"center\" width=\"100%\" bgcolor=\"$color1\"><font face=\"$FontFace\" size=\"$FontSize2\" color=\"$textcolor\"><B>Add Smilie.</B></font></td>";
       echo '</tr><TR><TD><TABLE width="100%" cellspacing="0" cellpadding="0"><TR>';
       echo "<td align=\"center\" width=\"100%\" bgcolor=\"$color2\"><font face=\"$FontFace\" size=\"$FontSize2\" color=\"$textcolor\"><P>"; ?>

	Make sure you uploaded your smiles in the proper directory.<br>
	For Smile URL, just put the smile filename.
	
	<form method=post action="<?php echo $PHP_SELF; ?>">
	Smile Code: <input type="text" name="code"><br>
	Smile URL: <input type="text" name="smile_url"><br>
	Smile Emotion: <input type="text" name="emotion"><br>
	<input type="hidden" name="mode" value="add">
	<input type="submit" name="submit" value="Add the Smile!">
	</form>
	<?php
echo '</font><P></TD>';
       echo '</TR></table></TD></TR></TABLE>';
   } else {
       $code = addslashes($code);
       $smile_url = addslashes($smile_url);
       $emotion = addslashes($emotion);

       if (!$insertsmile = mysql_query("INSERT INTO smiles (id, code, smile_url, emotion) VALUES ('', '$code', '$smile_url', '$emotion')")) {
           echo "<TABLE width=\"45%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bordercolor=\"$table_bgcolor\">";
           echo "<tr><td align=\"center\" width=\"100%\" bgcolor=\"$color1\"><font face=\"$FontFace\" size=\"$FontSize2\" color=\"$textcolor\"><B>Add Smilie.</B></font></td>";
           echo '</tr><TR><TD><TABLE width="100%" cellspacing="0" cellpadding="0"><TR>';
           echo "<td align=\"center\" width=\"100%\" bgcolor=\"$color2\"><font face=\"$FontFace\" size=\"$FontSize1\" color=\"$textcolor\"><P>&nbsp;&nbsp;Could Not Add The Smilie To The Database!</font><P></TD>";
           echo '</TR></table></TD></TR></TABLE>';
       } else {
           echo "<TABLE width=\"45%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bordercolor=\"$table_bgcolor\">";
           echo "<tr><td align=\"center\" width=\"100%\" bgcolor=\"$color1\"><font face=\"$FontFace\" size=\"$FontSize2\" color=\"$textcolor\"><B>Add Smilie.</B></font></td>";
           echo '</tr><TR><TD><TABLE width="100%" cellspacing="0" cellpadding="0"><TR>';
           echo "<td align=\"center\" width=\"100%\" bgcolor=\"$color2\"><font face=\"$FontFace\" size=\"$FontSize1\" color=\"$textcolor\"><P>&nbsp;&nbsp;Your Smilie Has Been Added!</font><P></TD>";
           echo '</TR></table></TD></TR></TABLE>';
       }
   }

   break;

 case 'edit':

   if (isset($id)) {
       $submit = "Let's Edit the Smile!";
       $smile = $id;
   }

   if ("Let's Edit the Smile!" == $submit) {
       if ($getsmiles = mysql_query("SELECT * FROM smiles WHERE id = '$smile'")) {
           $smiles = $getsmiles->fetch(\PDO::FETCH_BOTH);

           echo "<TABLE width=\"45%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bordercolor=\"$table_bgcolor\">";
           echo "<tr><td align=\"center\" width=\"100%\" bgcolor=\"$color1\"><font face=\"$FontFace\" size=\"$FontSize2\" color=\"$textcolor\"><B>Edit Smilie.</B></font></td>";
           echo '</tr><TR><TD><TABLE width="100%" cellspacing="0" cellpadding="0"><TR>';
           echo "<td align=\"center\" width=\"100%\" bgcolor=\"$color2\"><font face=\"$FontFace\" size=\"$FontSize2\" color=\"$textcolor\"><P>"; ?>
	   <form method=post action="<?php echo $PHP_SELF; ?>">
	   Smile Code: <input type="text" name="code" value="<?php echo $smiles[code]; ?>"><br>
	   Smile URL: <input type="text" name="smile_url" value="<?php echo $smiles[smile_url]; ?>"><br>
	   Smile Emotion: <input type="text" name="emotion" value="<?php echo $smiles[emotion]; ?>"><br>
	   <input type="hidden" name="mode" value="edit">
	   <input type="hidden" name="smile_id" value="<?php echo $smile; ?>">
	   <input type="submit" name="submit" value="Submit Changes">
	   </form>
	   <?php
echo '</font><P></TD>';
           echo '</TR></table></TD></TR></TABLE>';
       } else {
           echo "<TABLE width=\"45%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bordercolor=\"$table_bgcolor\">";
           echo "<tr><td align=\"center\" width=\"100%\" bgcolor=\"$color1\"><font face=\"$FontFace\" size=\"$FontSize2\" color=\"$textcolor\"><B>Edit Smilie.</B></font></td>";
           echo '</tr><TR><TD><TABLE width="100%" cellspacing="0" cellpadding="0"><TR>';
           echo "<td align=\"center\" width=\"100%\" bgcolor=\"$color2\"><font face=\"$FontFace\" size=\"$FontSize1\" color=\"$textcolor\"><P>&nbsp;&nbsp;Could Not Retrieve The Image.</font><P></TD>";
           echo '</TR></table></TD></TR></TABLE>';
       }
   } elseif ('Submit Changes' == $submit) {
       $code = addslashes($code);
       $smile_url = addslashes($smile_url);
       $emotion = addslashes($emotion);
       if ($updatesmile = mysql_query("UPDATE smiles SET code = '$code', emotion = '$emotion', smile_url = '$smile_url' WHERE id = '$smile_id'")) {
           echo "<TABLE width=\"45%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bordercolor=\"$table_bgcolor\">";
           echo "<tr><td align=\"center\" width=\"100%\" bgcolor=\"$color1\"><font face=\"$FontFace\" size=\"$FontSize2\" color=\"$textcolor\"><B>Edit Smilie.</B></font></td>";
           echo '</tr><TR><TD><TABLE width="100%" cellspacing="0" cellpadding="0"><TR>';
           echo "<td align=\"center\" width=\"100%\" bgcolor=\"$color2\"><font face=\"$FontFace\" size=\"$FontSize1\" color=\"$textcolor\"><P>&nbsp;&nbsp;Smile Successfully Updated.</font><P></TD>";
           echo '</TR></table></TD></TR></TABLE>';
       } else {
           echo "<TABLE width=\"45%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bordercolor=\"$table_bgcolor\">";
           echo "<tr><td align=\"center\" width=\"100%\" bgcolor=\"$color1\"><font face=\"$FontFace\" size=\"$FontSize2\" color=\"$textcolor\"><B>Edit Smilie.</B></font></td>";
           echo '</tr><TR><TD><TABLE width="100%" cellspacing="0" cellpadding="0"><TR>';
           echo "<td align=\"center\" width=\"100%\" bgcolor=\"$color2\"><font face=\"$FontFace\" size=\"$FontSize1\" color=\"$textcolor\"><P>&nbsp;&nbsp;Sorry Your Smilie Could Not Be Updated!</font><P></TD>";
           echo '</TR></table></TD></TR></TABLE>';
       }
   } else {
       $count = 1;

       if ($getsmiles = mysql_query('SELECT * FROM smiles')) {
           echo 'Please select a smile from the pile below.';
           if ('0' == ($numsmiles = $getsmiles->rowCount())) {
               echo "<font face=\"$FontFace\" size=2>No smiles currently. <a href='$PHP_SELF?mode=add'>Click here</a> to add some.</font>";
           } else {
               echo "<form method=post action=\"$PHP_SELF\"><input type='hidden' name='mode' value='edit'>";
               while ($smiles = $getsmiles->fetch(\PDO::FETCH_BOTH)) {
                   echo "<input type=\"radio\" name=\"smile\" value=\"$smiles[id]\">&nbsp;&nbsp;<img src=\"$url_smiles/$smiles[smile_url]\">&nbsp;&nbsp;$smiles[code]&nbsp;&nbsp;&nbsp;&nbsp;\n";

                   if ('0' == ($count % '7')) {
                       echo "<br>\n";
                   }
                   ++$count;
               }
               echo "<br><input type='submit' name='submit' value=\"Let's Edit the Smile!\">";
           }
       }
   }

   break;

 case 'delete':

   if (isset($id)) {
       $submit = 'Delete Smile';
       $smile_id = $id;
   }

   if (!isset($submit)) {
       if ($getsmiles = mysql_query('SELECT * FROM smiles')) {
           echo 'Please select a smile from the pile below.';

           if ('0' == ($numsmiles = $getsmiles->rowCount())) {
               echo "<font face=\"$FontFace\" size=2>No smiles currently. <a href='$PHP_SELF?mode=add'>Click here</a> to add some.</font>";
           } else {
               echo "<form method=post action=\"$PHP_SELF\"><input type='hidden' name='mode' value='delete'>";
               $count = 1;
               while ($smiles = $getsmiles->fetch(\PDO::FETCH_BOTH)) {
                   echo "<input type=\"radio\" name=\"smile\" value=\"$smiles[id]\">&nbsp;&nbsp;<img src=\"$url_smiles/$smiles[smile_url]\">&nbsp;&nbsp;$smiles[code]&nbsp;&nbsp;&nbsp;&nbsp;\n";
                   echo "<input type='hidden' name='smile_id' value='$smiles[id]'>";

                   if ('0' == ($count % '7')) {
                       echo "<br>\n";
                   }
                   ++$count;
               }
               echo "<br><input type='submit' name='submit' value='Delete Smile'>";
           }
       }
   } elseif ('Delete Smile' == $submit) {
       if (!$delsmile = mysql_query("DELETE FROM smiles WHERE id = '$smile_id'")) {
           echo "<TABLE width=\"45%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bordercolor=\"$table_bgcolor\">";
           echo "<tr><td align=\"center\" width=\"100%\" bgcolor=\"$color1\"><font face=\"$FontFace\" size=\"$FontSize2\" color=\"$textcolor\"><B>Delete Smilie.</B></font></td>";
           echo '</tr><TR><TD><TABLE width="100%" cellspacing="0" cellpadding="0"><TR>';
           echo "<td align=\"center\" width=\"100%\" bgcolor=\"$color2\"><font face=\"$FontFace\" size=\"$FontSize1\" color=\"$textcolor\"><P>&nbsp;&nbsp;Sorry Your Smilie Could Not Be Deleted!</font><P></TD>";
           echo '</TR></table></TD></TR></TABLE>';
       } else {
           echo "<TABLE width=\"45%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bordercolor=\"$table_bgcolor\">";
           echo "<tr><td align=\"center\" width=\"100%\" bgcolor=\"$color1\"><font face=\"$FontFace\" size=\"$FontSize2\" color=\"$textcolor\"><B>Delete Smilie.</B></font></td>";
           echo '</tr><TR><TD><TABLE width="100%" cellspacing="0" cellpadding="0"><TR>';
           echo "<td align=\"center\" width=\"100%\" bgcolor=\"$color2\"><font face=\"$FontFace\" size=\"$FontSize1\" color=\"$textcolor\"><P>&nbsp;&nbsp;Your Smilie Has Be Deleted!</font><P></TD>";
           echo '</TR></table></TD></TR></TABLE>';
       }
   }

   break;
}

    echo '</font></center><br><br>';

include '../page_tail.'.$phpEx;
