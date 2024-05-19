export default function History({ currencies, conversions, className = '' }) {
    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-medium text-gray-900">Histórico</h2>

                <p className="mt-1 text-sm text-gray-600">
                    Veja o seu histórico de conversões previamente realizadas.
                </p>
            </header>

            <div className='mt-6 space-y-4 max-h-40 overflow-y-auto px-4'>
                {!conversions.length
                    ? (
                        <div className="flex flex-col sm:justify-center items-center">
                            <p className="text-sm font-medium text-gray-400">Você ainda não realizou nenhuma conversão...</p>
                        </div>
                    )
                    : conversions.map((conversion) => {
                        const currentTargetCurrency = currencies.find((currency) => currency.code === conversion.target_currency)

                        return <div key={conversion.id}>
                            <div className='flex justify-between'>
                                <div>
                                    <h3 className="text-sm font-medium text-gray-900">
                                        R${conversion.amount.toFixed(2)} convertido para {currentTargetCurrency.symbol}{conversion.target_amount.toFixed(2)}
                                    </h3>
                                    <p className="text-xs text-gray-500">{conversion.created_at}</p>
                                </div>
                                <div>
                                    <p className="text-sm font-medium text-gray-900">{conversion.rate}</p>
                                </div>
                            </div>
                        </div>
                    })
                }
            </div>
        </section>
    );
}
