let categoriesList = document.querySelector('table tbody');
let categoryLine = categoriesList.querySelectorAll('tr');

categoryLine.forEach(function (line) {
    line.querySelector('.delete').addEventListener('click', function (e) {
        e.preventDefault();
        let categoryId = line.querySelector('input[name=' + 'id'+']').value;
        let url = '/categories';
        let data = {
            'id': categoryId
        };

        fetch(url, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    line.remove();
                }
                popupMessage(data.message, data.status);
            })
            .catch((error) => {
                console.log(error);
                popupMessage('Error deleting category', 'error');
            });
    });
});
