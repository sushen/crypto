<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

    <title>Crypto</title>
  </head>
  <body>
<div class="container-fluid">
<div class="row">
<div class="col-md-12">

  <table class="table" id="table">
    <thead>
        <th>SL</th>
        <th>Name</th>
        <th>Price</th>
        <th>24h</th>
        <th>7d</th>
        <th>Market cap</th>
        <!-- <th>Volume</th> -->
        <th>Circulating Supply</th>
        <!-- <th>Last 7d</th> -->
    </thead>
    <tbody>
<?php
$url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
$parameters = [
  'start' => '1',
  'limit' => '5000',
  'convert' => 'USD'
];

$headers = [
  'Accepts: application/json',
  'X-CMC_PRO_API_KEY: 90cfef0b-6b58-4768-ac3b-cddf200f5867'
];
$qs = http_build_query($parameters); // query string encode the parameters
$request = "{$url}?{$qs}"; // create the request URL


$curl = curl_init(); // Get cURL resource
// Set cURL options
curl_setopt_array($curl, array(
  CURLOPT_URL => $request,            // set the request URL
  CURLOPT_HTTPHEADER => $headers,     // set the headers 
  CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
));

$response = curl_exec($curl); // Send the request, save the response
$coin = json_decode($response); // print json decoded response


$print = "";
$i = 1;
foreach($coin->data as $coin){
    $print .= '<tr>';
    $print .= '<td><b>'. $i++ .'</b></td>';
    $print .= '<td><a href="/crypto/coin.php/?coin='.$coin->symbol.'"> '. $coin->name.' <b>('. $coin->symbol.')</b></a></td>';
    // $print .= '<td>'. $coin->name.' <b>('. $coin->symbol.')</b></td>';
        $c = $coin->quote; 
        foreach($c as $c){
            $print .= '<td><b>$</b>'. $c->price.'</td>';
            $print .= '<td>'. $c->percent_change_24h.'<b>%</b></td>';
            $print .= '<td>'. $c->percent_change_7d.'<b>%</b></td>';
            $print .= '<td><b>$</b>'. $c->market_cap.'</td>';
        }
    // $print .= '<td>'. $coin->circulating_supply.' <b>('. $coin->symbol.')</b></td>';
    $print .= '<td>'. $coin->circulating_supply.' <b>('. $coin->symbol.')</b></td>';
    $print .= '</tr>';
}


echo $print;
curl_close($curl); // Close request
?>

</tbody>
</table>


</div>
</div>
</div>

<script
  src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
  integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
  crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $('#table').DataTable();
} );
</script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  </body>
</html>