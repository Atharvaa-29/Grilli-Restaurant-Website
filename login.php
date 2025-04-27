<?php

    $uname = $_POST['username'];
    $pword = $_POST['password'];

    if($uname=="admin" && $pword=="admin")
    {

    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "grilli";



    $conn = new mysqli($servername,$username,$password,$dbname);
    if($conn->connect_error)
    {
        die("Connection Failed");
    }

    //Displaying All The Records

    $sql = "SELECT * FROM book_table";
    $result = $conn->query($sql);

    echo"<h1>Booking Details</h1>";
    if($result->num_rows>0)
    {
        echo "<table border=1>";
        echo "<tr>
                <th>name </th>
                <th>mail </th>
                <th>phone </th>
                <th>date </th>
                <th>time </th>
                <th>people </th>
                <th>message </th>

            </tr>";
  
        while($row = $result->fetch_assoc())
        {
            echo "<tr>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['mail']."</td>";
            echo "<td>".$row['phone']."</td>";
            echo "<td>".$row['date']."</td>";
            echo "<td>".$row['time']."</td>";
            echo "<td>".$row['people']."</td>";
            echo "<td>".$row['message']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    else
    {
        echo "No Record Found";
    }

    $conn->close();
}
?>