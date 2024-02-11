let addToCardBtn = document.querySelectorAll('.add-to-cart');

function ButtonItemHandler(response) {
    if (typeof response === 'string') {
        let data = JSON.parse(response);
        let button = document.querySelector('.add-to-cart');
        let buttonAdded = document.querySelector('.remove-from-cart');
        if (data.status === 'success') {
            button.classList.add('hidden');
            buttonAdded.classList.remove('hidden');
        }
    }
}

addToCardBtn.forEach(function(btn){
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        let productId = this.getAttribute('data-product-id');
        let quantity = this.getAttribute('data-product-quantity');
        addToCart(productId, quantity, ButtonItemHandler);
    });
    });
