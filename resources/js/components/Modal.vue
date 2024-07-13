<script setup>
import { defineProps, defineEmits, ref } from "vue";
import { onClickOutside } from "@vueuse/core";

const props = defineProps({
    isOpen: Boolean,
    message: String,
});

const emit = defineEmits(["modal-close"]);

const target = ref(null);
onClickOutside(target, () => emit("modal-close"));
</script>

<template>
    <div v-if="isOpen" class="fixed z-10 inset-0 overflow-y-auto" id="modal">
        <div
            class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
        >
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span
                class="hidden sm:inline-block sm:align-middle sm:h-screen"
                aria-hidden="true"
                >&#8203;</span
            >
            <div
                ref="target"
                class="inline-block align-bottom bg-gray-100 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                role="dialog"
                aria-modal="true"
                aria-labelledby="modal-headline"
            >
                <div>
                    <div
                        class="mx-auto flex items-center justify-center h-15 w-15"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            x="0px"
                            y="0px"
                            width="96"
                            height="96"
                            viewBox="0 0 48 48"
                        >
                            <path
                                fill="#f44336"
                                d="M44,24c0,11.045-8.955,20-20,20S4,35.045,4,24S12.955,4,24,4S44,12.955,44,24z"
                            ></path>
                            <path
                                fill="#fff"
                                d="M29.656,15.516l2.828,2.828l-14.14,14.14l-2.828-2.828L29.656,15.516z"
                            ></path>
                            <path
                                fill="#fff"
                                d="M32.484,29.656l-2.828,2.828l-14.14-14.14l2.828-2.828L32.484,29.656z"
                            ></path>
                        </svg>
                    </div>
                    <div class="text-center sm:mt-3 lg:mt-5">
                        <h3
                            class="text-2xl leading-10 font-bold text-gray-800"
                            id="modal-headline"
                        >
                            Error
                        </h3>
                        <div class="sm:mt-3 lg:mt-5">
                            <p class="text-xl text-gray-500">
                                {{ message }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="sm:mt-3 lg:mt-5">
                    <button
                        class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-trust-p7 text-base font-medium text-white hover:bg-trust-p3 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-xl"
                        @click.stop="emit('modal-close')"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
