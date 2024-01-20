<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>MVC</title>
</head>
<body>
<div>
    <header>
        <div style="margin-top: 58px;">
            <h1><?php echo $controladorObj->page_title; ?></h1>


            <?php if(!empty($parametrosHandler['page'])){

                echo" <h4>Pagina:".$parametrosHandler['page']."</h4>";

            }
            ?>

        </div>
    </header>