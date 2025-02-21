<?php 

$students_name = ["John","Mary","Steve","Anna"];
$students_age = [20,25,22,30];
$students_grades = ["A","A","B","A"];

// Calculate average age of students
function calculateAverageAge($ages)
{
    $num_students = count($ages);
    $sum = 0;    //Number of students
    foreach($ages as $age){
        $sum +=$age;  // add each student's age
    } 
    $average = $sum / $num_students;
    return $average;
}

// Display student Data 
function displayStudentInformation($names,$ages,$grades)
{
    foreach($names as $i=>$name) 
    {
        echo "Name : ".$name." ,Age : ".$ages[$i]." ,Grade : ".$grades[$i]."<br>";
    }
}

//Function for increment a static counter
function incrementCounter(){
  static $counter = 0;    // Static variable persists its value across function calls
  $counter++;           // Increment the counter each time the function is called
  return $counter;
}

// 5. Call functions and output results

// Call the calculateAverageAge function and store the result in a variable
$averageAge = calculateAverageAge($students_age);

// Display the average age
echo "Average Age: " . $averageAge . "<br><br>";

// Call the displayStudentInformation function
displayStudentInformation($students_name, $students_age, $students_grades);

echo "<br><br>";

// 6. Demonstrate variable scope
// Uncomment the line below to see that trying to access $localVariable here will cause an error
// echo $localVariable;  // This will result in an error

// 7. Call the incrementCounter function multiple times
echo "Counter Value (first call): " . incrementCounter() . "<br>";
echo "Counter Value (second call): " . incrementCounter() . "<br>";
echo "Counter Value (third call): " . incrementCounter() . "<br>";

?>