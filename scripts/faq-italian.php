<?php
/***************************************************************************
                          faq.php  -  description
                             -------------------
    begin                : Fri November 3, 2000
    copyright            : (C) 2001 The phpBB Group
    email                : support@phpbb.com

    $Id: faq-italian.php,v 1.1 2001/06/29 23:45:37 bartvb Exp $

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
/* Translated by: Guido Trotter (ultrotter@quaqua.net)
 * Date: 08/05/2001
 * 
 * *************************************************************************/
include('extention.inc');
include('functions.'.$phpEx);
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
          Asked Questions</font></b></td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
          <font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $linkcolor?>">
          <a href="#register">Sono obbligato a registrarmi?</a><br>
          <a href="#smilies">Posso usare le faccine?</a><br>
          <a href="#html">Uso dell'HTML</a><br>
          <a href="#bbcode">Uso dei "BB Code"</a><br>
          <a href="#mods">Cosa sono i moderatori?</a><br>
	  <a href="#profile">Posso cambiare il mio profilo?</a><br>
          <a href="#prefs">Posso personalizzare il forum in qualche modo?</a><br>
          <a href="#cookies">Usate cookies?</a><br>
          <a href="#edit">Posso modificare i miei messaggi?</a><br>
          <a href="#attach">Posso allegare file?</a><br>
          <a href="#search">Posso effettuare ricerche?</a><br>
          <a href="#signature">Posso aggiungere una firma alla fine dei miei messaggi?</a><br>
          <a href="#announce">Cosa sono gli annunci?</a><br>
          <a href="#pw">C'e' un modo di recuperare gli username/password?</a><br>
          <a href="#notify">Posso essere avvisato via email se qualcuno risponde a un mio topic?</a><br>
          <a href="#searchprivate">Posso leggere i forum privati?</a><br>
          <a href="#ranks">Quali sono i Gradi nel forum di <?php echo $sitename?>?</a><br>
          <a href="#rednumbers">Come mai alcune icone sono "infiammate" nella lista dei messaggi?</a></p></font>

        </td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
        <font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
        <a name="register"><b><br>Registrazione</b></font></a>
        </td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	La registrazione &egrave; richiesta a seconda del forum. A seconda di come l'amministratore ha impostato i suoi forum, per mandare messaggi in alcuni potrebbe essere necessario registrarsi, mentre altri potrebbero accettare post anonimi.
