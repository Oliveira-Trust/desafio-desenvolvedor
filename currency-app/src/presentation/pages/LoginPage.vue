<script setup lang="ts">
import { useAuthStore } from '@/core/stores/auth.store';
import router from '@/router';
import { mdiEmailOutline, mdiEye, mdiEyeOff, mdiLockOutline } from '@mdi/js';
import { ref } from 'vue';
import InputField from '../components/shared/form/InputField.vue';

const authStore = useAuthStore();

const form = ref(false);
const visible = ref(false);
const username = ref('');
const password = ref('');
const loading = ref(false);

const requiredRule = (value: string) => !!value || 'Campo obrigatório';
const usernameRules = ref([requiredRule]);
const passwordRules = ref([requiredRule]);

async function onLoginHandler() {
    if (form.value) {
        loading.value = true;

        try {
            await authStore.login(username.value, password.value);
            router.push({ name: 'home' });
        } catch (error: unknown) {
            if (error instanceof Error) {
                console.log(error.message);
            }
        }

        loading.value = false;
    }
}
</script>

<template>
    <div class="page">
        <VCard class="card" elevation="8" rounded="lg">
            <VForm v-model="form" @submit.prevent="onLoginHandler">
                <VRow>
                    <VCol cols="12">
                        <InputField
                            v-model="username"
                            label="Email"
                            :prepend-inner-icon="mdiEmailOutline"
                            :rules="usernameRules"
                            hide-details
                        />
                    </VCol>
                    <VCol cols="12">
                        <InputField
                            v-model="password"
                            label="Senha"
                            :type="visible ? 'text' : 'password'"
                            :prepend-inner-icon="mdiLockOutline"
                            :append-inner-icon="visible ? mdiEyeOff : mdiEye"
                            :rules="passwordRules"
                            hide-details
                            @click:append-inner="visible = !visible"
                        />
                    </VCol>
                </VRow>

                <VBtn class="mt-10" type="submit" color="blue" size="large" variant="tonal" block text="Entrar" />
            </VForm>
        </VCard>
    </div>
</template>

<style scoped lang="scss">
.page {
    width: 100vw;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;

    .card {
        width: 448px;
        padding: 48px;
    }
}
</style>
