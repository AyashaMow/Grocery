<?php

include 'DbConnect/connection.php';
 
$search = $_GET['search'];
//set the name;
$userId = $_GET['userId'];

$sql = "SELECT * FROM price_table WHERE product_name LIKE '$search%' LIMIT 3";
$result = $con->query($sql);
while($row = mysqli_fetch_assoc($result)){
	
	echo '<li>
            <a class="btn"  href="searchResult(staff).php?id='.$row['id'].'&userId='.$userId.'" style="display: flex; justify-content: space-between">
            <div id="productName">'.$row['product_name'].'</div>
            <div>'.$row['price'].'</div>
            </a>
        </li>';

}


$con->close();
?>