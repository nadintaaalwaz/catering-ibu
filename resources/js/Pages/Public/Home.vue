<script setup>
import { computed } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import PublicLayout from '../../Layouts/PublicLayout.vue';
import MenuCard from '../../Components/MenuCard.vue';
import SectionTitle from '../../Components/SectionTitle.vue';
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
        <!-- Hero: latar batik kawung + jendela shoji -->
        <section class="relative overflow-hidden rounded-xl border-2 border-emas/50">
            <div class="bg-kawung absolute inset-0"></div>
            <div class="absolute inset-0 bg-linear-to-r from-black/85 via-black/60 to-black/30"></div>

            <div class="relative grid items-center gap-8 px-6 py-10 md:grid-cols-[1fr_auto] md:px-10">
                <div class="text-washi">
                    <p class="text-sm tracking-widest text-emas">Sugeng Rawuh · ようこそ</p>
                    <h1 class="mt-2 font-display text-4xl font-bold">{{ site?.business_name }}</h1>
                    <p class="mt-3 max-w-xl text-washi/85">
                        {{ site?.about || 'Aneka kue dan nasi kotak untuk berbagai acara.' }}
                    </p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <Link href="/menu" class="rounded-lg bg-torii px-5 py-2 font-medium text-white">
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
                </div>

                <!-- Jendela: kumiko | shoji (logo + lampu) | kumiko -->
                <div class="jendela mx-auto w-60 md:w-72">
                    <div class="kumiko"></div>

                    <div class="shoji-frame aspect-3/4 flex-1" style="--cols: 2; --rows: 3">
                        <!-- sinar lampu di belakang logo -->
                        <div class="lampu"></div>

                        <!-- logo di depan kisi-kisi -->
                        <div class="relative z-10 flex h-full w-full items-center justify-center p-5">
                            <img
                                src="/images/logo.jpg"
                                alt="Logo Alwa Kue"
                                class="aspect-square w-full rounded-full object-cover shadow-2xl"
                            />
                        </div>
                    </div>

                    <div class="kumiko"></div>
                </div>
            </div>
        </section>

        <!-- Kategori -->
        <section class="mt-10">
            <SectionTitle title="Kategori" sub="Pilih sesuai kebutuhan acaramu" />
            <div class="flex flex-wrap gap-3">
                <Link
                    v-for="c in categories"
                    :key="c.id"
                    :href="`/menu?category=${c.slug}`"
                    class="rounded-full border border-soga/30 bg-kertas px-4 py-2 text-sm hover:border-emas"
                >
                    {{ c.name }} ({{ c.menus_count }})
                </Link>
            </div>
        </section>

        <!-- Menu unggulan -->
        <section class="mt-10">
            <SectionTitle title="Menu Unggulan" sub="人気のお品 · Favorit pelanggan" />
            <div v-if="featured.length" class="grid grid-cols-2 gap-4 md:grid-cols-3">
                <MenuCard v-for="m in featured" :key="m.id" :menu="m" />
            </div>
            <p v-else class="text-soga/60">Belum ada menu unggulan.</p>
        </section>
    </PublicLayout>
</template>