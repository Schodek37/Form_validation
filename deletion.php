<?PHP
    echo "Czy chcesz usunąć rekord?";
    $id = $_GET['id'];
    
?>
    
    

        <form action=<?PHP echo " index.php?subpage=5&id=$id  "?>   method="POST">
        <table> 
        
                  <?php  echo '<td>'.'<input type="submit" name="accept" value="Usuń"   '.'</td>'; ?> 
               <?php   echo '<td>'.'<input type="submit" name="odrzuc" value="Anuluj"   '.'</td>'; ?> 
        </table>
        </form>

			