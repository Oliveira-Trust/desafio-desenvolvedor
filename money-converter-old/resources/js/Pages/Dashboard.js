import React, { useState, useEffect } from 'react';
import Authenticated from '@/Layouts/Authenticated';
import { Head } from '@inertiajs/inertia-react';

export default function Dashboard(props) {
    const [purchases, setPurchases] = useState([]);

    useEffect(() => {
        async function bootstrap() {
            const response = await fetch('/v1/purchase');
            const rowPurchases = await response.json();

            console.log(rowPurchases);

            setPurchases(rowPurchases);
        }
        bootstrap();
    }, []);

    const convertToCurrency = (value, currency = 'BRL') => {
        const parseValue = Number(value);
        return parseValue.toLocaleString('pt-BR', {
            style: 'currency',
            currency,
        });
    }

    const formatDate = (date) => {
        const parsedData = new Date(date);
        return parsedData.toLocaleString('pt-br');
    }

    return (
        <Authenticated
            auth={props.auth}
            errors={props.errors}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div
                        className="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                        <header className="px-5 py-4 border-b border-gray-100">
                            <h2 className="font-semibold text-gray-800">Compras Realizadas</h2>
                        </header>
                        <div className="p-3">
                            <div className="overflow-x-auto">
                                <table className="table-auto w-full">
                                    <thead
                                        className="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                    <tr>
                                        <th className="p-2 whitespace-nowrap">
                                            <div className="font-semibold text-left">Origem</div>
                                        </th>
                                        <th className="p-2 whitespace-nowrap">
                                            <div className="font-semibold text-left">Destimo</div>
                                        </th>
                                        <th className="p-2 whitespace-nowrap">
                                            <div className="font-semibold text-left">Cotação</div>
                                        </th>
                                        <th className="p-2 whitespace-nowrap">
                                            <div className="font-semibold text-center">Taxa de Pagamento</div>
                                        </th>
                                        <th className="p-2 whitespace-nowrap">
                                            <div className="font-semibold text-center">Taxa de Conversão</div>
                                        </th>
                                        <th className="p-2 whitespace-nowrap">
                                            <div className="font-semibold text-center">Solicitado</div>
                                        </th>
                                        <th className="p-2 whitespace-nowrap">
                                            <div className="font-semibold text-center">Adquirido</div>
                                        </th>
                                        <th className="p-2 whitespace-nowrap">
                                            <div className="font-semibold text-center">Data da Compra</div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody className="text-sm divide-y divide-gray-100">
                                    {purchases.length === 0 && (
                                        <h2 className={'text-center'}>Nenhuma compra foi realizada</h2>
                                    )}
                                    {purchases.map(purchase => (
                                        <tr key={purchase.id}>
                                            <td className="p-2 whitespace-nowrap">
                                                <div className="flex items-center">
                                                    <div className="font-medium text-gray-800">
                                                        {purchase.origin}
                                                    </div>
                                                </div>
                                            </td>
                                            <td className="p-2 whitespace-nowrap">
                                                <div className="text-left">{purchase.destiny}</div>
                                            </td>
                                            <td className="p-2 whitespace-nowrap">
                                                <div className="text-left font-medium text-green-500">
                                                    {convertToCurrency(purchase.quotation_value, purchase.destiny)}
                                                </div>
                                            </td>
                                            <td className="p-2 whitespace-nowrap">
                                                <div className="text-left font-medium text-green-500 text-center">
                                                    {convertToCurrency(purchase.payment_taxe)}
                                                </div>
                                            </td>
                                            <td className="p-2 whitespace-nowrap">
                                                <div className="text-left font-medium text-green-500 text-center">
                                                    {convertToCurrency(purchase.conversion_taxe)}
                                                </div>
                                            </td>
                                            <td className="p-2 whitespace-nowrap">
                                                <div className="text-left font-medium text-green-500 text-center">
                                                    {convertToCurrency(purchase.request_value)}
                                                </div>
                                            </td>
                                            <td className="p-2 whitespace-nowrap">
                                                <div className="text-left font-medium text-green-500 text-center">
                                                    {convertToCurrency(purchase.purchase_value, purchase.destiny)}
                                                </div>
                                            </td>
                                            <td className="p-2 whitespace-nowrap">
                                                <div className="text-left font-medium text-green-500 text-center">
                                                    {formatDate(purchase.created_at)}
                                                </div>
                                            </td>
                                        </tr>
                                    ))}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Authenticated>
    );
}
