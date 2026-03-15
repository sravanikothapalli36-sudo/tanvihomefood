<?php
/**
 * Product catalog — single source for IDs, names, prices, weights.
 * Product IDs are for backend/cart only; do not display on the main site.
 * Update prices and add image paths here for future use.
 */

$WHATSPP_NUMBER = '919010053022';

$PRODUCTS = [
    // Healthy Snacks (image path: pics folder, filename without extension)
    ['id' => 1,  'name' => 'Bellam Sunnunda',           'category' => 'Healthy Snacks', 'weight' => '250g', 'rate' => 250,  'image_class' => 'laddu', 'image' => 'pics/Bellam-Sunnunda.jpg'],
    ['id' => 2,  'name' => 'Dry Fruit Laddu',            'category' => 'Healthy Snacks', 'weight' => '250g', 'rate' => 325,  'image_class' => 'laddu', 'image' => 'pics/Dry-Fruit-Laddu.jpg'],
    ['id' => 3,  'name' => 'Palli Chakki',               'category' => 'Healthy Snacks', 'weight' => '250g', 'rate' => 150,  'image_class' => 'laddu', 'image' => 'pics/Palli-Chakki.jpg'],
    ['id' => 4,  'name' => 'Raggi Dryfruit Laddu',       'category' => 'Healthy Snacks', 'weight' => '250g', 'rate' => 225,  'image_class' => 'laddu', 'image' => 'pics/Raggi-Dryfruit-Laddu.jpg'],
    // Pickles
    ['id' => 5,  'name' => 'Boneless Chicken Pickle',    'category' => 'Pickles', 'weight' => '250g', 'rate' => 350,  'image_class' => 'pickle'],
    ['id' => 6,  'name' => 'Chicken Pickle (With Bone)', 'category' => 'Pickles', 'weight' => '250g', 'rate' => 270,  'image_class' => 'pickle'],
    ['id' => 7,  'name' => 'Prawns Pickle',              'category' => 'Pickles', 'weight' => '250g', 'rate' => 500,  'image_class' => 'pickle'],
    ['id' => 8,  'name' => 'Allam (Ginger) Pickle',      'category' => 'Pickles', 'weight' => '250g', 'rate' => 200,  'image_class' => 'pickle'],
    ['id' => 9,  'name' => 'Cauliflower Pickle',         'category' => 'Pickles', 'weight' => '250g', 'rate' => 180,  'image_class' => 'pickle'],
    ['id' => 10, 'name' => 'Mango Pickle',               'category' => 'Pickles', 'weight' => '250g', 'rate' => 200,  'image_class' => 'pickle', 'image' => 'pics/Mango-Pickle.jpg'],
    ['id' => 11, 'name' => 'Lemon Pickle',               'category' => 'Pickles', 'weight' => '250g', 'rate' => 190,  'image_class' => 'pickle'],
    ['id' => 12, 'name' => 'Tomato Pickle',              'category' => 'Pickles', 'weight' => '250g', 'rate' => 200,  'image_class' => 'pickle'],
    // Hot & Sweet
    ['id' => 13, 'name' => 'Kaju Masala',                'category' => 'Hot & Sweet', 'weight' => '250g', 'rate' => 350,  'image_class' => 'muruku'],
    ['id' => 14, 'name' => 'Kara Bundi',                 'category' => 'Hot & Sweet', 'weight' => '250g', 'rate' => 150,  'image_class' => 'muruku'],
    ['id' => 15, 'name' => 'Chekkalu',                   'category' => 'Hot & Sweet', 'weight' => '250g', 'rate' => 150,  'image_class' => 'muruku'],
    ['id' => 16, 'name' => 'Chakralu',                   'category' => 'Hot & Sweet', 'weight' => '250g', 'rate' => 150,  'image_class' => 'muruku'],
    ['id' => 17, 'name' => 'Attukulu Mixture',           'category' => 'Hot & Sweet', 'weight' => '150g', 'rate' => 150,  'image_class' => 'muruku'],
    ['id' => 18, 'name' => 'Ribbon Pakoda',               'category' => 'Hot & Sweet', 'weight' => '250g', 'rate' => 180,  'image_class' => 'muruku', 'image' => 'pics/Ribbon-Pakoda.jpg'],
    ['id' => 19, 'name' => 'Sanna Karapusa',             'category' => 'Hot & Sweet', 'weight' => '250g', 'rate' => 150,  'image_class' => 'muruku', 'image' => 'pics/Sanna-Karapusa.jpg'],
    ['id' => 20, 'name' => 'Gavvalu',                    'category' => 'Hot & Sweet', 'weight' => '250g', 'rate' => 150,  'image_class' => 'muruku', 'image' => 'pics/Gavvalu.jpg'],
    ['id' => 21, 'name' => 'Gulab Jamun',                'category' => 'Hot & Sweet', 'weight' => '250g', 'rate' => 230,  'image_class' => 'laddu', 'image' => 'pics/gulab-jamun.jpg'],
    ['id' => 22, 'name' => 'Bobbatlu',                   'category' => 'Hot & Sweet', 'weight' => '1 Piece', 'rate' => 20,  'image_class' => 'laddu', 'image' => 'pics/Bobbatlu.jpg'],
    ['id' => 23, 'name' => 'Purnam Burelu',              'category' => 'Hot & Sweet', 'weight' => '1 Piece', 'rate' => 20,  'image_class' => 'laddu', 'image' => 'pics/Purnam-Burelu.jpg'],
];



/** Get product by ID (for send_order.php) */
function getProductById($id) {
    global $PRODUCTS;
    foreach ($PRODUCTS as $p) {
        if ((int) $p['id'] === (int) $id) return $p;
    }
    return null;
}

/** Group products by category for catalog display */
function getProductsByCategory() {
    global $PRODUCTS;
    $grouped = [];
    foreach ($PRODUCTS as $p) {
        $cat = $p['category'];
        if (!isset($grouped[$cat])) $grouped[$cat] = [];
        $grouped[$cat][] = $p;
    }
    return $grouped;
}
