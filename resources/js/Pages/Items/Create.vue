<script setup>
import SidebarLayout from '@/Layouts/SidebarLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
const fields = [
    { key: 'kode_barang', label: 'Kode Barang', type: 'text' },
    { key: 'nama_barang', label: 'Nama Barang', type: 'text' },
    { key: 'kategori', label: 'Kategori', type: 'text' },
    { key: 'jumlah', label: 'Jumlah', type: 'number' },
    { key: 'lokasi_simpan', label: 'Lokasi Simpan', type: 'text' },
];
const form = useForm({
    kode_barang: '',
    nama_barang: '',
    kategori: '',
    jumlah: 0,
    lokasi_simpan: '',
});
const simpan = () => {
    form.post(route('items.store'));
};
</script>
<template>
    <Head title="Tambah Barang" />
    <SidebarLayout>
        <h1 class="mb-6 text-2xl font-bold text-gray-800">Tambah Barang</h1>
        <form @submit.prevent="simpan" class="max-w-xl space-y-4 rounded-lg bg-white p-6 shadow">
            <div v-for="f in fields" :key="f.key">
                <label class="block text-sm font-medium text-gray-700">{{ f.label }}</label>
                <input
                    v-model="form[f.key]"
                    :type="f.type"
                    class="mt-1 w-full rounded border-gray-300"
                />
                <p v-if="form.errors[f.key]" class="mt-1 text-sm text-red-600">
                    {{ form.errors[f.key] }}
                </p>
            </div>
            <div class="flex items-center gap-3">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="rounded bg-slate-800 px-4 py-2 text-sm text-white"
                >
                    Simpan
                </button>
                <Link :href="route('items.index')" class="text-sm text-gray-500">Batal</Link>
            </div>
        </form>
    </SidebarLayout>
</template>