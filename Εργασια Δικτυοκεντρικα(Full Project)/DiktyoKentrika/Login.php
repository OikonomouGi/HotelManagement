<!DOCTYPE html> 
<!--Σελίδα σύνδεσης στην ιστοσελίδα με τα στοιχεία του χρήστη-->
<?php

session_start ();//Έναρξη session για αποθήκευση username και password
if(isset($_POST['Login'])){ //έλεγχος για το αν είναι set το Post['login'] , αν δηλαδή έχει πατηθεί το κουμπί στο login απο πλευράς χρήστη
    $Username = $_POST['Username']; //Εισαγωγή των τιμών που έδωσε ο χρήστης στο post μήνυμα
    $Password = $_POST['Password']; //Εισαγωγή των τιμών που έδωσε ο χρήστης στο post μήνυμα


    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "hotel";

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName); //Σύνδεση με την βάση δεδομένων του ξενοδοχείου
    if ($conn->connect_error) { //έλεγχος σύνδεσης στην βδ 
        die('Could not connect to the database.');
    }
    else {
        $sql = "select * from users where Username = '$Username' and Password=  '$Password'";  //δημιουργία query και εκτέλεση του
        $result = mysqli_query($conn , $sql);
        $row = mysqli_fetch_array($result , MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        
        if ($count == 1){ //Δημιουργία cookie το οποίο εξασφαλίζει το εάν ο χρήστης είναι συνδεδεμένος στο σύστημα ή όχι ,σε περίπτωση που υπάρχει αποτέλεσμα στην αναζήτηση στην βάση για τα στοιχεία που έδωσε ο χρήστης
            $cookie_name = "isLoggedin";
            $cookie_value = "True";
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            $_SESSION["Username"] = $row['Username']; //εισαγωγή τιμών username και pass στο session
            $_SESSION["Password"] = $row['Password'];
            if (($row['Username'] == 'admin')  && ($row['Password'] == 'admin')){
                echo "<script> 
                alert('Welcome Admin!');
                window.location.href='/DiktyoKentrika/AdminHomePage.html';
                </script>";
            }
            else{ 
            echo "<script>
            alert('Welcome , " .$_SESSION["Username"]. "');
            window.location.href='/DiktyoKentrika/HomePage.php';
            </script>";
            }
        }else{
            $cookie_name = "isLoggedin";
            $cookie_value = "False";
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            echo "            
            <script>
            alert('Wrong credentials!');
            window.location.href='/DiktyoKentrika/Login.php';
            </script>";
        }
        //έλεγχοι ανάλογα με τον ρόλο του χρήστη και ανακατεύθυνσή του στην ανάλογη σελίδα ανάλογα με τον ρόλο του
    }
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link type="text/css" rel="stylesheet" href="/Diktyokentrika/css/Login.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width , initial-scale=1.0">
    </head>
    <body>
        <div class="header">
            <nav>
                <div class="nav-links">
                    <i class="fa fa-times"></i>
                    <ul>
                        <li><a href="/DiktyoKentrika/HomePage.php">Home</a></li>
                        <li><a href="/DiktyoKentrika/Login.php">Login</a></li>
                        <li><a href="/DiktyoKentrika/Register.php">Register</a></li>
                        <li><a href="/DiktyoKentrika/Services.php">Services</a></li>
                        <li><a href="/DiktyoKentrika/Reserve.php">Book A Room</a></li>
                    </ul>
                </div>
                <i class="fa fa-bars"></i>
            </nav>
        </div>
        <div class="container">
            <div class="title">Login</div>
            <form method="POST" action="">
                <div class="user-details"> <!-- φόρμα για εισαγωγή στοιχείων απο user--> 
                    <div class="input-box">
                        <span class="details">Username</span>
                        <input type="text" name="Username"  placeholder="Enter your username" required>  
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" name="Password" placeholder="Enter your password" required>  
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Login" name="Login">
                </div>
            </form>
        </div>
    </body>
</html>