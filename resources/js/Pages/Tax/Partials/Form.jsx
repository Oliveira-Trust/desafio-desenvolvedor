import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import { useForm } from "@inertiajs/react";

export default function Form({ taxes, className }) {
    const { data, setData, patch, errors, processing } = useForm({
        taxes,
    });

    const submit = (e) => {
        e.preventDefault();

        patch(route("taxes.update"));
    };

    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-medium text-gray-900">
                    Configurar taxas
                </h2>
                <p className="mt-1 text-sm text-gray-600">
                    Use este formulário para configurar as taxas do sistema.
                </p>
            </header>

            <form onSubmit={submit} className="mt-6 space-y-2">
                <div className="space-y-4">
                    {taxes.map((tax) =>
                        tax.type === "amount_fee" ? (
                            <div key={tax.id} className="space-y-2">
                                <p className="block font-medium text-sm text-gray-700">
                                    {tax.name}:
                                </p>
                                <div className="border border-gray-150 rounded-lg p-3 space-y-1">
                                    <div>
                                        <InputLabel
                                            htmlFor={"taxes." + tax.id + ".amount"}
                                            value="Valor Base"
                                        />
                                        <TextInput
                                            id={"taxes." + tax.id + ".amount"}
                                            className="mt-1 block w-full"
                                            value={data.taxes.find((t) => t.id === tax.id).amount}
                                            onChange={(e) =>
                                                setData('taxes', data.taxes.map((t) => {
                                                    if (t.id === tax.id) {
                                                        t.amount = Number(e.target.value)
                                                    }
                                                    return t
                                                }))
                                            }
                                            type="number"
                                            step="1.00"
                                            min="1000.00"
                                            max="100000.00"
                                            required
                                            isFocused
                                        />
                                        <InputError
                                            className="mt-2"
                                            message={errors["taxes." + tax.id + ".amount"]}
                                        />
                                    </div>
                                    <div>
                                        <InputLabel
                                            htmlFor="min_amount_rate"
                                            value="Taxa valor abaixo da base"
                                        />
                                        <TextInput
                                            id="min_amount_rate"
                                            className="mt-1 block w-full"
                                            value={data.taxes.find((t) => t.id === tax.id).min_amount_rate}
                                            onChange={(e) =>
                                                setData('taxes', data.taxes.map((t) => {
                                                    if (t.id === tax.id) {
                                                        t.min_amount_rate = Number(e.target.value)
                                                    }
                                                    return t
                                                }))
                                            }
                                            type="number"
                                            step="0.01"
                                            min="1.00"
                                            max="99.00"
                                            required
                                            isFocused
                                        />
                                        <InputError
                                            className="mt-2"
                                            message={errors["taxes." + tax.id + ".min_amount_rate"]}
                                        />
                                    </div>
                                    <div>
                                        <InputLabel
                                            htmlFor="max_amount_rate"
                                            value="Taxa valor acima da base"
                                        />
                                        <TextInput
                                            id="amount"
                                            className="mt-1 block w-full"
                                            value={data.taxes.find((t) => t.id === tax.id).max_amount_rate}
                                            onChange={(e) =>
                                                setData('taxes', data.taxes.map((t) => {
                                                    if (t.id === tax.id) {
                                                        t.max_amount_rate = Number(e.target.value)
                                                    }
                                                    return t
                                                }))
                                            }
                                            type="number"
                                            step="0.01"
                                            min="1.00"
                                            max="99.00"
                                            required
                                            isFocused
                                        />
                                        <InputError
                                            className="mt-2"
                                            message={errors["taxes." + tax.id + ".max_amount_rate"]}
                                        />
                                    </div>
                                </div>
                            </div>
                        ) : (
                            <div key={tax.id} className="space-y-2">
                                <div>
                                    <InputLabel htmlFor="rate" value={tax.name} />
                                    <TextInput
                                        id={"rate"}
                                        className="mt-1 block w-full"
                                        value={data.taxes.find((t) => t.id === tax.id).rate}
                                        onChange={(e) =>
                                            setData('taxes', data.taxes.map((t) => {
                                                if (t.id === tax.id) {
                                                    t.rate = Number(e.target.value)
                                                }
                                                return t
                                            }))
                                        }
                                        type="number"
                                        step="0.01"
                                        min="0.01"
                                        max="99.00"
                                        required
                                        isFocused
                                    />
                                    <InputError
                                        className="mt-2"
                                        message={errors["taxes." + tax.id + ".rate"]}
                                    />
                                </div>
                            </div>
                        )
                    )}
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
