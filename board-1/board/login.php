<?php  
 session_start();  
 $host = "localhost";  
 $username = "root";  
 $password = "";  
 $database = "board";  
 $message = "";  
 try  
 {  
      $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);  
      $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
      if(isset($_POST["login"]))  
      {

            $login_suc = FALSE;
           if(empty($_POST["username"]) || empty($_POST["password"]))  
           {  
                $message = '<label>All fields are required</label>';  
           }  
           else  
           {  
                $query = "SELECT * FROM users WHERE username = :username";  
                $statement = $connect->prepare($query);  
                $statement->execute(  
                     array(  
                          'username'     =>     $_POST["username"]                            
                     ) 
                     
                );  
                $count = $statement->rowCount();  
                if($count > 0)  
                {  
                    $users = $statement->fetchAll();
                    foreach ($users as $user) {
                        if($_POST["password"] == $user['password']){
                            //The passwords are equal
                            $login_suc = TRUE;

                            $_SESSION["username"] = $user["username"];
                            
                            $_SESSION["fullname"] = $user["fullname"];
                            $_SESSION["email"] = $user["email"];
                            $_SESSION['logged_in'] = time();
                            echo $user;
                            break;
                          }                          
                    }

                    if($login_suc){
                        $_SESSION["username"] = $_POST["username"];
                        header("location:board.php");
                    }
                    else{
                        $message = '<label>Wrong Username/Password</label>';
                    }
                }  
                else  
                {  
                     $message = '<label>Wrong Username/Password</label>';  
                }  
           }  
      }  
 }  
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Project Assignment 4- login</title>  
           
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
                <h3 align="">PROGRAMMING ASS 4</h3><br />  
                <form method="post">  
                     
                     <h3 align=""> Please Login in this page </h3> <br/> 
                     <br/>
                     <label>Username</label>
                     <input type="text" name="username" class="form-control" />  
                     <br />  
                     <br/>
                     <label>Password</label>  
                     <input type="password" name="password" class="form-control" />  
                     <br />  
                     <input type="submit" name="login" class="btn btn-info" value="Login" />  
                </form>  
           </div>  
           <br />  
      </body>  
 </html> 