<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

const props = defineProps({ category: Object });

const form = useForm({
    name: props.category?.name ?? '',
    sort_order: props.category?.sort_order ?? 0,
});

const submit = () => {
    if (props.category) {
        form.put(`/admin/categories/${props.category.id}`);
    } else {
        form.post('/admin/categories');
    }
};
</script>

<template>
    <Head :title="category ? 'Ubah Kategori' : 'Tambah Kategori'" />

    <AdminLayout>
        <h1 class="mb-4 text-2xl font-bold">
            {{ category ? 'Ubah Kategori' : 'Tambah Kategori' }}
        </h1>

        <form @submit.prevent="submit" class="max-w-md space-y-4 rounded-xl bg-white p-6 shadow">
            <div>
                <label class="mb-1 block text-sm font-medium">Nama kategori</label>
                <input
                    v-model="form.name"
                    type="text"
                    class="w-full rounded-lg border border-stone-300 px-3 py-2"
                    autofocus
                />
                <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Urutan tampil</label>
                <input
                    v-model="form.sort_order"
                    type="number"
                    min="0"
                    class="w-full rounded-lg border border-stone-300 px-3 py-2"
                />
                <p class="mt-1 text-xs text-stone-500">Angka kecil tampil lebih dulu.</p>
                <p v-if="form.errors.sort_order" class="mt-1 text-sm text-red-600">
                    {{ form.errors.sort_order }}
                </p>
            </div>

            <div class="flex gap-3">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="rounded-lg bg-stone-800 px-4 py-2 text-white disabled:opacity-50"
                >
                    Simpan
                </button>
                <Link href="/admin/categories" class="rounded-lg border px-4 py-2">Batal</Link>
            </div>
        </form>
    </AdminLayout>
</template>
