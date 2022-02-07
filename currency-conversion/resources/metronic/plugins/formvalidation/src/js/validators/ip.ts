/**
 * FormValidation (https://formvalidation.io)
 * The best validation library for JavaScript
 * (c) 2013 - 2020 Nguyen Huu Phuoc <me@phuoc.ng>
 */

import { Localization, ValidateInput, ValidateOptions, ValidateResult } from '../core/Core';

export interface IpOptions extends ValidateOptions {
    // Enable IPv4 validator, default to true
    ipv4?: boolean;
    // Enable IPv6 validator, default to true
    ipv6?: boolean;
}
export interface IpLocalization extends Localization {
    ip: {
        default: string,
        ipv4: string,
        ipv6: string,
    };
}

export default function ip() {
    return {
        /**
         * Return true if the input value is a IP address.
         */
        validate(input: ValidateInput<IpOptions, IpLocalization>): ValidateResult {
            if (input.value === '') {
                return { valid: true };
            }

            const opts = Object.assign({}, {
                ipv4: true,
                ipv6: true,
            }, input.options);
            /* tslint:disable:max-line-length */
            const ipv4Regex = /^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)(\/([0-9]|[1-2][0-9]|3[0-2]))?$/;
            const ipv6Regex = /^\s*((([0-9A-Fa-f]{1,4}:){7}([0-9A-Fa-f]{1,4}|:))|(([0-9A-Fa-f]{1,4}:){6}(:[0-9A-Fa-f]{1,4}|((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){5}(((:[0-9A-Fa-f]{1,4}){1,2})|:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){4}(((:[0-9A-Fa-f]{1,4}){1,3})|((:[0-9A-Fa-f]{1,4})?:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){3}(((:[0-9A-Fa-f]{1,4}){1,4})|((:[0-9A-Fa-f]{1,4}){0,2}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){2}(((:[0-9A-Fa-f]{1,4}){1,5})|((:[0-9A-Fa-f]{1,4}){0,3}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){1}(((:[0-9A-Fa-f]{1,4}){1,6})|((:[0-9A-Fa-f]{1,4}){0,4}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(:(((:[0-9A-Fa-f]{1,4}){1,7})|((:[0-9A-Fa-f]{1,4}){0,5}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:)))(%.+)?\s*(\/(\d|\d\d|1[0-1]\d|12[0-8]))?$/;
            /* tslint:enable:max-line-length */

            switch (true) {
                case (opts.ipv4 && !opts.ipv6):
                    return {
                        message: input.l10n ? (opts.message || input.l10n.ip.ipv4) : opts.message,
                        valid: ipv4Regex.test(input.value),
                    };

                case (!opts.ipv4 && opts.ipv6):
                    return {
                        message: input.l10n ? (opts.message || input.l10n.ip.ipv6) : opts.message,
                        valid: ipv6Regex.test(input.value),
                    };

                case (opts.ipv4 && opts.ipv6):
                default:
                    return {
                        message: input.l10n ? (opts.message || input.l10n.ip.default) : opts.message,
                        valid: ipv4Regex.test(input.value) || ipv6Regex.test(input.value),
                    };
            }
        },
    };
}
