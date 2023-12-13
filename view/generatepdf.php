<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dompdf\Dompdf;

$data = json_decode(file_get_contents('php://input'), true);

$html = file_get_contents('template.html');
$tbodyHtml = '';
$totalPrice = 586;
$subtotal=0;
foreach ($data as $item) {
  $name = isset($item['name']) ? $item['name'] : '';
  $price = isset($item['price']) ? $item['price'] : '';
  $quantity = isset($item['quantity']) ? $item['quantity'] : '';
  
  
  $tbodyHtml .= "<tr><td>$name</td><td>$price</td><td>$quantity</td></tr>";
  
}

$html = str_replace('{{ tbody }}', $tbodyHtml, $html);
$html = str_replace('{{ total_price }}', $totalPrice, $html);

$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
?>
