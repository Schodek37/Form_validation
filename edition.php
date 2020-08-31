<?php

    require_once("connect.php");
    
    echo "Edycja pracownika";
   
    
    echo "<br>";
    
    $polaczenie = mysqli_connect($host, $db_user, $db_password, $db_name);
    
     if(isset($_GET['page']))
    {
        $page = $_GET['page'];
    }
    else
    {
        $page = 1;
    }
    
    $liczba_na_str = 5;
    $str = ($page-1)*5;
    
    $query = "SELECT * FROM Formularz limit $str, $liczba_na_str";
    
    
    $result = mysqli_query($polaczenie, $query);
    
    
   
    
    
   if($polaczenie->connect_errno)
   {
            die('Connect Error(' . $mysqli->connect_errno . ')'.$mysqli->connect_error);
   }
   else
   {
       
      
            echo '<table class="table table-striped table-dark table-bordered table-hover table-responsive-sm">';
            echo '<tr><td>'."Edycja";
            echo '</td><td>'."Id";
            echo '</td><td>'."Imie";
            echo '</td><td>'."Nazwisko";
            echo '</td><td>'."Gender"; 
            echo '</td><td>'."Nazw_Pan";            
            echo '</td><td>'."Email";         
            echo '</td><td>'."Kod_Pocz";  
            echo '</td></tr>';
            while($row = mysqli_fetch_assoc($result)){
                echo '<tr><td>'.'<a href="#">Edycja</a>';
                echo '</td><td>'.$row['Id'];
                echo '</td><td>'.$row['Imie'];
                echo '</td><td>'.$row['Nazwisko'];
                echo '</td><td>'.$row['Gender']; 
                echo '</td><td>'.$row['Nazw_pan'];            
                echo '</td><td>'.$row['Email'];         
                echo '</td><td>'.$row['Kod_pocztowy'];  
                echo '</td></tr>';
            }
            
           echo '</table>';
         
         
       
            $pr_query = "SELECT * FROM Formularz";
            $pr_result = mysqli_query($polaczenie, $pr_query);
            $resultCheck = mysqli_num_rows($pr_result);
            $liczba_str = ceil($resultCheck/$liczba_na_str);
        
            if($page>1)
            {
                echo "<a href='index.php?"."kryteria="."$kryt"."&szukaj=Szukaj&"."subpage=3&page=".($page-1)."'  class='btn btn-danger'  >previous</a>";;
    
            }
           
             
            for($i=1;$i<=$liczba_str;$i++){
                
                if($page!=$i){ 
                    echo "<a href='index.php?"."kryteria="."$kryt"."&szukaj=Szukaj&"."subpage=3&page=".$i."'  class='btn btn-primary' >$i</a>";
                }
                else{
                    echo "<a href='#'  class='btn btn-success' background-color:#fff >$i</a>";
                }
                
                
            }
            
            if($liczba_str>$page)
            {
                echo "<a href='index.php?"."kryteria="."$kryt"."&szukaj=Szukaj&"."subpage=3&page=".($page+1)."'  class='btn btn-danger' >next</a>";;
    
            }   
       
           
     
       $polaczenie->close();      
    }
    
                        
                        
                        
?>	