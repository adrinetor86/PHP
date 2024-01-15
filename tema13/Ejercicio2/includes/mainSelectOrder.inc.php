<main>

<section>
    <?php
include ("PDO.inc.php");
   if(isset($_REQUEST)){

       foreach ($_REQUEST as $modo => $columna){
        //   echo $modo .'+'.$columna;
           selectOrder($columna,$modo);
       }

   }


    ?>
</section>
</main>