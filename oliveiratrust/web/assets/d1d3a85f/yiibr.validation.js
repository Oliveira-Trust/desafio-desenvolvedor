/**
 * yiibr validation module.
 *
 * This JavaScript module provides the validation methods for the built-in validators.
 *
 * @link https://github.com/yiibr/yii2-br-validator
 * @license https://github.com/yiibr/yii2-br-validator/blob/master/LICENSE
 * @author Wanderson Bragança <wanderson.wbc@gmail.com>
 */
 var yiibr = (typeof yiibr == "undefined" || !yiibr)? {} : yiibr;

yiibr.validation = (function($) {
    var pub = {
        isEmpty: function(value) {
            return value === null || value === undefined || value == [] || value === '';
        },
        addMessage: function(messages, message, value) {
            messages.push(message.replace(/\{value\}/g, value));
        },
        isAllCharEquals: function(string) {
            var c = string.charAt(0);
            for (var i in string) {
                if (c != string.charAt(i)) {
                    return false;
                }
            }
            return true;
        },
        cpf: function(value, messages, options) {
            if (options.skipOnEmpty && pub.isEmpty(value)) {
                return;
            }
            String.prototype.repeat = function(num) {
                return new Array(isNaN(num) ? 1 : ++num).join(this);
            };

            var valid = true;
            var cpf = value.replace(/[^0-9_]/g, "");
            if (cpf.length != 11) {
                valid = false;
            } else {
                for (var x = 0; x < 10; x++) {
                    if (cpf === x.toString().repeat(11)) {
                        valid = false;
                    }
                }
                if (valid) {
                    var c = cpf.substr(0, 9);
                    var dv = cpf.substr(9, 2);
                    var d1 = 0;
                    for (i = 0; i < 9; i++) {
                        d1 += c.charAt(i) * (10 - i);
                    }
                    if (d1 == 0) {
                        valid = false;
                    } else {
                        d1 = 11 - (d1 % 11);
                        if (d1 > 9) d1 = 0;
                        if (dv.charAt(0) != d1) {
                            valid = false;
                        } else {
                            d1 *= 2;
                            for (i = 0; i < 9; i++) {
                                d1 += c.charAt(i) * (11 - i);
                            }
                            d1 = 11 - (d1 % 11);
                            if (d1 > 9) d1 = 0;
                            if (dv.charAt(1) != d1) {
                                valid = false;
                            }
                        }
                    }
                }
            }
            if (!valid) {
                pub.addMessage(messages, options.message, value);
            }
        },
        cnpj: function(value, messages, options) {
            if (options.skipOnEmpty && pub.isEmpty(value)) {
                return;
            }

            String.prototype.repeat = function(num) {
                return new Array(isNaN(num) ? 1 : ++num).join(this);
            };

            var valid = true;
            var cnpj = value.replace(/[^\d]+/g, '');

            if (cnpj.length != 14) {
                valid = false;
            } else if (pub.isAllCharEquals(cnpj)) {
                valid = false;
            } else {
                size = cnpj.length - 2;
                numbers = cnpj.substring(0, size);
                digits = cnpj.substring(size);
                sum = 0;
                pos = size - 7;
                for (i = size; i >= 1; i--) {
                    sum += numbers.charAt(size - i) * pos--;
                    if (pos < 2) {
                        pos = 9;
                    }
                }
                result = sum % 11 < 2 ? 0 : 11 - sum % 11;
                if (result != digits.charAt(0)) {
                    valid = false;
                }

                size = size + 1;
                numbers = cnpj.substring(0, size);
                sum = 0;
                pos = size - 7;
                for (i = size; i >= 1; i--) {
                    sum += numbers.charAt(size - i) * pos--;
                    if (pos < 2) {
                        pos = 9;
                    }
                }
                result = sum % 11 < 2 ? 0 : 11 - sum % 11;

                if (result != digits.charAt(1)) {
                    valid = false;
                }
            }

            if (!valid) {
                pub.addMessage(messages, options.message, value);
            }
        },
        cei: function(value, messages, options) {
            if (options.skipOnEmpty && pub.isEmpty(value)) {
                return;
            }

            var cei = value.replace(/[^0-9_]/g, '').split('');
            var valid = cei.length == 12;

            if (valid) {
                var sum = (7 * cei[0]) + (4 * cei[1]) + (1 * cei[2]) + (8 * cei[3]) + (5 * cei[4]) + (2 * cei[5]) +
                          (1 * cei[6]) + (6 * cei[7]) + (3 * cei[8]) + (7 * cei[9]) + (4 * cei[10]);

                var sumString = String(sum),
                    unidade = parseInt(sumString.substr(-1, 1)),
                    dezena = parseInt(sumString.substr(-2, 1)),
                    digitoVerificador = (10 - (dezena + unidade));

                valid = parseInt(cei[11]) == digitoVerificador;
            }

            if (!valid) {
                pub.addMessage(messages, options.message, value);
            }
        }
    };
    return pub;
})(jQuery);
