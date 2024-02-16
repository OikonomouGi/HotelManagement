<?php

if(isset($_COOKIE["isLoggedin"])){ //Κλήση cookie το οποίο ελέγχει εάν ο χρήστης είναι συνδεδεμένος ή όχι
    session_start();//δημιουργία session του χρήστη
    session_destroy();//τερματισμός session του χρήστη
    setcookie("isLoggedin", "", time() - 3600 , '/'); //καταστροφή του cookie
    echo "<script>
    alert('Redirecting you to HomePage...');
    window.location.href='/DiktyoKentrika/HomePage.php';
    </script>";
}

?>