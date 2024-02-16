<?php

include 'conn.php'; //κλήση του php αρχείου που εξασφαλίζει την σύνδεση με την βδ

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
    <title>Edit Users</title>
</head>
<body>
  <!--Τροποποίηση χρηστών από admin-->
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
        <button class="btn btn-primary my-5"><a href="/DiktyoKentrika/Register.php" class="text-light">Add User</a></button>
        <table class="table table-dark table-striped">
            <thead>
              <tr> <!--Πίνακας με τα στοιχεία  του χρήστη-->
                <th scope="col">Name</th>
                <th scope="col">Surname</th>
                <th scope="col">Country</th>
                <th scope="col">City</th>
                <th scope="col">Address</th>
                <th scope="col">E-mail</th>
                <th scope="col">Username</th>
                <th scope="col">Password</th>
                <th scope="col">Operations</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sql = "select * from users"; //επιλογή όλων των στοιχείων από τον πίνακα χρηστών
                $result = mysqli_query($con , $sql);
                if($result){
                  while($row = mysqli_fetch_assoc($result)){
                    $Name = $row['Name'];
                    $Surname = $row['Surname'];
                    $Country = $row['Country'];
                    $City = $row['City'];
                    $Address = $row['Address'];
                    $email = $row['email'];
                    $Username = $row['Username'];
                    $Password = $row['Password'];
                    echo '<tr>
                            <th scope="row">'.$Name.'</th>
                            <td>'.$Surname.'</td>
                            <td>'.$Country.'</td>
                            <td>'.$City.'</td>
                            <td>'.$Address.'</td>
                            <td>'.$email.'</td>
                            <td>'.$Username.'</td>
                            <td>'.$Password.'</td>
                            <td>
                            <button class="btn btn-primary"><a href="updateUser.php?updateuname='.$Username.'" class="text-light">Update</a></button>
                            <button class="btn btn-danger" ><a href="deleteUser.php?deleteuname='.$Username.'" class="text-light">Delete</a></button>
                            </td>
                          </tr>';
                  }
                  //κουμπιά ενημέρωσης και διαγραφής κράτησης και πέρασμα του Username στο url για την διαγραφή / ενημέρωση
                }
              ?>
            </tbody>
          </table>
    </div>
</body>
</html>

