/**
 * FormValidation (https://formvalidation.io)
 * The best validation library for JavaScript
 * (c) 2013 - 2020 Nguyen Huu Phuoc <me@phuoc.ng>
 */

import { Localization, ValidateInput, ValidateOptions, ValidateResult } from '../core/Core';

export default function mac() {
    return {
        /**
         * Return true if the input value is a MAC address.
         */
        validate(input: ValidateInput<ValidateOptions, Localization>): ValidateResult {
            return {
                valid: (input.value === '') ||
                        /^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/.test(input.value) ||
                        /^([0-9A-Fa-f]{4}\.){2}([0-9A-Fa-f]{4})$/.test(input.value),
            };
        },
    };
}
