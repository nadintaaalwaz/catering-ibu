<script setup>
import { computed } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import PublicLayout from '../../Layouts/PublicLayout.vue';
import { waLink } from '../../utils.js';

const site = computed(() => usePage().props.site);

const chat = computed(() =>
    waLink(site.value, `Halo ${site.value?.business_name ?? ''}, saya ingin bertanya.`)
);
</script>

<template>
    <Head title="Kontak" />

    <PublicLayout>
        <h1 class="mb-4 text-2xl font-bold">Kontak</h1>

        <div class="max-w-xl space-y-4 rounded-xl bg-kertas p-6 shadow">
            <div v-if="site?.address">
                <p class="text-sm text-stone-500">Alamat</p>
                <p>{{ site.address }}</p>
            </div>
            <div v-if="site?.opening_hours">
                <p class="text-sm text-stone-500">Jam operasional</p>
                <p>{{ site.opening_hours }}</p>
            </div>
            <div v-if="site?.instagram_url">
                <p class="text-sm text-stone-500">Instagram</p>
                <a :href="site.instagram_url" target="_blank" rel="noopener" class="underline">
                    {{ site.instagram_url }}
                </a>
            </div>

            <a
                :href="chat"
                target="_blank"
                rel="noopener"
                class="inline-block rounded-lg bg-green-600 px-5 py-2 font-medium text-white"
            >
                Chat via WhatsApp
            </a>
        </div>
    </PublicLayout>
</template>