<script setup>
import { Link } from '@inertiajs/vue3';
import { rupiah } from '../utils.js';

defineProps({ menu: Object });
</script>

<template>
    <Link
        :href="`/menu/${menu.slug}`"
        class="block overflow-hidden rounded-xl bg-white shadow transition hover:shadow-md"
    >
        <div class="relative aspect-4/3 bg-stone-100">
            <img
                v-if="menu.image_url"
                :src="menu.image_url"
                :alt="menu.name"
                class="h-full w-full object-cover"
            />
            <div v-else class="flex h-full items-center justify-center text-sm text-stone-400">
                Belum ada foto
            </div>
            <span
                v-if="!menu.is_available"
                class="absolute top-2 left-2 rounded-full bg-red-600 px-3 py-1 text-xs font-medium text-white"
            >
                Habis
            </span>
        </div>

        <div class="space-y-1 p-4">
            <p class="text-xs text-stone-500">{{ menu.category?.name }}</p>
            <h3 class="font-semibold">{{ menu.name }}</h3>
            <p class="font-bold text-amber-700">{{ rupiah(menu.price) }}</p>
            <p v-if="menu.min_order > 1" class="text-xs text-stone-500">
                Min. pesan {{ menu.min_order }}
            </p>
        </div>
    </Link>
</template>