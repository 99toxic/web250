<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bob's Auto Parts - Order Results</title>
</head>

<body>
    <h1>Bob's Auto Parts</h1>
    <h2>Order Results</h2>
    <?php
    //Create short variable names
    $tireqty = $_POST[ 'tireqty' ];
    $oilqty = $_POST[ 'oilqty' ];
    $sparkqty = $_POST[ 'sparkqty' ];

    $totalqty = 0;
    $totalqty = $tireqty + $oilqty + $sparkqty;
    $totalamount = 0.00;

    if ( $totalqty == 0 ) {
        echo "You did not order anything on the previous page! <br>";
    }else {
        echo "<p>Order processed at " . date( 'H:i, jS F Y' ) . "</p>"; //Start printing order
        echo htmlspecialchars( $tireqty ) . 'tires <br>';
        echo htmlspecialchars( $oilqty ) . 'bottles of oil <br>';
        echo htmlspecialchars( $sparkqty ) . 'spark plugs <br>';
    }

    echo "<p>Items Ordered: " . $totalqty . "<br>";

    define( 'TIREPRICE', 100 );
    define( 'OILPRICE', 10 );
    define( 'SPARKPRICE', 4 );

    $totalamount = $tireqty * TIREPRICE + $oilqty * OILPRICE + $sparkqty * SPARKPRICE;

    echo "Subtotal: $" . number_format( $totalamount, 2 ) . "<br>";
  
    //Discount
    if ($tireqty < 10) {
        $discount = 0;
    }elseif (($tireqty >= 10) && ($tireqty <= 49)) {
        $discount = .05;
    }elseif (($tireqty >= 50) && ($tireqty <= 99)) {
        $discount = .10;
    }elseif ($tireqty >= 100) {
        $discount = .15;
    }
    
    $discountamount = $totalamount * $discount;
    
    $totalamount = $totalamount - $discountamount;

    $taxrate = .10; //local sales tax is 10%
    $totalamount = $totalamount * ( 1 + $taxrate );
    
    echo "Discount Amount: $discount" . '<br>';

    echo "Total including tax: $" . number_format( $totalamount, 2 ) . "</p>";

    echo 'isset($tireqty): ' . isset( $tireqty ) . '<br>';
    echo 'isset($nothere): ' . isset( $nothere ) . '<br>';
    echo 'isset($tireqty): ' . isset( $tireqty ) . '<br>';

    ?>
</body>
</html>