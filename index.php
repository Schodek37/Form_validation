<?php

    session_start();
    
    if(!isset($_SESSION["pracownik"]))
            $_SESSION["pracownik"] = array();




?>


<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Jakub S</title>
    <meta name="description" content="Strona na studia." />
    <meta name="keywords" content="studia, strona, uczelnia, ZUT" />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
    
<div id="container">
    
        <div id="logo">
        logo
        </div>
        
        <div id="leftnav">
        <ul>
            <li><a href="index.php">Strona Główna</a></li>
            <li><a href="index.php?subpage=1">Formularz</a></li>
	        <li><a href="index.php?subpage=2">Zawartość sesji</a></li>
            <li><a href="index.php?subpage=3">Baza pracowników</a></li>
            <li><a href="index.php?subpage=4">Edycja pracownika</a></li>
            <li><a href="index.php?subpage=5">Usunięcie pracownika</a></li>

        </ul>
        </div>
        
        <div id="content">
        <?php
         if(isset($_GET['subpage'])){
		        if($_GET['subpage'] == 1){
		            include 'form.php';
                }else if($_GET['subpage'] == 2){
                    include 'session.php';
                }else if($_GET['subpage'] == 3){
                    include 'employees.php';
                }else if($_GET['subpage'] == 4){
                    include 'employees.php';
                }else if($_GET['subpage'] == 5){
                    include 'employees.php';
                }else if($_GET['subpage'] == 6){
                    include 'deletion.php';
                }
                
            }else{
             echo "<h1> To jest strona główna </h1> ";
            }
        ?>
        </div>
        
        <div id="rightnav">
            <form method="get" action='index.php'>
                <input type="text input-group input-group-sm mb-3" name="kryteria"/>
                <input type="submit" name="szukaj" value="Szukaj"/>
                <input type="hidden" name="subpage" value="3" />
            </form>
        </div>
        
        <div id="footer">
        2019 &copy; Jakub Schodowski   Liczba wpisanych osób: <?php echo count($_SESSION["pracownik"]); ?>
        </div>
        
        
</div>
    
</body>
</html> 
			