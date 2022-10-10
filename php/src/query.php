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
    
    /* Displaying all the values in the table
    $query = "SELECT * FROM People";
    $result = $conn->query($query);
    while($row = $result->fetch_array()) {
        echo $row['firstname'] . " " . $row['lastname'];
        echo "<br />";
    } */

    // Query the database for the given user
    $query_name = $_POST["name"];
    $result = $conn->query("SELECT * FROM People WHERE firstname='$query_name'");
    while ($row = $result->fetch_array()) {
        echo '<pre>'; print_r($row); echo '</pre>';
        echo "<br />";
    }
    
    // Drop table
    $sql = "DROP TABLE People";
    
    if (!$conn->query($sql)) {
        echo "Error deleting table: " . $conn->error;
    }
?>

</body>
</html> 