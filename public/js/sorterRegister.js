
function selectNumber2(element) {
    element.classList.toggle('selected');
    
    // Obtener el formulario correspondiente
    let form2 = document.getElementById('regForm2');
    const selectedNumbersInput2 = document.getElementById('selectedNumbers2');
    
    // Obtener los números seleccionados
    let selectedNumbers2 = form2.querySelectorAll('.number-square2.selected');
    let numbers2 = Array.from(selectedNumbers2).map(el => el.getAttribute('data-number2'));
    
    // Actualizar el valor del input hidden
    selectedNumbersInput2.value = numbers2.join('-');
  }



function selectNumber(element) {
    element.classList.toggle('selected');
    
    // Obtener el formulario correspondiente
    let form = element.closest('form');
    let selectedNumbersInput = form.querySelector('input[name="selectedNumbers"]');
    
    // Obtener los números seleccionados
    let selectedNumbers = form.querySelectorAll('.number-square.selected');
    let numbers = Array.from(selectedNumbers).map(el => el.getAttribute('data-number'));
    
    // Actualizar el valor del input hidden
    selectedNumbersInput.value = numbers.join('-');
  }
  function showForm(sunday,cant_luck) {
       // Muestra el formulario de edición
       if(cant_luck > 0){
            document.getElementById('editFormContainer').classList.remove('hidden');
            document.getElementById('sundayInput1').value = sunday;
       }else {
            document.getElementById('editFormContainer2').classList.remove('hidden');
            document.getElementById('sundayInput2').value = sunday;
       }
        
        
        // Coloca el valor de 'sunday' en un input hidden del formulario
        
        
        // Guardar el valor de 'sunday' para usarlo al enviar el formulario
        document.querySelectorAll('.form-wrapper form').forEach(form => {
            form.setAttribute('data-sunday', sunday);
    });
  }

  function cancelForm() {
      // Ocultar el formulario
      const formContainer = document.getElementById('editFormContainer');
      formContainer.classList.add('hidden');
      const formContainer2 = document.getElementById('editFormContainer2');
      formContainer2.classList.add('hidden');
      // Ocultar el overlay
      document.getElementById('overlay').style.display = 'none';
      document.getElementById('overlay2').style.display2 = 'none';
  }

  function submitForm() {
    const form = document.getElementById('regForm1');
    const form2 = document.getElementById('regForm2');
    const selectedNumbers2 = form2.querySelector('input[name="selectedNumbers2"]').value;
    const selectedNumbers = form.querySelector('input[name="selectedNumbers"]').value;
    const sunday = form.getAttribute('data-sunday');
    const dataToSend = {
        selectedNumbers: selectedNumbers,
        sunday: sunday,
        selectedNumbers2: selectedNumbers2
    };
    fetch('/your-endpoint', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(dataToSend)
    })
    .then(response => response.json())
    .then(data => {
        // Handle the response data here
        console.log(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}