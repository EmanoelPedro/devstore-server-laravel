let form = document.forms['create-category'];
let url = form.getAttribute('action');

form.addEventListener('submit', function (event) {
    event.preventDefault();
    let formData = new FormData(form);
    let data = {};

    for (let key of formData.keys()) {
        data[key] = formData.get(key);
    }
    fetch(url, {
        method: form.getAttribute('method'),
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            popupMessage(data.message, data.type);
        })
        .catch((error) => {
            popupMessage('Error saving category', 'error');
        });
});
