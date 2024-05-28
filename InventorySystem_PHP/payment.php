<?php
$page_title = 'Sales Report';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);

// Fetch all sales
$results = find_all_sale();

// Initialize total amount and profit
$total_amount = 0;
$profit = 0;

// Calculate total amount and profit
foreach ($results as $result) {
    $total_amount += $result['price'] * $result['qty'];
    // Assuming buy price is stored in the 'buy_price' field of the products table
    $profit += ($result['buy_price'] - $result['buy_price']) * $result['qty'];
}
?>
<!-- 
/*--------------------------------------------------------------*/
 /* Function for find all sales
 /*--------------------------------------------------------------*/
 function find_all_sale(){
   global $db;
   $sql  = "SELECT s.id,s.  ,s.price,s.date,p.name";
   $sql .= " FROM sales s";
   $sql .= " LEFT JOIN products p ON s.product_id = p.id";
   $sql .= " ORDER BY s.date DESC";
   return find_by_sql($sql);
 } -->
<!doctype html>
<html lang="en-US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>payment Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
</head>
<body>
<div class="container">
    <h2>Payment Report</h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Date</th>
            <th>Product Title</th>
            <th>Buying Price</th>
            <!-- <th>Selling Price</th> -->
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($results as $result): ?>
            <tr>
                <td><?php echo $result['date']; ?></td>
                <td><?php echo $result['name']; ?></td>
                <td><?php echo $result['buy_price']; ?></td>
                <!-- <td><?php echo $result['price']; ?></td> -->
                <td><?php echo $result['qty']; ?></td>
                <td><?php echo $result['qty']*$result['buy_price']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4" class="text-right">Total Amount:</td>
            <td><?php echo $total_amount; ?></td>
        </tr>
        <!-- <tr>
            <td colspan="5" class="text-right">Profit:</td>
            <td><?php echo $profit; ?></td>
        </tr> -->
        </tfoot>
    </table>
</div>
</body>
</html>