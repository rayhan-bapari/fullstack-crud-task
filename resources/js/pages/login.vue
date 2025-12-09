<template>
    <div
        class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8"
    >
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img
                class="mx-auto h-10 w-auto"
                src="//placehold.co/300x100?text=Inilabs+Task"
                alt="Inilabs Tasks"
            />
            <h2
                class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-white"
            >
                Sign in to your account
            </h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" id="loginForm">
                <div>
                    <label
                        for="email"
                        class="block text-sm/6 font-medium text-gray-100"
                    >
                        Email address
                    </label>
                    <div class="mt-2">
                        <input
                            type="email"
                            name="email"
                            id="email"
                            v-model="email"
                            autocomplete="email"
                            required
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
                        />
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label
                            for="password"
                            class="block text-sm/6 font-medium text-gray-100"
                        >
                            Password
                        </label>
                    </div>
                    <div class="mt-2">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            v-model="password"
                            required
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
                        />
                    </div>
                </div>

                <div>
                    <button
                        type="button"
                        @click="login"
                        class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
                    >
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import router from "@/router";
import axios from "axios";

const email = ref("");
const password = ref("");

async function login() {
    await axios.get("/sanctum/csrf-cookie");

    const res = await axios.post("/api/v1/auth/login", {
        email: email.value,
        password: password.value,
    });

    localStorage.setItem("user", JSON.stringify(res.data.user));
    localStorage.setItem("token", res.data.token);
    router.push("/dashboard");
}
</script>
