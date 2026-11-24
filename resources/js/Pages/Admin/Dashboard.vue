<script setup>
import { Head, router } from '@inertiajs/vue3';

defineProps({
    totalMenus: Number,
    totalCategories: Number,
});

const logout = () => {
    router.post('/admin/logout');
};
</script>

<template>
    <Head title="Dashboard Admin" />

    <div class="mx-auto max-w-3xl p-6">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold">Dashboard Admin</h1>
            <button
                type="button"
                @click="logout"
                class="rounded-lg bg-stone-800 px-4 py-2 text-sm text-white"
            >
                Keluar
            </button>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="rounded-xl bg-white p-5 shadow">
                <p class="text-sm text-stone-500">Total Menu</p>
                <p class="text-3xl font-bold">{{ totalMenus }}</p>
            </div>
            <div class="rounded-xl bg-white p-5 shadow">
                <p class="text-sm text-stone-500">Total Kategori</p>
                <p class="text-3xl font-bold">{{ totalCategories }}</p>
            </div>
        </div>
    </div>
</template>