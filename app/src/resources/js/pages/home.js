const dashboardMethods = {
    setUpDomElements () {
        Inputmask('currency', { rightAlign: false, radixPoint: ',' }).mask($('.currency-converter-form-origin-input'));
        Inputmask('currency', { rightAlign: false, radixPoint: ',' }).mask($('.currency-converter-form-destination-input'));
    },

    startDomEventListeners () {
        $(document).on('submit', '.currency-converter-form', async event => {
            try {
                event.preventDefault();

                this.showResult(await this.convertCurrency());
            } catch (error) {
                swal.fire('Atenção', error.response.data.errors[0], 'warning');
            }
        });
    },

    async convertCurrency () {
        const { data: pricing } = await axios.get('/currency-exchange/convert', {
            params: {
                originValue: $('.currency-converter-form-origin-input').val(),
                destinationCurrency: $('.currency-converter-form-destination-currency').val(),
                paymentMethod: $('.currency-converter-form-payment-method').val()
            }
        });

        return pricing;
    },

    showResult (pricing) {
        $('.currency-converter-form-destination-input').val(pricing.convertedValue);

        $('.currency-converter-result-list-item-origin-currency').text(pricing.originCurrency);
        $('.currency-converter-result-list-item-destination-currency').text(pricing.destinationCurrency);
        $('.currency-converter-result-list-item-origin-currency-value').text(pricing.originCurrencyValue);
        $('.currency-converter-result-list-item-payment-method').text(pricing.paymentMethod);

        $('.currency-converter-result-list-item-destination-currency-base-value').text(pricing.destinationCurrencyBaseValue);
        $('.currency-converter-result-list-item-destination-currency-base-value').siblings('strong').find('span').text(pricing.destinationCurrency)

        $('.currency-converter-result-list-item-converted-value').text(pricing.convertedValue);
        $('.currency-converter-result-list-item-converted-value').siblings('strong').find('span').text(pricing.destinationCurrency);

        $('.currency-converter-result-list-item-payment-tax').text(pricing.paymentTax);
        $('.currency-converter-result-list-item-conversion-tax').text(pricing.conversionTax);
        $('.currency-converter-result-list-item-origin-currency-net-value').text(pricing.originCurrencyNetValue);
    }
};

$(document).ready(() => {
    dashboardMethods.setUpDomElements();
    dashboardMethods.startDomEventListeners();
});
