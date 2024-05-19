import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import Form from "./Partials/Form";
import { Head } from "@inertiajs/react";

export default function Create({ auth, flash, taxes }) {
    const { errorMessage, successMessage } = flash;

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Configurar taxas" />
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
                            taxes={taxes}
                            className="max-w-xl"
                        />
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
