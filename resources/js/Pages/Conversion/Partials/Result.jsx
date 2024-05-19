import PrimaryButton from "@/Components/PrimaryButton";
import { useForm } from "@inertiajs/react";

export default function Result({
    user,
    currencies,
    currentConversion,
    className = "",
}) {
    const { post, processing } = useForm({});

    const currentTargetCurrency =
        currentConversion &&
        currencies.find(
            (currency) => currency.code === currentConversion.target_currency
        );

    const submitMail = (e) => {
        e.preventDefault();

        post(route("send-quotation-mail", currentConversion.id));
    };

    return (
        <form onSubmit={submitMail} id="mail-form">
            {currentConversion && (
                <div className="p-4 sm:p-4 bg-white shadow sm:rounded-lg mt-4 text-sm">
                    <div>
                        <b>
                            Valor comprado em "Moeda de destino":{" "}
                            {currentTargetCurrency.symbol}
                            {currentConversion.target_amount.toFixed(2)}
                        </b>
                        <div className="mt-2 text-sm text-gray-600">
                            <p>Moeda de origem: {currentConversion.currency}</p>
                            <p>
                                Moeda de destino:{" "}
                                {currentConversion.target_currency}
                            </p>
                            <p>
                                Valor para conversão: R$
                                {currentConversion.amount.toFixed(2)}
                            </p>
                            <p>
                                Forma de pagamento:{" "}
                                {currentConversion.payment_method.name}
                            </p>
                            <p>
                                Valor da "Moeda de destino" usado para
                                conversão: {currentTargetCurrency.symbol}
                                {currentConversion.bid.toFixed(2)}
                            </p>
                            <p>
                                Taxa de pagamento:{" "}
                                {currentConversion.payment_fee.toFixed(2)}
                            </p>
                            <p>
                                Taxa de conversão:{" "}
                                {currentConversion.amount_fee.toFixed(2)}
                            </p>
                            <p>
                                Valor utilizado para conversão descontando as
                                taxas: R$
                                {(
                                    currentConversion.amount -
                                    currentConversion.payment_fee -
                                    currentConversion.amount_fee
                                ).toFixed(2)}
                            </p>
                        </div>
                    </div>
                    {user && (
                        <>
                            <hr className="my-4" />
                            <div className="flex items-center mt-2 flex-row-reverse">
                                <PrimaryButton disabled={processing}>
                                    Enviar por email
                                </PrimaryButton>
                            </div>
                        </>
                    )}
                </div>
            )}
        </form>
    );
}
