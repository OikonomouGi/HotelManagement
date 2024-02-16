<?php

include 'conn.php'; //κλήση του php αρχείου που εξασφαλίζει την σύνδεση με την βδ
if (isset($_COOKIE["isLoggedin"])){ //Κλήση cookie το οποίο ελέγχει εάν ο χρήστης είναι συνδεδεμένος ή όχι
    if($_COOKIE["isLoggedin"] == "True"){
        session_start (); //Έναρξη session για αποθήκευση username και password
    }   
}

?>
<!DOCTYPE html>
<!--Σελίδα με τις παρεχόμενες υπηρεσίες-->
<html>
    <head>
        <meta name="viewport" content="width=device-width , initial-scale=1.0">
        <title>Services - Tinos Hotel</title>
        <link rel="stylesheet" href="css/Services.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>
    <body class="body">
        <div class="header">
            <nav>
                <div class="nav-links">
                    <i class="fa fa-times"></i>
                    <ul>
                        <?php if(isset($_COOKIE["isLoggedin"])){  //Χρήση της php προκειμένου να εμφανίζεται διαφορετικό navigation bar ανάλογα με τον ρόλο του χρήστη 
                                echo '<li><a href="/DiktyoKentrika/HomePage.php">Home</a></li>',
                                    '<li><a href="/DiktyoKentrika/Services.php">Services</a></li>' ,
                                    '<li><a href="/DiktyoKentrika/Reserve.php">Book A Room</a></li>' ,
                                    '<li><a href="/DiktyoKentrika/View.php">User Profile</a></li>' ,
                                     '<li><a href="/DiktyoKentrika/Log-out.php">Logout</a></li>';
                            }else{
                                echo '<li><a href="/DiktyoKentrika/HomePage.php">Home</a></li>' , 
                                        '<li><a href="/DiktyoKentrika/Login.php">Login</a></li>' , 
                                        '<li><a href="/DiktyoKentrika/Register.php">Register</a></li>' ,
                                        '<li><a href="/DiktyoKentrika/Services.php">Services</a></li>' ,
                                        '<li><a href="/DiktyoKentrika/Reserve.php">Book A Room</a></li>' 
                                        ;
                            }
                            ?>
                    </ul>
                </div>
                <i class="fa fa-bars"></i>
            </nav>
        </div>
        <div class="text-box">
            <h1>Our Services  </h1>
        </div>
        <div class="slider">  <!-- html slideshow , 4 διαφάνειες με φωτογραφίες και αυτόματο nav bar -->
            <div class="slides">
               <input type="radio" name="radio-btn" id="radio1"> 
               <input type="radio" name="radio-btn" id="radio2"> 
               <input type="radio" name="radio-btn" id="radio3"> 
               <input type="radio" name="radio-btn" id="radio4">
               <div class="slide first">
                    <img src="/DiktyoKentrika/photos/breakfast1.jpg" alt="">
               </div>
               <div class="slide">
                    <img src="/DiktyoKentrika/photos/main-pool.jpg">
               </div>
               <div class="slide">
                    <img src="/DiktyoKentrika/photos/spa.jpg">
                </div>
                <div class="slide">
                    <img src="/DiktyoKentrika/photos/lobby-bar_europa-may2019-nh7.jpg">
                </div>
                <div class="navigation-auto">
                    <div class="auto-btn1"></div>
                    <div class="auto-btn2"></div>
                    <div class="auto-btn3"></div>
                    <div class="auto-btn4"></div>
                </div>
            </div>
            <div class="navigation-manual">
                <label for="radio1" class="manual-btn"></label>
                <label for="radio2" class="manual-btn"></label>
                <label for="radio3" class="manual-btn"></label>
                <label for="radio4" class="manual-btn"></label>
            </div>
        </div>
        <div class="container">
            <div class="slidertext">
                <p id="slidertext"></p>
            </div>
        </div> 
        <!--εσωτερικό css για styling  -->
        <style> 
            .list-serv {
                width:100%;
                margin-left: 20px;
                color: white;
            }
           
            .list{
                display: inline-block;
                margin-right: 0px;
                margin-left: 150px;
                text-align: left;
                
            }
            .list1{
                display: inline-block;
                margin-right: -15px;
                margin-left: 145px;
                text-align: left;
                
            }
           .list-container {
                margin-bottom: 50px;
            }
            h2{
                width: 35%;
                text-align:center;
            }
        </style>
        <h2><font color="white">Facilities & Services</font></h2> <!-- bullets για επεξήγηση υποδομών/υπηρεσιών ξενοδοχείου-->
        <div class="list-serv">  
            <div class="list-container">
            <ul class="list">
                
                <li>24-Hour Reception</li>
                <li>Lobby Lounge</li>
                <li>Bar Restaurant</li>
                <li>Sauna</li>
                <li>Breakfast</li>
                <li>Gym</li>
                <li>Internet Corner</li>
            </ul>
            <ul class="list">
                <li>Massage (upon request)</li>
                <li>Pets Allowed</li>
                <li>Room Service</li>
                <li>Laundry & Ironing Service</li>
                <li>Wi-Fi Internet Access</li>
                <li>Beauty Treatment (on request)</li>
                <li>Doctor (upon request)</li>
            </ul>
            
            <h2><font color="white" >Amenities</font></h2>
             
            <ul class="list1">      
                <li>Air Conditioning</li>
                <li>Bathrobes and Slippers </li>
                <li>Bathroom with Shower</li>
                <li>Cable-Satellite TV</li>
                <li>Closet</li>
                <li>Direct dial telephone</li>
                <li>Daily Maid Service</li>
            </ul>
            <ul class="list1"> 
                <li>Hairdryer</li>
                <li>Iron & Ironing Board</li>
                <li>Modern Furnishing</li>
                <li>Private Balcony</li>
                <li>Room Service (up to 23:00)</li>
                <li>Safe Deposit Box</li>
                <li>Wi-Fi (ADSL) Internet Connection (free of charge)</li>
            </ul>
            <ul class="list1"> 
                <li>Central Heating</li>
                <li>Coffee Facilities</li>
                <li>Electronic Locks</li>
                <li>Guest Laundry</li>
                <li>Mini-Bar</li>
                <li>Music</li>
                <li>Soundproof Windows</li>
            </ul>
            </div>
        </div>  
    </body>
    <script type="text/javascript"> //javascript κώδικας για το αυτόματο animation στο άλμπουμ φωτογραφιών
        var slideText = ["Breakfast" , "Main Pool" , "Sauna" , "Bar-Restaurant"];
        var counter = 1; 
        setInterval(function(){
            document.getElementById("radio" + counter).checked = true;
            document.getElementById("slidertext").innerHTML = slideText[counter-1];
            counter++;
            if(counter > 4){
                counter = 1;
            }
        } , 5000);
    </script>

</html>


