<?php include "Template/navbar.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "database.php";

?>

<?php
if (isset($_GET['date'])) {
    $dateY =$conn->real_escape_string($_GET['date']);
}else{
    $dateY= date("Y");
}
$result = $conn->query("SELECT * FROM `transactions` WHERE approved_date LIKE '%$dateY%'");
$year = [];$month = [];$dataPoints = array(
    array("label" => "January", "y" => 0),
    array("label" => "February", "y" => 0),
    array("label" => "March", "y" => 0),
    array("label" => "April", "y" => 0),
    array("label" => "May", "y" => 0),
    array("label" => "June", "y" => 0),
    array("label" => "July", "y" => 0),
    array("label" => "August", "y" => 0),
    array("label" => "September", "y" => 0),
    array("label" => "October", "y" => 0),
    array("label" => "November", "y" => 0),
    array("label" => "December", "y" => 0),
);


while ($row = $result->fetch_assoc()) {
    $datePiece = explode("-", $row['approved_date']);array_push($year, $datePiece[0]);array_push($month, $datePiece[1]);
}$ymonth = array_count_values($month);
foreach (array_unique($month) as $key) {
    $dataPoints[(int)str_replace("0", "", $key) - 1]["y"] =  $ymonth[$key];
    print_r($dataPoints[(int)str_replace("0", "", $key) - 1]["y"]);
}
?>
<script>
    window.onload = function() {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true, theme: "light2", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "<?php echo date("Y"); ?>"
            },
            axisY: {
                title: "Number of Transactions"
            },
            data: [{
                type: "column",dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

    }
</script>
<div id="chartContainer" style="height: 370px; width: 60%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<?php include "Template/footer.php"; ?>
