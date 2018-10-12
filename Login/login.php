<?php

//login.php

/**
 * Start the session.
 */
session_start();



/**
 * Include our MySQL connection.
 */
require '../connect.php';
if(isset($_SESSION['user_id']))
{
    header("location:../web/index.php");
}

$message = '';

if(isset($_POST["login"]))
{
    if(isset($_POST["user_email"]) && isset($_POST["user_password"]))
    {
        
        $query = "
        SELECT * FROM users 
            WHERE email = :user_email
        ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                    'user_email'    =>  $_POST["user_email"]
                )
        );
        $count = $statement->rowCount();
        if($count > 0)
        {
           
            $result = $statement->fetchAll();
            foreach($result as $row)
            {
                
                    if(password_verify($_POST["user_password"], $row["password"]))
                    //if($row["password"] == $_POST["user_password"])
                    {
                        if($row['admin'] == 2)
                            $_SESSION['admin_id'] = true;

                        $_SESSION['user_id'] = $row['id'];
                        $_SESSION['user_name'] = $row['name'];
                        $_SESSION['user_avatar'] = $row['avatar'];
                        header("location:../web/index.php");
                    }
                    else
                    {
                        $message = "<label>Wrong Password</label>";
                        echo $message;
                    }
            }
        }
        else
        {
            $message = "Wrong Email Address";
            header("location:../web/signin.php?message=$message");
        }
    }
}
else
{
    echo "problem";
}

?>
