<?php
include 'conn.php'; //κλήση του php αρχείου που εξασφαλίζει την σύνδεση με την βδ
?>
<?php 
session_start (); 
//Έναρξη session για αποθήκευση username και password
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="/Diktyokentrika/css/View.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <title>User profile</title>
</head>
<!--Σελίδα προβολής στοιχείων κρατήσεων του χρήστη-->
<body>
    <div class="header">
      <nav>
          <div class="nav-links">
            <i class="fa fa-times"></i>
              <ul>
                <li><a href="/DiktyoKentrika/HomePage.php">Home</a></li>
                <li><a href="/DiktyoKentrika/Services.php">Services</a></li>
                <li><a href="/DiktyoKentrika/Reserve.php">Book A Room</a></li>
                <li><a href="/DiktyoKentrika/View.php">User Profile</a></li>
                <li><a href="/DiktyoKentrika/Log-out.php">Logout</a></li>
              </ul>
          </div>
          <i class="fa fa-bars"></i>
      </nav>
    </div>
    <div class="text-box"> 
      <!--Διαβεβαίωση συνδεδεμένου χρήστη-->
                  <?php
                      if($_SESSION["Username"]){
                  ?>
                   <h1>       User : <?php echo $_SESSION["Username"]; ?> bookings </h1> <!--μήνυμα ανάλογα με το username-->
                  <?php
                      }else 
                          echo "<script>
                          alert('Please Login First!');
                          window.location.href='/DiktyoKentrika/Login.php';
                          </script>";
                  ?>
</div>
    <div class="container">
        <table class="table table-dark table-striped"> <!--Πίνακας με τα στοιχεία του χρήστη και της κράτησδης-->
            <thead>
              <tr>
                <th scope="col">Type</th>
                <th scope="col">Price</th>
                <th scope="col">Reservation ID</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>

              <?php
              $Username = $_SESSION["Username"];
                $sql = "select * from reservations where Username = '$Username' "; //επιλογή στοιχείων κράτησης ανάλογα με το username
                $result = mysqli_query($con , $sql);
                if($result){
                  while($row = mysqli_fetch_assoc($result)){
                    $Type = $row['Type'];
                    $Price = $row['TotalPrice'];
                    $ResID = $row['ResID'];
                    echo '<tr>
                            <th scope="row">'.$Type.'</th>
                            <td>'.$Price.'</td> 
                            <td>'.$ResID.'</td>                          
                            <td>
                            <button class="btn btn-primary"><a href="updateReservation.php?updateres='.$ResID.'" class="text-light">Update</a></button> 
                            <button class="btn btn-danger" ><a href="deleteRes.php?deleteres='.$ResID.'" class="text-light">Delete</a></button>
                            </td>
                          </tr>';
                  }
                  //κουμπιά ενημέρωσης και διαγραφής κράτησης και πέρασμα του ResID στο url για την διαγραφή / ενημέρωση
                }
              ?>
            </tbody>
          </table>
    </div>
</body>
</html>

