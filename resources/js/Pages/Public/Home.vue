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
        <!-- Hero: pola parang + jendela bulat -->
        <section class="overflow-hidden rounded-2xl border-2 border-emas/50">
            <div class="bg-parang grid items-center gap-8 px-6 py-10 md:grid-cols-[1fr_auto] md:px-10">
                <div class="text-washi">
                    <p class="text-sm tracking-widest text-emas">Sugeng Rawuh · ようこそ</p>
                    <h1 class="mt-2 font-display text-4xl font-bold">{{ site?.business_name }}</h1>
                    <p class="mt-3 max-w-xl text-washi/80">
                        {{ site?.about || 'Menerima pesanan kue dan nasi kotak untuk berbagai acara.' }}
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

                <div v-if="featured[0]?.image_url" class="mx-auto w-44 md:w-56">
                    <div class="marumado">
                        <img
                            :src="featured[0].image_url"
                            :alt="featured[0].name"
                            class="h-full w-full object-cover"
                        />
                    </div>
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