<?php
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
include "Template/navbar.php"; ?>

<div class="album py-5 bg-light">
    <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
           
            include 'database.php';
            if ($_POST['category']) {

                $categ = $conn->real_escape_string($_POST['category']);
                $result = $conn->query("Select * from `products` where `prodcateg` = '$categ' OR `prodname` LIKE '%$categ%'");
                if ($result->num_rows  > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '
                            <div class="col">
              <div class="card shadow-sm ">
                <img src="' . $row['prodimage'] . '" class="bd-placeholder-img card-img-top" width="100%" ></img>
    
               <div class="card-body">
               <h3 class="card-title">' . $row['prodname'] . '</h3>
                 <p class="card-text">' . $row['proddesc'] . '</p>
                 <div class="d-flex justify-content-between align-items-center">
                  
                   <small class="text-muted">' . date("F jS, Y", strtotime($row['dateposted'])) . '</small>
                  </div>
               </div>
              </div>
          </div>
                     ';
                    }
                }
            }

            ?>


            <!-- This is Column Data  -->
        </div>
    </div>
</div>



<?php include "Template/footer.php";
?>