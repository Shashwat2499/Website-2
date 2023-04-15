<?php



session_start();  
$host = "localhost";  
$username = "root";  
$password = "";  
$database = "board";  
$message = "";

error_reporting(E_ALL);
ini_set('display_errors','On');

try  
{   
    if(!isset($_SESSION['username']) || !isset($_SESSION['logged_in'])){
        header( "refresh:5;url=php_login.php" );
        exit;
        die();
    }

    $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          
          if(isset($_POST["newpost"]))
          {
               #echo($_POST["newmessage"]);
               $query = "INSERT INTO posts (id, postedby, datetime, message) VALUES (:u_id, :username,  NOW(), :message)";
               $statement = $connect->prepare($query);
               // use exec() because no results are returned
               //$conn->exec($sql);
               $statement->execute(
                    array(
                         'u_id'     =>     uniqid(),
                         'username'     =>     $_SESSION["username"],
                         'message'     =>     $_POST["newmessage"]
                         )
                    );
          } else if(isset($_POST["Logout"])){
               header("location:login.php");
               session_unset();
          }
     }

     $stmt = $connect->prepare('select * from posts');
    $stmt->execute();
    print "<table>";
    print "<thead>";
    print "<tr><th>id</th><th>Posted By</th><th>datatime</th><th>message</th></tr>";
    print "</thead><tbody>";
    
    while ($row = $stmt->fetch()) {
          print " <tr><td>" . $row['id'] .  "</td><td>" .  $row['postedby'] .  "</td><td>" .  $row['datetime'] .  "</td><td>" .  $row['message'] .  "</td></tr>" ;
     }
     print "</tbody></table>";
    
    
     
     

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>

  
<!DOCTYPE html>  
 <html>  
      <head>  
           <title>Message Board</title>  
           
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:500px;">  
                <?php  
                if(isset($message))  
                {  
                     echo '<label class="text-danger">'.$message.'</label>';  
                }  
                ?>  
                <h3 align="">PA4</h3><br />
                
                
                <form method="post">  
                     <label>Message</label>  
                     <br />  
                     <input type="textarea" name="newmessage" class="form-control" />  
                     <br />  
                     <input type="submit" name="newpost" class="btn btn-info" value="New Post" />
                     <br/>
                     <input type="submit" name="Logout" class="btn btn-info" value="Log out" />  
                </form>  
           </div>  
           <br />  
      </body>  
 </html> 