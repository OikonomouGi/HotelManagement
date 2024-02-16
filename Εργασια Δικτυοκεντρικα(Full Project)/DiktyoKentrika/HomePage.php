<?php

if(isset($_COOKIE["isLoggedin"])){
    session_start();
}
//Κλήση cookie το οποίο ελέγχει εάν ο χρήστης είναι συνδεδεμένος ή όχι
//Έναρξη session για αποθήκευση username και password
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta name="viewport" content="width=device-width , initial-scale=1.0">
        <title>HomePage - Delux Hotel</title> <!-- ονομασία σελίδας --> 
        <link rel="stylesheet" href="css/HomePage.css"> <!-- σύνδεση με css αρχείο -->
        <link rel="preconnect" href="https://fonts.googleapis.com">  <!-- συνδεση για απόκτηση γραμματοσειράς -->
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- συνδεση για απόκτηση γραμματοσειράς -->
        <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300&display=swap" rel="stylesheet"> <!-- συνδεση για απόκτηση γραμματοσειράς -->
    </head>
    <body>
        <!--Αρχική σελίδα-->
        <div class="header">
            <nav> 
                <div class="nav-links">
                    <!-- Δημιουργία navigation bar -->
                    <i class="fa fa-times"></i> <!-- element που το class εξασφαλίζει ότι στην css θα εφαρμόζεται σε όσα υπο-elements έχει -->
                    <ul>
                    <?php 
                    //Χρήση της php προκειμένου να εμφανίζεται διαφορετικό navigation bar ανάλογα με τον ρόλο του χρήστη 
                    if(isset($_COOKIE["isLoggedin"])){
                        echo '<li><a href="/DiktyoKentrika/HomePage.php">Home</a></li>' , 
                            '<li><a href="/DiktyoKentrika/Services.php">Services</a></li>' , 
                            '<li><a href="/DiktyoKentrika/Reserve.php">Book A Room</a></li>' , 
                            '<li><a href="/DiktyoKentrika/View.php">User Profile</a></li>' , 
                            '<li><a href="/DiktyoKentrika/Log-out.php">Logout</a></li>' ;

                    }else{
                        echo '<li><a href="/DiktyoKentrika/HomePage.php">Home</a></li>' ,
                            '<li><a href="/DiktyoKentrika/Login.php">Login</a></li>' ,
                            '<li><a href="/DiktyoKentrika/Register.php">Register</a></li>' ,
                            '<li><a href="/DiktyoKentrika/Services.php">Services</a></li>' ,
                            '<li><a href="/DiktyoKentrika/Reserve.php">Book A Room</a></li>';
                    }
            ?>
             
                    </ul>
                </div>
                <i class="fa fa-bars"></i>
            </nav>
            <div class="text-box"> 
           
                <h1>Delux Hotel</h1>
                
                <?php 
                    if(isset($_COOKIE["isLoggedin"])){ //χρήση php προκειμένου να παίρνουμε το username και να το εμφανίζουμε κεντρικά της σελίδας σε περίπτωση που ο χρήστης είναι logged in, και διαφορετικό text σε περίπτωση που δεν είναι
                ?>
                        <h3>Welcome  <?php echo $_SESSION["Username"]; ?> </h3>
                       <br> <p>Make your reservation now!</p>  <br>   <a href="/Diktyokentrika/Reserve.php" class="knowmore-button">Book</a>
                <?php
                    }else{
                        echo '<p>
                        Delux Hotel is a small collection of luxury holiday houses, located in
                        Greece.
                
                       <br> The houses at Tinos Hotel have been tastefully built and furnished to create a beautiful balance between descrete luxury and simplicity.</p>';
                    }
            ?>
                
            </div>
        </div>
    </body>
</html>