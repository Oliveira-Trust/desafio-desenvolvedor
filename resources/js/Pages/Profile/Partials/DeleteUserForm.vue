<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { nextTick, ref } from "vue";

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: "",
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route("profile.destroy"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Deletar Conta
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Depois que sua conta for excluída, todos os seus recursos e
                dados serão excluídos permanentemente. Antes de excluir sua
                conta, baixe quaisquer dados ou informações que você deseja
                reter.
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion">Deletar Conta</DangerButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2
                    class="text-lg font-medium text-gray-900 dark:text-gray-100"
                >
                    Tem certeza de que deseja excluir sua conta?
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Depois que sua conta for excluída, todos os seus recursos e
                    dados serão excluídos permanentemente. Por favor digite sua
                    senha para confirmar que deseja excluir permanentemente sua
                    conta.
                </p>

                <div class="mt-6">
                    <InputLabel
                        for="password"
                        value="Senha"
                        class="sr-only"
                    />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="Senha"
                        @keyup.enter="deleteUser"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">
                        Cancelar
                    </SecondaryButton>

                    <DangerButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Deletar Conta
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
