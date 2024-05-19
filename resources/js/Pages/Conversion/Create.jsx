import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import NotAuthenticatedLayout from "@/Layouts/NotAuthenticatedLayout";
import Form from "./Partials/Form";
import History from "./Partials/History";
import Result from "./Partials/Result";
import { Link, Head } from "@inertiajs/react";

export default function Create({
    auth,
    flash,
    currencies,
    paymentMethods,
    conversions,
}) {
    const { currentConversion, errorMessage, successMessage } = flash;

    return auth.user ? (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Conversor de moedas" />
            <div className="py-12 flex flex-col sm:justify-center items-center">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    {errorMessage && (
                        <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative">
                            {errorMessage}
                        </div>
                    )}
                    {successMessage && (
                        <div className="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative">
                            {successMessage}
                        </div>
                    )}
                    <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <Form
                            currencies={currencies}
                            paymentMethods={paymentMethods}
                            className="max-w-xl"
                        />
                        <Result
                            currencies={currencies}
                            currentConversion={currentConversion}
                            className="max-w-xl"
                        />
                    </div>
                    <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <History
                            currencies={currencies}
                            conversions={conversions}
                            className="max-w-xl"
                        />
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    ) : (
        <NotAuthenticatedLayout>
            <Head title="Conversor de moedas" />
            <div className="py-12 flex flex-col sm:justify-center items-center">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    {errorMessage && (
                        <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative">
                            {errorMessage}
                        </div>
                    )}
                    <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <Form
                            currencies={currencies}
                            paymentMethods={paymentMethods}
                            className="max-w-xl"
                        />
                        <Result
                            currencies={currencies}
                            currentConversion={currentConversion}
                            className="max-w-xl"
                        />
                    </div>
                </div>
            </div>
        </NotAuthenticatedLayout>
    );
}
