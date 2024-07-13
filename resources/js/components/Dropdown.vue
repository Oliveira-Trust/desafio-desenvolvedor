<script setup>
import {
    computed,
    defineProps,
    ref,
    defineEmits,
    onMounted,
    onBeforeUnmount,
} from "vue";
import { onClickOutside } from "@vueuse/core";

const props = defineProps({
    options: {
        type: Object,
        required: true,
    },
    modelValue: {
        default: null,
    },
    label: String,
});

const selectedOption = ref(null);
const isVisible = ref(false);
const target = ref(null);

const emit = defineEmits(["update:modelValue"]);

const mappedSelectedOption = computed(() => {
    return selectedOption.value?.name || selectedOption.value || props.label;
});

const toggleOptionSelect = (indexOption, valueOption) => {
    selectedOption.value = valueOption;
    emit("update:modelValue", indexOption);
    isVisible.value = false;
};

const close = (element) => {
    if (target.value.contains(element.target)) {
        return;
    }

    isVisible.value = false;
};

onMounted(() => {
    window.addEventListener("click", close);
});

onBeforeUnmount(() => {
    window.removeEventListener("click", close);
});
</script>

<template>
    <div class="w-full absolute" ref="target">
        <div
            class="w-full text-white bg-blue-700 hover:bg-trust-p3 focus:ring-4 focus:outline-none focus:ring-trust-p2 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-trust-p7 dark:hover:bg-trust-p3 dark:focus:ring-trust-p7"
            @click="isVisible = true"
        >
            {{ mappedSelectedOption }}
        </div>
        <div
            v-if="isVisible"
            id="dropdownUsers"
            class="w-full z-10 bg-white rounded shadow dark:bg-trust-p3"
        >
            <ul
                class="h-40 py-1 overflow-y-auto text-gray-700 dark:text-gray-200"
                aria-labelledby="dropdownUsersButton"
            >
                <li
                    v-for="(value, index) in props.options"
                    :key="index"
                    @click="toggleOptionSelect(index, value)"
                >
                    <span
                        class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                    >
                        {{ value || index }}
                    </span>
                </li>
            </ul>
        </div>
    </div>
</template>
