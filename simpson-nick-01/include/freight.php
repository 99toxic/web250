<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bob's Auot Parts - Freight Costs</title>
</head>

<body>
    <table>
        <tr>
            <td>Distance</td>
            <td>Cost</td>
        </tr>
<?php
     for ($distance = 50; $distance <= 250; $distance += 50) {
         echo "<tr>
                <td">".$distance."</td>
                <td">".($distance / 10)."</td>
                </tr>\n";
     }   
?>
    </table>

</body>
</html>