<?php

// Function to find common elements between two arrays
function findCommonElements($array1, $array2) {
    // array_intersect() returns an array containing all the values of $array1 that are also present in $array2
    return array_intersect($array1, $array2);
}

// Function to remove duplicate values from an array
function removeDuplicates($array) {
    // array_unique() removes all duplicate values from an array and returns the resulting array
    return array_unique($array);
}

// Function to filter an array by the specified type
function filterByType($array, $type) {
    // array_filter() filters elements of $array based on a callback function
    // Using 'gettype()' to check each element's type
    return array_filter($array, function($value) use ($type) {
        return gettype($value) === $type;
    });
}

// Function to sort an array in ascending or descending order based on the $order parameter
function customSort($array, $order) {
    // usort() sorts the array in place based on the comparison function provided
    // If $order is 'desc', we sort in descending order; otherwise, we sort in ascending order
    if ($order === 'desc') {
        usort($array, function($a, $b) {
            if ($a == $b) {
                return 0;
            }
            return ($a < $b) ? 1 : -1; // For descending order
        });
    } else {
        usort($array, function($a, $b) {
            if ($a == $b) {
                return 0;
            }
            return ($a < $b) ? -1 : 1; // For ascending order
        });
    }
    return $array;
}

// Function to convert an array to a string with a specified separator
function arrayToString($array, $separator) {
    // implode() joins array elements into a string using the specified separator
    return implode($separator, $array);
}

// Example arrays for testing

$array1 = [1, 2, 3, 4, 5, 6, 7];
$array2 = [5, 6, 7, 8, 9, 10];
$arrayWithDuplicates = [1, 2, 2, 3, 4, 4, 5];
$arrayMixed = [1, "apple", 3.14, "banana", 10, "orange"];
$arrayForSorting = [5, 3, 8, 1, 4];

// Test each function
echo "First Array :<br>";
print_r($array1);

echo "<br>second Array:<br>";
print_r($array2);
// 1. Find common elements between two arrays
$commonElements = findCommonElements($array1, $array2);
echo "<br>Common elements between array1 and array2:<br>";
print_r($commonElements);

// 2. Remove duplicates from an array
echo "<br>Array with Duplicate values:<br>";
print_r($arrayWithDuplicates);
$uniqueArray = removeDuplicates($arrayWithDuplicates);
echo "<br>Array after removing duplicates:<br>";
print_r($uniqueArray);

// 3. Filter array by type (e.g., only integers)
echo "<br>Mixed Array:<br>";
print_r($arrayMixed);
$filteredArray = filterByType($arrayMixed, 'integer');
echo "<br>Array filtered by integers:<br>";
print_r($filteredArray);

// 4. Sort the array in ascending order
echo "<br>Array for sorting:<br>";
print_r($arrayForSorting);
$sortedArrayAsc = customSort($arrayForSorting, 'asc');
echo "<br>Array sorted in ascending order:<br>";
print_r($sortedArrayAsc);

// 5. Sort the array in descending order
$sortedArrayDesc = customSort($arrayForSorting, 'desc');
echo "<br>Array sorted in descending order:<br>";
print_r($sortedArrayDesc);

// 6. Convert array to string with a separator
$arrayToStringResult = arrayToString($array1, ', ');
echo "<br>Array converted to string:<br>";
echo $arrayToStringResult;

?>
