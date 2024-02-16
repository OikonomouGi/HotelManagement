<?php 

include 'conn.php'; //κλήση του php αρχείου που εξασφαλίζει την σύνδεση με την βδ
if (isset($_COOKIE["isLoggedin"])){
    session_start ();
}
//Κλήση cookie το οποίο ελέγχει εάν ο χρήστης είναι συνδεδεμένοςς ή όχι
//Έναρξη session για αποθήκευση username και password
?>
<!DOCTYPE html>
<!--Σελίδα εγγραφής στο σύστημα-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registration Form</title>
        <link type="text/css" rel="stylesheet" href="/Diktyokentrika/css/Register.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width , initial-scale=1.0">
    </head>
    <body>
        <div class="header">
            <nav>
                <div class="nav-links">
                    <i class="fa fa-times"></i>
                    <ul>
                        <?php 
                    if(isset($_SESSION["Username"])){  //έλεγχος για το αν το Username έχει μπει σε session
                        if(($_SESSION["Username"] == 'admin')  && ($_SESSION["Password"] == 'admin')){ //έλεγχος για το αν o χρήστης είναι admin , έτσι ώστε να εμφανίζεται το ανάλογο navigation bar για κάθε τύπο χρήστη
                            echo '<li><a href="/DiktyoKentrika/AdminHomePage.html">Admin Home</a></li>',
                            '<li><a href="/DiktyoKentrika/EditUsers.php">Edit Users</a></li>',
                           '<li><a href="/DiktyoKentrika/EditRooms.php">Edit Rooms</a></li>',
                            '<li><a href="/DiktyoKentrika/Log-out.php">Log Out</a></li>';
    
                        }}
                    else{
                            echo  '<li><a href="/DiktyoKentrika/HomePage.php">Home</a></li>',
                            '<li><a href="/DiktyoKentrika/Login.php">Login</a></li>',
                            '<li><a href="/DiktyoKentrika/Register.php">Register</a></li>',
                            '<li><a href="/DiktyoKentrika/Services.php">Services</a></li>',
                            '<li><a href="/DiktyoKentrika/Reserve.php">Book A Room</a></li>';
                        }
                    
                ?>
                       
                    </ul>
                </div>
                <i class="fa fa-bars"></i>
            </nav>
        </div>
        <div class="container"> <!--Δημιουργία φόρμας για την δημιουργία λογαριασμού στην ιστοσελίδα-->
            <div class="title">Registration</div>
            <div id="error"></div>
            <form method="POST" action="reg.php"> <!-- κλήση αρχείου reg.php για το register-->
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Name</span>
                        <input type="text" name="Name" placeholder="Enter your First Name" required>  
                    </div>
                    <div class="input-box">
                        <span class="details">Surname</span>
                        <input type="text" name="Surname"  placeholder="Enter your Surname" required>  
                    </div>
                    <div class="input-box">
                        <span class="details">Country</span>
                        <input type="text" name="Country" placeholder="Enter your Country" required>  
                    </div>
                    <div class="input-box">
                        <span class="details">City</span>
                        <input type="text" name="City"  placeholder="Enter the city that you live in" required>  
                    </div>
                    <div class="input-box">
                        <span class="details">Address</span>
                        <input type="text" name="Address" placeholder="Enter your Address" required>  
                    </div>
                    <div class="input-box">
                        <span class="details">E-mail</span>
                        <input type="email" name="email" placeholder="Enter your e-mail" required>  
                    </div> 
                    <div class="input-box">
                        <span class="details">Username</span>
                        <input type="text" name="Username" placeholder="Enter your Username" required>  
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" name="Password" placeholder="Enter your password" required>  
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Submit" name="Register">
                </div>
            </form>
        </div>
    </body>
</html>