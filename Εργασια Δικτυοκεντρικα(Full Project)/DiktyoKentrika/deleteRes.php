<?php
    
    include 'conn.php'; 
    //κλήση του php αρχείου που εξασφαλίζει την σύνδεση με την βδ
    if (isset($_COOKIE["isLoggedin"])){ 
        //Κλήση cookie το οποίο ελέγχει εάν ο χρήστης είναι συνδεδεμένος ή όχι
        session_start (); //Έναρξη session για αποθήκευση username και password
    }
    if (isset($_GET['deleteres'])){ //έλεγχος για το αν η παράμετρος deleteres , δηλαδή το ReservationID που υπάρχει στο url είναι ορισμένη και εκχώρηση της τιμής σε μεταβλητή
        $ResID = $_GET['deleteres'];

        $sql="delete from reservations where ResID= '$ResID' "; //δημιουργία ερωτήματος και εκτέλεση για την διαγραφή του δωματίου με το ResID που πήραμε απο το url 
        $result=mysqli_query($con , $sql);
        if($result){
            if($_SESSION['Username'] != 'admin'){ //έλεγχος ρόλου χρήστη για την σωστή ανακατεύθυνση του
                echo "<script>
                alert('Reservation Deleted Successfully!');
                window.location.href='/DiktyoKentrika/View.php';
                </script>";
            }else{
                echo "<script>
                alert('Reservation Deleted Successfully!');
                window.location.href='/DiktyoKentrika/AdminHomePage.html';
                </script>";
            }
            
        }else{
            die(mysqli_error($con));
        }
    }

?>