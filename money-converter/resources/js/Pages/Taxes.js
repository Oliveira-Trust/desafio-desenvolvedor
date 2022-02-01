import React, {useEffect, useState} from 'react';
import Authenticated from '@/Layouts/Authenticated';
import { Head } from '@inertiajs/inertia-react';
import { FaSmile } from "react-icons/fa";

export default function Taxes(props) {
    const [paymentType, setPaymentType] = useState(1);
    const [paymentTypes, setPaymentTypes] = useState([]);
    const [taxe, setTaxe] = useState({});
    const [disablePercentage, setDisablePercentage] = useState(true);
    const [message, setMessage] = useState('');

    useEffect(() => {
        async function bootstrap() {
            const response = await fetch(`/v1/payment-method/${paymentType}/fees`);
            const getTaxe = await response.json();

            console.log(getTaxe);

            setTaxe({ ...taxe, ...getTaxe });
            setDisablePercentage(false);
        }
        bootstrap();
    }, [paymentType]);

    useEffect(() => {
        async function bootstrap() {
            const response = await fetch('/v1/payment-methods');
            const payments = await response.json();

            setPaymentTypes(payments);
        }
        bootstrap();
    }, []);

    const handleChangePaymentType = (event) => {
        setMessage('');
        setPaymentType(event.target.value);
    }

    const handlePercentage = (event) => {
        setMessage('');
        setTaxe({
            ...taxe,
            percentage: event.target.value,
            payment_type_id: paymentType,
        });
    }

    const handleSubmitUpdate = async (event) => {
        event.preventDefault();

        const response = await fetch(`/v1/fees/${taxe.id}`, {
            method: 'PATCH',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(taxe),
        });

        const updateStatus = response.status;

        if (updateStatus === 204) {
            setMessage('Taxa alterada com sucesso');
        }
    }

    return (
        <Authenticated
            auth={props.auth}
            errors={props.errors}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Taxes</h2>}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="lg:w-full md:w-1/2 w-2/3">
                            <form onSubmit={handleSubmitUpdate} className="bg-white p-10 rounded-lg shadow-lg min-w-full">
                                <h1 className="text-center text-2xl mb-6 text-gray-600 font-bold font-sans">
                                    Alterar Taxas
                                </h1>
                                {message && (
                                    <div className={'flex flex-row items-center bg-green-500 p-4 text-white rounded-md mb-4'}>
                                        <FaSmile size={20} />
                                        <span className={'ml-3 font-bold'}>{message}</span>
                                    </div>
                                )}
                                <div>
                                    <label className="text-gray-800 font-semibold block my-3 text-md"
                                           htmlFor="payment_type">Tipo de Pagamento</label>
                                    <select className="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none"
                                            name="payment_type"
                                            id="payment_type"
                                            value={paymentType}
                                            onChange={handleChangePaymentType}
                                    >
                                        {paymentTypes.map(payment => (
                                            <option key={payment.id} value={payment.id}>{payment.display_name}</option>
                                        ))}
                                    </select>
                                </div>
                                <div>
                                    <label className="text-gray-800 font-semibold block my-3 text-md"
                                           htmlFor="percentage">Porcentagem</label>
                                    <input
                                        className="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none disabled:bg-gray-300 disabled:cursor-not-allowed"
                                        type="text"
                                        name="percentage"
                                        id="percentage"
                                        onChange={handlePercentage}
                                        value={taxe.percentage || ''}
                                        disabled={disablePercentage}
                                    />
                                </div>

                                <button
                                    type="submit"
                                    className="w-full mt-6 bg-indigo-600 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans"
                                >
                                    Salvar Alterações
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </Authenticated>
    );
}
