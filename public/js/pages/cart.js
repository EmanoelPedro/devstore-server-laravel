let incrementToCartBtn = document.querySelectorAll('.increment-to-cart');
let decrementFromCartBtn = document.querySelectorAll('.decrement-from-cart');
let removeFromCartBtn = document.querySelectorAll('.remove-from-cart');


function removeItemFromCart(productId) {
    let Item = document.querySelector('.items-box').querySelector('div[data-product-id="'+productId+'"]');
    Item.remove();
    }
function inputItemHandler(response) {
    if (typeof response === 'string') {
        let data = JSON.parse(response);
        let input = document.querySelector('input[data-product-id="'+data.product_id+'"]');
        if (data.status === 'success') {
            input.value = data.product_quantity;
        }
        if (data.product_quantity === 0) {
            removeItemFromCart(data.product_id);
        }
    }
}

incrementToCartBtn.forEach(function(btn){
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        let productId = this.getAttribute('data-product-id');
        let quantity = this.getAttribute('data-product-quantity');
        addToCart(productId, quantity, inputItemHandler);
    });
});

decrementFromCartBtn.forEach(function(btn){
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        let productId = this.getAttribute('data-product-id');
        let quantity = this.getAttribute('data-product-quantity');
         removeFromCart(productId, quantity, inputItemHandler);
    });
});

removeFromCartBtn.forEach(function(btn){
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        let productId = this.getAttribute('data-product-id');
        let quantity = document.querySelector('input[data-product-id="'+productId+'"]').value;
        removeFromCart(productId, quantity);
        removeItemFromCart(productId);
    });
});


