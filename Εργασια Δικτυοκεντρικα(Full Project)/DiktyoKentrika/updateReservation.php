<!DOCTYPE html>
<?php

include 'conn.php';  //κλήση του php αρχείου που εξασφαλίζει την σύνδεση με την βδ


if (isset($_COOKIE["isLoggedin"])){
    if($_COOKIE["isLoggedin"] == "True"){
        session_start ();
        //Κλήση cookie το οποίο ελέγχει εάν ο χρήστης είναι συνδεδεμένος ή όχι
//Έναρξη session για αποθήκευση username και password

        if (isset($_GET['updateres'])){
            $ResID = $_GET['updateres']; //έλεγχος και απόκτηση ResID , δηλαδη ID  απο το url 
        }
        
       
        if ($_SESSION["Username"]){
            $Username = $_SESSION["Username"];
        }

        $sql = "select * from reservations where ResID = '$ResID'";
        $result = mysqli_query($con , $sql);
        $row = mysqli_fetch_assoc($result);
        $Username= $row['Username'];
        $Type = $row['Type'];
        $TotalPrice = $row['TotalPrice'];
        $Checkin=$row['Checkin'];
        $Checkout=$row['Checkout'];

        $sql1 = "select * from rooms where Type = '$Type'";
        $result1 = mysqli_query($con , $sql1);
        $row1 = mysqli_fetch_assoc($result1);
        $Price = $row1['Price'];

    }else{
        echo "<script>
                alert('Please Login First!');
                window.location.href='/DiktyoKentrika/Login.php';
                </script>";
    }
    
}else{
    echo "<script>
                alert('Please Login First!');
                window.location.href='/DiktyoKentrika/Login.php';
                </script>";
}




?>

<html>
    <head>
        <meta name="viewport" content="width=device-width , initial-scale=1.0">
        <title>Update your Reservation</title>
        <link rel="stylesheet" href="css/ReserveRoom.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!--Σελίδα ενημέρωσης κράτησης-->
        <div class="header">
            <nav>
                <div class="nav-links">
                    <i class="fa fa-times"></i>
                    <ul>
                <?php 
                    
                    if(isset($_COOKIE["isLoggedin"])){  //Κλήση cookie το οποίο ελέγχει εάν ο χρήστης είναι συνδεδεμένος ή όχι
                        if ($_SESSION['Username'] != 'admin'){ //εμφάνιση του κατάλληλου navbar ανάλογα με τον ρόλο του χρήστη
                            echo    '<li><a href="/DiktyoKentrika/HomePage.php">Home</a></li>' , 
                                    '<li><a href="/DiktyoKentrika/Services.php">Services</a></li>' , 
                                    '<li><a href="/DiktyoKentrika/Reserve.php">Book A Room</a></li>' , 
                                    '<li><a href="/DiktyoKentrika/View.php">User Profile</a></li>' , 
                                    '<li><a href="/DiktyoKentrika/Log-out.php">Logout</a></li>' ;
                        }else{
                            echo    '<li><a href="/DiktyoKentrika/AdminHomePage.html">Admin Home</a></li>',
                                    '<li><a href="/DiktyoKentrika/EditRes.php">Edit Reservations</a></li>',
                                    '<li><a href="/DiktyoKentrika/EditUsers.php">Edit Users</a></li>',
                                    '<li><a href="/DiktyoKentrika/EditRooms.php">Edit Rooms</a></li>',
                                    '<li><a href="/DiktyoKentrika/Log-out.php">Log Out</a></li>';
                        }
                    }
                ?>
                    </ul>
                </div>
                <i class="fa fa-bars"></i>
            </nav>
        </div>    
            <div class="container"> 
                <div class="title">Update your Reservation for room: <?php echo "$Type" ?> </div>
                <div id="error"></div>
                <form method="POST" action=""> <!-- Φόρμα με τα στοιχεία της κράτησης, χρήση Post ερωτήματος για αποστολή των στοιχείων-->
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Username</span>
                            <input type="text" name="Username" value=<?php echo $Username?> readonly>  
                        </div>
                        <div class="input-box">
                            <span class="details">Type</span>
                            <input type="text" name="Type"  value=<?php echo $Type?> readonly>  
                        </div>
                        <div class="input-box">
                            <span class="details">Total Price</span>
                            <input type="text" name="Total Price" value=<?php echo $TotalPrice?> readonly>  
                        </div>
                        <div class="input-box">
                            <span class="details">Check-in</span>
                            <input type="date" name="Checkin"  value=<?php echo $Checkin?> >  
                        </div>
                        <div class="input-box">
                            <span class="details">Check-out</span>
                            <input type="date" name="Checkout" value=<?php echo $Checkout?> >  
                        </div>

                    </div>
                    <div class="button">
                        <input type="submit" value="Submit" name="UpdateRes">
                    </div>
                </form>
            </div>
    </body>
</html>

<?php

if (isset($_POST['UpdateRes'])){ //έλεγχος για την σωστή εισαγωγή των ημερομηνιών από τον χρήστη 
    if(!empty($_POST['Checkin']) && !empty($_POST['Checkout'])){
        $checkin = new DateTime($_POST['Checkin']); //απόκτηση των ημερομηνιών απο το post ερώτημα
        $checkout = new DateTime($_POST['Checkout']);
        if ($checkin > $checkout || $checkin==$checkout){ //έλεγχος για σωστή επιλογή των ημερομηνιών και ανακατεύθυνση χρήστη για επανάληψη επιλογής ημερομηνιών
            echo "<script>
                alert('wrong dates');
                </script>";
            echo "<script>
                window.location.href='/DiktyoKentrika/updateReservation.php?ResID= ".$ResID." ';
                </script>";
        }
        $difference = $checkout->diff($checkin);
        $TotalPrice = $difference -> d * $Price; //υπολογισμός κόστους κράτησης
        $checkin = $checkin->format('Y/m/d');
        $checkout = $checkout->format('Y/m/d');
        $sql = "Update reservations set Username='$Username' , Type='$Type' , TotalPrice='$TotalPrice' , Checkin='$checkin' , Checkout='$checkout' where ResID = '$ResID'";
        $result = mysqli_query($con , $sql);
            if($result){ //ενημέρωση για την επιτυχία της κράτησης
                if(( $_SESSION["Username"] == 'admin')  && ($_SESSION["Password"] == 'admin')){
                    echo "<script>
                    alert('Reservation Updated Successfully!');
                    window.location.href='/DiktyoKentrika/AdminHomePage.html';
                    </script>";
                }
                echo "<script>
                alert('Reservation updated successfully!');
                window.location.href='/DiktyoKentrika/View.php';
                </script>";
            }
    }



}


?>

