<?php
if (isset($_REQUEST['id'])) {
    include('../includes/PDO.inc.php');
    update($_REQUEST);
}
header('Location: ../index.php');