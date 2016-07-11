

<!-- MySQL PHP PAYS    -->

<?php

// Connexion BD
$bdd = new PDO("mysql:host=localhost;dbname=euro2016;charset=utf8", "root", "root");


// si le pseudo et message existe
if(isset($_POST['pays1']) AND isset($_POST['pays2']) AND isset($_POST['res1']) AND isset($_POST['res2']) AND !empty($_POST['pays1']) AND !empty($_POST['pays2']) AND !empty($_POST['res1']) AND !empty($_POST['res2']))
{
// des variables secur - htmlspecialchars
   $pays1 = htmlspecialchars($_POST['pays1']);
   $pays2 = htmlspecialchars($_POST['pays2']);
   $res1 = htmlspecialchars($_POST['res1']);
   $res2 = htmlspecialchars($_POST['res2']);

   // requet
   $insertmsg = $bdd->prepare("INSERT INTO resultat(pays1, pays2, res1, res2) VALUES(?, ?, ?, ?)");
   $insertmsg->execute(array($pays1, $pays2, $res1, $res2));
}
?>

<!DOCTYPE HTML>
<HEAD>
   <TITLE>EURO 2016</TITLE>
   <meta charset="utf-8">
</HEAD>
<BODY>
<H1>EURO 2016</H1>
<br />


<!-- MySQL PHP Chat basique -->

<form method="POST" action="">
<input type="text" name="pays1" size="10" placeholder="PAYS 1"/>
<input type="text" name="res1" size="2"placeholder="RES 1"/> -
<input type="text" name="res2" size="2"placeholder="RES 2"/>
<input type="text" name="pays2" size="10"placeholder="PAYS 2"/>
<input type="submit" value="ENVOYER" />
</form>

<br /><br />
<H1>EURO 2016 : RESULTATS </H1>


<?php

// Afficher le chat
$allmsg = $bdd->query('SELECT * FROM resultat ORDER BY id DESC LIMIT 0,6');
while($msg = $allmsg->fetch())   // bucle pour chercher les informations
{



// Afficher le chat en HTML
?>
<br />
<?php echo $msg['pays1'] ?>   <?php echo $msg['res1'] ?>
<b> - </b><?php echo $msg['res2'] ?> <?php echo $msg['pays2'] ?>
<br /><br />
<hr />

<?php
}
?>

<br />

</BODY>

</HTML>
