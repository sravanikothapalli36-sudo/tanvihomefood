<?php
/**
 * Receives cart (product_id => quantity), builds order summary and redirects to WhatsApp.
 */
require_once __DIR__ . '/products.php';

$cart = isset($_POST['cart']) && is_array($_POST['cart']) ? $_POST['cart'] : [];

$lines = [];
$total = 0;

foreach ($cart as $productId => $qty) {
    $qty = (int) $qty;
    if ($qty <= 0) continue;

    $product = getProductById($productId);
    if (!$product) continue;

    $lineTotal = $product['rate'] * $qty;
    $total += $lineTotal;
    $lines[] = sprintf('%s × %d — ₹%s', $product['name'], $qty, number_format($lineTotal));
}

if (empty($lines)) {
    header('Location: index.php?empty=1');
    exit;
}

$message = "Hi, I would like to place an order:\n\n";
$message .= implode("\n", $lines);
$message .= "\n\n*Total: ₹" . number_format($total) . "*";

$url = 'https://wa.me/' . $WHATSPP_NUMBER . '?text=' . rawurlencode($message);
header('Location: ' . $url);
exit;
