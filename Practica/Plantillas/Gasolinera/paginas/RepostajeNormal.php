<?php

include ("../includes/mainRepostajeNormal.inc.php");
include ("../includes/PDO.inc.php");


    if(isset($_REQUEST['importe']) && $_REQUEST['importe']!=''){
        $importe=$_REQUEST['importe'];
        $_SESSION['Operacion']='Ticket';
        $ticket= new ticket(intval($importe));
        /*
        echo $ticket->getFecha()."// ";
        echo $ticket->getHora()."// ";
        echo $ticket->getImporte();
    */

        insertTicket($ticket->meterArr());

    }else if(isset($_REQUEST['volver'])){
        header("location: ../index.php");
    }


