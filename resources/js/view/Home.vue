<script setup>
import { reactive, ref } from "vue";
import { useAuth } from "../stores/auth.js";

const auth = useAuth();

const user = reactive({
    firstName: "John",
    lastName: "Doe",
    email: "test@example.com",
    password: "password",
});

const isCreateAccount = ref(true);

const createAccount = (value) => {
    isCreateAccount.value = value;
};

async function login(event) {
    await auth.signIn(user);
}

async function create(event) {}
</script>

<template>
    <div class="h-full pb-36">
        <!--Main-->
        <div
            class="container pt-24 md:pt-32 px-4 mx-auto flex flex-wrap flex-col md:flex-row items-center"
        >
            <!--Left Col-->
            <div
                class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden"
            >
                <h3
                    class="my-4 text-1xl md:text-2xl text-trust-p3 opacity-75 font-bold leading-tight text-center md:text-left"
                >
                    Log<span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-trust-p3 via-trust-p7 to-trust-p7"
                        >in</span
                    >
                </h3>
                <form
                    class="bg-trust-p9 opacity-75 w-full shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4"
                    onsubmit="return false"
                >
                    <div class="mb-4">
                        <label class="block text-trust-p1 py-2 font-bold mb-2">
                            {{
                                isCreateAccount
                                    ? "Signup to converter"
                                    : "Create Your Account."
                            }}.
                        </label>
                        <div v-if="!isCreateAccount" class="mb-4">
                            <input
                                class="mb-2 shadow appearance-none border rounded w-full p-3 text-gray-700 leading-tight focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
                                id="firstName"
                                name="firstname"
                                type="text"
                                placeholder="John"
                                v-model="user.firstName"
                            />
                            <input
                                class="mt-2 shadow appearance-none border rounded w-full p-3 text-gray-700 leading-tight focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
                                id="lastName"
                                name="lastName"
                                type="text"
                                placeholder="Doe"
                                v-model="user.lastName"
                            />
                        </div>
                        <input
                            class="mb-2 shadow appearance-none border rounded w-full p-3 text-gray-700 leading-tight focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
                            id="email"
                            name="email"
                            type="text"
                            placeholder="you@somewhere.com"
                            v-model="user.email"
                        />
                        <input
                            class="mt-2 shadow appearance-none border rounded w-full p-3 text-gray-700 leading-tight focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
                            id="password"
                            name="password"
                            type="password"
                            placeholder="password"
                            v-model="user.password"
                        />
                    </div>
                    <div
                        v-if="auth.hasError"
                        class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                        role="alert"
                    >
                        <svg
                            class="flex-shrink-0 inline w-4 h-4 me-3"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"
                            />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">Unauthorized!</span> Check
                            your e-mail, password and try again.
                        </div>
                    </div>
                    <div class="flex items-center pt-4">
                        <button
                            class="mr-2 bg-gradient-to-r from-trust-p7 to-trust-p5 hover:from-gray-500 hover:to-gray-800 text-trust-p1 font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
                            type="submit"
                            @click="login"
                            v-if="isCreateAccount"
                        >
                            Sign Up
                        </button>
                        <button
                            class="ml-2 bg-gradient-to-r from-trust-p5 to-trust-p7 hover:from-gray-500 hover:to-gray-800 text-trust-p1 font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
                            @click="createAccount(false)"
                            type="submit"
                            v-if="isCreateAccount"
                        >
                            Create Account
                        </button>
                        <button
                            class="mr-2 bg-gradient-to-r from-trust-p7 to-trust-p5 hover:from-gray-500 hover:to-gray-800 text-trust-p1 font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
                            type="submit"
                            v-if="!isCreateAccount"
                            @click="create"
                        >
                            Submit
                        </button>
                        <button
                            class="mr-2 bg-gradient-to-r from-trust-p7 to-trust-p5 hover:from-gray-500 hover:to-gray-800 text-trust-p1 font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
                            type="submit"
                            v-if="!isCreateAccount"
                            @click="createAccount(true)"
                        >
                            Back
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
