<?php

include 'conn.php';  //κλήση του php αρχείου που εξασφαλίζει την σύνδεση με την βδ

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
    <title>Edit Rooms</title>
</head>
<body>
  <!--Τροποποίηση δωματίων από admin-->
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
        <button class="btn btn-primary my-5"><a href="/DiktyoKentrika/AddRoom.php" class="text-light">Add Rooms</a></button>
        <table class="table table-dark table-striped">
            <thead>
              <tr> <!--Πίνακας με στοιχεία των δωματίων-->
                <th scope="col">Type</th>
                <th scope="col">Price</th>
                <th scope="col">Photo</th>
                <th scope="col">Capacity</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sql = "select * from rooms"; //επιλογή όλων των στοιχείων από τον πίνακα δωματίων
                $result = mysqli_query($con , $sql);
                if($result){
                  while($row = mysqli_fetch_assoc($result)){
                    $Type = $row['Type'];
                    $Price = $row['Price'];
                    $Photo = $row['Photo'];
                    $Capacity = $row['Capacity'];
                    echo '<tr>
                            <th scope="row">'.$Type.'</th>
                            <td>'.$Price.'</td>
                            <td>'.$Photo.'</td>
                            <td>'.$Capacity.'</td>
                            <td>
                            <button class="btn btn-primary"><a href="updateRoom.php?updateroom='.$Type.'" class="text-light">Update</a></button>
                            <button class="btn btn-danger" ><a href="deleteRoom.php?deleteroom='.$Type.'" class="text-light">Delete</a></button>
                            </td>
                          </tr>';
                  }
                  //κουμπιά ενημέρωσης και διαγραφής κράτησης και πέρασμα του τύπου στο url για την διαγραφή / ενημέρωση
                }
              ?>
            </tbody>
          </table>
    </div>
</body>
</html>
