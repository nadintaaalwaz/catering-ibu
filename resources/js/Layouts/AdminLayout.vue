<script setup>
import { computed } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';

const page = usePage();
const flash = computed(() => page.props.flash ?? {});

const logout = () => router.post('/admin/logout');
</script>

<template>
    <div class="min-h-screen bg-stone-100">
        <header class="bg-stone-800 text-white">
            <div class="mx-auto flex max-w-5xl flex-wrap items-center justify-between gap-3 px-4 py-3">
                <nav class="flex flex-wrap items-center gap-4 text-sm">
                    <span class="font-bold">Dapur Ibu</span>
                    <Link href="/admin">Dashboard</Link>
                    <Link href="/admin/categories">Kategori</Link>
                    <Link href="/admin/menus">Menu</Link>
                    <a href="/" target="_blank">Lihat Web</a>
                </nav>
                <button
                    type="button"
                    @click="logout"
                    class="rounded-lg bg-white/10 px-3 py-1.5 text-sm hover:bg-white/20"
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