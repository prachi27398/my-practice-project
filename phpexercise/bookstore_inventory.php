<?php
// Define an associative array called $inventory with at least 5 books
$inventory = [
    "Book1" => ["title" => "The Catcher in the Rye", "author" => "J.D. Salinger", "price" => 10.99, "quantity" => 5],
    "Book2" => ["title" => "To Kill a Mockingbird", "author" => "Harper Lee", "price" => 7.99, "quantity" => 3],
    "Book3" => ["title" => "1984", "author" => "George Orwell", "price" => 8.99, "quantity" => 10],
    "Book4" => ["title" => "The Great Gatsby", "author" => "F. Scott Fitzgerald", "price" => 6.99, "quantity" => 2],
    "Book5" => ["title" => "Moby Dick", "author" => "Herman Melville", "price" => 12.99, "quantity" => 4]
];

// Function to add a book to the inventory
function addBook($inventory, $title, $author, $price, $quantity) {
    $newKey = "Book" . (count($inventory) + 1); // Create a unique key for the new book
    $inventory[$newKey] = [
        "title" => $title,
        "author" => $author,
        "price" => $price,
        "quantity" => $quantity
    ];
    return $inventory;
}

// Function to remove a book from the inventory by its title
function removeBook($inventory, $title) {
    foreach ($inventory as $key => $book) {
        if ($book['title'] === $title) {
            unset($inventory[$key]);
            break;
        }
    }
    return $inventory;
}

// Function to update the quantity of a book in the inventory
function updateQuantity($inventory, $title, $newQuantity) {
    foreach ($inventory as $key => $book) {
        if ($book['title'] === $title) {
            $inventory[$key]['quantity'] = $newQuantity;
            break;
        }
    }
    return $inventory;
}

// Function to sort the inventory by the specified property (title, author, price, or quantity)
function sortInventory($inventory, $sortBy) {
    usort($inventory, function ($a, $b) use ($sortBy) {
        if ($a[$sortBy] == $b[$sortBy]) return 0;
        return ($a[$sortBy] < $b[$sortBy]) ? -1 : 1;
    });
    return $inventory;
}

// Test the functions

// Display the initial inventory
echo "Initial Inventory:<br>";
print_r($inventory);

// Add a new book
$inventory = addBook($inventory, "Pride and Prejudice", "Jane Austen", 9.99, 6);
echo "<br>Inventory after adding 'Pride and Prejudice':<br>";
print_r($inventory);

// Remove a book (e.g., '1984')
$inventory = removeBook($inventory, "1984");
echo "<br>Inventory after removing '1984':<br>";
print_r($inventory);

// Update the quantity of a book (e.g., 'The Great Gatsby')
$inventory = updateQuantity($inventory, "The Great Gatsby", 5);
echo "<br>Inventory after updating quantity of 'The Great Gatsby':<br>";
print_r($inventory);

// Sort the inventory by price
$inventory = sortInventory($inventory, 'price');
echo "<br>Inventory sorted by price:<br>";
print_r($inventory);

// Sort the inventory by quantity
$inventory = sortInventory($inventory, 'quantity');
echo "<br>Inventory sorted by quantity:<br>";
print_r($inventory);
?>
