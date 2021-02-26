<?php
include "Template/navbar.php";

include "database.php";
?>

<main>
    <div class="container mt-4 mb-4">
        <div class="row">
            <?php
            $query = "SELECT * FROM `products` WHERE `id` = ?";
            $stmt =   $conn->prepare($query);
            $id = $_GET['id'];
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_object();
            echo '
            <div class="row">
            <div class="col-sm-6"><img src="' . $user->prodimage . '"/></div>
            <div class="col-sm-6  d-flex align-self-center justify-content-center  ">
            <center>
           <h1 class="m-4" style="font-family: Lato;color:rgb(176, 46, 37);"> ' . $user->prodname . '
           </h1>
           <h2  class="m-4" style="font-family: Montserrat; font-size:1em;" >' . $user->proddesc . '</h2>
           <h3  class="m-4" style="font-family: Montserrat; font-size:1em;font-weight:700" >P' . $user->prodprice . '</h3>
            <form method="POST" action="scripts.php">
            <div class="m-auto input-group mb-3">
            <span class="input-group-text" id="basic-addon2">Quantity</span>
  <input type="text"  class=" form-control" aria-describedby="basic-addon2" value="1">
</div>
            </br>
            <input class=" btn btn-info" type="submit" name="addcart" value="Add to Cart">
            </form>
            </center>
            </div>
            </div>
            ';

            ?>
        </div>
    </div>
</main>

<?php include "Template/footer.php" ?>
