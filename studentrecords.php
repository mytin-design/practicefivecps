<?php

//List all registered users

require("./connect.php");

    // Establish database connection
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    // Prepare SQL statement with ORDER BY clause for 'name'
    $sql = "SELECT name, username, stream, entrymarks,healthstatus, profileimg, gender, dateofbirth FROM students ORDER BY name ASC";
    $stmt = $connect->prepare($sql);

    if (!$stmt) {
        die("Error in SQL query: " . $connect->error);
    }

    // Execute the prepared statement
    $stmt->execute();
    
    // Get result set
    $result = $stmt->get_result();

    // Check for data and display in HTML table
    if ($result->num_rows > 0) {
        echo "<table id='stdRecords' class='stdrecordstb'>";
        echo "<tr><th>NO</th><th>STUDENT NAME</th> <th>REG NO</th> <th>STREAM</th> <th>ENTRY MARKS</th> <th>HEALTH STATUS</th> <th>PROFILE PHOTO</th> <th>GENDER</th> <th>DATE OF BIRTH</th> <th>ACTIONS</th></tr>";
        
        $count = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$count."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['username']."</td>";
        echo "<td>".$row['stream']."</td>";
        echo "<td>".$row['entrymarks']."</td>";
        echo "<td>".$row['healthstatus']."</td>";
        echo "<td>".$row['profileimg']."</td>";
        echo "<td>".$row['gender']."</td>";
        echo "<td>".$row['dateofbirth']."</td>";

        echo "<td id='editbtnbox'><button class='streceditbtn' onclick='editRow(\"".$row['username']."\")'>Edit</button> <button class='streceditbtn' onclick='deleteRow(\"".$row['username']."\")'>Delete</button></td>";
        echo "</tr>";
        $count++;
    }

        echo "</table>";
    } else {
        echo "No results found.";
    }

    // Close prepared statement and database connection
    $stmt->close();
    $connect->close();



?>



<script>
    function editRow(username) {
        // Implement edit action using username (registration number)
        // Redirect to an edit page or perform AJAX to edit data
        alert("Editing user with username: " + username);
    }

    function deleteRow(username) {
        if (confirm("Are you sure you want to delete this user with username: " + username + "?")) {
            // AJAX request to delete the row from the database
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    // event.preventDefault();
                    alert("User with username: " + username + " deleted successfully.");
                    // Refresh the page after successful deletion
                    location.reload(); // Reload the current page
                }
            };
            xhr.open("POST", "./delete_row.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("username=" + username);
        }
    }
</script>
