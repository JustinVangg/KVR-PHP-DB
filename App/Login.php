<?php
    namespace App;
    use PDO;
    //include 'ForgotPass.php';

    class Login
    {   
        public function LoginCheck($email, $password)
        {
            return("email: $email Password: $password");
            try {
                $conn = new PDO("sqlsrv:server = tcp:konnectvr.database.windows.net,1433; Database = KVR_Database", "CloudSAf20f247f", "Konnectvr2023");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //print("connected to the server!". "<br>");
            }
            catch (PDOException $e) {
                print("Error connecting to SQL Server.");
                die(print_r($e));
            }

            //$email = $_POST["emailPost"];
            //$password = $_POST["passwordPost"];

            try {
                $sql = "SELECT * FROM loginData WHERE email = '". $email ."'";
                $temp = $conn -> query($sql);//Grab inforamtion based on above query statement
                $loginResult = $temp->fetch(PDO::FETCH_ASSOC);//Sort rows into arrays
                //$loginResult-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stored = $loginResult['password'];
                return("Stored: $stored Password:$password");
                
                if($email != $loginResult['email']){
                    return("Could not find an account for email. Please try again.");
                } else if(password_verify($password, $stored)){//Check array against entered info
                    return("Password is correct!");
                } else{
                    return("Password is incorrect. Please try again with another email or password. \n Stored: $stored Password:$password");
                    //print(".$stored. , .$password.");
                }
                    
            }

            catch(PDOException $e){
                print("Error finding username in database.");
                die(print_r($e));
            }
        }
    }

    //$Login = new Login();
    //$Login->LoginCheck();
        /*$sql = "SELECT Password FROM login Where Username = '". $loginUser . "'";

        $result = $conn->query($sql);

        if($result -> num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                if($row["Password"] == $loginPass)
                {echo "Sucessful Login and Connection!!";}
            }
        }
        else
        {echo "Sucessful connection, but failed login.";}*/

?>