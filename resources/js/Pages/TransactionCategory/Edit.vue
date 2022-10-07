<script setup>
    import AppLayout from '../../Layouts/AppLayout.vue';
    import { Link,useForm } from '@inertiajs/inertia-vue3';
    import PrimaryButton from '../../Components/PrimaryButton.vue';
    import SecondaryButton from '../../Components/SecondaryButton.vue';

    const props = defineProps({
        transactionCategory: Object
    })
    const form = useForm({
        category: props.transactionCategory?.category,
        description: props.transactionCategory?.description,
        type: props.transactionCategory?.type,
        noncash: props.transactionCategory?.noncash
    })

    const store = ()=>{
        form.put(route('category.update',props.transactionCategory), {
        errorBag: 'createCategory',
        preserveScroll: true,
    })
    }
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Kategori
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <Link :href="route('category.index')" class="inline-block mb-4">
                        <SecondaryButton type="button">&laquo Kembali</SecondaryButton>
                    </Link>
                    <hr>
                    <form @submit.prevent="store" class="mt-4">
                        <div class="px-8">
                            <div class="mb-2">
                                <label for="category" class="block font-medium text-sm text-gray-700">Nama Kategori</label>
                                <input v-model="form.category" type="text" class="w-full md:w-1/2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"/>
                                <p v-if="form.errors.category" class="text-sm text-red-500">{{form.errors.category}}</p>
                            </div>
                            <div class="mb-2">
                                <label for="description" class="block font-medium text-sm text-gray-700">Deskripsi</label>
                                <textarea v-model="form.description" class="w-full md:w-1/2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                                <p v-if="form.errors.description" class="text-sm text-red-500">{{form.errors.description}}</p>
                            </div>
                            <div class="mb-4">
                                <label for="type" class="block font-medium text-sm text-gray-700">Tipe Kategori</label>
                                <select v-model="form.type" id="type" class="w-full md:w-1/2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                    <option disabled selected>-- Pilih tipe --</option>
                                    <option value="income">Pemasukan</option>
                                    <option value="expense">Pengeluaran</option>
                                </select>
                                <p v-if="form.errors.type" class="text-sm text-red-500">{{form.errors.type}}</p>
                            </div>
                            <div class="mb-2">
                                <p class="block font-medium text-sm text-gray-700">Perbolehkan transaksi non-tunai ?</p>
                                <input type="radio" v-model="form.noncash" value="1" id="cash" class="m-4 focus:ring-0 rounded-sm text-indigo-500">
                                <label for="cash" class="mr-4">Ya</label>
                                <input type="radio" v-model="form.noncash" value="0" id="noncash" class="m-4 focus:ring-0 rounded-sm text-indigo-500">
                                <label for="noncash">Tidak</label>
                            </div>
                        </div>
                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 sm:rounded-bl-md sm:rounded-br-md">
                            <PrimaryButton  :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Simpan</PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>