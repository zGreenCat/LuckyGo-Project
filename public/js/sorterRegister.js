




function selectNumber2(element) {
    let form2 = element.closest('form');
    let selectedNumbersInput2 = form2.querySelector('input[name="selectedNumbers2"]');
    let selectedNumbers2 = form2.querySelectorAll('.number-square2.selected');
    if(selectedNumbers2.length == 5 && !element.classList.contains('selected')){
        Swal.fire({
            title: 'Sigue las instrucciones',
            html: '<div>¡La lotería se gana solo con 5 números!',
            icon: 'error',
            confirmButtonColor: 'f56558',
            confirmButtonText: 'Entendido'
        })
        return;
    }
    element.classList.toggle('selected');
    form2 = element.closest('form');
    selectedNumbersInput2 = form2.querySelector('input[name="selectedNumbers2"]');
    selectedNumbers2 = form2.querySelectorAll('.number-square2.selected');
    let numbers2 = Array.from(selectedNumbers2).map(el => el.getAttribute('data-number2'));
    selectedNumbersInput2.value = numbers2.join('-');
  }



function selectNumber(element) {
    let form = element.closest('form');
    let selectedNumbersInput = form.querySelector('input[name="selectedNumbers1"]');
    let selectedNumbers = form.querySelectorAll('.number-square.selected');
    if(selectedNumbers.length == 5 && !element.classList.contains('selected')){
        Swal.fire({
            title: 'Sigue las instrucciones',
            html: '<div>¡La lotería se gana solo con 5 números!',
            icon: 'error',
            confirmButtonColor: 'f56558',
            confirmButtonText: 'Entendido'
        })
        return;
    }
    element.classList.toggle('selected');
    form = element.closest('form');
    selectedNumbersInput = form.querySelector('input[name="selectedNumbers1"]');
    selectedNumbers = form.querySelectorAll('.number-square.selected');
    let numbers = Array.from(selectedNumbers).map(el => el.getAttribute('data-number'));
    selectedNumbersInput.value = numbers.join('-');
    
  }
  function showForm(raffle) {
    if (typeof raffle === 'string') {
        raffle = JSON.parse(raffle);
    }
    sunday = raffle.sunday;
    cant_luck = raffle.cant_tickets_luck
    console.log(sunday);
    if(cant_luck > 0){
        const detailsTable = document.querySelector('#editFormContainer table');
        detailsTable.rows[1].cells[0].innerText = raffle.formatted_sunday;
        detailsTable.rows[1].cells[1].innerText = raffle.cant_tickets + raffle.cant_tickets_luck;
        detailsTable.rows[1].cells[2].innerText = `$${((raffle.cant_tickets + raffle.cant_tickets_luck) * 2000).toLocaleString("es-ES")}`;
        detailsTable.rows[1].cells[3].innerText = `$${(raffle.cant_tickets_luck * 1000).toLocaleString("es-ES")}`;
        detailsTable.rows[1].cells[4].innerText = `$${((raffle.cant_tickets_luck * 3000) + (raffle.cant_tickets * 2000)).toLocaleString("es-ES")}`;
        document.getElementById('editFormContainer').classList.remove('hidden');
        document.getElementById('sundayInput1').value = sunday;
         
    }else {
        const detailsTable = document.querySelector('#editFormContainer2 table');
        detailsTable.rows[1].cells[0].innerText = raffle.formatted_sunday;
        detailsTable.rows[1].cells[1].innerText = raffle.cant_tickets + raffle.cant_tickets_luck;
        detailsTable.rows[1].cells[2].innerText = `$${((raffle.cant_tickets + raffle.cant_tickets_luck) * 2000).toLocaleString("es-ES")}`;
        detailsTable.rows[1].cells[3].innerText = `$${(raffle.cant_tickets_luck * 1000).toLocaleString("es-ES")}`;
        detailsTable.rows[1].cells[4].innerText = `$${((raffle.cant_tickets_luck * 3000) + (raffle.cant_tickets * 2000)).toLocaleString("es-ES")}`;
        document.getElementById('editFormContainer2').classList.remove('hidden');
        document.getElementById('sundayInput2').value = sunday;
    }
    document.getElementById('overlay').style.display = 'block';
     document.querySelectorAll('.form-wrapper form').forEach(form => {
         form.setAttribute('data-sunday', sunday);
        });
    }

  function cancelForm() {
    document.getElementById('overlay').style.display = 'none';
    const form = document.getElementById('regForm1');
    let selectedNumbers = form.querySelectorAll('.number-square.selected');
    selectedNumbers.forEach(el => el.classList.remove('selected'));
    form.querySelector('input[name="selectedNumbers1"]').value = '0';
    let selectedNumbers2 = form.querySelectorAll('.number-square2.selected');
    selectedNumbers2.forEach(el => el.classList.remove('selected'));
    form.querySelector('input[name="selectedNumbers2"]').value = '0';
    const formContainer = document.getElementById('editFormContainer');
    formContainer.classList.add('hidden');
    const formContainer2 = document.getElementById('editFormContainer2');
    formContainer2.classList.add('hidden');
    document.getElementById('overlay').style.display = 'none';
  }
  function cancelForm2() {
    document.getElementById('overlay').style.display = 'none';
    const form = document.getElementById('regForm2');
    let selectedNumbers = form.querySelectorAll('.number-square.selected');
    selectedNumbers.forEach(el => el.classList.remove('selected'));
    form.querySelector('input[name="selectedNumbers1"]').value = '0';
    const formContainer2 = document.getElementById('editFormContainer2');
    formContainer2.classList.add('hidden');
  }

  function submitForm() {
    const form = document.getElementById('regForm1');
    const sunday = form.getAttribute('data-sunday');
    
    if(form.querySelectorAll('.number-square2.selected').length == 5 && form.querySelectorAll('.number-square.selected').length== 5 ){
        const selectedNumbersInput = document.getElementById('selectedNumbers1');
        const selectedNumbers = Array.from(document.querySelectorAll('.number-square.selected'))
        .map(circle => circle.getAttribute('data-number'));
        selectedNumbersInput.value = selectedNumbers.join('-');
        const selectedNumbersInput2 = document.getElementById('selectedNumbers2');
        const selectedNumbers2 = Array.from(document.querySelectorAll('.number-square2.selected'))
        .map(circle => circle.getAttribute('data-number2'));
        selectedNumbersInput2.value = selectedNumbers2.join('-');
        Swal.fire({
            title: 'Confirmar registro',
            html: '<div>Has seleccionado los números: '+ selectedNumbersInput.value +'<br />Y para tendré suerte: '+selectedNumbersInput2.value+'<br/></div>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, registrar ganadores',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }else{
        Swal.fire({
            title: 'Sigue las instrucciones',
            html: '<div>Por favor selecciona 5 números para continuar.',
            icon: 'error',
            confirmButtonColor: 'f56558',
            confirmButtonText: 'Entendido'
        })
    }
    

}
function submitForm2() {
    const form = document.getElementById('regForm2');
    const sunday = form.getAttribute('data-sunday');
    if(form.querySelectorAll('.number-square.selected').length == 5){
        const selectedNumbersInput = document.getElementById('selectedNumbers1');
        const selectedNumbers = Array.from(document.querySelectorAll('.number-square.selected'))
        .map(circle => circle.getAttribute('data-number'));
        selectedNumbersInput.value = selectedNumbers.join('-');
        Swal.fire({
            title: 'Confirmar registro',
            html: '<div>Has seleccionado los números: '+ selectedNumbersInput.value +'</div>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, registrar ganadores',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }else{
        Swal.fire({
            title: 'Sigue las instrucciones',
            html: '<div>Por favor selecciona 5 números para continuar.',
            icon: 'error',
            confirmButtonColor: 'f56558',
            confirmButtonText: 'Entendido'
        })
    }
    

}

