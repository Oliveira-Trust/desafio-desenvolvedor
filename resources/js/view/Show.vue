<script setup>
import { reactive, onMounted, ref, computed } from "vue";
import Modal from "../components/Modal.vue";
import Dropdown from "../components/Dropdown.vue";
import { toClipboard } from "@soerenmartius/vue3-clipboard";
import useCurrencyConverter from "../stores/currencyConverter.js";

const result = ref({});
const showResult = ref(false);
const isCopied = ref(false);
const isSend = ref(false);
const currencyConverter = useCurrencyConverter();

const data = reactive({
    from: "",
    to: "",
    payment: "",
    amount: 0,
});

const currencies = data;

onMounted(async () => {
    await currencyConverter.findTranslations();
    await currencyConverter.findCombinations();
    await currencyConverter.findPayments();
});

const defaultBRLTranslation = ref({ BRL: "Real Brasileiro" });
const translationsValue = computed(() => {
    return { ...currencyConverter.translations };
});

const paymentsValue = computed(() => {
    return { ...currencyConverter.payments };
});

const clipBoard = (result) => {
    toClipboard(result.amount_used_conversion);
    isCopied.value = true;
    setTimeout(() => {
        isCopied.value = false;
    }, 1000);
};

const convert = async () => {
    isSend.value = true;
    await currencyConverter.conversion(JSON.stringify(data));
    result.value = { ...currencyConverter.conversionResult };
    showResult.value = true;
    isSend.value = false;
};

const formatCurrency = (value, countryCode, currencyCode) => {
    return value === undefined
        ? ""
        : value.toLocaleString(`pt-${countryCode}`, {
              style: "currency",
              currency: `${currencyCode}`,
          });
};
</script>

