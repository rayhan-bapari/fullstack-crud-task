<template>
    <div
        class="w-full h-screen flex flex-col items-center justify-center space-y-8"
    >
        <div class="max-w-7xl">
            <div class="relative overflow-x-auto rounded-lg shadow-xl">
                <table
                    class="w-full text-sm text-left rtl:text-right border-collapse"
                >
                    <thead
                        class="text-xs uppercase bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400"
                    >
                        <tr>
                            <th scope="col" class="px-6 py-3">Title</th>
                            <th scope="col" class="px-6 py-3">Description</th>
                            <th scope="col" class="px-6 py-3">Priority</th>
                            <th scope="col" class="px-6 py-3">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="task in tasks"
                            :key="task.id"
                            class="border-b bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700"
                        >
                            <th
                                scope="row"
                                class="px-6 py-4 font-medium whitespace-nowrap text-gray-900 dark:text-white"
                            >
                                {{ task.title }}
                            </th>
                            <td
                                class="px-6 py-4 text-gray-700 dark:text-gray-300"
                            >
                                {{ task.description }}
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100"
                                >
                                    {{ task.priority }}
                                </span>
                            </td>
                            <td
                                class="px-6 py-4 text-xs text-gray-500 dark:text-gray-400"
                            >
                                {{ task.created_at }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="text-center my-2 space-x-4">
                    <button
                        @click="showModal = true"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800 shadow-lg"
                    >
                        Open Task Modal
                    </button>
                    <button
                        @click="logout"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800 shadow-lg"
                    >
                        Logout
                    </button>
                </div>
            </div>
        </div>
        <div
            v-if="showModal"
            class="fixed inset-0 bg-gray-900 bg-opacity-50 dark:bg-opacity-80 flex items-center justify-center z-50"
            @click.self="showModal = false"
        >
            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow-2xl p-6 w-11/12 max-w-lg"
            >
                <div
                    class="flex justify-between items-center pb-3 border-b border-gray-200 dark:border-gray-700"
                >
                    <h3
                        class="text-xl font-semibold text-gray-900 dark:text-white"
                    >
                        Add New Task
                    </h3>
                    <button
                        @click="showModal = false"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    >
                        <svg
                            class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </button>
                </div>

                <div class="py-1 text-gray-700 dark:text-gray-300">
                    <input
                        type="text"
                        v-model="title"
                        placeholder="Task Title"
                        class="mt-4 w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white"
                    />
                </div>
                <div class="py-1 text-gray-700 dark:text-gray-300">
                    <textarea
                        cols="2"
                        v-model="description"
                        placeholder="Task description"
                        class="mt-4 w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white"
                    ></textarea>
                </div>
                <div class="py-1 text-gray-700 dark:text-gray-300">
                    <select
                        class="mt-4 w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white"
                        v-model="priority"
                    >
                        <option value="">Select Priority</option>
                        <option value="lower">Lower</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>

                <div class="flex justify-end pt-4">
                    <button
                        @click="showModal = false"
                        class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 mr-2"
                    >
                        Close
                    </button>
                    <button
                        @click="addTask"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700"
                    >
                        Save Task
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import axios from "axios";
import router from "@/router";
const showModal = ref(false);
const tasks = ref([]);

const title = ref("");
const description = ref("");
const priority = ref("");

async function fetchData() {
    try {
        const response = await axios.get("/api/v1/tasks", {
            headers: {
                Authorization: `Bearer ${localStorage.getItem("token")}`,
            },
        });
        tasks.value = response.data.data || response.data;
    } catch (error) {
        console.log(error);
    }
}

async function addTask() {
    try {
        await axios.post(
            "/api/v1/tasks",
            {
                title: title.value,
                description: description.value,
                priority: priority.value,
            },
            {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            }
        );

        showModal.value = false;
        fetchData();
    } catch (error) {
        console.error(error);
    }
}

async function logout() {
    try {
        await axios.post(
            "/api/v1/auth/logout",
            {},
            {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            }
        );
    } catch (error) {
        console.log(error);
    }
    localStorage.removeItem("token");
    localStorage.removeItem("user");
    router.push("/login");
}

onMounted(() => {
    fetchData();
});
</script>
