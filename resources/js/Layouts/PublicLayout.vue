<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { waLink } from '../utils.js';

const page = usePage();
const site = computed(() => page.props.site);
const isAdmin = computed(() => page.props.isAdmin);
const year = new Date().getFullYear();

const chat = computed(() =>
    waLink(site.value, `Halo ${site.value?.business_name ?? ''}, saya ingin bertanya tentang menu.`)
);
</script>

<template>
    <div class="flex min-h-screen flex-col">
        <!-- Navbar -->
        <header class="navbar-gelap text-washi">
            <div class="mx-auto flex max-w-5xl flex-wrap items-center justify-between gap-3 px-4 py-3">
                <Link href="/" class="flex items-center gap-3">
                    <img
                        src="/images/logo.jpg"
                        alt="Logo"
                        class="h-11 w-11 rounded-full border-2 border-emas object-cover shadow-[0_0_14px_rgba(242,185,75,0.6)]"
                    />
                    <span class="font-display text-xl font-bold tracking-wide text-emas">
                        {{ site?.business_name ?? 'Alwa Kue' }}
                    </span>
                </Link>
                <nav class="flex items-center gap-5 text-sm font-medium">
                    <Link href="/" class="hover:text-emas">Beranda</Link>
                    <Link href="/menu" class="hover:text-emas">Menu</Link>
                    <Link href="/kontak" class="hover:text-emas">Kontak</Link>
                    <Link
                        v-if="isAdmin"
                        href="/admin"
                        class="rounded bg-emas px-2 py-1 text-xs text-black"
                    >
                        Panel Admin
                    </Link>
                </nav>
            </div>
        </header>

        <main class="mx-auto w-full max-w-5xl flex-1 px-4 py-8">
            <slot />
        </main>

        <!-- Footer -->
        <footer class="footer-gelap text-washi/80">
            <div class="mx-auto grid max-w-5xl gap-6 px-4 py-8 text-sm md:grid-cols-[auto_1fr_auto]">
                <img
                    src="/images/logo.jpg"
                    alt="Logo"
                    class="h-16 w-16 rounded-full border-2 border-emas object-cover shadow-[0_0_16px_rgba(242,185,75,0.5)]"
                />

                <div class="space-y-1">
                    <p class="font-display text-lg font-bold text-emas">{{ site?.business_name }}</p>
                    <p class="text-washi/60">Aneka Kue | Nasi Kotak</p>
                    <p v-if="site?.address">{{ site.address }}</p>
                    <p v-if="site?.opening_hours">Buka: {{ site.opening_hours }}</p>
                </div>

                <div class="flex flex-col gap-1">
                    <Link href="/menu" class="hover:text-emas">Menu</Link>
                    <Link href="/kontak" class="hover:text-emas">Kontak</Link>
                    <a
                        v-if="site?.instagram_url"
                        :href="site.instagram_url"
                        target="_blank"
                        rel="noopener"
                        class="hover:text-emas"
                    >
                        Instagram
                    </a>
                </div>
            </div>
            <div class="border-t border-emas/20 py-3 text-center text-xs text-washi/50">
                &copy; {{ year }} {{ site?.business_name }}
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