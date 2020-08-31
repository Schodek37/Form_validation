<?php

for ($i = 0; $i < count($_SESSION["pracownik"]); $i++) {

        echo "Imię:".$_SESSION["pracownik"][$i][imie];
        echo "<br>";
        
      echo "Nazwisko:".$_SESSION["pracownik"][$i][nazwisko];
      echo "<br>";
        
      echo "Płeć:".$_SESSION["pracownik"][$i][gender];
    echo "<br>";

      echo "Nazwisko Panieńskie:".$_SESSION["pracownik"][$i][Nazw_pan];
        echo "<br>";
        
      echo "Email:".$_SESSION["pracownik"][$i][email];
        echo "<br>";
        
      echo "Kod Pocztowy:".$_SESSION["pracownik"][$i][kod_pocztowy];
        echo "<br>";
      
               echo "<br>";




}



?>		