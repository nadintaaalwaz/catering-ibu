<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

defineProps({ categories: Array });

const remove = (category) => {
    if (confirm(`Hapus kategori "${category.name}"?`)) {
        router.delete(`/admin/categories/${category.id}`);
    }
};
</script>

<template>
    <Head title="Kategori" />

    <AdminLayout>
        <div class="mb-4 flex items-center justify-between">
            <h1 class="text-2xl font-bold">Kategori</h1>
            <Link
                href="/admin/categories/create"
                class="rounded-lg bg-stone-800 px-4 py-2 text-sm text-white"
            >
                + Tambah Kategori
            </Link>
        </div>

        <div class="overflow-x-auto rounded-xl bg-white shadow">
            <table class="w-full text-left text-sm">
                <thead class="border-b bg-stone-50 text-stone-500">
                    <tr>
                        <th class="px-4 py-3">Urutan</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Jumlah Menu</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="c in categories" :key="c.id" class="border-b last:border-0">
                        <td class="px-4 py-3">{{ c.sort_order }}</td>
                        <td class="px-4 py-3 font-medium">{{ c.name }}</td>
                        <td class="px-4 py-3">{{ c.menus_count }}</td>
                        <td class="px-4 py-3 text-right">
                            <Link :href="`/admin/categories/${c.id}/edit`" class="mr-3 text-blue-600">
                                Ubah
                            </Link>
                            <button type="button" @click="remove(c)" class="text-red-600">
                                Hapus
                            </button>
                        </td>
                    </tr>
                    <tr v-if="categories.length === 0">
                        <td colspan="4" class="px-4 py-6 text-center text-stone-500">
                            Belum ada kategori.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>