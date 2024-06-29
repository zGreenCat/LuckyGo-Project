    const totalElement = document.getElementById('total');
    const luckCheckbox = document.getElementById('luck');
    const numberCircles = document.querySelectorAll('.number-circle');

    luckCheckbox.addEventListener('change', function () {
        updateTotal();
    });

    numberCircles.forEach(function (circle) {
        circle.addEventListener('click', function () {
            //Guardamos los numeros seleccionados de la clase .number-circle.selected en una cosntante
            const selectedCircles = document.querySelectorAll('.number-circle.selected');
            if (this.classList.contains('selected')) {
                this.classList.remove('selected');
            } else if (selectedCircles.length < 5) {
                this.classList.add('selected');
            } else {
                Swal.fire({
                    title: 'Sigue las instrucciones',
                    html: '<div>Solo puedes seleccionar 5 números para jugar.',
                    icon: 'error',
                    confirmButtonColor: 'f56558',
                    confirmButtonText: 'Entendido'
                })
            }
    
        });
    });

    function updateTotal() {
        let total = 2000;
        if (luckCheckbox.checked) {
            total += 1000;
        }
        totalElement.textContent = '$' + total.toLocaleString();
        
    }