let deleteProductButtons = document.querySelectorAll(".delete-product-btn");
let modalToDeleteProduct = document.querySelector('#confim-del-product-modal');
let modalCancelButton = modalToDeleteProduct.querySelector('.del-product-modal-btn-cancel');
let modalConfirmButton = modalToDeleteProduct.querySelector('.del-product-modal-btn-confirm');

modalCancelButton.addEventListener('click', function (e) {
    modalToDeleteProduct.removeAttribute('data-product-id');
    modalToDeleteProduct.classList.add('hidden');
});

 modalConfirmButton.addEventListener('click', function(e){
     e.preventDefault();
    let productId = modalToDeleteProduct.getAttribute('data-product-id');
    deleteProductRequest(productId).then((response) => {
        popupMessage(response.data.message, 'success');
    }).catch((error)=>{
       if (error.response) {
           console.log(error.response.data);
           console.error(error.response.status);
           console.error(error.response.headers);
       } else {
           console.log('Woops... Algo deu errado, tente novamente em alguns minutos');
       }
    });
});

    deleteProductButtons.forEach(function (element) {
        element.addEventListener('click', function(ev){
        ev.preventDefault();
        modalToDeleteProduct.setAttribute('data-product-id', element.getAttribute('data-product-id'));
        modalToDeleteProduct.classList.remove('hidden');
        })
});

function deleteProductRequest(productId) {
    let domain = location.hostname;
       return axios.delete(`/products/delete/${productId}`, {
           baseURL: '/',
           headers: {
               'Accept': 'application/json',
               'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").value,
           }
       });
}
