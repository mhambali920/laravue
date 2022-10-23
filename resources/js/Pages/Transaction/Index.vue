<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import { onMounted } from "vue";

defineProps({
    transactions: Object,
});
const form = useForm();
const deleteTransaction = (id) => {
    if (confirm("anjeun yakin bade ngahapus iye data ?"))
        form.delete(route("transaction.destroy", id), {
            errorBag: "deleteTransaction",
        });
};
const formatDate = (dateString) => {
    const date = new Date(dateString);
    return new Intl.DateTimeFormat("id-ID", { dateStyle: "full" }).format(date);
};
onMounted(() => console.log("mounted"));
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Daftar Transaksi
            </h2>
        </template>

        <div class="block md:flex lg:px-8 py-12">
            <div class="w-full md:w-7/12 sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4"
                >
                    <Link
                        :href="route('transaction.create')"
                        class="inline-block mb-4"
                    >
                        <PrimaryButton type="button"
                            >Tambah Transaksi</PrimaryButton
                        >
                    </Link>
                    <div
                        class="mb-8"
                        v-for="(transaction, index) in transactions"
                        :key="index"
                    >
                        <div
                            class="flex items-center justify-between mt-4 border-b-2 border-indigo-400"
                        >
                            <p class="text-lg font-bold">
                                {{ formatDate(index) }}
                            </p>
                            <p class="text-lg font-bold">Rp 258.000</p>
                        </div>
                        <div class="px-4">
                            <div
                                v-for="item in transaction"
                                :key="item.id"
                                class="border p-2 my-2"
                            >
                                <div
                                    class="flex items-center justify-between mb-2"
                                >
                                    <p class="font-bold text-gray-700">
                                        {{ item.r_category.category }}
                                    </p>
                                    <p class="font-bold text-gray-700">
                                        {{ item.amount }}
                                    </p>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-400 font-bold">
                                        {{ item.description }} dari
                                        {{ item.contact_name }}
                                    </p>
                                    <div class="flex">
                                        <a
                                            href=""
                                            class="text-xs rounded px-2.5 py-0.5 font-semibold bg-indigo-100 text-indigo-700"
                                            >Edit</a
                                        >
                                        <button
                                            @click="deleteTransaction(item.id)"
                                            class="text-xs rounded px-2.5 py-0.5 font-semibold bg-red-100 text-red-700 ml-4"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-5/12 sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4"
                >
                    ini nanti buat diagram
                </div>
            </div>
        </div>
    </AppLayout>
</template>
