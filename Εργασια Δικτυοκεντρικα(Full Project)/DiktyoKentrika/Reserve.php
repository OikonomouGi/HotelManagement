<?php 

include 'conn.php'; //κλήση του php αρχείου που εξασφαλίζει την σύνδεση με την βδ
if (isset($_COOKIE["isLoggedin"])){
    session_start ();
}
//Κλήση cookie το οποίο ελέγχει εάν ο χρήστης είναι συνδεδεμένος ή όχι
//Έναρξη session για αποθήκευση username και password
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width , initial-scale=1.0">
        <title>Tinos Hotel - Reserve</title>
        <link rel="stylesheet" href="css/Reserve.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/searchbar.css">
        
    </head>
    <body>
        <!--Σελίδα κράτησης δωματίου-->
        <div class="header">
            <nav>
                <div class="nav-links">
                <i class="fa fa-times"></i>
                    <ul>
                    <?php 
                    
                            if(isset($_COOKIE["isLoggedin"])){  //Χρήση της php προκειμένου να εμφανίζεται διαφορετικό navigation bar ανάλογα με τον ρόλο του χρήστη 
                                echo '<li><a href="/DiktyoKentrika/HomePage.php">Home</a></li>' , 
                                    '<li><a href="/DiktyoKentrika/Services.php">Services</a></li>' , 
                                    '<li><a href="/DiktyoKentrika/Reserve.php">Book A Room</a></li>' , 
                                    '<li><a href="/DiktyoKentrika/View.php">User Profile</a></li>' , 
                                    '<li><a href="/DiktyoKentrika/Log-out.php">Logout</a></li>' ;

                            }else{
                                echo '<li><a href="/DiktyoKentrika/HomePage.php">Home</a></li>' ,
                                    '<li><a href="/DiktyoKentrika/Login.php">Login</a></li>' ,
                                    '<li><a href="/DiktyoKentrika/Register.php">Register</a></li>' ,
                                    '<li><a href="/DiktyoKentrika/Services.php">Services</a></li>' ,
                                    '<li><a href="/DiktyoKentrika/Reserve.php">Book A Room</a></li>';
                            }
                    ?>
                    </ul>
                </div>
                <i class="fa fa-bars"></i>
            </nav>

            <!-- φόρμα  με το κουμπί για αναζήτηση δωματίων-->
            <form class="search" action="" method="GET">
                <input type="search" name="search"  value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Number of people"><!--Δημιουργία input-box για αναζήτηση και χρήση της php για ανάκτηση παραμέτρων -->
                <button type="submit" >Search</button><!--Δημιουργία κουμπιού αναζήτησης-->
             </form> 
            

            <!-- πίνακας για εμφάνιση των δωματίων-->
            <div style="height:715px; overflow:auto;">
                        <table class="content-table">
                        <thead>
                        <tr>
                        <th scope="col">Room Type</th>
                        <th scope="col">Capacity</th>
                        <th scope="col">Price/Night</th>
                        <th scope="col">Photo</th>                                          
                        <th scope="col">Action</th>
                    </tr>    
                    </thead>
                <tbody>
              
                            <?php 
                                    //αναζήτηση του πίνακα
                                    include 'conn.php';
                                    if(isset($_GET['search']))
                                    {
                                        $filtervalues = $_GET['search'];
                                        $query = "SELECT * FROM rooms WHERE CONCAT(Capacity) LIKE '%$filtervalues%' ";
                                        $query_run = mysqli_query($con, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $items)
                                            {
                                                        ?>
                                        <tr style="border-bottom: 1px solid #dddddd;">
                                        <td scope="row" style="padding: 12px 15px; color:white; text-align:center; font-size: 23px;"><?= $items['Type']; ?></td>
                                        <td style="padding: 12px 15px; color:white; text-align:center; font-size: 23px;"><?= $items['Capacity']; ?></td>
                                        <td style="padding: 12px 15px; color:white; text-align:center; font-size: 23px;"><?= $items['Price']; ?></td>
                                        <td style="padding: 12px 15px;"><img src= "<?= $items['Photo']; ?>" style="width: 290px; height:200px; text-align:center;"/> </td>                                    
                                        <td style="padding: 12px 15px; text-align:center;"><button  style="
                                        
                                        
                                        display: inline-block;
                                        padding: 15px 25px;
                                        font-size: 24px;
                                        cursor: pointer;
                                        text-align: center;
                                        text-decoration: none;
                                        outline: none;
                                        color: #fff;
                                        background-color:#5d82b9;
                                        border: none;
                                        border-radius: 15px;
                                        box-shadow: 0 9px #999; 
                                        "
                                        
                                        
                                        
                                        
                                        ><a href="ReserveForm.php?room='.$Type.'&Price='.$Price.'" style="color:white;" >Reserve</a></button></td>
                                        </tr> 
                                                  
                                                        <?php
                                                    }
                                                }
                                                else
                                                {
                                                    ?>
                                                        <tr>
                                                            <td colspan="4">No room found</td>
                                                        </tr>
                                                    <?php
                                                }
                                            }
                                            else{
                                                //σύνδεση με την βάση για γέμισμα του πίνακα με τις τιμές της
                                                $sql = "select * from rooms";
                                                $result = mysqli_query($con , $sql);
                                                if ($result){
                                                while($row = mysqli_fetch_assoc($result)){
                                                    $Type = $row['Type'];
                                                    $Capacity = $row['Capacity'];
                                                    $Price = $row['Price'];
                                                    $Photo = $row['Photo'];                                                 
                                                echo '<tr style="border-bottom: 1px solid #dddddd;">
                                                <td scope="row" style="padding: 12px 15px; color:white; text-align:center; font-size: 23px;">'.$Type.'</td>
                                                <td style="padding: 12px 15px; color:white; text-align:center; font-size: 23px;">'.$Capacity.'</td>
                                                <td style="padding: 12px 15px; color:white; text-align:center; font-size: 23px;">'.$Price.'</td>
                                                <td style="padding: 12px 15px;"><img src= "'.$Photo.'" style="width: 290px; height:200px; text-align:center;"/> </td>
                                                <td style="padding: 12px 15px; text-align:center;"><button  style="
                                                
                                                display: inline-block;
                                                padding: 15px 25px;
                                                font-size: 24px;
                                                cursor: pointer;
                                                text-align: center;
                                                text-decoration: none;
                                                outline: none;
                                                color: #fff;
                                                background-color:#5d82b9;
                                                border: none;
                                                border-radius: 15px;
                                                box-shadow: 0 9px #999; 
                                                "
                                                
                                                
                                                
                                                
                                                ><a href="ReserveForm.php?room='.$Type.'&Price='.$Price.'" style="color:white;" >Reserve</a></button></td>
                                                </tr> '; //κουμπί που οδηγεί στην σελίδα ReserveForm.php και περνάνε ως παράμετροι μέσα στο url ο τύπος του δωματίου και η τιμή του
                                            
                                            }
                                        }
                                    }
                                        ?>
                </tbody>
            </table>
            </div>    
            
        </div>

        

     
    </body>
</html>