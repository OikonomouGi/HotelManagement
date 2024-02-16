<?php 
include  'conn.php';  //κλήση του php αρχείου που εξασφαλίζει την σύνδεση με την βδ
$Type1 = $_GET['updateroom']; //απόκτηση του τύπου του δωματίου θέλουμε να κάνουμε update και εκτέλεση query για απόκτηση των υπόλοιπων πληροφοριών για αυτο το δωμάτιο
$sql = "select * from rooms where Type = '$Type1'"; 
$result = mysqli_query($con , $sql);
$row = mysqli_fetch_assoc($result);
$Type= $row['Type'];
$Price = $row['Price'];
$Photo = $row['Photo'];
$Capacity = $row['Capacity'];
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
            <div class="title">Update Room</div>
            <div id="error"></div>
            <form method="POST" action=""> <!-- Φόρμα με τα στοιχεία του δωματίου, χρήση Post ερωτήματος για αποστολή των στοιχείων-->
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Type</span>
                        <input type="text" name="Type" value=<?php echo $Type?> required>  
                    </div>
                    <div class="input-box">
                        <span class="details">Price</span>
                        <input type="text" name="Price"  value=<?php echo $Price?> required>  
                    </div>
                    <div class="input-box">
                        <span class="details">Photo</span>
                        <input type="text" name="Photo" value=<?php echo $Photo?> required>  
                    </div>
                    <div class="input-box">
                        <span class="details">Capacity</span>
                        <input type="text" name="Capacity" value=<?php echo $Capacity?> required>  
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Update" name="Update">
                </div>
            </form>
        </div>
    </body>
</html>

<?php


    if (isset($_POST['Update'])) { //έλεγχος για το αν είναι set το Post['Update'] , αν δηλαδή έχει πατηθεί το κουμπί στο Update απο πλευράς χρήστη
        $Type = $_POST['Type']; //εκχώρηση τιμών απο το post ερώτημα
        $Price = $_POST['Price'];
        $Photo = $_POST['Photo'];
        $Capacity = $_POST['Capacity'];
    
        $sql = "update rooms set Type='$Type' , Price='$Price' , Photo='$Photo' , Capacity='$Capacity' where Type='$Type1'"; //ενημέρωση στοιχείων δωματίου
        $result = mysqli_query($con , $sql);
        if($result){
            echo "<script>
            alert('Room Updated Successfully!');
            window.location.href='/DiktyoKentrika/EditRooms.php';
            </script>";
        }
    }




?>