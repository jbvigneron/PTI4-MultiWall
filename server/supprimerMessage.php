<?php
include_once("classes/utilisateur.class.php");
include_once("classes/message.class.php");

$message = new Message();
$message->Construire($_POST['emetteur'], $_POST['message'], $_POST['destinataire']);
$message->Supprimer();
?>
<script type="text/javascript">
document.location.href="index.php";
</script>
