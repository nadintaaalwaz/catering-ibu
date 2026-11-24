<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

const props = defineProps({
    menu: Object,
    categories: Array,
});

const form = useForm({
    category_id: props.menu?.category_id ?? props.categories[0]?.id ?? '',
    name: props.menu?.name ?? '',
    description: props.menu?.description ?? '',
    price: props.menu?.price ?? '',
    min_order: props.menu?.min_order ?? 1,
    is_available: props.menu?.is_available ?? true,
    is_featured: props.menu?.is_featured ?? false,
    image: null,
});

const preview = ref(props.menu?.image_url ?? null);

const onFile = (e) => {
    const file = e.target.files[0];
    form.image = file ?? null;
    if (file) {
        preview.value = URL.createObjectURL(file);
    }
};

const submit = () => {
    if (props.menu) {
        // Upload file butuh POST + _method=put
        form
            .transform((data) => ({ ...data, _method: 'put' }))
            .post(`/admin/menus/${props.menu.id}`, { forceFormData: true });
    } else {
        form.post('/admin/menus', { forceFormData: true });
    }
};
</script>

<template>
    <Head :title="menu ? 'Ubah Menu' : 'Tambah Menu'" />

    <AdminLayout>
        <h1 class="mb-4 text-2xl font-bold">{{ menu ? 'Ubah Menu' : 'Tambah Menu' }}</h1>

        <form @submit.prevent="submit" class="max-w-2xl space-y-4 rounded-xl bg-white p-6 shadow">
            <div>
                <label class="mb-1 block text-sm font-medium">Kategori</label>
                <select
                    v-model="form.category_id"
                    class="w-full rounded-lg border border-stone-300 px-3 py-2"
                >
                    <option v-for="c in categories" :key="c.id" :value="c.id">{{ c.name }}</option>
                </select>
                <p v-if="form.errors.category_id" class="mt-1 text-sm text-red-600">
                    {{ form.errors.category_id }}
                </p>
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Nama menu</label>
                <input
                    v-model="form.name"
                    type="text"
                    class="w-full rounded-lg border border-stone-300 px-3 py-2"
                />
                <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Deskripsi</label>
                <textarea
                    v-model="form.description"
                    rows="3"
                    class="w-full rounded-lg border border-stone-300 px-3 py-2"
                    placeholder="Isi paket, ukuran, dll."
                ></textarea>
                <p v-if="form.errors.description" class="mt-1 text-sm text-red-600">
                    {{ form.errors.description }}
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="mb-1 block text-sm font-medium">Harga (Rp)</label>
                    <input
                        v-model="form.price"
                        type="number"
                        min="0"
                        class="w-full rounded-lg border border-stone-300 px-3 py-2"
                    />
                    <p v-if="form.errors.price" class="mt-1 text-sm text-red-600">{{ form.errors.price }}</p>
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium">Minimal pesan</label>
                    <input
                        v-model="form.min_order"
                        type="number"
                        min="1"
                        class="w-full rounded-lg border border-stone-300 px-3 py-2"
                    />
                    <p v-if="form.errors.min_order" class="mt-1 text-sm text-red-600">
                        {{ form.errors.min_order }}
                    </p>
                </div>
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Foto</label>
                <img
                    v-if="preview"
                    :src="preview"
                    alt="Pratinjau"
                    class="mb-2 h-40 w-40 rounded-lg object-cover"
                />
                <input
                    type="file"
                    accept="image/jpeg,image/png,image/webp"
                    @change="onFile"
                    class="block w-full text-sm"
                />
                <p class="mt-1 text-xs text-stone-500">JPG, PNG, atau WEBP, maksimal 4 MB.</p>
                <p v-if="form.errors.image" class="mt-1 text-sm text-red-600">{{ form.errors.image }}</p>
            </div>

            <div class="flex flex-wrap gap-6">
                <label class="flex items-center gap-2 text-sm">
                    <input v-model="form.is_available" type="checkbox" />
                    Tersedia
                </label>
                <label class="flex items-center gap-2 text-sm">
                    <input v-model="form.is_featured" type="checkbox" />
                    Tampilkan di beranda (unggulan)
                </label>
            </div>

            <div class="flex gap-3">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="rounded-lg bg-stone-800 px-4 py-2 text-white disabled:opacity-50"
                >
                    Simpan
                </button>
                <Link href="/admin/menus" class="rounded-lg border px-4 py-2">Batal</Link>
            </div>
        </form>
    </AdminLayout>
</template>