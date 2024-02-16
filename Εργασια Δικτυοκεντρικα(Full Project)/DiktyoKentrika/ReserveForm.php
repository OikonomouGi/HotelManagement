<!DOCTYPE html>
<?php

include 'conn.php'; //κλήση του php αρχείου που εξασφαλίζει την σύνδεση με την βδ


if (isset($_COOKIE["isLoggedin"])){ //έλεγχος για το αν το cookie είναι set ή οχι 
    if($_COOKIE["isLoggedin"] == "True"){ //έλεγχος για το αν το cookie έχει την τιμή True , αν δηλαδή ο χρήστης ειναι logged in 
        session_start (); //έναρξη session

        if (isset($_GET['room'])){
            $Type = $_GET['room'];  //απόκτηση του τύπου του δωματίου απο τα header του url μέσω GET
        }
        
        if (isset($_GET['Price'])){
            $Price = $_GET['Price'];  //απόκτηση της τιμής του δωματίου απο τα header του url μέσω GET
        }

        if ($_SESSION["Username"]){
            $Username = $_SESSION["Username"]; //απόκτηση του username απο το session
        }

        $sql = "select * from users where Username = '$Username'"; //ερώτημα για απόκτηση των υπόλοιπων πεδίων του χρήστη που επιθυμεί να κάνει κράτηση και εμφάνιση τους στην φόρμα σε κατάσταση readonly
        $result = mysqli_query($con , $sql);
        $row = mysqli_fetch_assoc($result);
        $Name=$row['Name'];
        $Surname = $row['Surname'];
        $Country = $row['Country'];
        $City = $row['City'];
        $Address=$row['Address'];
        $email=$row['email'];

    }else{ //έλεγχος περίπτωσης που ο χρήστης δεν είναι logged in 
        echo "<script> 
                alert('Please Login First!');
                window.location.href='/DiktyoKentrika/Login.php';
                </script>";
    }
    
}else{   //έλεγχος περίπτωσης που ο χρήστης δεν είναι logged in 
    echo "<script>
                alert('Please Login First!');
                window.location.href='/DiktyoKentrika/Login.php';
                </script>";
}




?>

<html>
    <head>
        <meta name="viewport" content="width=device-width , initial-scale=1.0">
        <title>Book your Room</title>
        <link rel="stylesheet" href="css/ReserveRoom.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
    <!--Σελίδα φόρμας υποβολής κράτησης δωματίου-->
        <div class="header">
            <nav>
                <div class="nav-links">
                    <i class="fa fa-times"></i>
                    <ul>
                        <li><a href="/DiktyoKentrika/HomePage.php">Home</a></li>
                        <li><a href="/DiktyoKentrika/Services.php">Services</a></li>
                        <li><a href="/DiktyoKentrika/View.php">User Profile</a></li>
                        <li><a href="/DiktyoKentrika/Homepage.php">Logout</a></li>
                    </ul>
                </div>
                <i class="fa fa-bars"></i>
            </nav>
        </div>    
            <div class="container"> <!--Δημιουργία φόρμας κράτησης-->
                <div class="title">Reserve Room: <?php echo "$Type" ?> </div>
                <div id="error"></div>
                <form method="POST" action="">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Name</span>
                            <input type="text" name="Name" value=<?php echo $Name?> readonly>  
                        </div>
                        <div class="input-box">
                            <span class="details">Surname</span>
                            <input type="text" name="Surname"  value=<?php echo $Surname?> readonly>  
                        </div>
                        <div class="input-box">
                            <span class="details">Country</span>
                            <input type="text" name="Country" value=<?php echo $Country?> readonly>  
                        </div>
                        <div class="input-box">
                            <span class="details">City</span>
                            <input type="text" name="City"  value=<?php echo $City?> readonly>  
                        </div>
                        <div class="input-box">
                            <span class="details">Address</span>
                            <input type="text" name="Address" value=<?php echo $Address?> readonly>  
                        </div>
                        <div class="input-box">
                            <span class="details">E-mail</span>
                            <input type="email" name="email" value=<?php echo $email?> readonly>  
                        </div> 
                        <div class="input-box">
                            <span class="details">Check In</span>
                            <input type="date" name="checkin" required>  
                        </div> 
                        <div class="input-box">
                            <span class="details">Check out</span>
                            <input type="date" name="checkout" required>  
                        </div> 
                    </div>
                    <div class="button">
                        <input type="submit" value="Submit" name="Reserve">
                    </div>
                </form>
            </div>
    </body>
</html>

<?php

if (isset($_POST['Reserve'])){ //έλεγχος για την σωστή εισαγωγή των ημερομηνιών από τον χρήστη 
    if(!empty($_POST['checkin']) && !empty($_POST['checkout'])){
        $checkin = new DateTime($_POST['checkin']); //απόκτηση των ημερομηνιών απο το post ερώτημα
        $checkout = new DateTime($_POST['checkout']);
        if ($checkin > $checkout || $checkin==$checkout){ //έλεγχος για σωστή επιλογή των ημερομηνιών και ανακατεύθυνση χρήστη για επανάληψη επιλογής ημερομηνιών
            echo "<script>
                alert('Please enter valid dates');
                </script>";
            echo "<script>
                window.location.href='/DiktyoKentrika/ReserveRoom.php?room= ".$Type." '&Price=' ".$Price." ';
                </script>";
        }else{
            $difference = $checkout->diff($checkin);
            $TotalPrice = $difference -> d * $Price; //υπολογισμός κόστους κράτησης
            $checkin = $checkin->format('Y/m/d');
            $checkout = $checkout->format('Y/m/d');
            $sql = "insert into reservations (Username , Type , TotalPrice , Checkin , Checkout) values ('$Username' , '$Type' , '$TotalPrice' ,'$checkin' , '$checkout')";
            $result = mysqli_query($con , $sql);
                if($result){ //ενημέρωση για την επιτυχία της κράτησης
                    echo "<script>
                    alert('Reservation made successfully!');
                    window.location.href='/DiktyoKentrika/HomePage.php';
                    </script>";
                }
        }
        
    }



}


?>


