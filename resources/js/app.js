import './bootstrap';
import AutoNumeric from 'autonumeric';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function() {
    const currencyInput = document.getElementById('amount');

    if (currencyInput) {

        const autoNumericInstance = new AutoNumeric(currencyInput, {
            digitGroupSeparator: '.',
            decimalCharacter: ',',
            decimalPlaces: 2,
            decimalPlacesShownOnFocus: 2,
            decimalPlacesShownOnBlur: 2,
            currencySymbol: '',
            emptyInputBehavior: 'zero',
            unformatOnSubmit: true
        });

        function validateAndAdjustValue() {
            let value = autoNumericInstance.getNumber();

            const minimumValue = 1000.00;
            const maximumValue = 100000.00;

            if (value === null || isNaN(value)) {
                value = minimumValue;
            } else if (value < minimumValue) {
                value = minimumValue;
            } else if (value > maximumValue) {
                value = maximumValue;
            }

            autoNumericInstance.set(value.toFixed(2));
        }

        currencyInput.addEventListener('blur', validateAndAdjustValue);
    }
});







