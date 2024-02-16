<?php
    include 'conn.php'; //κλήση του php αρχείου που εξασφαλίζει την σύνδεση με την βδ
    if (isset($_GET['deleteroom'])){ //έλεγχος για το αν η παράμετρος deleteroom , δηλαδή o τύπος του δωματίου που θέλουμε να διαγράψουμε που υπάρχει στο url είναι ορισμένη και εκχώρηση της τιμής σε μεταβλητή
        $Type = $_GET['deleteroom'];

        $sql="delete from rooms where Type='$Type' "; //διαγραφή δωματίων σύμφωνα με τον τύπο τους
        $result=mysqli_query($con , $sql);
        if($result){
            echo "<script>
            alert('Room Deleted Successfully!'); 
            window.location.href='/DiktyoKentrika/EditRooms.php';
            </script>";
        }else{
            die(mysqli_error($con));
        }
    }

?>