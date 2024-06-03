    const totalElement = document.getElementById('total');
    const tendresuerteCheckbox = document.getElementById('tendresuerte');
    const numberCircles = document.querySelectorAll('.number-circle');

    tendresuerteCheckbox.addEventListener('change', function () {
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
                alert('Solo puedes seleccionar un máximo de 5 números.');
            }
    
        });
    });

    function updateTotal() {
        let total = 2000;
        if (tendresuerteCheckbox.checked) {
            total += 1000;
        }
        totalElement.textContent = '$' + total.toLocaleString();
        
    }


    


    

    