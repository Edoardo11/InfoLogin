<!DOCTYPE HTML>
<html>

<head>
    <title>MySQLi C R U D</title>
</head>

<body>

    <h1>MySQLi: Update a Record</h1>

    <?php
    //include database connection
    include 'db_connect.php';

    // if the form was submitted/posted, update the record
    if ($_POST) {

        //write query
        $sql = "UPDATE
                users
            SET
                name = ?,
                email = ?,
                mobile = ?,
                password  = ?
            WHERE
                uid= ?";

        $stmt = $conn->prepare($sql);

        // you can bind params this way,
        // if you want to see the other way, see our add.php
        $stmt->bind_param(
            'ssssi',
            $_POST['name'],
            $_POST['email'],
            $_POST['mobile'],
            $_POST['password'],
            $_POST['uid']
        );

        // execute the update statement
        if ($stmt->execute()) {
            echo "User was updated.";

            // close the prepared statement
            $stmt->close();
        } else {
            die("Unable to update.");
        }
    }

    //echo "prima if get<br>";
    if ($_GET) {

        $sql = "SELECT
            uid, name, email, mobile, password
        FROM
            users
        WHERE
            uid = " .
            $conn->real_escape_string($_GET['uid']) .
            " LIMIT 0,1";
        echo $sql . "<br>";

        // execute the sql query
        $result = $conn->query($sql);

        //get the result
        $row = $result->fetch_assoc();

        // php's extract() makes $row['firstname'] to $firstname automatically
        extract($row);
        //$uid=$row['uid'];
        //echo "<br>".$uid."<br>"."<br>";

        //disconnect from database
        $result->free();
        $conn->close();
    }
    ?>

    <!--we have our html form here where new user information will be entered-->
    <form action='u_update.php?uid=<?php echo $uid; ?>' method='post' border='0'>
        <table>
            <tr>
                <td>Name</td>
                <td><input type='text' name='name' value='<?php echo $name;  ?>' /></td>
            </tr>
            <tr>
                <td>email</td>
                <td><input type='text' name='email' value='<?php echo $email;  ?>' /></td>
            </tr>
            <tr>
                <td>mobile</td>
                <td><input type='text' name='mobile' value='<?php echo $mobile;  ?>' /></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type='password' name='password' value='<?php echo $password;  ?>' /></td>
            <tr>
                <td></td>
                <td>
                    <!-- so that we could identify what record is to be updated -->
                    <input type='hidden' name='uid' value='<?php echo $uid ?>' />
                    <input type='submit' value='Update' />
                    <a href='index.php'>Back to index</a>
                </td>
            </tr>
        </table>
    </form>

</body>

</html>