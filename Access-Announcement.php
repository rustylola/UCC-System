<?php include('database.php'); 


$queryannounce = "SELECT * FROM `vax_announcement` ORDER BY ID DESC";
$results = mysqli_query($mysqli,$queryannounce);
$counts = mysqli_num_rows($results);

if($counts > 0){
    while($rows = mysqli_fetch_array($results)){
        $data[] = $rows;
    }

    print(json_encode($data));
}
mysqli_close($mysqli);

?>