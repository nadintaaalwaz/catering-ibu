<script setup>
import { computed } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';

const page = usePage();
const flash = computed(() => page.props.flash ?? {});

const logout = () => router.post('/admin/logout');
</script>

<template>
    <div class="min-h-screen bg-stone-100">
        <header class="navbar-gelap text-washi">
            <div class="mx-auto flex max-w-5xl flex-wrap items-center justify-between gap-3 px-4 py-3">
                <nav class="flex flex-wrap items-center gap-4 text-sm">
                    <span class="flex items-center gap-2">
                        <img
                            src="/images/logo.jpg"
                            alt="Logo"
                            class="h-8 w-8 rounded-full border border-emas object-cover"
                        />
                        <span class="font-display text-base font-bold text-emas">Admin</span>
                    </span>
                    <Link href="/admin" class="hover:text-emas">Dashboard</Link>
                    <Link href="/admin/categories" class="hover:text-emas">Kategori</Link>
                    <Link href="/admin/menus" class="hover:text-emas">Menu</Link>
                    <Link href="/admin/settings" class="hover:text-emas">Pengaturan</Link>
                    <a href="/" target="_blank" class="hover:text-emas">Lihat Web</a>
                </nav>
                <button
                    type="button"
                    @click="logout"
                    class="rounded-lg border border-emas/50 px-3 py-1.5 text-sm text-emas hover:bg-emas hover:text-black"
                >
                    Keluar
                </button>
            </div>
        </header>

        <main class="mx-auto max-w-5xl p-4">
            <div v-if="flash.success" class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-green-800">
                {{ flash.success }}
            </div>
            <div v-if="flash.error" class="mb-4 rounded-lg bg-red-100 px-4 py-3 text-red-800">
                {{ flash.error }}
            </div>

            <slot />
        </main>
    </div>
</template>