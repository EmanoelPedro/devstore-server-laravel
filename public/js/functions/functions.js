function CartItensManipulator(productId, quantity, url, render) {
    const xhr = new XMLHttpRequest();

// Open a new connection, using the POST request on the URL endpoint
    xhr.open('POST',url,true);
// Set Content-Type to application/json
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
// Send request with JSON payload
    xhr.send(
        JSON.stringify({
            'product_id': productId,
            'quantity': quantity
        }));
    // Fire On request completes successfully
    xhr.onload = function(e) {
        if (xhr.readyState  === XMLHttpRequest.DONE) {
            if(typeof render === 'function') {
                render(xhr.responseText);
            }
        }
    }
}



function addToCart(productId, quantity, callback) {
    let url = '/products/add-to-cart';
    return CartItensManipulator(productId, quantity, url, callback);
}

function removeFromCart(productId, quantity, callback) {
    let url = '/products/remove-from-cart';
    let response = CartItensManipulator(productId, quantity, url, callback);
    return response;
}

