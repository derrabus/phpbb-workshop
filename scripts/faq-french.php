<?php
/***************************************************************************
                          faq-french.php  -  description
                             -------------------
    begin                : Fri November 3, 2000
    translated by 	 : Kirin * http://www.choixpc.com/ * on 10/06/2001
    original file	 : faq.php - English language -
    copyright            : Free - Offered to the phpBB Community - All thanks to the phpBB group !
    email                : support@phpbb.com

    $Id: faq-french.php,v 1.1 2001/08/01 00:46:00 thefinn Exp $

 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
/***************************************************************************
 * Created by: Steven Cunningham (defender@webinfractions.com) for phpBB
 * *************************************************************************/
include('extention.inc');

include('config.'.$phpEx);
require('auth.'.$phpEx);
$pagetitle = "FAQ";
$pagetype = "other";
include('page_header.'.$phpEx);
?>

<div align="center"><center>
<table border="0" width="<?php echo $tablewidth?>" bgcolor="<?php echo $table_bgcolor?>">
  <TR><TD>
<table border="0" width="100%" bgcolor=>
    <tr bgcolor="<?php echo $color1?>">
        <td><font size="<?php echo $FontSize4?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>"><b>Frequently
          Asked Questions (Questions Fréquemment Posées)</font></b></td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
          <font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $linkcolor?>">
          <a href="#register">Suis-je obligé de m'inscrire ?</a><br>
          <a href="#smilies">Puis-je utiliser des smileys ?</a><br>
          <a href="#html">Utiliser du HTML</a><br>
          <a href="#bbcode">Utiliser les codes spécifiques aux forums</a><br>
          <a href="#mods">Que font les modérateurs ?</a><br>
	  <a href="#profile">Puis-je modifier mon profil ?</a><br>
          <a href="#prefs">Puis-je "customiser" le forum ?</a><br>
          <a href="#cookies">Le forum utilise-t-il des cookies ?</a><br>
          <a href="#edit">Puis-je éditer mes propres posts ?</a><br>
          <a href="#attach">Puis-je insérer des documents attachés ?</a><br>
          <a href="#search">Puis-je faire une recherche sur le forum ?</a><br>
          <a href="#signature">Puis-je insérer une signature à la fin de mes posts ?</a><br>
          <a href="#announce">Que sont les "announcements" ?</a><br>
          <a href="#pw">Existe-t-il un système de récupération de mon nom d'utilisateur / mot de passe ?</a><br>
          <a href="#notify">Puis-je être notifié par e-mail si quelqu'un répond à mon sujet ?</a><br>
          <a href="#searchprivate">Puis-je faire une recherche sur les forums privés ?</a><br>
          <a href="#ranks">Quels sont les "ranks" dans les forums <?php echo $sitename?></a><br>
          <a href="#rednumbers">Pourquoi y a-t-il des icônes en flamme parfois ?</a></p></font>
        </td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<a name="register">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
        <b>S'inscrire</b></font></a>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	L'inscription est uniquement requise ou pas en fonction des forums. Suivant comment l'administrateur du forum a réglé ses forums, certains 
	nécessiteront que vous soyez inscrits pour y poster, et d'autres vous permettront d'y poster librement. Si le fait de poster anonymement 
	est autorisé vous pouvez le faire simplement en n'entrant ni nom d'utilisateur ni mot de passe lorsqu'ils vous seront demandés.
        L'inscription est libre et il ne vous est pas demandé de donner votre vrai nom. Vous n'êtes pas obligé de donner votre vrai adresse e-mail,
        cependant elle ne sera utilisée que pour vous faire parvenir un nouveau mot de passe au cas où vous ayez oublié le votre. Par défaut 
        votre adresse e-mail est cachée aux yeux de tout le monde (excepté de l'administrateur du forum) mais vous pouvez permettre aux autres 
        utilisateur de voir votre adresse e-mail en sélectionnant l'option "Autoriser les autres membres à voir votre Adresse Email" lors de 
        l'inscription ou encore ultérieurement dans votre profil. Vous pouvez vous inscrire 
        <a href="<?php echo $url_phpbb?>/bb_register.<?php echo $phpEx?>?mode=agreement">ici</a></font>.
	</td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<a name="smilies">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
        <b>Les smileys</b></font></a>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Vous avez probablement vu d'autres utilisateurs du forum ayant inséré des smileys dans leurs messages. Les smileys sont des assosciations de 
	caractères claviers utilisés pour exprimer des émotions, comme des sourires ou des grimaces. Ce forum convertit automatiquement certains smileys
	en une représentation graphique. Les smileys suivant sont actuellement supportés :
        </font><BR>
	
	<div align="center"><center>
	<table border=0 cellpadding=0 cellspacing=0 align="CENTER"><TR><td bgcolor="#FFFFFF">
	  <TABLE WIDTH="500" border="0" cellpadding="0" cellspacing="1">
		 <TR BGCOLOR="<?php echo $color1?>">
		 <TD width="200" align="center">
		 	<FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2?>" COLOR="<?php echo $textcolor?>">
		 		<?php echo $l_smilesym?>
		 	</FONT>
		 </td>
		 <td width="200" align="center">
		 	<FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2?>" COLOR="<?php echo $textcolor?>">
				<?php echo $l_smileemotion?>
			</FONT>
		</td>
		<td width="100" align="center">
		 	<FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2?>" COLOR="<?php echo $textcolor?>">
				<?php echo $l_smilepict?>
			</FONT>
		</td></tr>
 <?php

      if ($getsmiles = mysql_query("SELECT * FROM smiles")) {
          while ($smile = $getsmiles->fetch(\PDO::FETCH_BOTH)) {
              ?>
		 <TR BGCOLOR="<?php echo $color2?>">
		 <TD width="200" align="center">
		 	<FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2?>" COLOR="<?php echo $textcolor?>">
		 		<?php echo stripslashes($smile[code])?>
		 	</FONT>
		 </td>
		 <td width="200" align="center">
		 	<FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2?>" COLOR="<?php echo $textcolor?>">
				<?php echo stripslashes($smile[emotion])?>&nbsp;
			</FONT>
		</td>
		<td width="100" align="center">
			<IMG SRC="<?php echo "$url_smiles/$smile[smile_url]"; ?>">
		</td></tr>
<?php
          }
      } else {
          echo "Could not retrieve from the smile database.";
      }
?>
    </TABLE>
		</td></tr>

    </TABLE>
    
</center></div>
	<tr bgcolor="<?php echo $color1?>">
	<td>
		<p align="left"><a name="html">
		<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
		<b>Utiliser du HTML</b></font></a></p>
	</td>
	</tr>
	<tr bgcolor="<?php echo $color2?>">
	<td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Si les administrateurs et modérateurs ont activés cette option, vous pourrez utilisez du HTML dans vos posts. A chaque fois que vous posterez 
	un nouveau message, il vous sera demandé si le code BB (cf. ci-dessous) et/ou le HTML est activé. Si le HTML est activé, vous pouvez alors utiliser
	du code de ce type, mais soyez attentifs à bien utiliser la syntaxe du HTML : en cas d'erreur, un modérateur ou adminsitrateur pourrait être amené à 
	éditer votre post.
	</font></td>
	<tr bgcolor="<?php echo $color1?>">
	<td>
		<p align="left"><a name="bbcode">
		<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
		<b>Utiliser du code BB</b></font></a></p>
	</td>
	</tr>
	<tr bgcolor="<?php echo $color2?>">
	<td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
Le code BB est une variation des tags HTML avec laquelle vous êtes peut-être déjà familier. De manière simpliste, il permet d'ajouter des fonctionnalités ou 
de l'enrichissement de texte qui normalement auraient requis du code HTML. Vous pouvez utiliser du code BB même si le HTML n'est pas activé sur le Forum 
que vous utilisez. Vous pouvez préférer le code BB au HTML, même si le HTML est validé sur votre forum, car il est de syntaxe plus courte et plus sûr 
d'usage (des erreurs de codage et de syntaxe ne conduiront pas à autant de soucis).
</font>
<P>

<table border=0 cellpadding=0 cellspacing=0 width="<?php echo $tablewidth?>" align="CENTER"><TR><td bgcolor="#FFFFFF">
<table border=0 cellpadding=4 border=0 cellspacing=1 width=100%>
<TR bgcolor="<?php echo $color1?>">
<TD>
<FONT SIZE="2" FACE="Verdana, Arial">
Créer des hyperliens</FONT></td></tr>
<TR bgcolor="<?php echo $color2?>"><TD><FONT SIZE="2" FACE="Verdana, Arial">
Si le code BB est validé dans votre forum, vous n'avez plus besoin d'utiliser le code [URL] pour créer un hyperlien. Mettez simplement l'URL complète d'une
des manières suivantes et le lien sera créé automatiquement.
<UL><FONT SIZE="2" FACE="Verdana, Arial" color="silver">
<LI> http://www.votreURL.com
<LI> www.votreURL.com
</font>

Remarquez que vous pouvez au choix utiliser la formulation complète de l'adresse URL avec "le http://" ou la raccourcir en commençant au "www" : cependant
 si le site à lier ne commence pas par "wwww", vous devez écrire l'adresse URL complète. De la même manière, si le BBcode est activé, vous pouvez utiliser 
des préfixes https et FTP dans ce mode.

<P>
L'ancien code [URL] continuera à fonctionner comme détaillé ci-dessous.

Encapsulez jsut le lient comme montré dans l'exemple ci-dessous (le code BB est en <FONT COLOR="#FF0000">rouge</FONT>).
<P><center>
<FONT COLOR="#FF0000">[url]</FONT>www.choixpc.com<FONT COLOR="#FF0000">[/url]</FONT>
<P></center>
Vous pouvez aussi faire de vrais hyperliens en utilisant le code HTML [url].  Utilisez juste le format suivant :
<BR><center>
<FONT COLOR="#FF0000">[url=http://www.choixpc.com]</font>Choisir son PC pièce par pièce<FONT COLOR="#FF0000">[/url]</font>
</center><p>
Dans les exemples ci-dessus, le code BB génère automatiquement un lien vers l'URL qui est associée. Il assurera aussi l'ouverture du lien dans une nouvelle
fenêtre lorsque l'utilisateur cliquera dessus. Notez que la partie  "http://" de l'URL est complètement optionnelle. Dans le second exemple ci-dessus, le code
permet de lier le texte de votre choix vers toute URL inscrite après le symbôle égal. Remarquez aussi que vous ne devez pas utiliser de guillemets à 
l'intérieur du tag URL.
</font>
</td>
<tr bgcolor="<?php echo $color1?>"><td>
<FONT SIZE="2" FACE="Verdana, Arial">
Lier des email</FONT></td></tr>
<TR bgcolor="<?php echo $color2?>"><TD>
<FONT SIZE="2" FACE="Verdana, Arial">
Pour ajouter un hyperlien vers une adresse email dans votre message, encapsulez juste l'adresse email comme montré dans l'exemple ci-dessous.
(Le code BB est en <FONT COLOR="#FF0000">rouge</FONT>).
<P>
<CENTER>
<FONT COLOR="#FF0000">[email]</FONT>adresse@email.com<FONT COLOR="#FF0000">[/email]</FONT>
</CENTER>
<P>
Dans cet exemple, le code BB génère automatiquement un lien vers cette adresse e-mail encapsulée.
</FONT>
</td></tr>
<tr bgcolor="<?php echo $color1?>"><td>
<FONT SIZE="2" FACE="Verdana, Arial">
Le gras et l'italique</FONT></td></tr>
<TR bgcolor="<?php echo $color2?>"><TD>
<FONT SIZE="2" FACE="Verdana, Arial">
Vous pouvez faire du texte gras ou italique en encapsulant les portions de texte appropriées avec, respectivement, les tags [b] [/b] et [i] [/i].
<P>
<CENTER>
Bonjour, <FONT COLOR="#FF0000">[b]</FONT><B>James</B><FONT COLOR="#FF0000">[/b]</FONT><BR>
Bonjour, <FONT COLOR="#FF0000">[i]</FONT><I>Mary</I><FONT COLOR="#FF0000">[/i]</FONT><BR>
Bonjour, <FONT COLOR="#FF0000">[b][i]</FONT><B><I>James et Mary</I></B><FONT COLOR="#FF0000">[/i][/b]</FONT>
</CENTER>
</FONT>
</td></tr>
<tr bgcolor="<?php echo $color1?>"><td>
<FONT SIZE="2" FACE="Verdana, Arial">
Les listes</FONT></td></tr>
<TR bgcolor="<?php echo $color2?>"><TD>
<FONT SIZE="2" FACE="Verdana, Arial">
Vous pouvez faire des listes avec des point noirs, des chiffres ou des lettres.
<P>
Liste non ordonnées, avec des points noirs :
<P>
<FONT COLOR="#FF0000">[list]</FONT>
<BR>
<FONT COLOR="#FF0000">[*]</font> Ceci est le premier objet en liste.<BR>
<FONT COLOR="#FF0000">[*]</font> Ceci est le second objet en liste.<BR>
<FONT COLOR="#FF0000">[/list]</font>
<P>
Ceci produit:
<ul>
<LI> Ceci est le premier objet en liste.
<LI> Ceci est le second objet en liste..
</ul>
Remarquez que vous devez inclure une fermeture de liste à la fin de chacune des listes.

<P>
Faire des listes ordonnées avec des lettre ou des chiffres est tout aussi simple. Il suffit d'ajouter respectivement [LIST=A] et [LIST=1].
<P>
Voici un exemple :
<P>

<FONT COLOR="#FF0000">[list=A]</FONT>
<BR>
<FONT COLOR="#FF0000">[*]</font> Ceci est le premier objet en liste.<BR>
<FONT COLOR="#FF0000">[*]</font> Ceci est le second objet en liste.<BR>
<FONT COLOR="#FF0000">[/list]</font>
<P>
Ce qui produit :
<ol type=A>
<LI> Ceci est le premier objet en liste.
<LI> Ceci est le second objet en liste..
</ul>


</FONT>
</td></tr>
<TR bgcolor="<?php echo $color1?>"><TD>
<FONT SIZE="2" FACE="Verdana, Arial">
Ajouter des images</font></td></tr>
<TR bgcolor="<?php echo $color2?>"><TD>
<FONT SIZE="2" FACE="Verdana, Arial">
Pour ajouter des images dans votre message, encapsulez simplement l'URL de l'image comme vu dans les exemples précédents (le code BBCode est en <FONT COLOR="#FF0000">rouge</FONT>).
<P>
<CENTER>
<FONT COLOR="#FF0000">[img]</FONT>http://www.choixpc.com/p4.jpg<FONT COLOR="#FF0000">[/img]</FONT>
</CENTER>
<P>
Dans cet exemple, le code BB rend ce graphisme automatiquement visible dans votre message. Remarquez que la partie "http://" de l'URL est ici 
nécessaire pour le code <FONT COLOR="#FF0000">[img]</FONT>.
</FONT>
</td></tr>
<TR bgcolor="<?php echo $color1?>"><TD>
<FONT SIZE="2" FACE="Verdana, Arial">
Citer un autre message</font></td></tr>
<TR bgcolor="<?php echo $color2?>"><TD>
<FONT SIZE="2" FACE="Verdana, Arial">
Pour citer une partie de ce que quelqu'un a écris, faites un couper/coller de la partie en question et encapsulez là comme montré ci-dessous. (le Code BB est en <FONT COLOR="#FF0000">rouge</FONT>).
<P>
<CENTER>
<FONT COLOR="#FF0000">[QUOTE]</FONT>Pour utliser ces forums correctement... <BR>pensez à lire la FAQ et à utiliser la fonction recherche pour vérifier si la question n'a pas déjà été posée.<FONT COLOR="#FF0000">[/QUOTE]</FONT>
</CENTER>
<P>
Dans cet exemple, le code BB met automatiquement en citation et entre des lignes le texte auquel vous faites référence.
</td>
</tr>
<TR bgcolor="<?php echo $color1?>"><TD>
<FONT SIZE="2" FACE="Verdana, Arial">
Code Tag</FONT></td></tr>
<TR bgcolor="<?php echo $color2?>"><TD>
<FONT SIZE="2" FACE="Verdana, Arial">
De manière similaire au tag QUOTE, le tag CODE permet de préserver le formatage du texte écris. Ceci est particulièrement utile pour afficher du code
de programmation, par exemple.
<P>

<FONT COLOR="#FF0000">[CODE]</FONT>#!/usr/bin/perl
<P>
print "Content-type: text/html\n\n";
<BR>
print "Hello World!";
<FONT COLOR="#FF0000">[/CODE]</FONT>

<P>
Dans cet exemple, le code BB met automatiquement en citation le texte et en préserve le formatage.
</FONT>
</td>
</tr>
</table>
</td></tr></table>
</blockquote>
<BR>
Vous ne devez pas utiliser à la fois les code HTML et BB pour réaliser la même fonctionnalité.
Notez aussi que le code BB, n'est pas sensible à la casse (ainsi vous pouvez utiliser <FONT COLOR="#FF0000">[URL]</FONT> tout comme <FONT COLOR="#FF0000">[url]</FONT>).
<P>
<FONT COLOR="silver">Usage incorrect de code BB</FONT>
<P>
<FONT COLOR="#FF0000">[url]</FONT> www.choixpc.com <FONT COLOR="#FF0000">[/url]</FONT> Ne fonctionne pas : ne mettez pas des espaces entre 
les crochets et le texte auquel vous appliquez le code.
<P>
<FONT COLOR="#FF0000">[email]</FONT>adresse@email.com<FONT COLOR="#FF0000">[email]</FONT> Les crochets de fin doivent inclure un slash
(<FONT COLOR="#FF0000">[/email]</FONT>)

<P>
</FONT>
</B>

	</td>


    <tr bgcolor="<?php echo $color1?>">
        <td nowrap>
	<p align="left"><a name="mods">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Les Modérateurs (Modo)</b></font></a></p>
        </td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
          <p>
	    <font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	    Les modérateurs controlent les forums. Ils peuvent, éditer, supprimer, verrouiller ou déplacer tout post dans leurs sections.
            Si vous avez une question à propos d'une section de forum particulière, vous devriez l'adresser au modérateur du forum.</p>
          <p>Les admins et les modérateurs du forum se réservent le droit de déplacer, fermer ou détruire tout post qui le nécessiterait ou qui ne 
          présenterait pas un sujet utile et clair. De nombreux membres utilisent encore des modems 56K ou moindre et qui n'ont pas de temps à perdre
          avec des sujets inutiles et dépourvus de sens.</p>
          <p>Tout personne qui poste juste pour augmenter ses stats de forumeur, s'expose à voir ses sujets fermés, supprimés voire à avoir son pseudo
          supprimé.</p>
          <p>Essyez de faire en sorte que le sujet reflète ce qu'il y a dans la discussion. Les sujets du type "Regrdez cela !" attirent seulement des 
          membres vers un sujet qu'ils ne souhaitent peut-être pas lire...
          </font></p>
        </td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<p align="left"><a name="profile">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Mofifier votre profil</b></font></a></p>
        </td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Vous pouvez facilement modifier toute information stockée dans votre profil d'inscription en utilisant le lien	&quot;Votre profil&quot; 
	situé en haut à droite de chaque page. Identifiez vous tout simplement avec votre Nom d'utilisateur et Mot de passe et toutes vos informations
	de profil apparaitront alors, avec la possibilité de les modifier.
	</font>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<a name="prefs">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Customiser le forum : utiliser les préférences</b></font></a>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	En tant que membre inscrit de ce forum, vous pouvez stocker votre nom d'utilisateur pour au maximum 1 an.
	Ce faisant, le forum a la possibilité de savoir qui vous êtes quand vous visitez le forum et de plus vous pouvez customiser l'allure du forum
	en sélectionnant un des thèmes de couleurs disponible.
	D'autre part, si l'administrateur l'autorise, vous pouvez avoir la possibilité de créer de nouveaux thèmes pour le forum. 
	En créant un nouveau thème, vous aurez la possibilité de choisir les couleurs de fond, polices et tailles des textes, mais seul l'administrateur 
	peut modifier les images pour chaque thème. Lorsqu'un utilisateur crée un thème, les images par défaut du forum sont celles utilisées.
	<br>*NB : pour pouvoir utiliser les thèmes, vous devez avoir validé les cookies dans votre navigateur.</font>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td><a name="cookies">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Les cookies</b></font></a></td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Ce forum utilise les cookies pour stocker les informations suivantes : la dernière fois que vous avez visité le forum, votre nom d'utilisateur, et 
	un n° de session unique lorsque vous vous identifiez au forum. Ces cookies sont stockées dans votre navigateur. Si votre navigateur ne supporte pas
	les cookies, ou que vous ne les avez pas autorisés, aucune de ces fonctionnalités liées à la datation ne pourra fonctionner correctement mais le 
	forum restera tout à fait utilisable.
	</font>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td><a name="edit">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Editer vos posts</b></font></a>
        </td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Vous pouvez éditer vos propres posts n'importe quand. Allez simplement à la discussion où le post à éditer se trouve et vous verrez un petit icône 
	d'édition sous votre message. Cliquez dessus et éditez votre post. Personne d'autre ne peut éditer votre post, excepté les modérateurs du forum ou.
	D'autre part, dans la demi-heure qui suit l'envoi initial d'un post, l'écran d'édition vous donnera la possibilité de détruire votre message. Passé
	cette période, seul un modérateur pourra enlever ce post.
	</font>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td><a name="signature">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Ajouter une signature</b></font></a>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Vous pouvez utiliser une signature à vos posts. Si vous cliquez sur le lien "votre profil", visible au sommet de la plupart des pages,
        vous pourrez éditer votre profil, y compris votre signature par défaut. Une fois que vous y avez défini une signature, vous pouvez choisir de l'inclure
        dans tout post que vous faites en cochant la case &quot;Insérer votre signature&quot; au momment de la création de votre post.
        L'administrateur de ce forum peut néanmoins décider de supprimer cette possibilité à tout moment. Si ceci est le cas, l'option 
        &quot;Insérer votre signature&quot; sera sans effet, même si vous avez effectivement bien défini une signature dans votre profil.
	Notez que vous pouvez modifier votre signature à tout moment dans la section "votre profil".
	
	<p>NB : vous pouvez utiliser du  HTML ou du <a href="#bbcode">code BB</a> si l'administrateur a validé ces options.
	    </font>
        </p>
        </td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<a name="attach">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Joindre des documents attachés</b></font></a>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Pour des raisons de sécurité, vous ne pouvez pas joindre des documents attachés, à vos posts. Vous pouvez cependant faire un copier/coller
	du texte dans votre post ou encore utiliser du code HTML ou BB pour fournir des liens vers des documents externes. Les documents attachés 
	seront inclus dans une version future de phpBB. (NDT : phpBB 2.0 sûrement)</font>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<a name="search">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Rechercher des posts spécifiques</b></font></a>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Vous pouvez chercher des posts spécifiques à partir d'un ou plusieurs mots, d'un nom d'utilisateur, d'une date, et/ou d'un forum particulier. 
	Cliquez juste sur le lien &quot;Rechercher&quot; visible en haut à droire de la majorité des pages.</font>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<a name="announce">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>"Announcements"</b></font></a>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Les "Announcements" n'ont pas été implémentés, mais il est prévu de le faire dans une prochaine version de phpBB
	Cependant, l'administrateur peut créer un forum ou seuls les autres adminsitrateurs et modérateurs peuvent poster.
	Ce type de forum peut facilement être utilisé comme un forum d'"Announcements".
 	</td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<a name="pw">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Nom d'utilisateur et / ou Mot de passe perdu</b></font></a>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
 	Au cas où vous perdriez votre mot de passe, vous pouvez cliquer sur le lien &quot;J'ai perdu mon mot de passe!&quot; visible 
 	au moment des identifications. Ce lien vous amènera sur une page où vous pourrez remplir votre Nom d'utilisateur et votre adresse e-mail.
	Le système vous enverra alors un nouveau mot de passe généré aléatoirement à l'adresse email inscrite dans votre profil, en supposant que vous aviez
	fourni une adresse email correcte.
	</FONT>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<a name="notify">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Notification par email.</b></font></a>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Lorsque vous créez un nouveau sujet, vous avez la possibilité de recevoir un email de notification
	à chaque fois que quelqu'un poste une réponse à ce sujet. Cochez juste la case de notification par email lorsque vous créez un nouveau sujet si vous 
	souhaitez utiliser cette fonctionnalité.
        </font>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<a name="searchprivate">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Puis chercher dans les forums privés ?</b>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Oui, mais vous ne pouvez pas lire les posts, à moins que vous n'ayez le mot de passe à ce(s) forum(s) privé(s). </font></p>
        </td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<a name="ranks">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Quels sont les rangs pour le forum <?php echo $sitename?> ?</b></font></a>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	The <?php echo $sitename?> Les forums établissent des méthodes pour classer leur utilisateurs à travers leur nombre de posts.</p>
	<br>
	Les rangs actuels sont :<br>

	<?php
    $sql = "SELECT * FROM ranks WHERE rank_special = 0";
    if (!$r = mysql_query($sql, $db)) {
        echo "Error connecting to the database";
        include('page_tail.'.$phpEx);
        exit();
    }
    ?>
	<br><TABLE BORDER="0" WIDTH="<?php echo $TableWidth?>" CELLPADDING="1" CELLSPACING="0" ALIGN="CENTER" VALIGN="TOP"><TR><TD BGCOLOR="<?php echo $table_bgcolor?>">
	<TABLE BORDER="0" CELLPADDING="1" CELLSPACING="1" WIDTH="100%">
	<TR BGCOLOR="<?php echo $color1?>" ALIGN="CENTER">
	<TD><font face="<?php echo $FontFace?>" size="<?php echo $FontSize2?>" color="<?php echo $textcolor?>">&nbsp;Titre du rang &nbsp;</font></TD>
	<TD><font face="<?php echo $FontFace?>" size="<?php echo $FontSize2?>" color="<?php echo $textcolor?>">&nbsp;Minimum de posts&nbsp;</font></TD>
	<TD><font face="<?php echo $FontFace?>" size="<?php echo $FontSize2?>" color="<?php echo $textcolor?>">&nbsp;Maximum de posts&nbsp;</font></TD>
        <TD><font face="<?php echo $FontFace?>" size="<?php echo $FontSize2?>" color="<?php echo $textcolor?>">&nbsp;Image associée au rang&nbsp;</font></TD>
	</TR>
	<?php
    if ($m = $r->fetch(\PDO::FETCH_BOTH)) {
        do {
            echo "<TR BGCOLOR=\"$color2\" ALIGN=\"CENTER\">";
            echo "<TD><font face=\"<?php echo $FontFace?>\" size=\"2\" color=\"$textcolor\">$m[rank_title]</font></TD>";
            echo "<TD><font face=\"<?php echo $FontFace?>\" size=\"2\" color=\"$textcolor\">$m[rank_min]</font></TD>";
            echo "<TD><font face=\"<?php echo $FontFace?>\" size=\"2\" color=\"$textcolor\">$m[rank_max]</font></TD>";
            if ($m[rank_image] != '') {
                echo "<TD><img src=\"$url_images/$m[rank_image]\"></TD>";
            } else {
                echo "<TD>&nbsp;</TD>";
            }
            echo "</TR>";
        } while ($m = $r->fetch(\PDO::FETCH_BOTH));
    } else {
        echo "<TR BGCOLOR=\"$color2\" ALIGN=\"CENTER\">";
        echo "<TD COLSPAN=\"4\">Pas de rangs dans la base de données</TD>";
        echo "</TR>";
    }
    ?>
	</TABLE></TABLE></font>
	<br>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Les administrateurs ont aussi la possibilité d'assigner un rang spécial à tout utilisateur de leur choix. La table ci-dessus ne liste 
	pas ces rangs spéciaux.
	</font>
        </td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<a name="rednumbers">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Pourquoi certains icones de posts sont-ils </b>
	</font>
	<font color="#FF0033" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>enflammés ?</b>
	</font>
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b> in the forum view?</b></font></a>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Les icônes enflammés sont là pour indiquer qu'il y a plus de <?php echo $hot_threshold?> post dans cette discussion. Il s'agit aussi d'un indicateur
	qui prévient les utilisateurs de connexion "lentes" que la discussion peut prendre un peu de temps à se charger.</font></p>
        </td>
    </tr>
</table>
</TABLE>
</center>
</div>

<?php
include('page_tail.'.$phpEx);
?>
