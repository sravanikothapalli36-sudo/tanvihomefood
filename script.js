// Cart state: { productId: quantity }
var cart = {};

var cartCountEl = document.getElementById('cart-count');
var cartListEl = document.getElementById('cart-list');
var cartEmptyEl = document.getElementById('cart-empty');
var cartFooterEl = document.getElementById('cart-footer');
var cartTotalEl = document.getElementById('cart-total');
var cartFormEl = document.getElementById('cart-form');
var cartFormInputsEl = document.getElementById('cart-form-inputs');
var cartDrawerEl = document.getElementById('cart-drawer');
var cartOverlayEl = document.getElementById('cart-overlay');

function getCartTotalItems() {
  var n = 0;
  for (var id in cart) { n += cart[id] | 0; }
  return n;
}

function getCartTotalPrice() {
  var total = 0;
  document.querySelectorAll('.product-card').forEach(function (card) {
    var id = card.getAttribute('data-product-id');
    var price = parseInt(card.getAttribute('data-price'), 10) || 0;
    var qty = cart[id] | 0;
    total += price * qty;
  });
  return total;
}

function renderCart() {
  if (!cartListEl) return;

  cartListEl.innerHTML = '';
  var totalPrice = 0;

  for (var id in cart) {
    var qty = cart[id] | 0;
    if (qty <= 0) continue;

    var card = document.querySelector('.product-card[data-product-id="' + id + '"]');
    if (!card) continue;

    var name = card.getAttribute('data-name') || 'Item';
    var price = parseInt(card.getAttribute('data-price'), 10) || 0;
    var lineTotal = price * qty;
    totalPrice += lineTotal;

    var li = document.createElement('li');
    li.className = 'cart-item';
    li.innerHTML =
      '<div class="cart-item-info">' +
        '<span class="cart-item-name">' + escapeHtml(name) + '</span>' +
        '<span class="cart-item-price">₹' + formatNum(price) + ' × ' + qty + ' = ₹' + formatNum(lineTotal) + '</span>' +
      '</div>' +
      '<div class="cart-item-actions">' +
        '<button type="button" class="cart-qty-btn" data-id="' + id + '" data-delta="-1" aria-label="Decrease">−</button>' +
        '<span class="cart-item-qty">' + qty + '</span>' +
        '<button type="button" class="cart-qty-btn" data-id="' + id + '" data-delta="1" aria-label="Increase">+</button>' +
        '<button type="button" class="cart-remove" data-id="' + id + '" aria-label="Remove">Remove</button>' +
      '</div>';
    cartListEl.appendChild(li);
  }

  var totalItems = getCartTotalItems();
  if (cartCountEl) cartCountEl.textContent = totalItems;
  if (cartEmptyEl) cartEmptyEl.hidden = totalItems > 0;
  if (cartFooterEl) cartFooterEl.hidden = totalItems === 0;
  if (cartTotalEl) cartTotalEl.textContent = 'Total: ₹' + formatNum(totalPrice);

  // Hidden inputs for form submit
  if (cartFormInputsEl) {
    cartFormInputsEl.innerHTML = '';
    for (var pid in cart) {
      var q = cart[pid] | 0;
      if (q <= 0) continue;
      var input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'cart[' + pid + ']';
      input.value = q;
      cartFormInputsEl.appendChild(input);
    }
  }
}

function escapeHtml(s) {
  var div = document.createElement('div');
  div.textContent = s;
  return div.innerHTML;
}

function formatNum(n) {
  return n.toLocaleString('en-IN');
}

function openCart() {
  if (cartDrawerEl) cartDrawerEl.classList.add('cart-drawer-open');
  if (cartOverlayEl) cartOverlayEl.classList.add('cart-overlay-open');
  document.body.classList.add('cart-open');
}

function closeCart() {
  if (cartDrawerEl) cartDrawerEl.classList.remove('cart-drawer-open');
  if (cartOverlayEl) cartOverlayEl.classList.remove('cart-overlay-open');
  document.body.classList.remove('cart-open');
}

function addToCart(productId) {
  productId = String(productId);
  cart[productId] = (cart[productId] | 0) + 1;
  renderCart();
  openCart();
}

// Add to cart buttons
document.querySelectorAll('.btn-add-cart').forEach(function (btn) {
  btn.addEventListener('click', function () {
    var card = btn.closest('.product-card');
    if (!card) return;
    var id = card.getAttribute('data-product-id');
    if (id) addToCart(id);
  });
});

// Cart list: +/- and remove
document.addEventListener('click', function (e) {
  var qtyBtn = e.target.closest('.cart-qty-btn');
  if (qtyBtn) {
    var id = qtyBtn.getAttribute('data-id');
    var delta = parseInt(qtyBtn.getAttribute('data-delta'), 10) || 0;
    cart[id] = Math.max(0, (cart[id] | 0) + delta);
    if (cart[id] === 0) delete cart[id];
    renderCart();
    return;
  }
  var removeBtn = e.target.closest('.cart-remove');
  if (removeBtn) {
    var id = removeBtn.getAttribute('data-id');
    delete cart[id];
    renderCart();
  }
});

// Cart open/close
document.querySelectorAll('.cart-toggle').forEach(function (btn) {
  if (btn) btn.addEventListener('click', openCart);
});
if (document.getElementById('cart-close')) {
  document.getElementById('cart-close').addEventListener('click', closeCart);
}
if (cartOverlayEl) {
  cartOverlayEl.addEventListener('click', closeCart);
}

// Prevent submit if cart empty
if (cartFormEl) {
  cartFormEl.addEventListener('submit', function (e) {
    if (getCartTotalItems() === 0) {
      e.preventDefault();
      return;
    }
  });
}

// Mobile menu toggle
(function () {
  var toggle = document.querySelector('.menu-toggle');
  var nav = document.querySelector('.nav');
  if (!toggle || !nav) return;

  toggle.addEventListener('click', function () {
    nav.classList.toggle('is-open');
    var isOpen = nav.classList.contains('is-open');
    toggle.setAttribute('aria-label', isOpen ? 'Close menu' : 'Open menu');
  });

  nav.querySelectorAll('a').forEach(function (link) {
    link.addEventListener('click', function () {
      nav.classList.remove('is-open');
    });
  });
})();

// Initial render
renderCart();
