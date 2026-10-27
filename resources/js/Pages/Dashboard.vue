<script setup>
import SidebarLayout from '@/Layouts/SidebarLayout.vue';
import { Head } from '@inertiajs/vue3';
defineProps({
    totalJenis: Number,
    totalStok: Number,
});
</script>
<template>
    <Head title="Dashboard" />
    <SidebarLayout>
        <h1 class="mb-6 text-2xl font-bold text-gray-800">Dashboard</h1>
        <div class="grid max-w-2xl grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="rounded-lg bg-white p-6 shadow">
                <p class="text-sm text-gray-500">Total Jenis Barang</p>
                <p class="mt-2 text-3xl font-bold text-slate-800">{{ totalJenis }}</p>
            </div>
            <div class="rounded-lg bg-white p-6 shadow">
                <p class="text-sm text-gray-500">Total Stok (unit)</p>
                <p class="mt-2 text-3xl font-bold text-slate-800">{{ totalStok }}</p>
            </div>
        </div>
    </SidebarLayout>
</template>