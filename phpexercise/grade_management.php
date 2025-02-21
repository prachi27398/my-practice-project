<?php
// Define a multidimensional array called $studentGrades with at least 5 students
$studentGrades = [
    "Alice" => ["Math" => 85, "English" => 92, "Science" => 88],
    "Bob" => ["Math" => 78, "English" => 80, "Science" => 75],
    "Charlie" => ["Math" => 95, "English" => 85, "Science" => 90],
    "David" => ["Math" => 88, "English" => 85, "Science" => 91],
    "Eve" => ["Math" => 82, "English" => 89, "Science" => 84]
];

// Function to calculate and return the average grade for a specific student
function calculateAverage($studentGrades, $student) {
    if (isset($studentGrades[$student])) {
        $grades = $studentGrades[$student];
        $average = array_sum($grades) / count($grades);
        return $average;
    }
    return null;
}

// Function to find and return the name of the student with the highest grade in a specific subject
function findTopStudent($studentGrades, $subject) {
    $topStudent = '';
    $highestGrade = -1;

    foreach ($studentGrades as $student => $grades) {
        if (isset($grades[$subject]) && $grades[$subject] > $highestGrade) {
            $highestGrade = $grades[$subject];
            $topStudent = $student;
        }
    }
    return $topStudent;
}

// Function to calculate and return the class average for a specific subject
function classAverage($studentGrades, $subject) {
    $total = 0;
    $count = 0;

    foreach ($studentGrades as $student => $grades) {
        if (isset($grades[$subject])) {
            $total += $grades[$subject];
            $count++;
        }
    }

    if ($count > 0) {
        return $total / $count;
    }
    return null;
}

// Function to sort students based on their overall average grade across all subjects
function sortStudentsByOverallAverage($studentGrades) {
    $averageGrades = [];

    foreach ($studentGrades as $student => $grades) {
        $averageGrades[$student] = array_sum($grades) / count($grades);
    }

    arsort($averageGrades); // Sort in descending order
    return $averageGrades;
}

// Test the functions

// 1. Calculate the average grade for a specific student
$student = "Alice";
$average = calculateAverage($studentGrades, $student);
echo "Average grade for $student: " . $average . "<br>";

// 2. Find the top student in Math
$topMathStudent = findTopStudent($studentGrades, "Math");
echo "Top student in Math: $topMathStudent<br>";

// 3. Calculate the class average for Science
$classScienceAverage = classAverage($studentGrades, "Science");
echo "Class average for Science: " . $classScienceAverage . "<br>";

// 4. Sort students by their overall average
echo "Students sorted by overall average:<br>";
$sortedStudents = sortStudentsByOverallAverage($studentGrades);
foreach ($sortedStudents as $student => $average) {
    echo "$student: " . $average . "<br>";
}

?>
