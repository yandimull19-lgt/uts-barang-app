<script setup>
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();

const menus = [
    { label: 'Dashboard', routeName: 'dashboard', pattern: 'dashboard' },
    { label: 'Data Barang', routeName: 'items.index', pattern: 'items.*' },
    { label: 'Tentang', routeName: 'tentang', pattern: 'tentang' },
];

const getRoute = (name) => (route().has(name) ? route(name) : '#');

const isCurrent = (pattern) => {
    try {
        return route().current(pattern);
    } catch (e) {
        return false;
    }
};
</script>

<template>
    <div class="flex min-h-screen bg-gray-100">
        <aside class="flex w-60 shrink-0 flex-col bg-slate-800 text-white">
            <div class="border-b border-slate-700 px-6 py-5 text-lg font-bold">
                Inventaris Kantor
            </div>

            <nav class="flex-1 space-y-1 px-3 py-4">
                <Link
                    v-for="menu in menus"
                    :key="menu.routeName"
                    :href="getRoute(menu.routeName)"
                    class="block rounded px-3 py-2 text-sm"
                    :class="isCurrent(menu.pattern) ? 'bg-slate-600 font-semibold' : 'hover:bg-slate-700'"
                >
                    {{ menu.label }}
                </Link>
            </nav>

            <div class="border-t border-slate-700 px-6 py-4 text-sm">
                <div class="mb-2">
                    {{ page.props.auth?.user?.name ?? 'Pengguna' }}
                </div>

                <Link
                    v-if="route().has('logout')"
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="text-red-300 hover:text-red-200"
                >
                    Logout
                </Link>
            </div>
        </aside>

        <main class="min-w-0 flex-1 p-8">
            <slot />
        </main>
    </div>
</template>