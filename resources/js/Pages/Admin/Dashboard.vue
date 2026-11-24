<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '../../Layouts/AdminLayout.vue';

defineProps({
    totalMenus: Number,
    totalCategories: Number,
});
</script>

<template>
    <Head title="Dashboard Admin" />

    <AdminLayout>
        <h1 class="mb-4 text-2xl font-bold">Dashboard</h1>

        <div class="grid grid-cols-2 gap-4">
            <Link href="/admin/menus" class="rounded-xl bg-white p-5 shadow">
                <p class="text-sm text-stone-500">Total Menu</p>
                <p class="text-3xl font-bold">{{ totalMenus }}</p>
            </Link>
            <Link href="/admin/categories" class="rounded-xl bg-white p-5 shadow">
                <p class="text-sm text-stone-500">Total Kategori</p>
                <p class="text-3xl font-bold">{{ totalCategories }}</p>
            </Link>
        </div>
    </AdminLayout>
</template>