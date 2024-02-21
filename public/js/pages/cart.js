let incrementToCartBtn = document.querySelectorAll('.increment-to-cart');
let decrementFromCartBtn = document.querySelectorAll('.decrement-from-cart');
let removeFromCartBtn = document.querySelectorAll('.remove-from-cart');


function removeItemFromCart(productId) {
    let Item = document.querySelector('.items-box').querySelector('div[data-product-id="' + productId + '"]');
    let ItemsBox = document.querySelector('.items-box');
    Item.remove();
    document.querySelector('.cart-icon-products-quantity').innerHTML = ItemsBox.children.length;

    if (ItemsBox.children.length === 0) {
        document.querySelector('.cart-no-items-box').classList.remove('hidden');
        document.querySelector('.cart-total-value-box').classList.add('hidden');
        if (document.querySelector('.cart-icon-products')) {
            document.querySelector('.cart-icon-products-quantity').remove();
        }
    }
}

function inputItemHandler(response) {
    if (typeof response === 'string') {
        let data = JSON.parse(response);
        let input = document.querySelector('input[data-product-id="' + data.product_id + '"]');
        let ItemTotal = document.querySelector('.item-total-price[data-product-id="' + data.product_id + '"]');
        let cartTotal = document.querySelector('.cart-total-price');
        if (data.status === 'success') {
            input.value = data.product_quantity;
            cartTotal.innerHTML = data.cart_total_value;
            ItemTotal.innerHTML = data.product_quantity * data.product_price;
        }
        if (data.product_quantity === 0) {
            removeItemFromCart(data.product_id);
        }
    }
}

incrementToCartBtn.forEach(function (btn) {
    btn.addEventListener('click', function (e) {
        e.preventDefault();
        let productId = this.getAttribute('data-product-id');
        let quantity = this.getAttribute('data-product-quantity');
        addToCart(productId, quantity, inputItemHandler);
    });
});

decrementFromCartBtn.forEach(function (btn) {
    btn.addEventListener('click', function (e) {
        e.preventDefault();
        let productId = this.getAttribute('data-product-id');
        let quantity = this.getAttribute('data-product-quantity');
        removeFromCart(productId, quantity, inputItemHandler);
    });
});

removeFromCartBtn.forEach(function (btn) {
    btn.addEventListener('click', function (e) {
        e.preventDefault();
        let productId = this.getAttribute('data-product-id');
        let quantity = document.querySelector('input[data-product-id="' + productId + '"]').value;
        removeFromCart(productId, quantity);
        removeItemFromCart(productId);
    });
});


