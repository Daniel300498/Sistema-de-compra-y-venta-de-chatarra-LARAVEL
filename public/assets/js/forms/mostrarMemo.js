document.addEventListener('DOMContentLoaded', function () {
    const modals = document.querySelectorAll('.modal'); 
    
    modals.forEach(modal => {
        const modalId = modal.getAttribute('id').split('-')[1]; 
        const tipoBajaSelect = document.getElementById(`tipo_baja_${modalId}`);
        const memorandumContainer = document.getElementById(`memorandum-container_${modalId}`);
        const memorandumInput = document.getElementById(`memorandum_${modalId}`);

        if (tipoBajaSelect) {
            tipoBajaSelect.addEventListener('change', function () {
                const selectedValue = this.value;
                 if (selectedValue === 'AGRADECIMIENTO DE SERVICIOS' || selectedValue === 'ACEPTACION DE RENUNCIA' || selectedValue === 'RETIRO POR ABANDONO' || selectedValue === 'TERMINACION DE CONTRATO') {
                    memorandumContainer.style.display = 'block';
                    memorandumInput.setAttribute('required', 'required');
                } else {
                    memorandumContainer.style.display = 'none';
                    memorandumInput.removeAttribute('required');
                }
            });
        }
    });
});
