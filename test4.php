<?php
/**
 * Created by PhpStorm.
 * User: blessing
 * Date: 09/08/2023
 * Time: 11:36 am
 */


/**
 *  @Considerations: Using POST request for submitting sensitive data
 *  like usernames and passwords is generally a more secure
 *  approach compared to using a GET request.
 *  @Other_considerations:
 *  - Sanitization
 *  - Password Hashing
 *  - Binding Parameters
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $password = md5($password);

    try {
        // Create an in-memory SQLite database
        $pdo = new PDO('sqlite::memory:');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Create users table
        $pdo->exec("DROP TABLE IF EXISTS users");
        $pdo->exec("CREATE TABLE users (username VARCHAR(255), password VARCHAR(255))");

        // Add a root user with hashed password
        $rootPassword = md5("secret");
        $pdo->exec("INSERT INTO users (username, password) VALUES ('root', '$rootPassword')");

        // Prepare and execute a SELECT query with parameter binding
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if a result was found
        if ($result) {
            echo "Access granted to $username!<br>\n";
        } else {
            echo "Access denied for $username!<br>\n";
        }
    } catch (PDOException $e) {
        // Handle any exceptions
        echo "An error occurred: " . $e->getMessage();
    }
} else {
    // Redirect or display an error message for non-POST requests
    echo "Please submit the form using a POST request.";
}






