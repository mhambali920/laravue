<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import SecondaryButton from "../../Components/SecondaryButton.vue";
import { computed } from "@vue/reactivity";

const props = defineProps({
    categories: Array,
});
const form = useForm({
    category_id: null,
    contact_id: null,
    contact_name: null,
    date: null,
    amount: null,
    description: null,
    payment_method: null,
    due_date: null,
});

const cobacomputed = computed(() => {
    let i = props.categories.filter((el) => {
        el.id == 17;
    });
    console.log(props.categories);
    return i;
});
const store = () => {
    form.post(route("transaction.store"), {
        errorBag: "createTransaction",
        preserveScroll: true,
    });
};
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tambah Transaksi
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4"
                >
                    <Link
                        :href="route('transaction.index')"
                        class="inline-block mb-4"
                    >
                        <SecondaryButton type="button"
                            >&laquo Kembali</SecondaryButton
                        >
                    </Link>
                    <hr />
                    <form @submit.prevent="store" class="w-full lg:w-1/3 mt-4">
                        <div class="">
                            <div class="mb-4">
                                <div class="flex items-center">
                                    <label
                                        for="date"
                                        class="block font-medium text-sm text-indigo-500"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="currentColor"
                                            class="w-8 h-8"
                                        >
                                            <path
                                                d="M12.75 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM7.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM8.25 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9.75 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM10.5 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12.75 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM14.25 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 13.5a.75.75 0 100-1.5.75.75 0 000 1.5z"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </label>
                                    <input
                                        v-model="form.date"
                                        type="date"
                                        id="date"
                                        class="w-full ml-4 border-0 border-b-2 border-indigo-300 focus:ring-0 shadow-sm"
                                    />
                                </div>
                                <p
                                    v-if="form.errors.date"
                                    class="text-sm text-red-500"
                                >
                                    {{ form.errors.date }}
                                </p>
                            </div>
                            <div class="mb-4">
                                <div class="flex items-center">
                                    <label
                                        for="category"
                                        class="block font-medium text-sm text-indigo-500"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="currentColor"
                                            class="w-8 h-8"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.25 2.25a3 3 0 00-3 3v4.318a3 3 0 00.879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 005.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 00-2.122-.879H5.25zM6.375 7.5a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </label>
                                    <select
                                        v-model="form.category_id"
                                        class="w-full ml-4 border-0 border-b-2 border-indigo-300 focus:ring-0 shadow-sm"
                                    >
                                        <option :value="null" disabled hidden>
                                            Pilih kategori
                                        </option>
                                        <option
                                            v-for="item in categories"
                                            :value="item.id"
                                            :key="item.id"
                                        >
                                            {{
                                                `${
                                                    item.type === "income"
                                                        ? "Pemasukan"
                                                        : "Pengeluaran"
                                                } - ${item.category}`
                                            }}
                                        </option>
                                    </select>
                                </div>
                                <p
                                    v-if="form.errors.category_id"
                                    class="text-sm text-red-500"
                                >
                                    {{ form.errors.category_id }}
                                </p>
                            </div>
                            <div class="mb-4">
                                <div class="flex items-center bg-gray-200 pl-4">
                                    <label
                                        for="amount"
                                        class="inline-block font-bold text-xl bg-gray-200 text-indigo-500"
                                    >
                                        Rp
                                    </label>
                                    <input
                                        id="amount"
                                        v-model="form.amount"
                                        placeholder="0"
                                        type="text"
                                        class="w-full ml-4 border-0 bg-gray-200 focus:ring-0"
                                    />
                                </div>
                                <p
                                    v-if="form.errors.amount"
                                    class="text-sm text-red-500"
                                >
                                    {{ form.errors.amount }}
                                </p>
                            </div>
                            <div class="mb-4">
                                <div class="flex items-center">
                                    <label
                                        for="contact"
                                        class="block font-medium text-sm text-indigo-500"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="currentColor"
                                            class="w-8 h-8"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </label>
                                    <input
                                        id="contact"
                                        v-model="form.contact_name"
                                        :required="form.payment_method == 0"
                                        type="text"
                                        placeholder="Kontak Bisnis"
                                        class="w-full ml-4 border-0 border-b-2 border-indigo-300 focus:ring-0 shadow-sm"
                                    />
                                    <button
                                        type="button"
                                        class="ml-2 text-green-500"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-6 h-6"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
                                            />
                                        </svg>
                                    </button>
                                </div>
                                <p
                                    v-if="form.errors.contact_id"
                                    class="text-sm text-red-500"
                                >
                                    {{ form.errors.contact_id }}
                                </p>
                            </div>
                            <div class="mb-4">
                                <div class="flex items-center">
                                    <label
                                        for="description"
                                        class="block font-medium text-sm text-indigo-500"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="currentColor"
                                            class="w-8 h-8"
                                        >
                                            <path
                                                d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z"
                                            />
                                            <path
                                                d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z"
                                            />
                                        </svg>
                                    </label>
                                    <input
                                        id="description"
                                        v-model="form.description"
                                        type="text"
                                        placeholder="Tambahkan catatan"
                                        class="w-full ml-4 border-0 border-b-2 border-indigo-300 focus:ring-0 shadow-sm"
                                    />
                                </div>
                                <p
                                    v-if="form.errors.description"
                                    class="text-sm text-red-500"
                                >
                                    {{ form.errors.description }}
                                </p>
                            </div>
                            <div
                                class="mb-4 bg-gray-100 px-4 py-2"
                                v-if="cobacomputed"
                            >
                                <p class="text-medium uppercase">
                                    metode pembayaran
                                </p>
                            </div>
                            <div>
                                <input
                                    type="radio"
                                    v-model="form.payment_method"
                                    value="1"
                                    id="cash"
                                    class="m-4 focus:ring-0 rounded-full text-indigo-500"
                                />
                                <label for="cash" class="mr-4">Tunai</label>
                                <input
                                    type="radio"
                                    v-model="form.payment_method"
                                    value="0"
                                    id="noncash"
                                    class="m-4 focus:ring-0 rounded-full text-indigo-500"
                                />
                                <label for="noncash">Non tunai</label>
                                <p
                                    v-if="form.errors.payment_method"
                                    class="text-sm text-red-500"
                                >
                                    {{ form.errors.payment_method }}
                                </p>
                            </div>
                            <div v-if="form.payment_method == 0" class="mb-4">
                                <div class="mt-4 bg-gray-100 px-4 py-2">
                                    <p class="text-medium uppercase">
                                        Tanggal jatuh tempo
                                    </p>
                                </div>
                                <div class="flex items-center">
                                    <label
                                        for="due_date"
                                        class="block font-medium text-sm text-indigo-500"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="currentColor"
                                            class="w-8 h-8"
                                        >
                                            <path
                                                d="M12.75 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM7.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM8.25 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9.75 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM10.5 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12.75 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM14.25 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 13.5a.75.75 0 100-1.5.75.75 0 000 1.5z"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </label>
                                    <input
                                        v-model="form.due_date"
                                        :required="form.payment_method == 0"
                                        type="date"
                                        class="w-full ml-4 border-0 border-b-2 border-indigo-300 focus:ring-0 shadow-sm"
                                    />
                                </div>
                                <p
                                    v-if="form.errors.due_date"
                                    class="text-sm text-red-500"
                                >
                                    {{ form.errors.due_date }}
                                </p>
                            </div>
                        </div>
                        <div
                            class="flex items-center justify-end py-3 bg-gray-100 text-right sm:px-6 sm:rounded-bl-md sm:rounded-br-md"
                        >
                            <PrimaryButton
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                                >Simpan</PrimaryButton
                            >
                        </div>
                    </form>
                    <!-- {{ categories }} -->
                </div>
            </div>
        </div>
    </AppLayout>
</template>
