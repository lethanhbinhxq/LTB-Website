<?php
$dsn = 'mysql:host=localhost;dbname=ltbdb';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Function to insert multiple users
function insertUsers($pdo, $users)
{
    // SQL statement to insert a user
    $sql = "INSERT INTO users (full_name, gender, email, password_, user_role, province, district, commune, street_address) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $pdo->prepare($sql);

    // Array to store inserted users with their IDs
    $insertedUsers = [];

    // Loop through the users and insert them
    foreach ($users as $user) {
        // Hash the password
        $hashedPassword = password_hash($user['password_'], PASSWORD_DEFAULT);

        // Execute the statement by passing the parameters directly
        $stmt->execute([
            $user['full_name'],
            $user['gender'],
            $user['email'],
            $hashedPassword,
            $user['user_role'],
            $user['province'],
            $user['district'],
            $user['commune'],
            $user['street_address']
        ]);

        // Get the last inserted ID
        $user['id'] = $pdo->lastInsertId();

        // Add the user to the result array
        $insertedUsers[] = $user;
    }

    // Return the inserted users with their IDs
    return $insertedUsers;
}