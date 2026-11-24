<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

defineProps({ menus: Array });

const rupiah = (n) => 'Rp ' + Number(n).toLocaleString('id-ID');

const toggle = (menu) => {
    router.patch(`/admin/menus/${menu.id}/toggle`, {}, { preserveScroll: true });
};

const remove = (menu) => {
    if (confirm(`Hapus menu "${menu.name}"?`)) {
        router.delete(`/admin/menus/${menu.id}`, { preserveScroll: true });
    }
};
</script>

<template>
    <Head title="Menu" />

    <AdminLayout>
        <div class="mb-4 flex items-center justify-between">
            <h1 class="text-2xl font-bold">Menu</h1>
            <Link
                href="/admin/menus/create"
                class="rounded-lg bg-stone-800 px-4 py-2 text-sm text-white"
            >
                + Tambah Menu
            </Link>
        </div>

        <div class="overflow-x-auto rounded-xl bg-white shadow">
            <table class="w-full text-left text-sm">
                <thead class="border-b bg-stone-50 text-stone-500">
                    <tr>
                        <th class="px-4 py-3">Foto</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3">Min. pesan</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="m in menus" :key="m.id" class="border-b last:border-0">
                        <td class="px-4 py-3">
                            <img
                                v-if="m.image_url"
                                :src="m.image_url"
                                :alt="m.name"
                                class="h-12 w-12 rounded-lg object-cover"
                            />
                            <div
                                v-else
                                class="flex h-12 w-12 items-center justify-center rounded-lg bg-stone-100 text-xs text-stone-400"
                            >
                                -
                            </div>
                        </td>
                        <td class="px-4 py-3 font-medium">
                            {{ m.name }}
                            <span v-if="m.is_featured" class="ml-1 text-xs text-amber-600">★ Unggulan</span>
                        </td>
                        <td class="px-4 py-3">{{ m.category?.name }}</td>
                        <td class="px-4 py-3">{{ rupiah(m.price) }}</td>
                        <td class="px-4 py-3">{{ m.min_order }}</td>
                        <td class="px-4 py-3">
                            <button
                                type="button"
                                @click="toggle(m)"
                                class="rounded-full px-3 py-1 text-xs font-medium"
                                :class="m.is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                            >
                                {{ m.is_available ? 'Tersedia' : 'Habis' }}
                            </button>
                        </td>
                        <td class="px-4 py-3 text-right whitespace-nowrap">
                            <Link :href="`/admin/menus/${m.id}/edit`" class="mr-3 text-blue-600">Ubah</Link>
                            <button type="button" @click="remove(m)" class="text-red-600">Hapus</button>
                        </td>
                    </tr>
                    <tr v-if="menus.length === 0">
                        <td colspan="7" class="px-4 py-6 text-center text-stone-500">Belum ada menu.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>