Se il posting anonimo &egrave; accettato puoi farlo semplicemente senza inserire n&egrave; username n&egrave; password quando &egrave; richiesto.
La registrazione &egrave; gratuita e non &egrave; necessario inserire il proprio nome reale. Bisogna inserire il proprio indirizzo e-mail, che sar&agrave; utilizzato solamente per inviarti una nuova password se hai dimenticato la tua.
C'&egrave; anche la possibilit&agrave;, scelta di default, di nascondere il tuo indirizzo a chiunque eccetto gli amministratori. Se per&ograve; lo si desidera si pu&ograve; permettere agli altri di vedere l'indirizzo scegliendo "Permetti a tutti gli utenti di visualizzare il mio indirizzo email" nel modulo di 
registrazione o nel proprio profilo. Puoi registrarti cliccando 
	<a href="<?php echo $url_phpbb?>/bb_register.<?php echo $phpEx?>?mode=agreement">qui</a></font>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<a name="smilies">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
        <b>Faccine</b></font></a>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Probabilmente hai visto altri utenti usare le faccine su altri forum.
	Le faccine sono sequenze di caratteri usate per mostrare un'emozione, 
	come un sorriso :) o un muso :(
	Questo sistema di messaggistica converte automaticamente alcune faccine
	con una rappresentazione grafica.
	Le seguenti sono supportate attualmente:</font><BR>
	<table width="50%" ALIGN="CENTER" BGCOLOR="<?php echo $table_bgcolor?>" CELLSPACEING=1 BORDER="0">
	  <TR><TD>
	  <TABLE WIDTH="100%" BORDER="0">
		 <TR BGCOLOR="<?php echo $color1?>">
		 <TD width="100">
		 	<FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2?>" COLOR="<?php echo $textcolor?>">
		 		<?php echo $l_smilesym?>
		 	</FONT>
		 </td>
		 <td width="50%">
		 	<FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2?>" COLOR="<?php echo $textcolor?>">
				<?php echo $l_smileemotion?>
			</FONT>
		</td>
		<td width="55">
		 	<FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2?>" COLOR="<?php echo $textcolor?>">
				<?php echo $l_smilepict?>
			</FONT>
		</td></tr>
 <?php

	  if ($getsmiles = mysql_query("SELECT * FROM smiles")) {
	     while ($smile = mysql_fetch_array($getsmiles)) {
?>
		 <TR BGCOLOR="<?php echo $color2?>">
		 <TD width="100">
		 	<FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2?>" COLOR="<?php echo $textcolor?>">
		 		<?php echo stripslashes($smile[code])?>
		 	</FONT>
		 </td>
		 <td width="50%">
		 	<FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2?>" COLOR="<?php echo $textcolor?>">
				<?php echo stripslashes($smile[emotion])?>&nbsp;
			</FONT>
		</td>
		<td width="55">
			<IMG SRC="<?php echo "$url_smiles/$smile[smile_url]";?>">
		</td></tr>
<?php
	     }
	  } else
	     echo "Could not retrieve from the smile database.";
?>
    </TABLE></TABLE>
    </div>
	</td>
    </tr>
	<tr bgcolor="<?php echo $color1?>">
	<td>
		<p align="left"><a name="html">
		<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
		<b>Uare l'HTML</b></font></a></p>
	</td>
	</tr>
	<tr bgcolor="<?php echo $color2?>">
	<td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	&Egrave; possibile usare l'HTML nei messaggi se l'amministratore e i 
	moderatori hanno abilitato questa opzione. Ogni volta che manderai un
	nuovo messaggio sarai infomato se i BB Code e/o l'HTML sono abilitati.
	Se l'HTML &egrave; attivo puoi usare tag HTML, ma per favore sii molto
	attento a usare una sintassi corretta. Se non lo farai gli amministratori o i moderatori potrebbero dover modificare il tuo messaggio.
	</td>
	<tr bgcolor="<?php echo $color1?>">
	<td>
		<p align="left"><a name="bbcode">
		<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
		<b>Usare i "BB Code"</b></font></a></p>
	</td>
	</tr>
	<tr bgcolor="<?php echo $color2?>">
	<td>
	I BBCode sono una variazione dei tag HTML che potresti gi&agrave; conoscere. In sostanza ti permette di aggiungere funzioni o stile ai messaggi che normalmente richiederebbero di conoscere l'HTML. Puoi usare i BBCode anche se l'HTML non &egrave; abilitato sul forum che stai usando. Potresti voler usare i BBCode
anche se l'HTML &egrave; abilitato, perch&egrave; ci sono meno cose da imparare
ed &egrave; pi&ugrave; sicuro da usare (l'uso di una sintassi errata non implica
altrettanti problemi).
<P>

<table border=0 cellpadding=0 cellspacing=0 width="<?php echo $tablewidth?>" align="CENTER"><TR><td bgcolor="#FFFFFF">
<table border=0 cellpadding=4 border=0 cellspacing=1 width=100%>
<TR bgcolor="<?php echo $color1?>">
<TD>
<FONT SIZE="2" FACE="Verdana, Arial">
URL link</FONT></td></tr>
<TR bgcolor="<?php echo $color2?>"><TD><FONT SIZE="2" FACE="Verdana, Arial">
Se i BBCode sono abilitati in un forum non &egrave; necessario utilizzare il
codice [URL] per creare un link. Inserisci semplicemente il link in una delle
due seguenti modalit&agrave; e il link verr&agrave; attivato automaticamente:
<UL><FONT SIZE="2" FACE="Verdana, Arial" color="silver">
<LI> http://www.yourURL.com
<LI> www.yourURL.com
</font>
Noteari che puoi usare sia la forma completa di "http://" o accorciarla al
dominio www. Se il sito non inizia con www, tuttavia, &egrave; necessario usare
l'indirizzo completo di "http://". Puoi anche usare i prefissi https e ftp in
modo auto-linkante (cio&egrave; quando i BBCode sono attivi).
<P>
Il vecchio codice [URL] funzioner&agrave; ancora, come spiegato sotto.

Semplicemente incapsula il link come spiegato nel seguente esempio (il BBCode &egrave; in colore <FONT COLOR="#FF0000">rosso</FONT>).
<P><center>
<FONT COLOR="#FF0000">[url]</FONT>www.totalgeek.org<FONT COLOR="#FF0000">[/url]</FONT>
<P></center>
Puoi anche usare veri link con il codice [url]. Basta usare questa sintassi:
<BR><center>
<FONT COLOR="#FF0000">[url=http://www.totalgeek.org]</font>totalgeek.org<FONT COLOR="#FF0000">[/url]</font>
</center><p>
Negli esempi sopra il BBCode genera automaticamente un link ipertestuale all'URL
inserito. Assicura anche che il link sia aperto in una nuova finestra quando un
utente ci clicca sopra. Nota che la parte "http://" dell'URL &egrave; completamente facoltativa. Nel secondo esempio qui sopra, il testo sar&agrave; collegato a quello che hai inserito dopo il segno di uguale. Nota anche che non dovresti
usare caratteri di citazione (le virgolette) nel tag URL.
</font>
</td>
<tr bgcolor="<?php echo $color1?>"><td>
<FONT SIZE="2" FACE="Verdana, Arial">
Email Links</FONT></td></tr>
<TR bgcolor="<?php echo $color2?>"><TD>
<FONT SIZE="2" FACE="Verdana, Arial">
Per inserire un link a un indirizzo di posta elettronica nel tuo messaggio,
inserisci semplicemente l'indirizzo come spiegato nel seguente esempio il (BBCod&egrave; in colore <FONT COLOR="#FF0000">rosso</FONT>).
<P>
<CENTER>
<FONT COLOR="#FF0000">[email]</FONT>james@totalgeek.org<FONT COLOR="#FF0000">[/email]</FONT>
</CENTER>
<P>
Nell'esempio sopra il BBCode genera automaticamente un collegamento all'indirizzo email che &egrave; inserito.
</FONT>
</td></tr>
<tr bgcolor="<?php echo $color1?>"><td>
<FONT SIZE="2" FACE="Verdana, Arial">
Grassetto e Corsivo</FONT></td></tr>
<TR bgcolor="<?php echo $color2?>"><TD>
<FONT SIZE="2" FACE="Verdana, Arial">
Puoi creare testo in grassetto, o renderlo corsivo, inserendo parti del tuo
messaggio nei tag [b] [/b] o [i] [/i].
<P>
<CENTER>
Hello, <FONT COLOR="#FF0000">[b]</FONT><B>James</B><FONT COLOR="#FF0000">[/b]</FONT><BR>
Hello, <FONT COLOR="#FF0000">[i]</FONT><I>Mary</I><FONT COLOR="#FF0000">[/i]</FONT>
</CENTER>
</FONT>
</td></tr>
<tr bgcolor="<?php echo $color1?>"><td>
<FONT SIZE="2" FACE="Verdana, Arial">
Liste</FONT></td></tr>
<TR bgcolor="<?php echo $color2?>"><TD>
<FONT SIZE="2" FACE="Verdana, Arial">
Puoi creare liste sia normali che ordinate (con numeri o lettere).
<P>
Lista non ordinata:
<P>
<FONT COLOR="#FF0000">[list]</FONT>
<BR>
<FONT COLOR="#FF0000">[*]</font> Questo &egrave; il primo oggetto.<BR>
<FONT COLOR="#FF0000">[*]</font> Questo &egrave; il secondo oggetto.<BR>
<FONT COLOR="#FF0000">[/list]</font>
<P>
Questo produce:
<ul>
<LI> Questo &egrave; il primo oggetto.
<LI> Questo &egrave; il secondo oggetto.
</ul>
Nota Bene che &egrave; necessario includere il tag [/list] alla fine di ogni
lista.
<P>
Fare liste ordinate &egrave; ugualmente semplice. Semplicemente aggiungi
[list=A] o [list=1] a seconda che tu preferisca il formato da A a Z o numerato.
<P>
Esempio:
<P>

<FONT COLOR="#FF0000">[list=A]</FONT>
<BR>
<FONT COLOR="#FF0000">[*]</font> Questo &egrave; il primo oggetto.<BR>
<FONT COLOR="#FF0000">[*]</font> Questo &egrave; il secondo oggetto.<BR>
<FONT COLOR="#FF0000">[/list]</font>
<P>
Questo crea:
<ol type=A>
<LI> Questo &egrave; il primo oggetto.
<LI> Questo &egrave; il secondo oggetto.
</ul>


</FONT>
</td></tr>
<TR bgcolor="<?php echo $color1?>"><TD>
<FONT SIZE="2" FACE="Verdana, Arial">
Aggiungere Immagini</font></td></tr>
<TR bgcolor="<?php echo $color2?>"><TD>
<FONT SIZE="2" FACE="Verdana, Arial">
Per mettere un disegno nel tuo messaggio semplicemente inserisci l'url 
dell'immagine come mostrato nell'esempio (il BBCode &egrave; in colore <FONT COLOR="#FF0000">rosso</FONT>).
<P>
<CENTER>
<FONT COLOR="#FF0000">[img]</FONT>http://www.totalgeek.org/images/tline.gif<FONT COLOR="#FF0000">[/img]</FONT>
</CENTER>
<P>
Nell'esempio il BBCode rende l'immagine automaticamente visibile nel tuo 
messaggio. 
Nota Bene: la parte "http://" dell'URL &egrave; OBBLIGATORIA nel codice <FONT COLOR="#FF0000">[img]</FONT>.
</FONT>
</td></tr>
<TR bgcolor="<?php echo $color1?>"><TD>
<FONT SIZE="2" FACE="Verdana, Arial">
Citazioni</font></td></tr>
<TR bgcolor="<?php echo $color2?>"><TD>
<FONT SIZE="2" FACE="Verdana, Arial">
Per citare qualcosa di specifico che qualcuno ha detto, semplicemente scrivilo
come &egrave; scritto sotto:
(il BBCode &egrave; in colore <FONT COLOR="#FF0000">rosso</FONT>).
<P>
<CENTER>
<FONT COLOR="#FF0000">[QUOTE]</FONT>Non chiederti quello che l'Impero pu&ograve; fare per te...<BR>Domandati ci&ograve; che puoi fare per l'Impero.<FONT COLOR="#FF0000">[/QUOTE]</FONT>
</CENTER>
<P>
Nell'esempio sopra il BBCode inserisce automaticamente in un blocco citazione
il testo che hai evidenziato.</font>
</td>
</tr>
<TR bgcolor="<?php echo $color1?>"><TD>
<FONT SIZE="2" FACE="Verdana, Arial">
Tag per il codice</FONT></td></tr>
<TR bgcolor="<?php echo $color2?>"><TD>
<FONT SIZE="2" FACE="Verdana, Arial">
Come il tag di citazione, quello per il codice aggiunge i tag &lt;PRE&gt; per
conservare la formattazione. Questo &egrave; utile per scrivere codice sorgente,
ad esempio.
<P>

<FONT COLOR="#FF0000">[CODE]</FONT>#!/usr/bin/perl
<P>
print "Content-type: text/html\n\n";
<BR>
print "Hello World!";
<FONT COLOR="#FF0000">[/CODE]</FONT>

<P>
Nell'esempio il BBCode conserva la formattazione del codice.</FONT>
</td>
</tr>
</table>
</td></tr></table>
</blockquote>
<BR>
Non si possono usare sia l'HTML che i BBCode contemporaneamente per fare la
stessa cosa. Nota anche che i BBCode non sono case-sensitive (cio&egrave; puoi usare sia <FONT COLOR="#FF0000">[URL]</FONT> sia <FONT COLOR="#FF0000">[url]</FONT> indifferentemente).
<P>
<FONT COLOR="silver">Uso errato dei BBCode:</FONT>
<P>
<FONT COLOR="#FF0000">[url]</FONT> www.totalgeek.org <FONT COLOR="#FF0000">[/url]</FONT> - non inserire spazi fra il codice fra parentesi e il testo a cui lo stai applicando.
<P>
<FONT COLOR="#FF0000">[email]</FONT>james@totalgeek.org<FONT COLOR="#FF0000">[email]</FONT> - il codice di chiusura deve includere la barra: (<FONT COLOR="#FF0000">[/email]</FONT>)

<P>
</FONT>
</B>

	</td>


    <tr bgcolor="<?php echo $color1?>">
        <td nowrap>
	<p align="left"><a name="mods">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Moderatori</b></font></a></p>
        </td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
          <p>
	    <font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	I Moderatori controllano i singoli forum. Possono modificare, 
	cancellare o sfoltire ogni messaggio nei loro forum. 
	Se hai una domanda su uno specifico
	    forum dovresti farla al suo moderatore.</p>
	    <p>Gli amministratori e i moderatori si riservano il diritto di
	    chiudere o cancellare messaggi che non abbiano un tema chiaro e 
	    utile. Vi sono membri che usano ancora modem a 28.8 o 56k e non 
	    hanno tempo per vagare fra topic inutili o senza senso.</p>
	    <p>Chiunque invii messaggi solo per aumentare le sue statistiche sui Forum di <?php echo $sitename?> o mandi messaggi fuori sopportazione rischia di trovarsi i suoi topic chiusi, rimossi o la revoca della registrazione.</p>
          <p>Cerca invece di mantenere gli oggetti dei messaggi in linea con quello che &egrave; scritto all'interno. Oggetti come "Guarda questo" o
            "~~\\Non perderti questo!//~~" si limitano ad attrarre i membri verso messaggi che potrebbero non voler leggere.</font></p>
        </td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<p align="left"><a name="profile">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Modificare il proprio Profilo</b></font></a></p>
        </td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Puoi facilmente modificare ogni informazione inserita nel tuo profilo
	di registrazione, usando il link &quot;profile&quot; situato in alto
	in ogni pagina. Prima identificati dando i tuoi username e password
	e appariranno tutte le tue informazioni.</font>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<a name="prefs">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Personalizzare le proprie preferenze</b></font></a>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Quale utente registrato puoi salvare il tuo username in memoria per fino
	ad un anno di tempo. Inoltre puoi personalizzare l'interfaccia del forum
	scegliendo fra i temi che l'amministratore ti ha messo a disposizione,
	e anche crearne dei nuovi, se permesso.
	Creando un nuovo tema sarai in grado di scegliere i colori, i font e le
	loro dimensioni, ma per ora solo l'amministratore puo' cambiare le 
	immagini  per ogni tema. Quando un utente crea un tema saranno usate le
	immagini dal tema di default.
	<br>Nota Bene: Per usare queste funzioni devi avere i cookies abilitati.
	</font>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td><a name="cookies">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Cookies</b></font></a></td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Questo sistema usa i cookies per salvare le seguenti informazioni:
	l'ultima volta che hai visitato il forum, il tuo username, e un ID
	di sessione univoco quando accedi. Queste informazioni sono conservate
	nel tuo browser. Se il tuo browser non supporta i cookies nessuna di
	queste funzioni (che ti permettono di risparmiare tempo) 
	funzioner&agrave; in modo adeguato.</font>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td><a name="edit">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Modificare i tuoi messaggi</b></font></a>
        </td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Puoi modificare i tuoi messaggi in qualunque momento.
	Basta andare al thread dov'&egrave; uicato il messaggio e cliccare 
	sull'icona edit sotto il messaggio. Nessuno, a parte te o gli 
	amministratori del sistema, pu&ograve; modificare il tuo messaggio.
	Inoltre, fino a 30 minuti dopo che hai mandato un messaggio la schermata
	di editing conterr&agrave; anche l'optione di cancellarlo. 
	Dopo 30 minuti solo i moderatori e/o gli amministratori possono 
	rimuoverlo.</font>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td><a name="signature">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Aggiungere una Firma</b></font></a>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Puoi firmare i tuoi messaggi.
	Se clicchi il link in alto per modificare il tuo profilo puoi scegliere
	anche la tua firma standard. Quando hai una firma salvata puoi scegliere
	di aggiungerla in ogni messaggio selezionando l'opzione &quot;Mostra la 
	firma&quot; in fase di creazione del messaggio. L'amministratore puo`,
	pero`, disattivare questa opzione a suo piacimento. In questo caso
	non apparira` l'opzione &quot;Mostra firma&quot; neppure se hai salvato
	una firma. Puoi anche modificare la tua firma in ogni momento 
	modificando il tuo profilo.
	<p>Nota Bene: Puoi usare l'HTML o i <a href="#bbcode">BBCode</a> se 
	l'amministratore ha abilitato queste opzioni.
	    </font>
        </p>
        </td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<a name="attach">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Allegare Files</b></font></a>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Per ragioni di sicurezza non puoi allegare file ai post. Tuttavia 
	incollare il testo direttamente nei messaggi, o usare l'HTML e/o i
	BBCode (se abilitati) per fornire collegamenti ipertestuali a documenti
	esterni. Allegare file sar&agrave; possibile in una delle prossime 
	versioni di phpBB.</font>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<a name="search">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Cercare Particolari Messaggi</b></font></a>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Puoi fare una ricerca sui messaggi basata su una o pi&ugrave; parole
	presenti nei post, sull'username, sull data e/o uno o pi&ugrave; forum.
	Clicca semplicemente sul link &quot;cerca&quot; in alto.</font>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<a name="announce">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Annunci</b></font></a>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Non sono ancora stati implementati gli annunci, ma sono pianificati per
	una versione futura.
	Tuttavia gli amministratori possono creare un forum dove solo altri amministratori e moderatori possono mandare messaggi, e questa opzione pu&ograve;
	essere facilmente usate come forum di annunci.
	</td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<a name="pw">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Perdita dell'Username e/o della Password</b></font></a>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Se dovesse accadere che tu perda la tua password puoi cliccare sul
	link &quot;Ho dimenticato la mia Password!&quot; nello schermo di
	invio dei messaggi o in quello di login, vicino al campo password.
	Questo ti porter&agrave; a una pagina dove puoi inserire il tuo username
	e indirizzo email. Il sistema ti mander&agrave; una nuova password 
	casuale se inserirai il giusto indirizzo email.</font>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<a name="notify">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Avvisi via Email</b></font></a>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Se crei un nuovo argomento principale, hai la possibilit&agrave; di 
	ricevere una mail ogni volta che qualcuno risponde. Per farlo puoi
	selezionare, quando crei il nuovo topic, l'opzione &quot;Notifica per
	email quando vengono inviate risposte al messaggio&quot; in fase di 
	scrittura del nuovo topic.</font>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<a name="searchprivate">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Posso cercare fra i forum privati?</b>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Si, ma non puoi leggere i messaggi se non hai la password di accesso al
	forum.</font>
        </td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<a name="ranks">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Quali sono i gradi per i Forum di <?php echo $sitename?>?</b></font></a>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	I Forum di <?php echo $sitename?> hanno un modo di classificare i loro
	utenti a seconda del numero di messaggi.
	<br>
	I gradi attuali sono quelli che seguono:<br>

	<?php
	$sql = "SELECT * FROM ranks WHERE rank_special = 0";
	if(!$r = mysql_query($sql, $db)) {
	echo "Error connecting to the database";
	include('page_tail.'.$phpEx);
	exit();
	}
	?>
	<br><TABLE BORDER="0" WIDTH="<?php echo $TableWidth?>" CELLPADDING="1" CELLSPACING="0" ALIGN="CENTER" VALIGN="TOP"><TR><TD BGCOLOR="<?php echo $table_bgcolor?>">
	<TABLE BORDER="0" CELLPADDING="1" CELLSPACING="1" WIDTH="100%">
	<TR BGCOLOR="<?php echo $color1?>" ALIGN="CENTER">
	<TD><font face="<?php echo $FontFace?>" size="<?php echo $FontSize2?>" color="<?php echo $textcolor?>">&nbsp;Titolo&nbsp;</font></TD>
	<TD><font face="<?php echo $FontFace?>" size="<?php echo $FontSize2?>" color="<?php echo $textcolor?>">&nbsp;Post Minimi&nbsp;</font></TD>
	<TD><font face="<?php echo $FontFace?>" size="<?php echo $FontSize2?>" color="<?php echo $textcolor?>">&nbsp;Post Massimi&nbsp;</font></TD>
        <TD><font face="<?php echo $FontFace?>" size="<?php echo $FontSize2?>" color="<?php echo $textcolor?>">&nbsp;Immagine Associata&nbsp;</font></TD>
	</TR>
	<?php
	if($m = mysql_fetch_array($r)) {
	do {
	echo "<TR BGCOLOR=\"$color2\" ALIGN=\"CENTER\">";
	echo "<TD><font face=\"<?php echo $FontFace?>\" size=\"2\" color=\"$textcolor\">$m[rank_title]</font></TD>";
	echo "<TD><font face=\"<?php echo $FontFace?>\" size=\"2\" color=\"$textcolor\">$m[rank_min]</font></TD>";
	echo "<TD><font face=\"<?php echo $FontFace?>\" size=\"2\" color=\"$textcolor\">$m[rank_max]</font></TD>";
	if($m[rank_image] != '')
	   echo "<TD><img src=\"$url_images/$m[rank_image]\"></TD>";
	else
	   echo "<TD>&nbsp;</TD>";
	echo "</TR>";
	} while($m = mysql_fetch_array($r));
	}
	else {
	echo "<TR BGCOLOR=\"$color2\" ALIGN=\"CENTER\">";
	echo "<TD COLSPAN=\"4\">No Ranks in the database</TD>";
	echo "</TR>";
	}
	?>
	</TABLE></TABLE></font>
	<br>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Gli amministratori possono anche assegnare gradi "speciali" agli utenti
	da loro scelti. La tabella qui sopra non contiene questi gradi speciali.
	</font>
        </td>
    </tr>
    <tr bgcolor="<?php echo $color1?>">
        <td>
	<a name="rednumbers">
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>Come mai alcune icone di post sono </b>
	</font>
	<font color="#FF0033" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b>infiammate</b>
	</font>
	<font color="<?php echo $textcolor?>" size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
	<b> nella finestra dei forum?</b></font></a>
	</td>
    </tr>
    <tr bgcolor="<?php echo $color2?>">
        <td>
	<font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>" color="<?php echo $textcolor?>">
	Le icone infiammate significano che ci sono <?php echo $hot_threshold?>
	o pi&ugrave; messaggi in quel thread. &Egrave; un avvertimento alla 
	connessioni pi&ugrave; lente, perch&egrave; leggere quel thread potrebbe
	richiedere parecchio tempo di caricamento.</font>
        </td>
    </tr>
</table>
</TABLE>
</center>
</div>

<?php
include('page_tail.'.$phpEx);
?>
