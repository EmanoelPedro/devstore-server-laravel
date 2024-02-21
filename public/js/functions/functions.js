function CartItensManipulator(productId, quantity, url, render) {
    let isAuthenticated = document.querySelector('meta[name="is-authenticated"]').getAttribute('content');
    if (isAuthenticated !== 'true') {
        window.location.href = '/login';
        return;
    }

    const xhr = new XMLHttpRequest();

// Open a new connection, using the POST request on the URL endpoint
    xhr.open('POST', url, true);
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
    xhr.onload = function (e) {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (typeof render === 'function') {
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
    CartItensManipulator(productId, quantity, url, callback);
}

//
//
// POPUPS
//

function showPopup(popupId, message, options ) {
    let popup = document.getElementById(popupId);
    let trigger = popup.querySelector('button');
    popup.querySelector("div").innerText = message;
    popup.classList.remove('hidden');
    trigger.addEventListener('click', function () {
        popup.classList.add('hidden');
    });
}

function popupMessage(message, type, options = {
    transition: 'transition-opacity',
        duration: 10,
    timing: 'ease-out',
}) {
    switch (type) {
        case 'success':
            showPopup('success-popup', message, options);
            break;
        case 'error':
            showPopup('error-popup', message, options);
            break;
        case 'info':
            showPopup('info-popup', message, options);
            break;
        case 'warning':
            showPopup('warning-popup', message, options);
            break;
        default:
            showPopup('info-popup', message, options);
    }
}
