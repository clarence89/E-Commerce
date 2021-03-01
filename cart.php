<?php
ob_start();
include "Template/navbar.php";
?>

<main>
    <div class="container mt-4 mb-4">
    <form action="/scripts.php" method="POST">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col"><input type="checkbox" id="selectAll"></th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Product Quantity</th>
                    <th scope="col">Total Price(Price*Quantity)</th>
                    <th scope="col">Added to Cart</th>
                </tr>
            </thead>
            <tbody>

                    <?php
                    include "database.php";
                    if (isset($_SESSION['name']) && isset($_SESSION['id'])) {
                        $userid = $_SESSION['id'];
                        $sql = "SELECT * FROM carts WHERE `user_id` = $userid";
                        $result =   $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {

                                $id = $row['product_id'];
                                $sql1 = "SELECT * FROM products WHERE `id` = $id";
                                $result1 =   $conn->query($sql1);
                                $product = $result1->fetch_object();
                                echo '
                          <td><input type="checkbox" class="checkbox" name="check[]" value="' . $row['id'] . '"/></td>
                          <td>' . $product->prodname . '</td>
                         <td>' . $product->prodprice . '</td>
                         <td>' . $row['quantity'] . '</td>
                         <td>' . $product->prodprice * $row['quantity'] . '</td>
                         <td>' . $row['created_at'] . '</td>
                          ';
                                echo '  </tr>';
                            }
                        } else {
                            $cart = 0;
                        }
                    } else {
                        header("Location: /E-Commerce/");
                    }
                    ?>

            </tbody>
        </table>
        <input class="btn btn-success" type="submit" name="checkout" value="Checkout" />
                </form>
    </div>
</main>

<?php include "Template/footer.php" ?>
