<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


require_once "connect.php";
    


?>

<?php
            
                $name_error =  $secondname_error = $gender_error = $female_secondname_error = $email_error = $ZIP_CODE_error = "";
                $name = $secondname = $gender = $female_secondname = $email = $ZIP_CODE = "";
                $name_wal = $secondname_wal = $gender_wal = $female_secondname_wal = $email_wal = $ZIP_CODE_wal = "";
                $wal = 0;
                
                if (isset($_GET['id'])){
                     $polaczenie = mysqli_connect($host, $db_user, $db_password, $db_name);
                      
                    $id = $_GET['id'];
                    
                    $query = "SELECT * FROM Formularz WHERE id=$id "  ;                  
                    $result = mysqli_query($polaczenie, $query);
                     while($row = mysqli_fetch_assoc($result)){
                        $id = $row['Id'];
                        $name =  $row['Imie'];
                        $secondname = $row['Nazwisko'];
                        $gender = $row['Gender']; 
                        if($gender == "mezczyzna") $setm =1;
                        if($gender == "kobieta") $setk = 1;
                        
                        $female_secondname = $row['Nazw_pan'];            
                        $email = $row['Email'];         
                        $ZIP_CODE = $row['Kod_pocztowy'];
                        $set = 1;
                     }
                    /* echo "Id=".$id;
                     echo "<br>";
                     echo "Imie: ".$name;    
                     echo "<br>";                 
                     echo "Nazwisko: ".$secondname;                     
                     echo "<br>";
                     echo "Płeć: ".$gender;
                     echo "<br>";
                     echo "Nazwisko Panienskie: ".$female_secondname;
                     echo "<br>";
                     echo "Email: ".$email;
                     echo "<br>";
                     echo "Kod_Pocztowy: ".$ZIP_CODE;
                     echo "<br>";
                     */
                     $_SESSION['id'] = $id;
                }
                
                if(isset($_POST['set'])){
                    $set = 1;
                }
                 
                 
                 
                 
                 
                  if (isset($_POST['accept'])){
                      
                      $accept = 1;
                      
                 
                  }else if (isset($_POST['decline'])){
                      
                      header('employees.php'+'id='.$_SESSION['id'] );
                  }else if(isset($_POST['odrzuc'])){
                      header('index.php?subpage=5' );
                      
                  }
                  
                  
                if (isset($_POST['submit']) ||  isset($_POST['accept'])  ){
                    
                     if(empty($_POST["Imie"])){
                         $name_error = "Uzupełnij imie";
                     }else{
                     $name = test_input($_POST["Imie"]);
                     
                         if(!preg_match("/^[a-zA-Z ]*$/", $name)){
                            $name_error ="Dozwolone są tylko litery i spacje";
                         }else{
                         $name_wal=1;
                         
                         }
                     }
            
                   if(empty($_POST["Nazwisko"])){
                         $secondname_error = "Uzupełnij nazwisko";
                     }else{
                     $secondname = test_input($_POST["Nazwisko"]);
                     
                         if(!preg_match("/^[a-zA-Z ]*$/", $secondname)){
                            $secondname_error = "Dozwolone są tylko litery i spacje";
                         }else{
                         $secondname_wal=1;  
                         }
                     }
                     
                     
                     
                     
                     if(empty($_POST["gender"])){
                         $gender_error = "Wybierz płeć";
                     }else{
                         
                     $gender = test_input($_POST["gender"]);
                     $gender_wal = 1;
                     $sett = 1;
                     }
                     
                      
                    
                     
                     
                     $female_secondname = test_input($_POST["nazw_pan"]);
                         
                     if(!preg_match("/^[a-zA-Z ]*$/", $female_secondname)){
                        $female_secondname_error = "Dozwolone są tylko litery i spacje"; 
                     }else{
                         $female_secondname_wal = 1;
                     }
                     
                     
                     
                     if(empty($_POST["email"])){
                         $email_error = "Uzupełnij email";
                     }else{
                     $email = test_input($_POST["email"]);
                     
                         if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                            $email_error = "Niedozwolony format";
                         }else{
                            $email_wal=1; 
                         }
                     }
                     
                     if(empty($_POST["Kod_Pocztowy"])){
                         $ZIP_CODE_error = "Uzupełnij kod pocztowy";
                     }else{
                     $ZIP_CODE = test_input($_POST["Kod_Pocztowy"]);
                     
                         if(!preg_match("/^[0-9]{2}-[0-9]{3}$/", $ZIP_CODE)){
                            $ZIP_CODE_error = "Niedozwolony format";
                         }else{
                             $ZIP_CODE_wal =1;
                         }
                     }
                     
                       
                       
                     if($name_wal == 1 && $secondname_wal == 1 && $gender_wal == 1 && $female_secondname_wal == 1 && 
                     $email_wal == 1 && $ZIP_CODE_wal == 1){
                        $wal = 1;
                        echo "Imię:".$name;
                        echo "<br>";
                        echo "Nazwisko:".$secondname;
                        echo "<br>";
                        echo "Płeć:".$gender;
                        echo "<br>";                  
                        echo "Nazwisko Panieńskie ".$female_secondname;
                        echo "<br>";
                        echo "Email: ".$email;
                        echo "<br>";
                        echo "Kod Pocztowy: ".$ZIP_CODE;
                        echo "<br>";
                        echo "<br>";
                        if ($accept != 1){ 
                            
                        $_SESSION["pracownik"][] = array(imie=>$name,nazwisko=>$secondname,gender=>$gender,Nazw_pan=>$female_secondname,email=>$email,kod_pocztowy=>$ZIP_CODE);
                        
                        
                        
                        $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
                        
                    	if($polaczenie->connect_errno!=0)
                    	{
                    		echo "error: ",$polaczenie->connect_errno;
                    	}
                    	else
                    	{ 
                        	$nowy = "INSERT INTO Formularz (id, Imie, Nazwisko, Gender,  Nazw_Pan, Email, Kod_Pocztowy)
                            VALUES ('','$name','$secondname','$gender', '$female_secondname', '$email', '$ZIP_CODE')";
                            $zap = $polaczenie->query("$nowy");
                        	
                            if (!$zap) {
                               echo "Errormessage: ", $mysqli->error;
                            }else
                            {
                                echo "Wpisano do bazy";
                            }





                    		$polaczenie->close();
                    	}
    
                        
                        }else { //dla edycji
                            
                            
                        $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
                        
                    	if($polaczenie->connect_errno!=0)
                    	{
                    		echo "error: ",$polaczenie->connect_errno;
                    	}
                    	else
                    	{ 
                            $id = $_SESSION['id']; 
                            $nowy = "UPDATE Formularz SET id='$id', Imie='$name', Nazwisko='$secondname', Gender='$gender', Nazw_Pan='$female_secondname', Email='$email', Kod_Pocztowy='$ZIP_CODE' WHERE id='$id'";
                            
                            
                            $zap = $polaczenie->query("$nowy");
                        	
                            if (!$zap) {
                               echo "Errormessage: ", $mysqli->error;
                            }else
                            {
                                echo "edytowano wpis o id=".$id;
                                header('Location: index.php?subpage=4');
                                exit();
                            }
                            




                    		$polaczenie->close();
                    	}
                        
                        
                        
                        }  
                        
                     } //jeżeli poprawne wartości
                     
                    
                    } //jeżeli accept lub submit
                  
                    
                    if( !isset($_POST['submit']) || ($wal==0) || (($wal==0) && ($accept==1)) )
                    {
                   
                                            
?>
                    

<form action="index.php?subpage=1"   method="POST">
        <br>
        <span class="error">Pola oznaczone * są obowiązkowe </span>
         <table>    		     
				 <tr>
						<td>
						Imie<span class='error'> *</span>
						</td>
						
						<td>
						  <input type="text" name="Imie" placeholder="Jan" onfocus="this.placeholder=''" onblur="this.placeholder='Jan'" value="<?php  if($name_wal==1 || $set==1) echo $name;   ?>" >
						<span class="error"><?= $name_error?></span>
                        </td>
				  </tr>
                  
                    <br>
    		      <tr>
						<td>
						Nazwisko
						</td>
						
						<td>
						  <input type="text" name="Nazwisko" placeholder="Kowalski" onfocus="this.placeholder=''"  onblur="this.placeholder='Kowalski'" value="<?php  if($secondname_wal==1  || $set==1 ) echo $secondname;   ?>" >
						  <span class="error"><?= $secondname_error ?></span>
                        </td>
                        <br>
				  </tr>
                  
                   <tr>
    					<td>
						Płeć:<span class="error"> *</span>
						</td>
						
						<td>
						  <input type="radio" name="gender" value="kobieta" <?php if( $gender == "kobieta"  || $setk==1 ) echo "checked";  ?> >Kobieta&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;
						  <span class="error"><?=$gender_error?></span>
                        </td>
				  </tr>
				 
				   <tr>
						<td>
						</td>
						<td>
						  <input type="radio" name="gender" value="mezczyzna" <?php if( $gender == "mezczyzna" || $setm==1 ) echo "checked"; ?>  >Mezczyzna<br>
                        </td>
				  </tr>
				  
			       <tr>
						<td>
						Nazwisko panienskie
						</td>
						
						<td>
						  <input type="text" name="nazw_pan" onfocus="this.placeholder=''"  onblur="this.placeholder=''" value="<?php  if($female_secondname_wal==1  || $set==1) echo $female_secondname;   ?>" >
                          <span class="error"><?=$female_secondname_error?></span>
						</td>
				  </tr>
                  
                   <tr>
    					<td>
						Email<span class="error"> *</span>
						</td>
						
						<td>
							<input type="text" name="email" placeholder="jan.kowalski@gmail.com" onfocus="this.placeholder=''"
							onblur="this.placeholder='jan.kowalski@gmail.com'" value="<?php  if($email_wal==1  || $set==1 ) echo $email;   ?>" >
                            <span class="error"><?= $email_error ?></span>
                        </td>
				  </tr>
				  
				  
			        <tr>
						<td>
						Kod Pocztowy<span class="error"> *</span>
						</td>
						
						<td>
							<input type="text" name="Kod_Pocztowy" placeholder="10-001" onfocus="this.placeholder=''"
							onblur="this.placeholder='10-001'" value="<?php  if($ZIP_CODE_wal==1  || $set==1 ) echo $ZIP_CODE;   ?>" >
                            <span class="error"><?= $ZIP_CODE_error?> </span>
                        </td>
				  </tr>
				  
				  <tr>
                      <td></td>
                      
                      
                     
                  <?php  if($set != 1) { echo '<td>'.'<input type="submit" name="submit" value="Wyslij"   '.'</td>'; }?> 
                  <?php  if($set == 1) { echo '<td>'.'<input type="submit" name="accept" value="Akceptuj zmiany"   '.'</td>'; }?> 
               <?php  if($set == 1) { echo '<td>'.'<input type="submit" name="decline" value="Odrzuć zmiany"   '.'</td>'; }?> 
               <?php if($set == 1 ) { echo '<input type="hidden" name="set" value="1" />'; } ?>
                  </tr>
				  
                  
	</table>

    </form>
                 
                       
    
    
                    
             <?PHP
             }
             ?>  
                    
                     
                     
  
    
    	