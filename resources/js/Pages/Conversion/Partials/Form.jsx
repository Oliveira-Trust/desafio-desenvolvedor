import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { useForm } from '@inertiajs/react';

export default function Form({ currencies, paymentMethods, className = '' }) {
    const { data, setData, post, errors, processing } = useForm({
        amount: 1000.00,
    });

    const submit = (e) => {
        e.preventDefault();

        post(route('conversions.store'));
    };

    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-medium text-gray-900">Converter moeda</h2>

                <p className="mt-1 text-sm text-gray-600">
                    Use este formulário para converter uma quantia de um determinado tipo de moeda para outra.
                </p>
            </header>

            <form onSubmit={submit} className="mt-6 space-y-2">
                <div className='space-y-4'>
                    <div>
                        <InputLabel htmlFor="currencies_disabled" value="Moeda de origem:" />
                        <select
                            disabled
                            defaultValue="BRL"
                            id="currencies_disabled"
                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5">
                            <option value="BRL">BRL - Real Brasileiro</option>
                        </select>
                    </div>
                    <div>
                        <InputLabel htmlFor="target_currency" value="Moeda de destino:" />
                        <select
                            id="target_currency"
                            defaultValue="DEFAULT"
                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                            onChange={(e) => setData('target_currency', e.target.value)}
                        >
                            <option value="DEFAULT">Escolha uma moeda</option>
                            {currencies.map((currency) => (
                                <option key={currency.code} value={currency.code}>{currency.code} - {currency.name}</option>
                            ))}
                        </select>
                        <InputError className="mt-2" message={errors.target_currency} />
                    </div>
                    <div>
                        <InputLabel htmlFor="payment_method_id" value="Método de pagamento:" />
                        <select
                            id="payment_method_id"
                            defaultValue="DEFAULT"
                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                            onChange={(e) => setData('payment_method_id', e.target.value)}
                        >
                            <option value="DEFAULT">Escolha um método</option>
                            {paymentMethods.map((method) => (
                                <option key={method.id} value={method.id}>{method.name}</option>
                            ))}
                        </select>
                        <InputError className="mt-2" message={errors.payment_method_id} />
                    </div>
                    <div>
                        <InputLabel htmlFor="amount" value="Valor" />
                        <TextInput
                            id="amount"
                            className="mt-1 block w-full"
                            value={data.amount}
                            onChange={(e) => setData('amount', e.target.value)}
                            type="number"
                            step="1.00"
                            min="1000.00"
                            max="100000.00"
                            required
                            isFocused
                        />
                        <InputError className="mt-2" message={errors.amount} />
                    </div>
                </div>

                <div className="flex items-center gap-4">
                    <PrimaryButton
                        disabled={processing}
                        className="w-full flex-col sm:justify-center"
                    >
                        Converter moeda
                    </PrimaryButton>
                </div>
            </form>
        </section>
    );
}
