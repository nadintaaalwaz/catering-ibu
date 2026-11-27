<script setup>
import { computed } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import PublicLayout from '../../Layouts/PublicLayout.vue';
import MenuCard from '../../Components/MenuCard.vue';
import { waLink } from '../../utils.js';

defineProps({
    featured: Array,
    categories: Array,
});

const site = computed(() => usePage().props.site);

const order = computed(() =>
    waLink(site.value, `Halo ${site.value?.business_name ?? ''}, saya ingin memesan.`)
);
</script>

<template>
    <Head title="Beranda" />

    <PublicLayout>
        <!-- Hero -->
        <section class="rounded-2xl bg-stone-800 px-6 py-12 text-center text-white">
            <h1 class="text-3xl font-bold">{{ site?.business_name }}</h1>
            <p class="mx-auto mt-3 max-w-xl text-stone-300">
                {{ site?.about || 'Menerima pesanan kue dan nasi kotak untuk berbagai acara.' }}
            </p>
            <div class="mt-6 flex flex-wrap justify-center gap-3">
                <Link href="/menu" class="rounded-lg bg-white px-5 py-2 font-medium text-stone-800">
                    Lihat Menu
                </Link>
                <a
                    :href="order"
                    target="_blank"
                    rel="noopener"
                    class="rounded-lg bg-green-600 px-5 py-2 font-medium text-white"
                >
                    Pesan via WhatsApp
                </a>
            </div>
        </section>

        <!-- Kategori -->
        <section class="mt-8">
            <h2 class="mb-3 text-xl font-bold">Kategori</h2>
            <div class="flex flex-wrap gap-3">
                <Link
                    v-for="c in categories"
                    :key="c.id"
                    :href="`/menu?category=${c.slug}`"
                    class="rounded-full border bg-white px-4 py-2 text-sm"
                >
                    {{ c.name }} ({{ c.menus_count }})
                </Link>
            </div>
        </section>

        <!-- Menu unggulan -->
        <section class="mt-8">
            <h2 class="mb-3 text-xl font-bold">Menu Unggulan</h2>
            <div v-if="featured.length" class="grid grid-cols-2 gap-4 md:grid-cols-3">
                <MenuCard v-for="m in featured" :key="m.id" :menu="m" />
            </div>
            <p v-else class="text-stone-500">Belum ada menu unggulan.</p>
        </section>
    </PublicLayout>
</template>