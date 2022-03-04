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
    if ($action == 'deleted') {
        echo "User was deleted.";
    }

    $query = "select * from users";
    $result = $conn->query($query);

    $num_results = $result->num_rows;

    echo "<div><a href='c_insert.php'>Create New Record</a></div><br>";
    echo "<div><a href='index.php'>...back to index</a></div><br><br>";
    if ($num_results) {

        // html table
        echo "<table border='1'>";

        // table heading
        echo "<tr>";
        echo "<th>name</th>";
        echo "<th>email</th>";
        echo "<th>mobile</th>";
        echo "<th>action</th>";
        echo "</tr>";

        //loop to show each records
        while ($row = $result->fetch_assoc()) {

            //extract row
            //this will make $row['firstname'] to just $firstname only
            extract($row);  // 
            //creating new table row per record
            echo "<tr>";
            echo "<td>$name</td>";
            echo "<td>$email</td>";
            echo "<td>$mobile</td>";
            echo "<td>";
            echo "<a href='u_update.php?uid=$uid'>Edit</a>";
            echo " / ";

            // delete_user is a javascript function, see at the bottom par of the page
            echo "<a href='#' onclick='delete_user( $uid );'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }

        //end table
        echo "</table>";
    }

    //if table is empty
    else {
        echo "No records found.";
    }

    //disconnect from database
    $result->free();
    $conn->close();
    ?>

    <script type='text/javascript'>
        function delete_user(id) {

            var answer = confirm('Are you sure?');

            //if user clicked ok
            if (answer) {
                //redirect to url with action as delete and id to the record to be deleted
                window.location = 'd_delete.php?id=' + id;
            }
        }
    </script>

</body>

</html>