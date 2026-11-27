<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { waLink } from '../utils.js';

const page = usePage();
const site = computed(() => page.props.site);
const isAdmin = computed(() => page.props.isAdmin);

const chat = computed(() =>
    waLink(site.value, `Halo ${site.value?.business_name ?? ''}, saya ingin bertanya tentang menu.`)
);
</script>

<template>
    <div class="flex min-h-screen flex-col">
        <header class="bg-kon text-washi">
            <div class="mx-auto flex max-w-5xl flex-wrap items-center justify-between gap-3 px-4 py-3">
                <Link href="/" class="font-display text-xl font-bold tracking-wide text-emas">
                    {{ site?.business_name ?? 'Dapur Ibu' }}
                </Link>
                <nav class="flex items-center gap-5 text-sm font-medium">
                    <Link href="/" class="hover:text-emas">Beranda</Link>
                    <Link href="/menu" class="hover:text-emas">Menu</Link>
                    <Link href="/kontak" class="hover:text-emas">Kontak</Link>
                    <Link
                        v-if="isAdmin"
                        href="/admin"
                        class="rounded bg-emas px-2 py-1 text-xs text-kon"
                    >
                        Panel Admin
                    </Link>
                </nav>
            </div>
        </header>
        <div class="bg-parang h-3 border-y border-emas/40"></div>

        <main class="mx-auto w-full max-w-5xl flex-1 px-4 py-8">
            <slot />
        </main>

        <div class="bg-parang h-3 border-y border-emas/40"></div>
        <footer class="bg-kon text-washi/80">
            <div class="mx-auto max-w-5xl space-y-1 px-4 py-6 text-sm">
                <p class="font-display text-lg font-bold text-emas">{{ site?.business_name }}</p>
                <p v-if="site?.address">{{ site.address }}</p>
                <p v-if="site?.opening_hours">Buka: {{ site.opening_hours }}</p>
                <p v-if="site?.instagram_url">
                    <a :href="site.instagram_url" target="_blank" rel="noopener" class="underline">
                        Instagram
                    </a>
                </p>
            </div>
        </footer>

        <!-- Tombol WhatsApp mengambang -->
        <a
            :href="chat"
            target="_blank"
            rel="noopener"
            class="fixed right-4 bottom-4 rounded-full bg-green-600 px-5 py-3 text-sm font-semibold text-white shadow-lg hover:bg-green-700"
        >
            Chat WhatsApp
        </a>
    </div>
</template>