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
<?php
$symbol = $_GET['coin'];
$url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/info';
$parameters = [
  'symbol' => $symbol,
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
$result = json_decode($response); // print json decoded response

echo '<pre>';
// var_dump($result->data);
echo '<pre>';



foreach($result->data as $coin ):
?>


<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      <img src="<?php echo $coin->logo; ?>" alt="<?php echo 'logo'; ?>">
      <h2><?php echo $coin->name; ?> <small><?php echo $coin->symbol; ?></small></h2>
      <p><?php echo $coin->category; ?></p>
    </div>
    <div class="col-md-6">      
      <p><b>Description: </b><?php echo $coin->description; ?></p>
    </div>
  </div>
</div>
<?php
endforeach;
// echo $print;
curl_close($curl); // Close request
?>

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