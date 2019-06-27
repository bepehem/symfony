<h1>Exemple de tirage au sort !</h1>
<?php
$horaires = ["9h00", "9h25", "9h50", "10h15", "10h40", "11h05", "11h30", "11h55", "13h00", "13h25", "13h50", "14h15", "14h40", "15h05", "15h30", "15h55", "16h20", "16h45"];
$eleves = ["Anatolia", "Clarisse", "Marie", "Maïté", "Sylvain", "Didier", "Nicolas", "Pierre-Hugues", "Dimitri", "Erwan", "Yann", "Bertrand", "Sebastien", "Olivier", "Jérome"];
shuffle($eleves);
?>
<ol>
    <?php foreach ($eleves as $key => $value) : ?>
        <li><?= $horaires[$key] ?> - <?= $value ?></li>
    <?php endforeach; ?>
</ol>
<button onclick='window.location = document.location.href'>Relancer !</button>