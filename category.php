<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "Template/navbar.php"; ?>

<div class="album py-5 bg-light">
    <div class="container">
        <?php
        include 'database.php';
        $resultcateg1 = $conn->query("SELECT DISTINCT prodcateg FROM `products`");
        echo '
        <div class="row">
      <div class="col-3">

      <p style="font-weight: 600; color:rgb(176, 46, 37);">About PrinceK</p>
      <p style="font-weight: 600; color:rgb(176, 46, 37);">Product Categories</p>
        <ul style="list-style-type:disc">';
        while ($rowcateg1 = $resultcateg1->fetch_assoc()) {
            echo '<li><a style="color:black;" href="/E-Commerce/category/' . $rowcateg1['prodcateg'] . '">' . $rowcateg1['prodcateg'] . '</a></li>';
        }
        echo '
        </ul>
      </div>
      <div class="col-9">
      ';
        ?>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php


            if ($_GET['category']) {

                $categ = $conn->real_escape_string($_GET['category']);
                $result = $conn->query("Select * from `products` where `prodcateg` = '$categ' OR `prodname` LIKE '%$categ%'");
                if ($result->num_rows  > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '
                        <a  href="/E-Commerce/product/' . $row['id'] . '">
                            <div class="col">
              <div class="card shadow-sm ">
                <img src="' . $row['prodimage'] . '" class="bd-placeholder-img card-img-top" width="100%" ></img>

               <div class="card-body">
               <h3  style="font-family: Lato;color:rgb(176, 46, 37);" class="card-title">' . $row['prodname'] . '</h3>
                 <p style="font-family: Monthserrat;color:black;"  class="card-text">' . $row['proddesc'] . '</p>
                 <div class="d-flex justify-content-between align-items-center">

                   <small class="text-muted">' . date("F jS, Y", strtotime($row['prod_dateposted'])) . '</small>
                  </div>
               </div>
              </div>
          </div>
</a>
                     ';
                    }
                } else {
                    echo '<div class="container"><h1>No Data</h1></div>';
                }
            }
            echo '</div>';

            ?>


            <!-- This is Column Data  -->
        </div>
    </div>
</div>



<?php include "Template/footer.php";
?>
