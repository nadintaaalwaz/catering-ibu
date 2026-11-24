<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../Layouts/AdminLayout.vue';

const props = defineProps({ setting: Object });

const form = useForm({
    business_name: props.setting.business_name ?? '',
    whatsapp_number: props.setting.whatsapp_number ?? '',
    address: props.setting.address ?? '',
    opening_hours: props.setting.opening_hours ?? '',
    instagram_url: props.setting.instagram_url ?? '',
    about: props.setting.about ?? '',
});

const submit = () => form.put('/admin/settings', { preserveScroll: true });
</script>

<template>
    <Head title="Pengaturan" />

    <AdminLayout>
        <h1 class="mb-4 text-2xl font-bold">Pengaturan Usaha</h1>

        <form @submit.prevent="submit" class="max-w-2xl space-y-4 rounded-xl bg-white p-6 shadow">
            <div>
                <label class="mb-1 block text-sm font-medium">Nama usaha</label>
                <input
                    v-model="form.business_name"
                    type="text"
                    class="w-full rounded-lg border border-stone-300 px-3 py-2"
                />
                <p v-if="form.errors.business_name" class="mt-1 text-sm text-red-600">
                    {{ form.errors.business_name }}
                </p>
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Nomor WhatsApp</label>
                <input
                    v-model="form.whatsapp_number"
                    type="text"
                    class="w-full rounded-lg border border-stone-300 px-3 py-2"
                    placeholder="0812-3456-7890"
                />
                <p class="mt-1 text-xs text-stone-500">
                    Boleh diawali 0 atau +62, otomatis diubah ke format 62.
                </p>
                <p v-if="form.errors.whatsapp_number" class="mt-1 text-sm text-red-600">
                    {{ form.errors.whatsapp_number }}
                </p>
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Alamat</label>
                <textarea
                    v-model="form.address"
                    rows="2"
                    class="w-full rounded-lg border border-stone-300 px-3 py-2"
                ></textarea>
                <p v-if="form.errors.address" class="mt-1 text-sm text-red-600">{{ form.errors.address }}</p>
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Jam operasional</label>
                <input
                    v-model="form.opening_hours"
                    type="text"
                    class="w-full rounded-lg border border-stone-300 px-3 py-2"
                    placeholder="Senin - Sabtu, 07.00 - 17.00"
                />
                <p v-if="form.errors.opening_hours" class="mt-1 text-sm text-red-600">
                    {{ form.errors.opening_hours }}
                </p>
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Link Instagram</label>
                <input
                    v-model="form.instagram_url"
                    type="url"
                    class="w-full rounded-lg border border-stone-300 px-3 py-2"
                    placeholder="https://instagram.com/akun-kamu"
                />
                <p v-if="form.errors.instagram_url" class="mt-1 text-sm text-red-600">
                    {{ form.errors.instagram_url }}
                </p>
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Tentang usaha</label>
                <textarea
                    v-model="form.about"
                    rows="4"
                    class="w-full rounded-lg border border-stone-300 px-3 py-2"
                ></textarea>
                <p v-if="form.errors.about" class="mt-1 text-sm text-red-600">{{ form.errors.about }}</p>
            </div>

            <button
                type="submit"
                :disabled="form.processing"
                class="rounded-lg bg-stone-800 px-4 py-2 text-white disabled:opacity-50"
            >
                Simpan
            </button>
        </form>
    </AdminLayout>
</template>