<template>
    <!--Main-->
    <div class="container max-w-xl justify-center px-4 mx-auto mt-20">
        <div class="w-full justify-center">
            <form
                class="bg-trust-p10 opacity-75 w-full shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4"
                onsubmit="return false"
            >
                <h3
                    class="my-4 text-1xl md:text-2xl text-white opacity-75 font-bold leading-tight text-center md:text-left"
                >
                    Conver<span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-trust-p7 via-trust-p7 to-trust-p7"
                        >ter</span
                    >
                </h3>

                <div
                    class="grid grid-cols-3 sm:grid-cols-3 gap-4 mb-8 mt-10 text-trust-p1"
                >
                    <div class="flex relative justify-start z-20">
                        <Dropdown
                            :options="defaultBRLTranslation"
                            v-model="data.from"
                            :label="'From'"
                        />
                    </div>
                    <div class="flex justify-center">
                        <button
                            class="p-2 bg-trust-p7 rounded-full cursor-pointer hover:bg-trust-p3"
                        >
                            <svg
                                width="24"
                                height="24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M5 7h14m0 0l-3.5 4M19 7l-3.5-4M19 17H5m0 0l3.5 4M5 17l3.5-4"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </button>
                    </div>
                    <div class="relative flex justify-end z-20">
                        <Dropdown
                            :options="translationsValue"
                            v-model="data.to"
                            :label="'To'"
                        />
                    </div>
                </div>

                <div class="relative z-10 mt-10">
                    <Dropdown
                        :options="paymentsValue"
                        v-model="data.payment"
                        :label="'Payment'"
                    />
                </div>

                <label class="block mt-28 text-trust-p1 py-2 font-bold mb-2">
                    Amount
                </label>
                <input
                    class="block mb-2 shadow appearance-none border rounded w-full p-3 text-gray-700 leading-tight focus:ring transform transition duration-300 ease-in-out"
                    value="{amount}"
                    type="number"
                    min="0"
                    @keyup.enter="convert"
                    v-model="data.amount"
                    placeholder="0"
                />

                <div class="flex justify-end pt-4">
                    <button
                        class="mr-2 bg-gradient-to-r from-trust-p7 to-trust-p7 hover:from-trust-p7 hover:to-trust-p5 dark:text-trust-p1 font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
                        type="button"
                        @click="convert"
                        v-if="!isSend"
                    >
                        Convert
                    </button>
                    <div
                        v-if="isSend"
                        class="flex relative items-center block max-w-sm p-6 bg-white border border-gray-100 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-800 dark:hover:bg-gray-700"
                    >
                        <div
                            role="status"
                            class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2"
                        >
                            <svg
                                aria-hidden="true"
                                class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                viewBox="0 0 100 101"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor"
                                />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill"
                                />
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </form>
            <div
                class="w-full bg-white dark:bg-trust-p3 border border-gray-200 dark:border-gray-700 shadow rounded-lg p-5"
            >
                <h4
                    class="text-l font-semibold text-gray-900 dark:text-white mb-2"
                >
                    Conversion:
                </h4>
                <div
                    v-if="showResult"
                    class="bg-gray-50 dark:bg-gray-700 dark:border-gray-600 p-4 rounded-lg border border-gray-200 not-italic grid grid-cols-2 mb-2"
                >
                    <div
                        class="space-y-2 text-gray-500 dark:text-gray-400 leading-loose hidden sm:block"
                    >
                        Origin currency:
                    </div>
                    <div
                        id="result-details"
                        class="space-y-2 text-gray-900 dark:text-white font-medium leading-loose"
                    >
                        {{ result.origin_currency }}
                    </div>
                    <div
                        class="space-y-2 text-gray-500 dark:text-gray-400 leading-loose hidden sm:block"
                    >
                        Destiny currency:
                    </div>
                    <div
                        id="result-details"
                        class="space-y-2 text-gray-900 dark:text-white font-medium leading-loose"
                    >
                        {{ result.destiny_currency }}
                    </div>
                    <div
                        class="space-y-2 text-gray-500 dark:text-gray-400 leading-loose hidden sm:block"
                    >
                        Conversion amount:
                    </div>
                    <div
                        id="result-details"
                        class="space-y-2 text-gray-900 dark:text-white font-medium leading-loose"
                    >
                        {{
                            formatCurrency(
                                result.conversion_amount,
                                "BR",
                                "BRL",
                            )
                        }}
                    </div>
                    <div
                        class="space-y-2 text-gray-500 dark:text-gray-400 leading-loose hidden sm:block"
                    >
                        Payment type:
                    </div>
                    <div
                        id="result-details"
                        class="space-y-2 text-gray-900 dark:text-white font-medium leading-loose"
                    >
                        {{ result.payment_type }}
                    </div>
                    <div
                        class="space-y-2 text-gray-500 dark:text-gray-400 leading-loose hidden sm:block"
                    >
                        Payment rate:
                    </div>
                    <div
                        id="result-details"
                        class="space-y-2 text-gray-900 dark:text-white font-medium leading-loose"
                    >
                        {{ formatCurrency(result.payment_rate, "BR", "BRL") }}
                    </div>
                    <div
                        class="space-y-2 text-gray-500 dark:text-gray-400 leading-loose hidden sm:block"
                    >
                        Destination currency:
                    </div>
                    <div
                        id="result-details"
                        class="space-y-2 text-gray-900 dark:text-white font-medium leading-loose"
                    >
                        {{
                            formatCurrency(
                                result.amount_destination_currency,
                                currencies.to.slice(0, -1),
                                currencies.to,
                            )
                        }}
                    </div>
                    <div
                        class="space-y-2 text-gray-500 dark:text-gray-400 leading-loose hidden sm:block"
                    >
                        Currency purchased:
                    </div>
                    <div
                        id="result-details"
                        class="space-y-2 text-gray-900 dark:text-white font-medium leading-loose"
                    >
                        {{
                            formatCurrency(
                                result.amount_currency_purchased,
                                currencies.to.slice(0, -1),
                                currencies.to,
                            )
                        }}
                    </div>
                    <div
                        class="space-y-2 text-gray-500 dark:text-gray-400 leading-loose hidden sm:block"
                    >
                        Conversion rate:
                    </div>
                    <div
                        id="result-details"
                        class="space-y-2 text-gray-900 dark:text-white font-medium leading-loose"
                    >
                        {{
                            formatCurrency(result.conversion_rate, "BR", "BRL")
                        }}
                    </div>
                </div>
                <div
                    class="relative bg-gray-50 dark:bg-gray-700 dark:border-gray-600 p-4 rounded-lg border border-gray-200 not-italic grid grid-cols-2"
                >
                    <div
                        class="space-y-2 text-gray-500 dark:text-gray-400 leading-loose hidden sm:block"
                    >
                        Amount used conversion:
                    </div>
                    <div
                        id="result-details"
                        class="space-y-2 text-gray-900 dark:text-white font-medium leading-loose"
                    >
                        {{
                            formatCurrency(
                                result.amount_used_conversion,
                                "BR",
                                "BRL",
                            )
                        }}
                    </div>
                    <button
                        @click="clipBoard(result)"
                        data-copy-to-clipboard-target="result-details"
                        data-copy-to-clipboard-content-type="textContent"
                        data-tooltip-target="tooltip-result-details"
                        class="absolute end-2 top-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg p-2 inline-flex items-center justify-center"
                    >
                        <span
                            v-if="!isCopied"
                            id="default-icon-result-details"
                            class=""
                        >
                            <svg
                                class="w-3.5 h-3.5"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor"
                                viewBox="0 0 18 20"
                            >
                                <path
                                    d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z"
                                />
                            </svg>
                        </span>
                        <span
                            v-if="isCopied"
                            id="success-icon-result-details"
                            class="inline-flex items-center"
                        >
                            <svg
                                class="w-3.5 h-3.5 text-blue-700 dark:text-blue-500"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 16 12"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M1 5.917 5.724 10.5 15 1.5"
                                />
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
            <Modal
                :isOpen="currencyConverter.modal.isOpen"
                :message="currencyConverter.modal.message"
                @modal-close="currencyConverter.modal.close"
            />
        </div>
    </div>
</template>
