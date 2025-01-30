<?php 

// constant for database connection
define("HOST","localhost");
define("username","root");
define("password","");
define("database","myapp_db");


// constant for application info
define("APP_NAME","myapp");
define("app_version","1.0.0");
define("debug_mode",true);

// array version
define("langauges",["en"=>"English","sp"=>"Spanish","fr"=>"French"]);

//function for display database config

function databaseconfig()
{
    echo "Database Configuration:</br>";            // Demonstrating constants in a function (global scope)
    echo "Host : ".HOST."</br>"."Username : ".username."</br>"."Password : ".password."</br>"."Database : ".database."</br>";
}

// function for display application info
function appinfo()
{
    echo "Application Information:</br>";
    echo "Name : ".APP_NAME."</br>"."Version : ".app_version."</br>"."Debug Mode : ".(debug_mode?"Enabled":"Disabled")."</br>";
   
}

// function for listing all langauges
function displaylang()
{
    echo "Supported Languages:</br>";
    foreach(langauges as $key=>$l){
        echo $key." : ".$l."</br>";
    }
    // print_r(langauges);
}

databaseconfig();
echo "</br></br>"; 
appinfo();
echo "</br></br>";
displaylang();
echo "</br></br>";

//Demonstrating case-insensitive

echo "app_name: " . (defined('app_name') ? app_name : "Not accessible") . "<br>";


// Error handling demonstration
echo "</br>Error handling demonstration:</br>";
try {
    // Attempt to redefine a constant (this will trigger an error)
    define('APP_NAME', 'NewAppName');
} catch (Error $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

?>