<!DOCTYPE HTML>
<html>
    <head>
        <title>MySQLi: Read Records </title>
    </head>
<body>
 
<h1>MySQLi: Read Records</h1>
 
<?php
//include database connection
include 'db_connect.php';
 
$action = isset($_GET['action']) ? $_GET['action'] : "";
 
//if the user clicked ok, run our delete query
if($action=='deleted'){
    echo "User was deleted.";
}
 
 
$query = "SELECT Name, CountryCode FROM City ORDER by ID";

if ($stmt = $conn->prepare($query)) {

    /* execute statement */
    $stmt->execute();

    /* bind result variables */
    $stmt->bind_result($name, $code);

    /* fetch values */
    while ($stmt->fetch()) {
        printf ("%s (%s)\n", $name, $code);
    }

    /* close statement */
    $stmt->close();
} 
 
 
 
 
 
 
 
 
 
if ($stmt = $conn->prepare("SELECT * FROM Users WHERE firstname=?")) {

    /* bind parameters for markers */
	$nome="aldo";
    $stmt->bind_param("s", $nome);

    /* execute query */
    $stmt->execute();

    /* bind result variables */
    $stmt->bind_result($id, $fisrt, $last, $u, $p);
    //eval($stmt);
echo "<div><a href='c_insert.php'>Create New Record</a></div><br>";
echo "<div><a href='index.php'>...back to index</a></div><br><br>";
if( true /*$num_results*/ ){
 
    // html table
    echo "<table border='1'>";
 
        // table heading
        echo "<tr>";
            echo "<th>Firstname</th>";
            echo "<th>Lastname</th>";
            echo "<th>Username</th>";
            echo "<th>Action</th>";
        echo "</tr>";
 
    //loop to show each records
    while($stmt->fetch()){
 
        //extract row
        //this will make $row['firstname'] to just $firstname only
        //extract($row);
        //creating new table row per record
        echo "<tr>";
            echo "<td>{$first}</td>";
            echo "<td>{$last}</td>";
            echo "<td>{$u}</td>";
            echo "<td>";
                echo "<a href='u_update.php?IDuser={$id}'>Edit</a>";
                echo " / ";
 
                // delete_user is a javascript function, see at the bottom par of the page
                echo "<a href='#' onclick='delete_user( {$id} );'>Delete</a>";
            echo "</td>";
        echo "</tr>";
    }
 
    //end table
    echo "</table>";
 
}
 
//if table is empty
else{
    echo "No records found.";
}
 


    /* close statement */
    $stmt->close();
} 
 
 
 
 
 
//disconnect from database

$conn->close();
?>
 
<script type='text/javascript'>
function delete_user( id ){
 
    var answer = confirm('Are you sure?');
 
    //if user clicked ok
    if ( answer ){
        //redirect to url with action as delete and id to the record to be deleted
        window.location = 'd_delete.php?id=' + id;
    }
}
</script>
 
</body>
</html>
