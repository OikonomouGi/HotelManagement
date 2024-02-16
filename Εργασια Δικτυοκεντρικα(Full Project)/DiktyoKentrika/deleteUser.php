<?php
    include 'conn.php';//κλήση του php αρχείου που εξασφαλίζει την σύνδεση με την βδ
    if (isset($_GET['deleteuname'])){ //έλεγχος για το αν η παράμετρος deleteuname , δηλαδή το Username του χρήστηπ που θέλουμε να διαγράψουμε που υπάρχει στο url είναι ορισμένη και εκχώρηση της τιμής σε μεταβλητή
        $Username = $_GET['deleteuname'];

        $sql="delete from users where Username='$Username' "; //διαγραφή στοιχείου ανάλογα με το όνομα χρήστη
        $result=mysqli_query($con , $sql);
        if($result){
            echo "<script>
            alert('User Deleted Successfully!');
            window.location.href='/DiktyoKentrika/EditUsers.php';
            </script>";
        }else{
            die(mysqli_error($con));
        }
    }

?>