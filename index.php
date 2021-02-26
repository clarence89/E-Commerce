<?php include "Template/navbar.php";
include "database.php";

?>
<div class="mt-1">
  <main>

    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
      <ol class="carousel-indicators">

        <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
        <?php
        $result2 = $conn->query("SELECT COUNT(*) as counted FROM products WHERE isfeatured = true");
        $i = 1;
        $count = $result2->fetch_object()->counted;
        while ($i <= $count) {
          echo ' <li data-bs-target="#myCarousel" data-bs-slide-to=' . $i . '></li>';
          $i += 1;
        }
        ?>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">

          <img src="https://blogmedia.evbstatic.com/wp-content/uploads/wpmulti/sites/8/shutterstock_199419065.jpg" class="bd-placeholder-img" width="100%" height="100%">

          </img>
          <div class="container">
            <div class="carousel-caption text-start">
              <h1 style="font-family: Lato">PrinceK's Party Supplies</h1>
              <p style="font-family: Montserrat">You can choose different kinds of Party Suplies Here and Order like. Balloons, Confetti, Cakes, and more!!</p>
            </div>
          </div>
        </div>

        <!-- Carousel Item -->
        <?php
        $result1 = $conn->query("SELECT * FROM products WHERE isfeatured = true");

        if ($result1->num_rows > 0) {
          while ($row1 = $result1->fetch_assoc()) {
            echo '
           <div class="carousel-item">
           <center>
           <a href="/E-Commerce/product/'.$row1['id'].'">
             <img class="bd-placeholder-img" style="height:100%" src="' . $row1['prodimagecar'] . '">
             </a>
             </img>



           </div>
         ';
          }
        }
        ?>
      </div>
      <!-- Carousel Item End-->
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </a>
    </div>

    <div class="bg-light">
      <div class="mx-4">


        <!-- This is Column Data -->

        <?php
        include 'database.php';
        /* $result = $conn->query("SELECT * FROM `products` LIMIT 6");
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
        } else {
          echo '<div class="col"><h1>No Data</h1></div>';
        } */
        $resultcateg = $conn->query("SELECT DISTINCT prodcateg FROM `products`");
        $resultcateg1 = $conn->query("SELECT DISTINCT prodcateg FROM `products`");
        echo '
        <div class="row">
      <div class="d-none d-sm-block col-sm-3 col-md-2 col-lg-2 col-xl-2">

      <h1  style="font-family: Lato; font-size:1.2em; font-weight: 600; color:rgb(176, 46, 37);">About PrinceK</h1>
      <p style="font-family: Lato;font-size:1.2em; font-weight: 600; color:rgb(176, 46, 37);">Product Categories</p>
        <ul style="list-style-type:disc">';
        while ($rowcateg1 = $resultcateg1->fetch_assoc()) {
          echo '<li><a style="font-family: Montserrat;color:black;" href="/E-Commerce/category/' . $rowcateg1['prodcateg'] . '">' . $rowcateg1['prodcateg'] . '</a></li>';
        }
        echo '
        </ul>
      </div>


     <div class="col-12 col-sm-9 col-md-10 col-lg-10 col-xl-10">
        ';

        while ($rowcateg = $resultcateg->fetch_assoc()) {
          $category = $rowcateg['prodcateg'];
          echo '<p style="font-family: Lato; font-size:2em;font-weight:600;">' . $category . '</p></br>';
          echo '<div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4">';
          if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
          } else {
            $pageno = 1;
          }
          $no_of_records_per_page = 3;
          $offset = ($pageno - 1) * $no_of_records_per_page;

          $total_pages_sql = "SELECT COUNT(*) FROM products  WHERE prodcateg='$category'";
          $result =  $conn->query($total_pages_sql);
          $total_rows = $result->fetch_array()[0];
          $total_pages = ceil($total_rows / $no_of_records_per_page);

          $sql = "SELECT * FROM `products` WHERE prodcateg='$category'  ORDER BY `products`.`id` DESC LIMIT $offset, $no_of_records_per_page ";
          $res_data =  $conn->query($sql);
          if ($result->num_rows  > 0) {
            while ($row = $res_data->fetch_array()) {
              echo '
              <a  href="/E-Commerce/product/' . $row['id'] . '">
            <div class="col">
              <div class="card border-light">
                <img src="' . $row['prodimage'] . '" class="bd-placeholder-img card-img-top" width="100%" ></img>

               <div class="card-body">
               <div style="font-family: Lato" class="card-title"><h3>' . $row['prodname'] . '</h3></div>
                 <p style="font-family: Monthserrat;color:black;"  class="card-text text-center">' . $row['proddesc'] . '</p>
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
            echo '<div class="col"><h1>No Data</h1></div>';
          }
          echo '</div>';
          echo '
        <div class="container ">

        <div class="text-right">
          <a href="/category/' . $category . '" >See all...</a>
          </div>

        </div>';
        }

        ?>
      </div>
    </div>


</div>
<br>
<ul class="pagination  <?php if ($total_pages <= 1) {
                          echo 'd-none';
                        } ?>">
  <li class="btn"><a href="?pageno=1">First</a></li>
  <li class="btn <?php if ($pageno <= 1) {
                    echo 'disabled';
                  } ?>">
    <a href="<?php if ($pageno <= 1) {
                echo '#';
              } else {
                echo "?pageno=" . ($pageno - 1);
              } ?>">Prev</a>
  </li>
  <li class="btn <?php if ($pageno >= $total_pages) {
                    echo 'disabled';
                  } ?>">
    <a href="<?php if ($pageno >= $total_pages) {
                echo '#';
              } else {
                echo "?pageno=" . ($pageno + 1);
              } ?>">Next</a>
  </li>
  <li class="btn"><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
</ul>
</div>
</div>

</main>
</div>

<?php include "Template/footer.php"; ?>
