<?php
//create short variable name
$document_root = $_SERVER[ 'DOCUMENT_ROOT' ];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bob's Auto Parts - Order Results</title>
</head>

<body>
  <h1>Bob's Auto Parts</h1>
  <h2>Customer Orders</h2>
  <?php
  $fp = fopen( "$document_root/school/web-250/simpson-nick-02/orders/orders.txt", 'rb' );
  flock( $fp, LOCK_SH ); // lock file for reading

  if ( !$fp ) {
    echo "<p><strong>No orders pending.<br>Please try again later.</strong></p>";
    exit;
  }

  while ( !feof( $fp ) ) {
    $order = fgets( $fp );
    echo htmlspecialchars( $order ) . "<br>";

    flock( $fp, LOCK_UN ); // release read lock
    fclose( $fp );
  }
  ?>
</body>
</html>
<?php
echo "<mm:dwdrfml documentRoot=" . __FILE__ . ">";
$included_files = get_included_files();
foreach ( $included_files as $filename ) {
  echo "<mm:IncludeFile path=" . $filename . " />";
}
echo "</mm:dwdrfml>";
?>