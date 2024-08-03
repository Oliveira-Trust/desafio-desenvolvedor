<script setup lang="ts">
import { useAuthStore } from '@/core/stores/auth.store';
import router from '@/router';
import { mdiEmailOutline, mdiEye, mdiEyeOff, mdiLockOutline } from '@mdi/js';
import { ref } from 'vue';
import InputField from '../components/shared/form/InputField.vue';
import UnprocessableEntityException from "@/infrastructure/http/exceptions/unprocessable-entity-exception";
import logoOt from '@/assets/logo.svg';
import {useToastStore} from "@/core/stores/toast.store";

const authStore = useAuthStore();

const form = ref(false);
const visible = ref(false);
const email = ref('');
const password = ref('');
const loading = ref(false);
const errors = ref({} as {email: string[], password: string[]});

const requiredRule = (value: string) => !!value || 'Campo obrigatório';
const usernameRules = ref([requiredRule]);
const passwordRules = ref([requiredRule]);

async function onLoginHandler() {
    if (form.value) {
        loading.value = true;

        try {
            await authStore.login(email.value, password.value);
            await router.push({name: 'home'})
        } catch (error: unknown) {
            if (error instanceof UnprocessableEntityException) {
                // TODO: Aplicar highlight nos inputs de erro
                errors.value = error.errors;
            } else if (error instanceof Error) {
                useToastStore().error(error.message);
            }
        }

        loading.value = false;
    }
}
</script>

<template>
    <div class="page">
        <VCard class="card" elevation="2" rounded="lg">
          <VImg
              class="logo"
              max-width="240"
              :src="logoOt"
          />
            <VForm v-model="form" @submit.prevent="onLoginHandler">
                <VRow>
                    <VCol cols="12">
                        <InputField
                            v-model="email"
                            label="Email"
                            :prepend-inner-icon="mdiEmailOutline"
                            :error-messages="errors.email"
                            :rules="usernameRules"
                            hide-details="auto"
                        />
                    </VCol>
                    <VCol cols="12">
                        <InputField
                            v-model="password"
                            label="Senha"
                            :type="visible ? 'text' : 'password'"
                            :prepend-inner-icon="mdiLockOutline"
                            :append-inner-icon="visible ? mdiEyeOff : mdiEye"
                            :error-messages="errors.password"
                            :rules="passwordRules"
                            hide-details="auto"
                            @click:append-inner="visible = !visible"
                        />
                    </VCol>
                </VRow>

                <VBtn class="mt-10" type="submit" color="blue" size="large" variant="tonal" block text="Entrar" :loading />
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

      .logo {
        margin-inline: auto;
        margin-bottom: 36px;
      }
    }
}
</style>
