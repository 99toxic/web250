<!DOCTYPE html>
<?php
//Create short variable names
$tireqty = ( int )$_POST[ 'tireqty' ];
$oilqty = ( int )$_POST[ 'oilqty' ];
$sparkqty = ( int )$_POST[ 'sparkqty' ];
$address = preg_replace( '/\t|\r/', ' ', $_POST[ 'address' ] );
$document_root = $_SERVER[ 'DOCUMENT_ROOT' ];
$date = date( 'H:i, jS F Y' );
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bob's Auto Parts - Order Results</title>
</head>

<body>
  <h1>Bob's Auto Parts</h1>
  <h2>Order Results</h2>
  <?php
  define( 'TIREPRICE', 100 );
  define( 'OILPRICE', 10 );
  define( 'SPARKPRICE', 4 );

  $totalqty = 0;
  $totalqty = $tireqty + $oilqty + $sparkqty;
  $totalamount = 0.00;

  if ( $totalqty == 0 ) {
    echo "You did not order anything on the previous page! <br>";
  } else {

    echo "<p>Order processed at " . date( 'H:i, jS F Y' ) . "</p>"; //Start printing order
    echo "<p>Items Ordered: " . $totalqty . "<br>";

    if ( $tireqty > 0 ) {
      echo htmlspecialchars( $tireqty ) . 'tires <br>';
    } else {
      echo "<p> no tires ordered</p>";
    }
    if ( $oilqty > 0 ) {
      echo htmlspecialchars( $oilqty ) . 'bottles of oil <br>';
    } else {
      echo "<p> no bottles of oil ordered</p>";
    }
    if ( $sparkqty > 0 ) {
      echo htmlspecialchars( $sparkqty ) . 'spark plugs <br>';
    } else {
      echo "<p> no spark plugs ordered</p>";
    }
  }

  $totalamount = $tireqty * TIREPRICE + $oilqty * OILPRICE + $sparkqty * SPARKPRICE;

  echo "Subtotal: $" . number_format( $totalamount, 2 ) . "<br>";

  //Discount
  if ( $tireqty < 10 ) {
    $discount = 0;
  } elseif ( ( $tireqty >= 10 ) && ( $tireqty <= 49 ) ) {
    $discount = .05;
  } elseif ( ( $tireqty >= 50 ) && ( $tireqty <= 99 ) ) {
    $discount = .10;
  } elseif ( $tireqty >= 100 ) {
    $discount = .15;
  }

  $discountamount = $totalamount * $discount;

  $totalamount = $totalamount - $discountamount;

  $taxrate = .10; //local sales tax is 10%
  $totalamount = $totalamount * ( 1 + $taxrate );

  echo "Discount Amount: $discount" . '<br>';

  echo "Total including tax: $" . number_format( $totalamount, 2 ) . "</p>";

  echo "<p>Address to ship is to " . htmlspecialchars( $address ) . "</p>";

  $outputstring = $date . "\t" . $tireqty . " tires \t" . $oilqty . " oil\t" . $sparkqty . " spark plugs\t\$" . $totalamount . "\t" . $address . "\n";

  //Open a file for appending''    
  $fp = fopen( "$document_root/school/web-250/simpson-nick-02/orders/orders.txt", 'ab' );

  if ( !$fp ) {
    echo "<p><strong>Your order could not be processed at this time. Please try again later.</strong></p>";
    exit;
  }

  flock( $fp, LOCK_EX );

  fwrite( $fp, $outputstring, strlen( $outputstring ) );
  flock( $fp, LOCK_UN );
  fclose( $fp );

  echo "<p>Order written.</p>";

  ?>
</body>
</html>