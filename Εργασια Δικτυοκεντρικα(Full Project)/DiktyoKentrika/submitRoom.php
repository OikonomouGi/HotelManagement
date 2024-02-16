<?php
    include 'conn.php';  //κλήση του php αρχείου που εξασφαλίζει την σύνδεση με την βδ
    if(isset($_POST['type']) && isset($_POST['price']) && isset($_FILES['photo']) && isset($_POST['capacity'])){ //έλεγχος αν είναι ορισμένες οι τιμές απο το post ερώτημα και εκχώρηση τους σε μεταβλητές
        $price = $_POST['price'];
        $photo = $_FILES['photo'];
        $photo_name = $photo['name']; //η φωτογραφία χωρίζεται στο όνομα της , και στην ίδια την φωτογραφία.Το όνομα χρησιμεύει για την αποθήκευση του path της φωτογραφίας στην ΒΔ , και η ίδια η φωτογραφία αποθηκεύεται εσωτερικά στο file system και πρόσβαση της απο τις σελίδες (χρησιμοποιώντας το path της)
        $photo_size = $photo['size'];
        $photo_type = $photo['type'];
        $photo_tmp_name = $photo['tmp_name'];
        $Capacity = $_POST['capacity'];
    
        $upload_directory = 'photos/';
        $upload_file = $upload_directory . $photo_name;
        if (move_uploaded_file($photo_tmp_name, $upload_file)) {
            $query = "INSERT INTO rooms (Type, Price, Photo , Capacity) VALUES ('$type', '$price', '$upload_file' , '$Capacity')"; //εισαγωγή των νέων στοιχείων στον πίνακα rooms 
            if(mysqli_query($con, $query)){
                echo "<script>
                alert('Room added Successfully!');
                window.location.href='/DiktyoKentrika/EditRooms.php';
                </script>";
            }else{
                echo "<script>
                alert('error at query!');
                window.location.href='/DiktyoKentrika/AddRoom.php';
                </script>";
            }
        } else {
            echo "<script>
                alert('error at photo!');
                window.location.href='/DiktyoKentrika/Addroom.php';
                </script>";
        }
    }else{
        echo "<script>
                alert('error at post !');
                window.location.href='/DiktyoKentrika/Addroom.php';
                </script>";
    }
?>