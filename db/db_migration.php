<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: {$conn->connect_error}");
    } else {
        echo "Database connection established\n";
    }

    // Create database if it does not exist
    $dbname = "ltbDB";
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

    if ($conn->query($sql) === TRUE) {
        // Database created or already exists
        echo "Database {$dbname} created successfully\n";
    } else {
        throw new Exception("Error creating database: {$conn->error}");
    }

    // Use the newly created database
    if (!$conn->select_db($dbname)) {
        throw new Exception("Error selecting database: {$conn->error}");
    }

    // Create the 'users' table if it does not exist
    $sql_table_user = "CREATE TABLE IF NOT EXISTS users (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(100) NOT NULL CHECK(CHAR_LENGTH(full_name) >= 2),
        gender CHAR(1) NOT NULL CHECK(gender in ('M', 'F')),
        email VARCHAR(254) NOT NULL UNIQUE,
        password_ VARCHAR(255) NOT NULL,  -- Increased size for hashed passwords
        user_role VARCHAR(100) NOT NULL,
        province VARCHAR(5) NOT NULL,
        district VARCHAR(5) NOT NULL,
        commune VARCHAR(5) NOT NULL,
        street_address VARCHAR(150) NOT NULL CHECK(CHAR_LENGTH(street_address >= 5)),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if ($conn->query($sql_table_user) !== TRUE) {
        throw new Exception("Error creating table 'users': {$conn->error}");
    } else {
        echo "Table 'users' created successfully\n";
    }

    // Create the 'products' table if it does not exist
    $sql_table_product = "CREATE TABLE IF NOT EXISTS products (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        product_name VARCHAR(255) NOT NULL,
        description_ TEXT,
        image_url VARCHAR(255),
        category VARCHAR(100) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        quantity INT(11) UNSIGNED NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if ($conn->query($sql_table_product) !== TRUE) {
        throw new Exception("Error creating table 'products': {$conn->error}");
    } else {
        echo "Tables 'products' created successfully\n";
    }

    // Function to insert multiple users
    function insertUsers($conn, $users)
    {
        $sql = "INSERT INTO users (full_name, gender, email, password_, user_role, province, district, commune, street_address) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error preparing statement: {$conn->error}");
        }

        $insertedUser = [];

        foreach ($users as $user) {
            // Hash the password
            $hashedPassword = password_hash($user['password_'], PASSWORD_DEFAULT);

            // Bind the parameters
            $stmt->bind_param(
                "sssssssss",
                $user['full_name'],
                $user['gender'],
                $user['email'],
                $hashedPassword,
                $user['user_role'],
                $user['province'],
                $user['district'],
                $user['commune'],
                $user['street_address']
            );

            // Execute the statement
            if (!$stmt->execute()) {
                throw new Exception("Error inserting user {$user['email']}: {$stmt->error}");
            }

            $user['id'] = $conn->insert_id;
            $insertedUser[] = $user;
        }

        $stmt->close();
        return $insertedUser;
    }

    // Function to insert multiple products
    function insertProducts($conn, $products)
    {
        $sql = "INSERT INTO products (product_name, description_, category, price, quantity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error preparing statement: {$conn->error}");
        }

        foreach ($products as $product) {
            $stmt->bind_param("sssdi", $product['product_name'], $product['description'], $product['category'], $product['price'], $product['quantity']);
            if (!$stmt->execute()) {
                throw new Exception("Error inserting product {$product['product_name']}: {$stmt->error}");
            }
        }
        $stmt->close();
    }

    $usersToInsert = [
        [
            'full_name' => 'Le Thanh Binh',
            'gender' => 'F',
            'email' => 'ltb@abc.com',
            'password_' => 'Ltb@1234',
            'user_role' => 'Admin',
            'province' => '79',
            'district' => '784',
            'commune' => '27589',
            'street_address' => '28/1 Pham Van Sang'
        ],
        [
            'full_name' => 'Nikki',
            'gender' => 'F',
            'email' => 'nikki@abc.com',
            'password_' => 'Nikki@1234',
            'user_role' => 'Seller',
            'province' => '79',
            'district' => '771',
            'commune' => '27169',
            'street_address' => '123 Ly Thuong Kiet'
        ],
        [
            'full_name' => 'Lu Ming',
            'gender' => 'M',
            'email' => 'luming@abc.com',
            'password_' => 'Luming@1234',
            'user_role' => 'Customer',
            'province' => '01',
            'district' => '005',
            'commune' => '00172',
            'street_address' => '456 Dinh Nghe'
        ]
    ];
    insertUsers($conn, $usersToInsert);

    // $productsToInsert = [
    //     // Elegant
    //     ['product_name' => "Glittering Date", 'description' => 'Gently hold the glittering star in the palm, for it is an oath of protection.', 'category' => 'Elegant', 'price' => 300, 'quantity' => 30],

    //     ['product_name' => "Lightbringer's Ode", 'description' => 'I will guard the glory of the gods and my people with justice and kindness until the end of my life.', 'category' => 'Elegant', 'price' => 150, 'quantity' => 50],

    //     ['product_name' => "Crimson Phoenix", 'description' => 'Every thread is filled with best wishes for the present, expectations for the future, and determination to grow old with that special someone.', 'category' => 'Elegant', 'price' => 210, 'quantity' => 35],

    //     ['product_name' => "Moonlight Vow", 'description' => 'What will greet me when the fragile and vain fairy tale dream shatters?', 'category' => 'Elegant', 'price' => 270, 'quantity' => 40],

    //     ['product_name' => "Beads of Love", 'description' => 'The azure waves dance like the wind, caressing the tails of merpeople, swaying their hearts in rhythm.', 'category' => 'Elegant', 'price' => 270, 'quantity' => 40],

    //     // Sweet
    //     ['product_name' => "Guides of Star", 'description' => 'A girl trying to stop the end of civilization, who through many failures, becomes a light of hope.', 'category' => 'Sweet', 'price' => 340, 'quantity' => 25],

    //     ['product_name' => "Ad Lunam", 'description' => "Strings that tie the earth to the stars. Who's that silhouette pausing on the rainbow's arc?", 'category' => 'Sweet', 'price' => 320, 'quantity' => 27],

    //     ['product_name' => "Für Lilith", 'description' => "The pearl-colored silk is tinted by starlight, as the dress often sees rainbows pass through like a flawless dream.", 'category' => 'Sweet', 'price' => 260, 'quantity' => 30],

    //     ['product_name' => "Morning Dewsong", 'description' => "If one is forbidden from seeking knowledge, then they should no longer bend the knee.", 'category' => 'Sweet', 'price' => 150, 'quantity' => 32],

    //     ['product_name' => "Strawberry My Melody", 'description' => "True melodies can cross the stars and protect people's wishes. With My Melody here, the air smells like sweet berries.", 'category' => 'Sweet', 'price' => 100, 'quantity' => 36],

    //     // Cool
    //     ['product_name' => "Diamond Teardrop", 'description' => "Heavy lie the gemstones on the divine maiden's head, her saintly light a brand of despair.", 'category' => 'Cool', 'price' => 270, 'quantity' => 40],

    //     ['product_name' => "Carefree Fox Spirit", 'description' => "A fleeting surge of emotion escalates into an enduring entanglement of love and loathing.", 'category' => 'Cool', 'price' => 190, 'quantity' => 38],

    //     ['product_name' => "Sapphire Dreaming", 'description' => "The real essence of a wedding isn't in the complex proceedings, but rather in a shared dance, a short poem, and two earnest hearts.", 'category' => 'Cool', 'price' => 200, 'quantity' => 38],

    //     ['product_name' => "Dustless Feathers", 'description' => "What is it that gave birth to beauty, hope or desire? Seeking a land of eternity for memories and beauty, I knocked on the door and opened it.", 'category' => 'Cool', 'price' => 220, 'quantity' => 42],

    //     ['product_name' => "Star Beyond Galaxy", 'description' => "AI never despairs. No matter how many times she's failed, Glow is always patient and reasonable, and never gives up.", 'category' => 'Cool', 'price' => 280, 'quantity' => 32],

    //     // Sexy
    //     ['product_name' => "Lightweaving Kiss", 'description' => "No creature ensnared can flee from this tender snare or escape the web's lethal embrace. She is the omnipotent ruler over every reach of her silk.", 'category' => 'Sexy', 'price' => 250, 'quantity' => 45],

    //     ['product_name' => "Watcher of the Depths", 'description' => "The meandering waves weave long, elegant lines; the expansive waters spill tides beneath the moon.", 'category' => 'Sexy', 'price' => 160, 'quantity' => 50],

    //     ['product_name' => "Banquet Undercurrent", 'description' => "Carrying out a mission during a ball... Risky, but doesn't it sound like fun?", 'category' => 'Sexy', 'price' => 100, 'quantity' => 40],

    //     ['product_name' => "Drunken Rose", 'description' => "How lovely is the night—can you not see? All the souls are dancing free...", 'category' => 'Sexy', 'price' => 350, 'quantity' => 36],

    //     ['product_name' => "Mystical Kuromi", 'description' => "Hang out with the playful Kuromi and let's create some irresistibly cute and captivating tunes!", 'category' => 'Sexy', 'price' => 100, 'quantity' => 40],

    //     // Fresh
    //     ['product_name' => "Godfall Omens", 'description' => "Every story finds its end, just as even the immortal can't escape their eventual ruin.", 'category' => 'Fresh', 'price' => 300, 'quantity' => 38],

    //     ['product_name' => "Flames of Dawn", 'description' => "The day shall come when the shadows fall and the guarding flames remain. My flames are eternal, after all.", 'category' => 'Fresh', 'price' => 320, 'quantity' => 40],

    //     ['product_name' => "Fleeting Dream", 'description' => "I only bloom on New Year's night. Don't miss it.", 'category' => 'Fresh', 'price' => 280, 'quantity' => 36],

    //     ['product_name' => "Cloud-Water Visitor", 'description' => "The butterflies dance and the wind has its own voice, a dream-like scene.", 'category' => 'Fresh', 'price' => 230, 'quantity' => 40],

    //     ['product_name' => "Forever Love", 'description' => "Love appears and flourishes in strange places, even in wastelands where it's destined to wither away.", 'category' => 'Fresh', 'price' => 380, 'quantity' => 40],
    // ];


    // insertProducts($conn, $productsToInsert);


    // ///////////////////////

    // // Function to update multiple users
    // function updateUsers($conn, $users)
    // {
    //     $stmt = $conn->prepare("UPDATE users SET full_name = ?, username = ?, user_level = ? WHERE id = ?");
    //     if (!$stmt) {
    //         throw new Exception("Error preparing statement: {$conn->error}");
    //     }

    //     foreach ($users as $user) {
    //         $stmt->bind_param("ssii", $user['full_name'], $user['username'], $user['user_level'], $user['id']);
    //         if (!$stmt->execute()) {
    //             throw new Exception("Error updating user ID {$user['id']}: {$stmt->error}");
    //         }
    //     }
    //     $stmt->close();
    // }

    // // Function to update multiple products
    // function updateProducts($conn, $products)
    // {
    //     $stmt = $conn->prepare("UPDATE products SET product_name = ?, description_ = ?, price = ?, quantity = ? WHERE id = ?");
    //     if (!$stmt) {
    //         throw new Exception("Error preparing statement: {$conn->error}");
    //     }

    //     foreach ($products as $product) {
    //         $stmt->bind_param("ssdii", $product['product_name'], $product['description'], $product['price'], $product['quantity'], $product['id']);
    //         if (!$stmt->execute()) {
    //             throw new Exception("Error updating product ID {$product['id']}: {$stmt->error}");
    //         }
    //     }
    //     $stmt->close();
    // }

    // // Update user (Nikki)
    // $usersToUpdate = [
    //     ['id' => 2, 'full_name' => 'Nikki', 'username' => 'nikki@126', 'user_level' => 3]
    // ];
    // updateUsers($conn, $usersToUpdate);

    // // Update product (Wedding dress)
    // $productsToUpdate = [
    //     ['id' => 2, 'product_name' => 'Wedding dress', 'description' => 'Pink wedding dress', 'price' => 324.99, 'quantity' => 10]
    // ];
    // updateProducts($conn, $productsToUpdate);

    // Function to delete multiple users
    // function deleteUsers($conn, $userIds)
    // {
    //     $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    //     if (!$stmt) {
    //         throw new Exception("Error preparing statement: {$conn->error}");
    //     }

    //     foreach ($userIds as $userId) {
    //         $stmt->bind_param("i", $userId);
    //         if (!$stmt->execute()) {
    //             throw new Exception("Error deleting user ID $userId: {$stmt->error}");
    //         }
    //     }
    //     $stmt->close();
    // }

    // // Function to delete multiple products
    // function deleteProducts($conn, $productIds)
    // {
    //     $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    //     if (!$stmt) {
    //         throw new Exception("Error preparing statement: {$conn->error}");
    //     }

    //     foreach ($productIds as $productId) {
    //         $stmt->bind_param("i", $productId);
    //         if (!$stmt->execute()) {
    //             throw new Exception("Error deleting product ID $productId: {$stmt->error}");
    //         }
    //     }
    //     $stmt->close();
    // }

    // // Delete user (Nephiliet)
    // $userIdsToDelete = [3]; // Nephiliet
    // deleteUsers($conn, $userIdsToDelete);

    // // Delete product
    // $productIdsToDelete = [3];
    // deleteProducts($conn, $productIdsToDelete);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
} finally {
    // Close the connection
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
}