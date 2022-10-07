<script setup>
    import AppLayout from '../../Layouts/AppLayout.vue';
    import { Link, useForm } from '@inertiajs/inertia-vue3';
    import PrimaryButton from '../../Components/PrimaryButton.vue';
    import SecondaryButton from '../../Components/SecondaryButton.vue';
    const form = useForm({
        name: null,
        phone: null,
        address: null,
        notes: null,
    })

    const store = ()=>{
        form.post(route('contact.store'), {
        errorBag: 'createContact',
        preserveScroll: true,
    })
    }
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tambah Data Kontak
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <Link :href="route('contact.index')" class="inline-block mb-4">
                        <SecondaryButton type="button">&laquo Kembali</SecondaryButton>
                    </Link>
                    <hr>
                    <form @submit.prevent="store" class="mt-4">
                        <div class="px-8">
                            <div class="mb-2">
                                <label for="name" class="block font-medium text-sm text-gray-700">Nama</label>
                                <input v-model="form.name" type="text" class="w-full md:w-1/2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"/>
                                <p v-if="form.errors.name" class="text-sm text-red-500">{{form.errors.name}}</p>
                            </div>
                            <div class="mb-2">
                                <label for="phone" class="block font-medium text-sm text-gray-700">Telepon</label>
                                <input v-model="form.phone" type="text" class="w-full md:w-1/2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"/>
                                <p v-if="form.errors.phone" class="text-sm text-red-500">{{form.errors.phone}}</p>
                            </div>
                            <div class="mb-2">
                                <label for="address" class="block font-medium text-sm text-gray-700">Alamat</label>
                                <textarea v-model="form.address" class="w-full md:w-1/2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                                <p v-if="form.errors.address" class="text-sm text-red-500">{{form.errors.address}}</p>
                            </div>
                            <div class="mb-2">
                                <label for="notes" class="block font-medium text-sm text-gray-700">Catatan</label>
                                <input v-model="form.notes" type="text" placeholder="Opsional" class="w-full md:w-1/2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"/>
                                <p v-if="form.errors.notes" class="text-sm text-red-500">{{form.errors.notes}}</p>
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