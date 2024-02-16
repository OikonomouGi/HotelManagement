<?php 
include  'conn.php';  //κλήση του php αρχείου που εξασφαλίζει την σύνδεση με την βδ
$Username = $_GET['updateuname'];
$sql = "select * from users where Username = '$Username'";
$result = mysqli_query($con , $sql);
$row = mysqli_fetch_assoc($result);
$Name=$row['Name'];
$Surname = $row['Surname'];
$Country = $row['Country'];
$City = $row['City'];
$Address=$row['Address'];
$email=$row['email'];
$Username=$row['Username'];
$Password=$row['Password'];
 
if (isset($_POST['Update'])) { //έλεγχος για το αν είναι set το Post['Update'] , αν δηλαδή έχει πατηθεί το κουμπί στο Update απο πλευράς χρήστη
    //εκχώρηση τιμών απο το post ερώτημα
        $Name = $_POST['Name'];
        $Surname = $_POST['Surname'];
        $Country = $_POST['Country'];
        $City = $_POST['City'];
        $Address = $_POST['Address'];
        $email = $_POST['email'];
        $Username = $_POST['Username'];
        $Password = $_POST['Password'];
    
        $sql = "update users set Name='$Name' , Surname='$Surname' , Country='$Country' , City='$City', Address='$Address', email='$email', Username='$Username', Password='$Password' where Username='$Username'";
        $result = mysqli_query($con , $sql);
        if($result){
            echo "<script>
            alert('User Updated Successfully!');
            window.location.href='/DiktyoKentrika/EditUsers.php';
            </script>";
        }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Update Form</title>
        <link type="text/css" rel="stylesheet" href="/Diktyokentrika/css/update.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width , initial-scale=1.0">
    </head>
    <body>
<!--Σελίδα ενημέρωσης στοιχείων χρήστη από τον admin-->
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
            <div class="title">Update User</div>
            <div id="error"></div>
            <form method="POST" action=""> <!-- Φόρμα με τα στοιχεία του χρήστη, χρήση Post ερωτήματος για αποστολή των στοιχείων-->
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Name</span>
                        <input type="text" name="Name" value=<?php echo $Name?> required>  
                    </div>
                    <div class="input-box">
                        <span class="details">Surname</span>
                        <input type="text" name="Surname"  value=<?php echo $Surname?> required>  
                    </div>
                    <div class="input-box">
                        <span class="details">Country</span>
                        <input type="text" name="Country" value=<?php echo $Country?> required>  
                    </div>
                    <div class="input-box">
                        <span class="details">City</span>
                        <input type="text" name="City"  value=<?php echo $City?> required>  
                    </div>
                    <div class="input-box">
                        <span class="details">Address</span>
                        <input type="text" name="Address" value=<?php echo $Address?> required>  
                    </div>
                    <div class="input-box">
                        <span class="details">E-mail</span>
                        <input type="email" name="email" value=<?php echo $email?> required>  
                    </div> 
                    <div class="input-box">
                        <span class="details">Username</span>
                        <input type="text" name="Username" value=<?php echo $Username?> required>  
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" name="Password" value=<?php echo $Password?> required>  
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Update" name="Update"> <!--κουμπί για ενημέρωση των αλλαγών-->
                </div>
            </form>
        </div>
    </body>
</html>
