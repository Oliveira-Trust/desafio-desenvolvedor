<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.currency_converter') }}</title>
    @vite(['resources/css/styles.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0"></script>
</head>
<body>
    <nav class="navbar">
        <div class="language-select">
            <img src="{{ asset('images/flags/en.png') }}" alt="English" class="flag" data-lang="en">
            <img src="{{ asset('images/flags/br.png') }}" alt="Português" class="flag" data-lang="pt_BR">
        </div>
    </nav>
    <div class="main-content" id="main-content">
        <div class="container" id="form-container">
            <h1>{{ __('messages.currency_converter') }}</h1>
            <form id="conversion-form">
                @csrf
                <label for="origin-currency">{{ __('messages.origin_currency') }}</label>
                <input type="text" id="origin-currency" value="BRL" disabled>

                <label for="target-currency">{{ __('messages.target_currency') }}</label>
                <select id="target-currency" required>
                    <option value="" disabled selected>{{ __('messages.select_currency') }}</option>
                    @foreach (\App\Enum\CurrencyEnum::convertable() as $currency)
                        <option value="{{ $currency }}">{{ $currency }}</option>
                    @endforeach
                </select>

                <label for="conversion-value">{{ __('messages.value_for_conversion') }}</label>
                <input type="text" id="conversion-value" min="1000" max="100000" required>

                <label for="payment-method">{{ __('messages.payment_method') }}</label>
                <select id="payment-method" required>
                    <option value="" disabled selected>{{ __('messages.select_payment_method') }}</option>
                    <option value="BANK_BILLET">{{ __('messages.bank_billet') }}</option>
                    <option value="CREDIT_CARD">{{ __('messages.credit_card') }}</option>
                </select>

                <button type="submit" id="convert-button">{{ __('messages.convert') }}</button>
            </form>
        </div>

        <div id="result" class="result">
            <h2><i class="fas fa-calculator"></i>{{ __('messages.conversion_result') }}</h2>
            <div class="result-box" id="conversion-details"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Cleave('#conversion-value', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand',
                delimiter: '.',
                numeralDecimalMark: ','
            });
        });

        function setLanguageCookie(lang) {
            document.cookie = `lang=${lang};path=/;max-age=31536000`;
            location.reload();
        }

        document.querySelectorAll('.flag').forEach(flag => {
            flag.addEventListener('click', function() {
                const lang = this.getAttribute('data-lang');
                setLanguageCookie(lang);
            });
        });

        const paymentMethodTranslations = {
            'BANK_BILLET': '{{ __('messages.bank_billet') }}',
            'CREDIT_CARD': '{{ __('messages.credit_card') }}'
        };

        function formatCurrency(value, currency) {
            return new Intl.NumberFormat(document.documentElement.lang, {
                style: 'currency',
                currency: currency,
                minimumFractionDigits: 2,
                maximumFractionDigits: 4
            }).format(value);
        }

        document.getElementById('conversion-form').addEventListener('submit', async function(event) {
            event.preventDefault();

            const convertButton = document.getElementById('convert-button');
            convertButton.disabled = true;
            convertButton.innerHTML = '<div class="spinner"></div>{{ __('messages.convert') }}';

            const targetCurrency = document.getElementById('target-currency').value;
            const conversionValueRaw = document.getElementById('conversion-value').value;
            const conversionValue = parseFloat(conversionValueRaw.replace(/\./g, '').replace(',', '.')) * 100; // Convert to numeric value
            const paymentMethod = document.getElementById('payment-method').value;

            if (isNaN(conversionValue) || conversionValue < 100000 || conversionValue > 10000000) { // Validate numeric and within range (multiplied by 100)
                alert('{{ __('messages.invalid_conversion_value') }}');
                convertButton.disabled = false;
                convertButton.innerHTML = '{{ __('messages.convert') }}';
                return;
            }

            try {
                const response = await
                    fetch('/api/currency-conversion', {
                        method: 'POST',
                        body: JSON.stringify({
                            origin: 'BRL',
                            target: targetCurrency,
                            conversion_value: conversionValue,
                            payment_method: paymentMethod,
                        }),
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'Accept-Language': document.documentElement.lang // Send the current language as a header
                        }
                    });

                const data = await response.json();

                if (data.data) {
                    const result = data.data;

                    const details = `
                        <p><strong>{{ __('messages.origin_currency') }}</strong> ${result.origin}</p>
                        <p><strong>{{ __('messages.destination_currency') }}</strong> ${result.target}</p>
                        <p><strong>{{ __('messages.payment_method') }}</strong> ${paymentMethodTranslations[result.payment_method]}</p>
                        <p><strong>{{ __('messages.conversion_value') }}</strong> ${formatCurrency(result.conversion_value / 100, 'BRL')}</p>
                        <p><strong>{{ __('messages.payment_tax') }}</strong> ${formatCurrency(result.payment_method_tax / 100, 'BRL')}</p>
                        <p><strong>{{ __('messages.conversion_tax') }}</strong> ${formatCurrency(result.conversion_tax / 100, 'BRL')}</p>
                        <p><strong>{{ __('messages.usable_conversion_value') }}</strong> ${formatCurrency(result.convertable_value / 100, 'BRL')}</p>
                        <p><strong>{{ __('messages.destination_rate') }}</strong> ${formatCurrency(result.convertable_rate / 10000, targetCurrency)}</p>
                        <p><strong>{{ __('messages.converted_value') }}</strong> ${formatCurrency(result.converted_value / 100, targetCurrency)}</p>
                    `;

                    document.getElementById('conversion-details').innerHTML = details;
                    document.getElementById('result').style.display = 'block';
                    document.getElementById('result').style.opacity = '1';

                    document.getElementById('main-content').style.justifyContent = 'space-between';
                    document.getElementById('form-container').style.transform = 'translateX(0)';
                } else {
                    document.getElementById('conversion-details').innerHTML = `<p>{{ __('messages.conversion_error') }}</p>`;
                    document.getElementById('result').style.display = 'block';
                }
            } catch (error) {
                console.error('Error:', error);
            } finally {
                convertButton.disabled = false;
                convertButton.innerHTML = '{{ __('messages.convert') }}';
            }
        });

        document.getElementById('form-container').style.transform = 'translateX(0)';
    </script>
</body>
</html>
