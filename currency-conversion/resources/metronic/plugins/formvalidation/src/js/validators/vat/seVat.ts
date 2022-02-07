/**
 * FormValidation (https://formvalidation.io)
 * The best validation library for JavaScript
 * (c) 2013 - 2020 Nguyen Huu Phuoc <me@phuoc.ng>
 */

import luhn from '../../algorithms/luhn';

/**
 * Validate Swiss VAT number
 *
 * @returns {ValidateResult}
 */
export default function seVat(value: string) {
    let v = value;
    if (/^SE[0-9]{10}01$/.test(v)) {
        v = v.substr(2);
    }
    if (!/^[0-9]{10}01$/.test(v)) {
        return {
            meta: {},
            valid: false,
        };
    }

    v = v.substr(0, 10);
    return {
        meta: {},
        valid: luhn(v),
    };
}
