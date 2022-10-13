<html>
<body>

<?php
    //These are the defined authentication environment in the db service
    // The MySQL service named in the docker-compose.yml.
    $host = 'db';

    // Database use name
    $user = 'MYSQL_USER';

    //database user password
    $pass = 'MYSQL_PASSWORD';

    $dbname = 'MYSQL_DATABASE';

    // check the MySQL connection status
    $conn = new mysqli($host, $user, $pass, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS People (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        pswd VARCHAR(30) NOT NULL
        )";
    
    if (!$conn->query($sql)) {
        echo "Error creating table: " . $conn->error;
    }

    // Inserting value into the table
    $sql = "INSERT INTO People (firstname, lastname, pswd)
    VALUES
    ('John', 'Doe', 'password'),
    ('Mary', 'Moe', '123456'),
    ('Julie', 'Dooley', 'password123')";
    
    if (!$conn->query($sql)) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Querying databse for username and password to authenticate user
    // Here we are protected from SQL injections
    $firstname = $_POST["name"];
    $pswd = $_POST["password"];


    // Preparing the statements 
    $stmt = $conn->prepare("SELECT * FROM People WHERE firstname = ? AND pswd = ?");
    $stmt->bind_param("ss", $firstname, $pswd);
    
    // Executing the statement that was prepared 
    $stmt->execute(); 
    $result = $stmt->get_result();
    
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    $num = mysqli_stmt_num_rows($stmt);

    if ($num > 0) {
        echo "Logged in successfully<br>";
        // Query the database for the given user
        $query_name = $_POST["name"];

        // Just printing an array of the results at the moment, this should be changed to a table or something
        while ($row = $result->fetch_array()) {
            echo "Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
            echo "Password: " . $row["pswd"] . "<br>";
        }
    } else {
        echo "Username or password incorrect";
    }

    
    // Drop table
    $sql = "DROP TABLE People";
    
    if (!$conn->query($sql)) {
        echo "Error deleting table: " . $conn->error;
    }
?>

</body>
</html> 
