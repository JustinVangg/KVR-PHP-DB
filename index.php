<?php  
    print("Hello World!");
    
    // PHP Data Objects(PDO) Sample Code:
    try {
        $conn = new PDO("sqlsrv:server = tcp:konnectvr-db.database.windows.net,1433; Database = konnectVR-Data", "konnectVR", "TZeu4kAmTK2BWPS");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        print("connected to the server!");
    }
    catch (PDOException $e) {
        print("Error connecting to SQL Server.");
        die(print_r($e));
    }

    $loginUser -> username = 'Bill';
    $loginPass -> Password = '123qwe';

    /*try {
        $loginResult = $conn -> query('SELECT password FROM loginData WHERE username = '. $loginUser .'');
        $loginResult-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if($loginPass -> password = $loginResult){
            print("Password is correct!");
        }
    
    }
    catch(PDOException $e){
        print("Error finding username in database.");
        die(print_r($e));
    }*/

    $sql = "SELECT Password FROM login Where Username = '". $loginUser . "'";

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
    {echo "Sucessful connection, but failed login";}

?>