<script setup>
import { Link } from '@inertiajs/vue3';
import { rupiah } from '../utils.js';

defineProps({ menu: Object });
</script>

<template>
    <Link
        :href="`/menu/${menu.slug}`"
        class="block overflow-hidden rounded-lg border border-soga/20 bg-kertas shadow-sm transition hover:shadow-md"
    >
        <div class="shoji-frame relative aspect-4/3 bg-washi" style="--cols: 3; --rows: 2">
            <img
                v-if="menu.image_url"
                :src="menu.image_url"
                :alt="menu.name"
                class="h-full w-full object-cover"
            />
            <div v-else class="flex h-full items-center justify-center text-sm text-soga/50">
                Belum ada foto
            </div>
            <span
                v-if="!menu.is_available"
                class="absolute top-2 left-2 z-10 rounded-full bg-torii px-3 py-1 text-xs font-medium text-white"
            >
                Habis
            </span>
        </div>

        <div class="space-y-1 p-4">
            <p class="text-xs text-soga/60">{{ menu.category?.name }}</p>
            <h3 class="font-display text-lg leading-tight">{{ menu.name }}</h3>
            <p class="font-bold text-torii">{{ rupiah(menu.price) }}</p>
            <p v-if="menu.min_order > 1" class="text-xs text-soga/60">
                Min. pesan {{ menu.min_order }}
            </p>
        </div>
    </Link>
</template>