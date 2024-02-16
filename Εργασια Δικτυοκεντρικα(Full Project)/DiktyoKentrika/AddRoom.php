<?php
include 'conn.php'; //κλήση του php αρχείου που εξασφαλίζει την σύνδεση με την βδ
session_start(); 
//Έναρξη session για αποθήκευση username και password
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width , initial-scale=1.0">
        <title>Add Room - Delux Hotel Admin</title>
        <link rel="stylesheet" href="css/AddRoom.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!--Σελίδα προσθήκης δωματίου admin-->
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
            <form action="submitRoom.php" method="POST" enctype="multipart/form-data"> <!-- φόρμα για προσθήκη δωματίου-->
                <label for="name">Type:</label>
                <input type="text" id="type" name="type" required>
                <br>
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" required>
                <br>
                <label for="photo">Photo:</label>
                <input type="file" id="photo" name="photo" accept="image/jpeg" required> <!-- δημιουργία element για το πεδίο της φωτογραφίας έτσι ώστε να δέχεται μόνο jpeg αρχεία-->
                <br>
                <label for="price">Capacity:</label>
                <input type="text" id="capacity" name="capacity" required>
                <input type="submit" value="Submit">
            </form>
        </div>
    </body>
</html>