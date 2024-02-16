<?php

include 'conn.php';//κλήση του php αρχείου που εξασφαλίζει την σύνδεση με την βδ

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="/Diktyokentrika/css/Edit.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <title>Edit Reservations</title>
</head>
<body>
<!--Τροποποίηση κράτησης χρήστη από admin-->
    <div class="header">
      <nav>
          <div class="nav-links">
            <i class="fa fa-times"></i>
              <ul>
                  <li><a href="/DiktyoKentrika/AdminHomePage.html">Admin Home</a></li>
                  <li><a href="/DiktyoKentrika/EditRes.php">Edit Reservations</a></li>
                  <li><a href="/DiktyoKentrika/EditUsers.php">Edit Users</a></li>
                  <li><a href="/DiktyoKentrika/EditRooms.php">Edit Rooms</a></li>
                  <li><a href="/DiktyoKentrika/Log-out.php">Log Out</a></li>
              </ul>
          </div>
          <i class="fa fa-bars"></i>
      </nav>
    </div>
    <div class="container">
        <table class="table table-dark table-striped">
            <thead>
              <tr> <!--Πίνακας με στοιχεία κράτησης του χρήστη-->
                <th scope="col">Username</th>
                <th scope="col">Type</th>
                <th scope="col">Total Price</th>
                <th scope="col">Check-in</th>
                <th scope="col">Check-out</th>
                <th scope="col">Reservation ID</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sql = "select * from reservations"; //επιλογή όλων των στοιχείων από τον πίνακα κρατήσεων
                $result = mysqli_query($con , $sql);
                if($result){
                  while($row = mysqli_fetch_assoc($result)){
                    $Username = $row['Username'];
                    $Type = $row['Type'];
                    $TotalPrice = $row['TotalPrice'];
                    $Checkin = $row['Checkin'];
                    $Checkout = $row['Checkout'];
                    $ResID = $row['ResID'];
                    echo '<tr>
                            <th scope="row">'.$Username.'</th>
                            <td>'.$Type.'</td>
                            <td>'.$TotalPrice.'</td>
                            <td>'.$Checkin.'</td>
                            <td>'.$Checkout.'</td>
                            <td>'.$ResID.'</td>
                            <td>
                            <button class="btn btn-primary"><a href="updateReservation.php?updateres='.$ResID.'" class="text-light">Update</a></button>
                            <button class="btn btn-danger" ><a href="deleteRes.php?deleteres='.$ResID.'" class="text-light">Delete</a></button>
                            </td>
                          </tr>';
                  }
                  //κουμπιά ενημέρωσης και διαγραφής κράτησης και πέρασμα του ResID στο url για την διαγραφή / ενημέρωση
                }
              ?>
            </tbody>
          </table>
    </div>
</body>
</html>
