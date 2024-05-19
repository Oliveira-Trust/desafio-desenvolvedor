import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { useForm } from '@inertiajs/react';

export default function Form({ currencies, paymentMethods, className = '' }) {
    const { data, setData, post, errors, processing } = useForm({
        amount: data.amount,
        rate: data.rate,
        min_amount_rate: data.min_amount_rate,
        max_amount_rate: data.max_amount_rate,
    });

    const submit = (e) => {
        e.preventDefault();

        post(route('taxes.update'));
    };

    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-medium text-gray-900">Configurar taxas</h2>
                <p className="mt-1 text-sm text-gray-600">
                    Use este formulário para configurar as taxas do sistema.
                </p>
            </header>

            <form onSubmit={submit} className="mt-6 space-y-2">
                <div className='space-y-4'>
                    <div>
                        <InputLabel htmlFor="amount" value="Valor base de taxa" />
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
                        Salvar
                    </PrimaryButton>
                </div>
            </form>
        </section>
    );
}
