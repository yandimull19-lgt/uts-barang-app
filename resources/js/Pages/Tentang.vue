<script setup>
import SidebarLayout from '@/Layouts/SidebarLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>
<template>

    <Head title="Tentang" />
    <SidebarLayout>
        <h1 class="mb-6 text-2xl font-bold text-gray-800">Tentang Aplikasi</h1>
        <div class="max-w-2xl space-y-2 rounded-lg bg-white p-6 text-gray-700 shadow">
            <p>Sistem Informasi Inventaris Barang Kantor.</p>
            <p>Dibuat untuk UTS Pemrograman Web II (SIM534).</p>
            <p>Dibangun dengan Laravel, Inertia, dan Vue.</p>
        </div>
    </SidebarLayout>
</template>