<?php
require_once __DIR__ . '/products.php';
$byCategory = getProductsByCategory();
$categoriesMeta = [
    'Healthy Snacks' => ['id' => 'healthy-snacks', 'icon' => '🥜', 'desc' => 'Nutty, wholesome laddus and traditional snacks. Perfect with chai or as a quick bite.'],
    'Pickles'        => ['id' => 'pickles',        'icon' => '🥭', 'desc' => 'Slow-cured with mustard oil and spices. Perfect with rice, roti, or as a tangy accent.'],
    'Hot & Sweet'    => ['id' => 'hot-sweet',      'icon' => '🌶️', 'desc' => 'Savoury snacks, mixtures, and sweet treats. Ideal with chai or as a quick bite.'],
];
$wa = $WHATSPP_NUMBER;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tanvi Home Foods — Authentic Homemade Pickles & Healthy Snacks</title>
  <meta name="description" content="Traditional Indian pickles and healthy homemade snacks. Made with love, tradition, and natural ingredients. No preservatives." />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
  <header class="site-header">
    <div class="header-inner container">
      <a href="#" class="logo">Tanvi Home Foods</a>
      <nav class="nav">
        <a href="#specialties">Specialties</a>
        <a href="#why-us">Why Us</a>
        <a href="#products">Products</a>
        <a href="#about">About</a>
        <a href="#contact">Contact</a>
      </nav>
      <button type="button" class="cart-toggle" aria-label="Open cart">
        <span class="cart-icon" aria-hidden="true">🛒</span>
        <span class="cart-count" id="cart-count">0</span>
      </button>
      <button class="menu-toggle" aria-label="Open menu"><span></span><span></span><span></span></button>
    </div>
  </header>

  <main>
    <!-- 1. Hero -->
    <section class="hero">
      <div class="hero-bg"></div>
      <div class="hero-content container">
        <h1 class="hero-title">Authentic Homemade Pickles & Healthy Snacks</h1>
        <p class="hero-subtitle">Made with Love, Tradition, and Natural Ingredients</p>
        <a href="#products" class="btn btn-primary btn-hero">Order Now</a>
      </div>
    </section>

    <!-- 2. Our Specialties -->
    <section id="specialties" class="section specialties-section">
      <div class="container">
        <h2 class="section-title">Our Specialties</h2>
        <p class="section-subtitle">Handcrafted with traditional recipes passed down through generations</p>
        <ul class="specialties-grid">
          <li><span class="specialty-icon">🧄</span><span>Garlic Pickle</span></li>
          <li><span class="specialty-icon">🍅</span><span>Tomato Pickle</span></li>
          <li><span class="specialty-icon">🥜</span><span>Dry Fruit Laddu</span></li>
          <li><span class="specialty-icon">🌾</span><span>Ragi Powder</span></li>
          <li><span class="specialty-icon">🥮</span><span>Bobbatlu</span></li>
          <li><span class="specialty-icon">🥡</span><span>Healthy Homemade Snacks</span></li>
        </ul>
      </div>
    </section>

    <!-- 3. Why Choose Us -->
    <section id="why-us" class="section why-section">
      <div class="container">
        <h2 class="section-title">Why Choose Us</h2>
        <p class="section-subtitle">What makes Tanvi Home Foods different</p>
        <div class="why-grid">
          <div class="why-card">
            <span class="why-icon">🌿</span>
            <h3>No Preservatives</h3>
            <p>Only fresh, natural ingredients. No artificial additives.</p>
          </div>
          <div class="why-card">
            <span class="why-icon">👩‍🍳</span>
            <h3>Homemade with Traditional Recipes</h3>
            <p>Time-tested recipes from our kitchen to yours.</p>
          </div>
          <div class="why-card">
            <span class="why-icon">✨</span>
            <h3>Freshly Prepared</h3>
            <p>Made in small batches for the best taste and quality.</p>
          </div>
          <div class="why-card">
            <span class="why-icon">💚</span>
            <h3>Healthy Ingredients</h3>
            <p>Wholesome, nutritious choices for you and your family.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- 4. Product Gallery -->
    <section id="products" class="section products-section">
      <div class="container">
        <h2 class="section-title">Product Gallery</h2>
        <p class="section-subtitle">Browse our range and add to cart. Send your order via WhatsApp.</p>

        <?php foreach ($byCategory as $categoryName => $products): ?>
        <?php $meta = $categoriesMeta[$categoryName] ?? ['id' => '', 'icon' => '', 'desc' => '']; ?>
        <div class="catalog-category" id="<?php echo htmlspecialchars($meta['id']); ?>">
          <h3 class="category-heading">
            <span class="category-icon"><?php echo $meta['icon']; ?></span>
            <?php echo htmlspecialchars($categoryName); ?>
          </h3>
          <p class="category-desc"><?php echo htmlspecialchars($meta['desc']); ?></p>
          <div class="product-grid">
            <?php foreach ($products as $p): ?>
            <article class="product-card" data-product-id="<?php echo (int) $p['id']; ?>" data-name="<?php echo htmlspecialchars($p['name']); ?>" data-price="<?php echo (int) $p['rate']; ?>" data-weight="<?php echo htmlspecialchars($p['weight']); ?>">
              <div class="product-card-image product-card-image-<?php echo htmlspecialchars($p['image_class']); ?>">
                <?php if (!empty($p['image'])): ?>
                <img src="<?php echo htmlspecialchars($p['image']); ?>" alt="<?php echo htmlspecialchars($p['name']); ?>" loading="lazy" />
                <?php endif; ?>
              </div>
              <div class="product-card-body">
                <h4 class="product-card-title"><?php echo htmlspecialchars($p['name']); ?></h4>
                <p class="product-card-meta"><?php echo htmlspecialchars($p['weight']); ?> · ₹<?php echo number_format($p['rate']); ?></p>
                <a href="https://wa.me/<?php echo $wa; ?>?text=Hi%2C%20I%27d%20like%20to%20order%20<?php echo rawurlencode($p['name']); ?>" class="btn btn-order btn-product" target="_blank" rel="noopener">Order on WhatsApp</a>
                <button type="button" class="btn btn-add-cart btn-product">Add to Cart</button>
              </div>
            </article>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- 5. Customer Love -->
    <section class="section testimonials-section">
      <div class="container">
        <h2 class="section-title">Customer Love</h2>
        <p class="section-subtitle">What our customers say about us</p>
        <div class="testimonials-grid">
          <blockquote class="testimonial-card">
            <p>“The mango pickle tastes exactly like my grandmother used to make. So authentic and fresh!”</p>
            <footer>— Priya M.</footer>
          </blockquote>
          <blockquote class="testimonial-card">
            <p>“Dry fruit laddus are a hit with the whole family. We order every month. Thank you Tanvi Home Foods!”</p>
            <footer>— Ramesh K.</footer>
          </blockquote>
          <blockquote class="testimonial-card">
            <p>“Finally found homemade snacks without preservatives. The quality and taste are outstanding.”</p>
            <footer>— Anitha S.</footer>
          </blockquote>
        </div>
      </div>
    </section>

    <!-- 6. About -->
    <section id="about" class="section about-section">
      <div class="container">
        <h2 class="section-title">Our Story</h2>
        <p class="section-subtitle">Tanvi Home Foods</p>
        <div class="about-content">
          <p>Tanvi Home Foods is a family-run homemade food brand born from a love for traditional Indian cooking. We started in our own kitchen, making pickles and snacks the way our mothers and grandmothers did—with patience, care, and the finest natural ingredients.</p>
          <p>Today we bring you the same authentic taste: tangy pickles, nutty laddus, and crispy snacks—all made in small batches, without preservatives. Every jar and pack is prepared with love and delivered to your door so you can enjoy the taste of home, wherever you are.</p>
        </div>
      </div>
    </section>

    <!-- 7. Contact / Footer -->
    <footer id="contact" class="site-footer">
      <div class="container">
        <h2 class="footer-brand">Tanvi Home Foods</h2>
        <p class="footer-tagline">Authentic Homemade Pickles & Healthy Snacks</p>
        <div class="footer-grid">
          <div class="footer-block">
            <span class="footer-label">📞 Contact</span>
            <a href="tel:+<?php echo htmlspecialchars($wa); ?>">9010053022</a>
          </div>
          <div class="footer-block">
            <span class="footer-label">📍 Location</span>
            <p>We deliver locally and across regions. Message us for details.</p>
          </div>
        </div>
        <div class="footer-actions">
          <a href="https://wa.me/<?php echo $wa; ?>" class="btn btn-whatsapp" target="_blank" rel="noopener">Order on WhatsApp</a>
          <a href="https://instagram.com/tanvihomefoods" class="btn btn-instagram" target="_blank" rel="noopener">Instagram</a>
        </div>
        <p class="footer-copy">Made with love · No preservatives · Traditional recipes</p>
      </div>
    </footer>
  </main>

  <!-- Sticky WhatsApp -->
  <a href="https://wa.me/<?php echo $wa; ?>" class="sticky-whatsapp" target="_blank" rel="noopener" aria-label="Order on WhatsApp">
    <span class="sticky-wa-icon" aria-hidden="true">💬</span>
    <span class="sticky-wa-text">Order</span>
  </a>

  <!-- Cart drawer -->
  <div class="cart-overlay" id="cart-overlay" aria-hidden="true"></div>
  <aside class="cart-drawer" id="cart-drawer" aria-label="Shopping cart">
    <div class="cart-drawer-header">
      <h2 class="cart-drawer-title">Your Order</h2>
      <button type="button" class="cart-drawer-close" id="cart-close" aria-label="Close cart">&times;</button>
    </div>
    <div class="cart-drawer-body">
      <div class="cart-empty" id="cart-empty">
        <p>Your cart is empty. Add products from the gallery above.</p>
      </div>
      <ul class="cart-list" id="cart-list"></ul>
    </div>
    <div class="cart-drawer-footer" id="cart-footer" hidden>
      <form action="send_order.php" method="post" id="cart-form">
        <div class="cart-total" id="cart-total">Total: ₹0</div>
        <div id="cart-form-inputs"></div>
        <button type="submit" class="btn btn-primary btn-cart-whatsapp">Send to WhatsApp</button>
      </form>
    </div>
  </aside>

  <script src="script.js"></script>
</body>
</html>
