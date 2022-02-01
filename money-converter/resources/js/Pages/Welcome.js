import React, { useEffect, useState } from 'react';
import { Link, Head } from '@inertiajs/inertia-react';
import { FaAngleRight, FaSmile, FaSadTear } from 'react-icons/fa';

export default function Welcome(props) {
    const [origin, setOrigin] = useState('BRL');
    const [destiny, setDestiny] = useState('USD');
    const [payment_method, setPaymentMethod] = useState('boleto');
    const [purchaseValue, setPurchaseValue] = useState(0);
    const [loading, setLoading] = useState(false);
    const [message, setMessage] = useState('');
    const [errors, setErrors] = useState([]);
    const [currencies, setCurrencies] = useState([]);

    useEffect(() => {
        async function bootstrap() {
            setLoading(true);

            const response = await fetch('v1/currencies');
            const availableCurrencies = await response.json();

            setCurrencies([currencies, ...availableCurrencies]);
            setLoading(false);
        }

        bootstrap();
    }, []);

    const handleSelectOrigin = (event) => {
        setOrigin(event.target.value);
    }

    const handleSelectDestiny = (event) => {
        setDestiny(event.target.value);
    }

    const handlePurchaseValue = (event) => {
        setPurchaseValue(event.target.value);
    }

    const handlePaymentType = (event) => {
        setPaymentMethod(event.target.value);
    }

    const handleSubmitForm = async (event) => {
        event.preventDefault();

        const requestData = {
            origin,
            destiny,
            payment_method,
            value: Number(purchaseValue),
        }

        const response = await fetch('/v1/purchases', {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            method: 'POST',
            body: JSON.stringify(requestData),
        });

        const statusCode = response.status;

        if (statusCode === 201) {
            setMessage('Compra Realizada com sucesso !')
            setErrors([]);
        }

        if (statusCode === 404) {
            setErrors(['Combinação de moedas inválida']);
        }

        if (statusCode === 422) {
            const { errors: { value } } = await response.json();
            setErrors(value);
        }
    }

    return (
        <>
            <Head title="Welcome" />
            <div className="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
                <div className="fixed top-0 right-0 px-6 py-4 sm:block">
                    {props.auth.user && (
                        <Link
                            href={route('dashboard')}
                            className="text-sm font-bold text-gray-700 hover:text-gray-500"
                        >
                            <div className={'flex flex-row items-center'}>
                                <span className={'mr-2'}>Ir para o Painel</span>
                                <FaAngleRight size={15} />
                            </div>
                        </Link>
                    )}
                </div>

                <div className="container mx-auto">
                    <div className="flex justify-center px-6 my-12">
                        <div className="w-full xl:w-3/4 lg:w-11/12 flex">
                            <div
                                className="w-full h-auto bg-gradient-to-r from-sky-500 to-indigo-500 hidden lg:block lg:w-5/12 bg-cover rounded-l-lg"
                            ></div>
                            <div className="w-full lg:w-7/12 bg-white p-5 rounded-lg lg:rounded-l-none">
                                <form onSubmit={handleSubmitForm} className="px-8 pt-6 pb-8 mb-4 bg-white rounded">
                                    {message && (
                                        <div className={'flex flex-row items-center bg-green-500 p-4 text-white rounded-md mb-4'}>
                                            <FaSmile size={20} />
                                            <span className={'ml-3 font-bold'}>{message}</span>
                                        </div>
                                    )}

                                    {errors && errors.map(error => (
                                        <div className={'flex flex-row items-center bg-red-500 p-4 text-white rounded-md mb-4'}>
                                            <FaSadTear size={20} />
                                            {error && (<span className={'ml-3 font-bold'}>{error}</span>)}
                                        </div>
                                    ))}
                                    <div className="mb-4 md:flex md:justify-between">
                                        <div className="mb-4 md:mr-2 md:mb-0">
                                            <label className="block mb-2 text-sm font-bold text-gray-700"
                                                   htmlFor="origin">
                                                Moeda de Origem
                                            </label>
                                            <select
                                                className="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                                id="origin"
                                                value={origin}
                                                onChange={handleSelectOrigin}
                                            >
                                                {currencies.map(currency => (
                                                    <option value={currency.code}>{`${currency.code} - ${currency.display_name}`}</option>
                                                ))}
                                            </select>
                                        </div>
                                        <div className="md:ml-2">
                                            <label className="block mb-2 text-sm font-bold text-gray-700"
                                                   htmlFor="destiny">
                                                Moeda de Destino
                                            </label>
                                            <select
                                                className="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                                id="destiny"
                                                value={destiny}
                                                onChange={handleSelectDestiny}
                                            >
                                                {currencies.map(currency => (
                                                    <option value={currency.code}>{`${currency.code} - ${currency.display_name}`}</option>
                                                ))}
                                            </select>
                                        </div>
                                    </div>

                                    <div className="mb-4 md:flex md:justify-between">
                                        <div className="mb-4 md:mr-2 md:mb-0">
                                            <label className="block mb-2 text-sm font-bold text-gray-700"
                                                   htmlFor="value">
                                                Valor da compra
                                            </label>
                                            <input
                                                className="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                                id="value"
                                                type="text"
                                                onChange={handlePurchaseValue}
                                            />
                                            {/*<p className="text-xs italic text-red-500">Please choose a password.</p>*/}
                                        </div>
                                        <div className="md:ml-2">
                                            <label className="block mb-2 text-sm font-bold text-gray-700"
                                                   htmlFor="payment_type">
                                                Método de Pagamento
                                            </label>
                                            <select
                                                className="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                                id="payment_type"
                                                value={payment_method}
                                                onChange={handlePaymentType}
                                            >
                                                <option value="boleto">Boleto</option>
                                                <option value="cartao">Cartão</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div className="mb-6 text-center">
                                        <button
                                            className="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-md hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                            type="submit"
                                        >
                                            Converter Moeda
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
