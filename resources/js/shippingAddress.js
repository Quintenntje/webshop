function initShippingAddress() {
    const addressSelection = document.querySelectorAll('input[name="address_selection"]');
    const addressFields = document.getElementById('addressFields');
    const selectedAddressId = document.getElementById('selected_address_id');
    
    if (!addressSelection.length || !addressFields || !selectedAddressId) return;
    
    const addressInputs = addressFields.querySelectorAll('input[required]');
    
    function toggleAddressFields() {
        const selected = document.querySelector('input[name="address_selection"]:checked');
        
        if (!selected) return;
        
        if (selected.value === 'existing') {
            addressFields.style.display = 'none';
            addressInputs.forEach(input => input.removeAttribute('required'));
            const addressId = selected.getAttribute('data-address-id');
            if (selectedAddressId) {
                selectedAddressId.value = addressId || '';
            }
        } else {
            addressFields.style.display = 'block';
            addressInputs.forEach(input => input.setAttribute('required', 'required'));
            if (selectedAddressId) {
                selectedAddressId.value = '';
            }
        }
    }
    
    addressSelection.forEach(radio => {
        radio.addEventListener('change', toggleAddressFields);
    });
    
    toggleAddressFields();
}

export default initShippingAddress;

