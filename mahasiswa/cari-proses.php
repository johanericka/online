<?php
require_once('../system/dbconn.php');

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
//$link = mysqli_connect("103.17.76.12:9779", "masterdata", "masterdata2020", "masterdata");

// Check connection
//if($link === false){
//    die("ERROR: Could not connect. " . mysqli_connect_error());
//}

if (isset($_REQUEST["term"])) {
    // Prepare a select statement
    $sql = "SELECT * FROM useraccount2 WHERE upper(nama) LIKE ?";

    if ($stmt = mysqli_prepare($dbsurat, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);

        // Set parameters
        $param_term = '%' . strtoupper($_REQUEST["term"]) . '%';

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            // Check number of rows in the result set
            if (mysqli_num_rows($result) > 0) {
                // Fetch result rows as an associative array
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo "<p>" . $row["nama"] . "</p>";
                }
            } else {
                echo "<p>Data tidak ditemukan</p>";
            }
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
