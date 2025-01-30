<!-- A simple calculator that uses a function to add two variables with numerical values, and then output the sum of these two values in an HTML format -->
<!DOCTYPE html>
<head>
    <title>Add Numbers</title>
</head>
<body>
    <h1>Add Numbers Excersice</h1>
    <h3>First number is : 10</h3>
    <h3>Second number is : 20</h3>
    <?php 
    
        function addNumbers()
        {
            $a = 10;
            $b = 20;
            $sum = $a + $b;
            print_r($sum);
        } 
    ?>
    <h3>Sum of these two numbers is : <?= addNumbers(); ?></h3>

    
</body>
</html>