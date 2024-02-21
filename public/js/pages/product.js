let addToCardBtn = document.querySelectorAll('.add-to-cart');
let removeFromCardBtn = document.querySelectorAll('.remove-from-cart');
let incrementToCartBtn = document.querySelectorAll('.increment-to-cart');
let decrementFromCartBtn = document.querySelectorAll('.decrement-from-cart');
let InputItemQuantity = 1;

function buttonAddToCartHandler(response) {
    if (typeof response === 'string') {
        let data = JSON.parse(response);
        let button = document.querySelector('.add-to-cart[data-product-id="' + data.product_id + '"]');
        let buttonAdded = document.querySelector('.remove-from-cart[data-product-id="' + data.product_id + '"');
        if (data.status === 'success') {
            if (document.querySelector('.cart-icon-products-quantity').classList.contains('hidden')) {
                document.querySelector('.cart-icon-products-quantity').classList.remove('hidden');
            }
            document.querySelector('.cart-icon-products-quantity').innerHTML = data.cart_total_items;
            button.classList.add('hidden');
            buttonAdded.classList.remove('hidden');
        }
    }
}
function buttonRemoveToCartHandler(response) {
    if (typeof response === 'string') {
        let data = JSON.parse(response);
        let button = document.querySelector('.add-to-cart[data-product-id="' + data.product_id + '"]');
        let buttonAdded = document.querySelector('.remove-from-cart[data-product-id="' + data.product_id + '"');
        if (data.status === 'success') {
            if (data.cart_total_items === 0) {
                document.querySelector('.cart-icon-products-quantity').classList.add('hidden');
            }
            document.querySelector('.cart-icon-products-quantity').innerHTML = data.cart_total_items;
            button.classList.remove('hidden');
            buttonAdded.classList.add('hidden');
        }
    }
}


addToCardBtn.forEach(function (btn) {
    btn.addEventListener('click', function (e) {
        e.preventDefault();
        let productId = this.getAttribute('data-product-id');
        let quantity = InputItemQuantity;
        if (quantity > 0) {
        addToCart(productId, quantity, buttonAddToCartHandler);
        }
    });
});

removeFromCardBtn.forEach(function (btn) {
    btn.addEventListener('click', function (e) {
        e.preventDefault();
        let productId = this.getAttribute('data-product-id');
        let quantity = this.getAttribute('data-product-quantity');
        removeFromCart(productId, quantity, buttonRemoveToCartHandler);
    });
});
//
// incrementToCartBtn.forEach(function (btn) {
//     btn.addEventListener('click', function (e) {
//         e.preventDefault();
//         InputItemQuantity.value = parseInt(InputItemQuantity.value) + 1;
//     });
// });
//
// decrementFromCartBtn.forEach(function (btn) {
//     btn.addEventListener('click', function (e) {
//         e.preventDefault();
//         if (parseInt(InputItemQuantity.value) > 1) {
//         InputItemQuantity.value = parseInt(InputItemQuantity.value) - 1;
//         }
//     });
// });


