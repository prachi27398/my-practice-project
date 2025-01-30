
<h2>Welcome to the Inventory Management System</h2>

<?php 

    $inventory_data = ["apple"=>0.50,"Banana"=>0.30,"Orange"=>0.60,"Mango"=>1.20,"Grape"=>2.00];
    $inventory_qut = ["apple"=>150,"Banana"=>200,"Orange"=>100,"Mango"=>75,"Grape"=>80];

?>

<h3>Current Inventory:</h3>

<table>
    <tr>
        <th>Item</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Total Value</th>
    </tr>
    <?php $grandtotal = 0; 
      foreach($inventory_data as $key=>$row) { ?>
        <tr>
            <td><?= $key; ?></td>
            <td><?= $qtn = $inventory_qut[$key]; ?></td>
            <td>$ <?= $row; ?></td>
            <td>$ <?= $total = ($row * $qtn ); ?></td>
        </tr>
    <?php $grandtotal += $total;  } ?>
    
</table>
<h3>Total Inventory Value : $<?= $grandtotal; ?></h3>

<?php 

// Inventory Management System using PHP Loops

// Sample inventory data
$inventory = [
    'apple' => ['name' => 'Apple', 'quantity' => 150, 'price' => 0.50],
    'banana' => ['name' => 'Banana', 'quantity' => 200, 'price' => 0.30],
    'orange' => ['name' => 'Orange', 'quantity' => 100, 'price' => 0.60],
    'mango' => ['name' => 'Mango', 'quantity' => 75, 'price' => 1.20],
    'grape' => ['name' => 'Grape', 'quantity' => 80, 'price' => 2.00]
];

// Function to display inventory
function displayInventory($inventory) {
    echo "Current Inventory:<br>";
    echo str_repeat('-', 50) . "<br>";
    echo sprintf("%-15s %-15s %-15s %s<br>", "Item", "Quantity", "Price", "Total Value");
    echo str_repeat('-', 50) . "<br>";

    $totalInventoryValue = 0;

    foreach ($inventory as $item) {
        $totalValue = $item['quantity'] * $item['price'];
        $totalInventoryValue += $totalValue;
        echo sprintf("%-15s %-15d $%-14.2f $%.2f<br>", 
            $item['name'], 
            $item['quantity'], 
            $item['price'], 
            $totalValue
        );
    }

    echo str_repeat('-', 50) . "<br>";
    echo sprintf("Total Inventory Value: $%.2f<br>", $totalInventoryValue);
}

// Function to update inventory
function updateInventory(&$inventory, $item, $quantity) {
    if (array_key_exists($item, $inventory)) {
        $inventory[$item]['quantity'] += $quantity;
        echo "Updated {$inventory[$item]['name']} quantity. New quantity: {$inventory[$item]['quantity']}<br>";
    } else {
        echo "Item not found in inventory.<br>";
    }
}

// Function to find items below threshold
function findLowStock($inventory, $threshold) {
    echo "Items with stock below $threshold:<br>";
    $lowStockItems = [];

    foreach ($inventory as $key => $item) {
        if ($item['quantity'] < $threshold) {
            $lowStockItems[$key] = $item;
        }
    }

    if (empty($lowStockItems)) {
        echo "No items below the threshold.<br>";
    } else {
        foreach ($lowStockItems as $item) {
            echo "{$item['name']}: {$item['quantity']}<br>";
        }
    }
}

// Function to apply discount
function applyDiscount(&$inventory, $discountPercent) {
    echo "Applying {$discountPercent}% discount to all items:<br>";

    foreach ($inventory as &$item) {
        $originalPrice = $item['price'];
        $item['price'] *= (1 - $discountPercent / 100);
        echo sprintf("%s: $%.2f -> $%.2f<br>", $item['name'], $originalPrice, $item['price']);
    }
}

// Main program
echo "Welcome to the Inventory Management System<br><br>";

// Display initial inventory
displayInventory($inventory);

echo "<br>Updating inventory...<br>";
updateInventory($inventory, 'apple', 50);
updateInventory($inventory, 'banana', -30);
updateInventory($inventory, 'watermelon', 20);

echo "<br>Checking low stock items...<br>";
findLowStock($inventory, 100);

echo "<br>Applying discount...<br>";
applyDiscount($inventory, 10);

echo "<br>Final Inventory:<br>";
displayInventory($inventory);


?>