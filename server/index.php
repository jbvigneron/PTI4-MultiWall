<?php
include_once("classes/utilisateur.class.php");
include_once("classes/message.class.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>MultiWall :: Index</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<script type="text/javascript" src="jquery/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
</head>

<body>
<?php include_once("haut.php"); ?>
		<div id="content">
    		<div style="text-align:right">
				<a href="#" id="actualiserMessages">
					Actualiser la liste des messages
				</a>
        	</div>
			<div id="listeMessages"><!-- Ici apparaitront les messages !--></div>
       </div>
<?php include_once("bas.php"); ?>
</body>
</html>