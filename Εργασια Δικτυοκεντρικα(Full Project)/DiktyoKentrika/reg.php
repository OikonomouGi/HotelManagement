<?php

if (isset($_COOKIE["isLoggedin"])){//Κλήση cookie το οποίο ελέγχει εάν ο χρήστης είναι συνδεδεμένος ή όχι
    session_start ();//Έναρξη session για αποθήκευση username και password
}


if (isset($_POST['Register'])) { //έλεγχος για το αν είναι set το Post['Register'] , αν δηλαδή έχει πατηθεί το κουμπί στο register απο πλευράς χρήστη
    if (isset($_POST['Name']) && isset($_POST['Surname']) &&
        isset($_POST['Country']) && isset($_POST['City']) &&   //έλεγχος για το αν είναι set τα πεδία απο το post ερώτημα
        isset($_POST['Address']) && isset($_POST['email']) &&
        isset($_POST['Username']) && isset($_POST['Password']))
        {

        $Name = $_POST['Name'];
        $Surname = $_POST['Surname'];
        $Country = $_POST['Country'];  //εισαγωγή των τιμών τους για χειρισμό αυτών
        $City = $_POST['City'];
        $Address = $_POST['Address'];
        $email = $_POST['email'];
        $Username = $_POST['Username'];
        $Password = $_POST['Password'];


        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "hotel";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {  //έλεγχος σύνδεσης στην βδ 
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT Username FROM users WHERE Username = ? LIMIT 1"; //δημιουργία sql ερωτήματος και εκτέλεση του ως prepared statement
            $Insert = "INSERT INTO users(Name, Surname, Country, City , Address , email , Username , Password) values(?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $Username);
            $stmt->execute();
            $stmt->bind_result($resultUsername);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum == 0) {
                $stmt->close();

                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("ssssssss",$Name, $Surname, $Country, $City , $Address , $email , $Username , $Password);
                if ($stmt->execute()) {
                    if(( $_SESSION["Username"] == 'admin')  && ($_SESSION["Password"] == 'admin')){ //έλεγχος για ιδιότητα χρήστη έτσι ώστε να γίνεται η ανάλογη ανακατεύθυνση 
                        echo "<script>
                        alert('User Registered Successfully!');
                        window.location.href='/DiktyoKentrika/AdminHomePage.html';
                        </script>";
                    }
                    echo "<script>
                    alert('User Registered Successfully!');
                    window.location.href='/DiktyoKentrika/HomePage.php';
                    </script>";
                }
                else {
                    echo $stmt->error;
                }
            }
            else { //εμφάνιση μηνύματος για προσπάθεια register με ήδη υπάρχον username και ανακατεύθυνση του χρήστη για επαναληπτική προσπάθεια
                echo "<script>
                    alert('An account with this username already exists');
                    window.location.href='/DiktyoKentrika/Register.php';  
                    </script>";
            }
            $stmt->close();
            $conn->close();
        }
    }
    else { //μήνυμα σε περίπτωση που ο χρήστης πατήσει submit χωρίς να χει συπληρώσει όλα τα πεδία
        echo "All fields are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}
?>