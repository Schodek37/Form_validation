<?php

    require_once("connect.php");
    
   if(!isset($_GET['id'])){
    
    echo "baza pracowników";   
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
    
    if (isset($_GET['szukaj'])){ 
        
       

        $kryteria = explode(' ', $_GET['kryteria']);
        $kryt = implode('+', $kryteria);
        //echo "$kryt";
        $query = "SELECT * FROM Formularz WHERE ";
         
        for ($i=0; $i < count($kryteria); $i++)
        {
                    $query = $query . "Nazwisko LIKE '%" . $kryteria[$i] . "%' ";
                    if ($i+1 < count($kryteria)){
                        $query = $query . "OR ";
                    }
                    
        } 
        $help_query = $query;
        $query = $query." limit $str, $liczba_na_str " ;
        }else{
            $query = "SELECT * FROM Formularz limit $str, $liczba_na_str";
        }
    
    
    $result = mysqli_query($polaczenie, $query);
    
    
   
    
    
   if($polaczenie->connect_errno)
   {
            die('Connect Error(' . $mysqli->connect_errno . ')'.$mysqli->connect_error);
   }
   else
   {
       
      
            echo '<table class="table table-striped table-dark table-bordered table-hover table-responsive-sm">';
            if($_GET['subpage'] == 4){
            echo '<tr><td>'."Edycja";
            echo '</td><td>'."Id";
            echo '</td><td>'."Imie";
            echo '</td><td>'."Nazwisko";
            echo '</td><td>'."Gender"; 
            echo '</td><td>'."Nazw_Pan";            
            echo '</td><td>'."Email";         
            echo '</td><td>'."Kod_Pocz";  
            echo '</td></tr>';
            }else if($_GET['subpage'] == 5){
            echo '<tr><td>'."Usun";
            echo '</td><td>'."Id";
            echo '</td><td>'."Imie";
            echo '</td><td>'."Nazwisko";
            echo '</td><td>'."Gender"; 
            echo '</td><td>'."Nazw_Pan";            
            echo '</td><td>'."Email";         
            echo '</td><td>'."Kod_Pocz";  
            echo '</td></tr>';
            }else{
            echo '<tr><td>'."Id";
            echo '</td><td>'."Imie";
            echo '</td><td>'."Nazwisko";
            echo '</td><td>'."Gender"; 
            echo '</td><td>'."Nazw_Pan";            
            echo '</td><td>'."Email";         
            echo '</td><td>'."Kod_Pocz";  
            echo '</td></tr>';
            }
            while($row = mysqli_fetch_assoc($result)){

                if($_GET['subpage'] == 4){
                    echo '<tr><td>' . '<a href="index.php?subpage=1&id='. $row["Id"] .'">Edycja</a>';
                    echo '</td><td>'.$row['Id'];
                    echo '</td><td>'.$row['Imie'];
                    echo '</td><td>'.$row['Nazwisko'];
                    echo '</td><td>'.$row['Gender']; 
                    echo '</td><td>'.$row['Nazw_pan'];            
                    echo '</td><td>'.$row['Email'];         
                    echo '</td><td>'.$row['Kod_pocztowy'];  
                    echo '</td></tr>';
                }else if($_GET['subpage'] == 5){
                    echo '<tr><td>' . '<a href="index.php?subpage=6&id='. $row["Id"] .'">Usuń</a>';
                    echo '</td><td>'.$row['Id'];
                    echo '</td><td>'.$row['Imie'];
                    echo '</td><td>'.$row['Nazwisko'];
                    echo '</td><td>'.$row['Gender']; 
                    echo '</td><td>'.$row['Nazw_pan'];            
                    echo '</td><td>'.$row['Email'];         
                    echo '</td><td>'.$row['Kod_pocztowy'];  
                    echo '</td></tr>';
                }else{
                echo '<tr><td>'.$row['Id'];
                echo '</td><td>'.$row['Imie'];
                echo '</td><td>'.$row['Nazwisko'];
                echo '</td><td>'.$row['Gender']; 
                echo '</td><td>'.$row['Nazw_pan'];            
                echo '</td><td>'.$row['Email'];         
                echo '</td><td>'.$row['Kod_pocztowy'];  
                echo '</td></tr>';
                }
            }
            
           echo '</table>';
         
         
        if( empty ($kryt) ) 
        {
            $pr_query = "SELECT * FROM Formularz";
            $pr_result = mysqli_query($polaczenie, $pr_query);
            $resultCheck = mysqli_num_rows($pr_result);
            $liczba_str = ceil($resultCheck/$liczba_na_str);
        }else
        {
            $pr_result = mysqli_query($polaczenie, $help_query);
            $resultCheck = mysqli_num_rows($pr_result);
            echo "ilość wyników dla warunku: ".$resultCheck;
            echo "<br>";
            $liczba_str = ceil($resultCheck/$liczba_na_str);
        }
        
         if($_GET['subpage'] == 4){
            if($page>1)
            {
                echo "<a href='index.php?subpage=4&page=".($page-1)."'  class='btn btn-danger'  >previous</a>";;
    
            }
           
             
            for($i=1;$i<=$liczba_str;$i++){
                
                if($page!=$i){ 
                    echo "<a href='index.php?subpage=4&page=".$i."'  class='btn btn-primary' >$i</a>";
                }
                else{
                    echo "<a href='#'  class='btn btn-success' background-color:#fff >$i</a>";
                }
                
                
            }
            
            if($liczba_str>$page)
            {
                echo "<a href='index.php?subpage=4&page=".($page+1)."'  class='btn btn-danger' >next</a>";;
    
            }
        }else  if($_GET['subpage'] == 5){
            if($page>1)
            {
                echo "<a href='index.php?subpage=5&page=".($page-1)."'  class='btn btn-danger'  >previous</a>";;
    
            }
           
             
            for($i=1;$i<=$liczba_str;$i++){
                
                if($page!=$i){ 
                    echo "<a href='index.php?subpage=5&page=".$i."'  class='btn btn-primary' >$i</a>";
                }
                else{
                    echo "<a href='#'  class='btn btn-success' background-color:#fff >$i</a>";
                }
                
                
            }
            
            if($liczba_str>$page)
            {
                echo "<a href='index.php?subpage=5&page=".($page+1)."'  class='btn btn-danger' >next</a>";;
    
            }
       }else{
                
        
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
       }
           
     
       $polaczenie->close();      
    }
    
                        
   }else
   {
      $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
                        
        if($polaczenie->connect_errno!=0){
        echo "error: ",$polaczenie->connect_errno;
        }  else if(isset($_POST['odrzuc'])){ 
            
          header('Location: index.php?subpage=5');
           
       }
       else{
             $id = $_GET['id']; 
            $nowy = "DELETE FROM Formularz WHERE id=$id";
                
                
            $zap = $polaczenie->query("$nowy");
            
            if (!$zap) {
                echo "Errormessage: ", $mysqli->error;
            }else{
                 header('Location: index.php?subpage=5');
            }
    
    
           $polaczenie->close();
       }
   }
                        
?>    