<script setup>
    import AppLayout from '../../Layouts/AppLayout.vue';
    import { Link } from '@inertiajs/inertia-vue3';
    import PrimaryButton from '../../Components/PrimaryButton.vue';

    defineProps({
        categories : Array
    })

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Kategori Transaksi
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <Link :href="route('category.create')" class="inline-block mb-4">
                        <PrimaryButton type="button">Tambah Kategori</PrimaryButton>
                    </Link>
                    <table class="w-full">
                        <thead>
                        <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                            <th class="px-4 py-3">Nama Kategori</th>
                            <th class="px-4 py-3">Deskripsi</th>
                            <th class="px-4 py-3">Tipe</th>
                            <th class="px-4 py-3">Non-Cash</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr v-for="transactionCategory in categories" :key="transactionCategory.id" class="text-gray-700">
                                <td class="px-4 py-3 font-semibold border">{{transactionCategory.category}}</td>
                                <td class="px-4 py-3 text-ms font-semibold border">{{transactionCategory.description}}</td>
                                <td class="px-4 py-3 border text-xs">
                                <span :class="[transactionCategory.type == 'income' ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100']"
                                class="px-2 py-1 font-semibold leading-tight  rounded">{{transactionCategory.type==='income' ?'Pemasukan' : 'Pengeluaran'}}</span>
                                </td>
                                <td class="px-4 py-3 text-sm border"><input type="checkbox" class="rounded focus:ring-0 text-indigo-500" :checked="transactionCategory.noncash"></td>
                                <td class="px-4 py-3 text-sm border">
                                    <Link :href="route('category.edit', transactionCategory.id)" class="mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block text-indigo-500 w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </Link>
                                    <Link :href="route('category.destroy',transactionCategory.id)"
                                        as="button"
                                        type="button"
                                        method="delete"
                                        class="mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block text-red-500 w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>