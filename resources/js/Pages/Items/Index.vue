<script setup>
import SidebarLayout from '@/Layouts/SidebarLayout.vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps({
    items: Array,
    search: String,
});

const page = usePage();
const flash = computed(() => page.props.flash);
const keyword = ref(props.search ?? '');

const cari = () => {
    router.get(
        route('items.index'),
        { search: keyword.value },
        { preserveState: true }
    );
};

const hapus = (item) => {
    if (confirm(`Hapus barang "${item.nama_barang}"?`)) {
        router.delete(route('items.destroy', item.id));
    }
};
</script>

<template>
    <Head title="Data Barang" />

    <SidebarLayout>
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">
                Data Barang
            </h1>

            <Link
                :href="route('items.create')"
                class="rounded bg-slate-800 px-4 py-2 text-sm text-white"
            >
                + Tambah Barang
            </Link>
        </div>

        <div
            v-if="flash.success"
            class="mb-4 rounded border border-green-300 bg-green-100 px-4 py-3 text-sm text-green-800"
        >
            {{ flash.success }}
        </div>

        <form @submit.prevent="cari" class="mb-4 flex gap-2">
            <input
                v-model="keyword"
                type="text"
                placeholder="Cari nama barang..."
                class="w-64 rounded border-gray-300 text-sm"
            />

            <button
                type="submit"
                class="rounded bg-teal-700 px-4 py-2 text-sm text-white"
            >
                Cari
            </button>
        </form>

        <div class="overflow-hidden rounded-lg bg-white shadow">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-200 text-gray-700">
                    <tr>
                        <th class="px-4 py-3">Kode</th>
                        <th class="px-4 py-3">Nama Barang</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Jumlah</th>
                        <th class="px-4 py-3">Lokasi</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr
                        v-for="item in items"
                        :key="item.id"
                        class="border-t"
                    >
                        <td class="px-4 py-3">{{ item.kode_barang }}</td>
                        <td class="px-4 py-3">{{ item.nama_barang }}</td>
                        <td class="px-4 py-3">{{ item.kategori }}</td>
                        <td class="px-4 py-3">{{ item.jumlah }}</td>
                        <td class="px-4 py-3">{{ item.lokasi_simpan }}</td>

                        <td class="flex gap-3 px-4 py-3">
                            <Link
                                :href="route('items.edit', item.id)"
                                class="text-blue-600"
                            >
                                Edit
                            </Link>

                            <button
                                @click="hapus(item)"
                                class="text-red-600"
                            >
                                Hapus
                            </button>
                        </td>
                    </tr>

                    <tr v-if="items.length === 0">
                        <td
                            colspan="6"
                            class="px-4 py-6 text-center text-gray-500"
                        >
                            Belum ada data barang.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </SidebarLayout>
</template>