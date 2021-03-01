<?php
include "Template/navbar.php";
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
            <form method="POST" action="/E-Commerce/scripts.php">
            <div style="display:none;" class="m-auto input-group mb-3">
            <span class="input-group-text" id="basic-addon2">ID</span>
            <input name="id" type="text"  class=" form-control" aria-describedby="basic-addon2" value="' . $user->id . '">
            </div>
            <div class="m-auto input-group mb-3">
            <span class="input-group-text" id="basic-addon2">Quantity</span>
            <input name="quantity" type="text"  class=" form-control" aria-describedby="basic-addon2" value="1">
            </div>
            </br>
            <div style="display: none;"  class="mb-3">
                            <input name="urlb" type="text" class="form-control" id="urlb">
                        </div>
                        ';

            if (isset($_SESSION['name']) && isset($_SESSION['id'])) {
                echo '<input class=" btn btn-info" type="submit" name="addcart" value="Add to Cart">';
            }
            else{

                echo '<input class=" btn btn-info"   data-bs-toggle="modal" data-bs-target="#exampleModal" href="#"  name="addcart" value="Add to Cart">';
            }


            echo '
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
