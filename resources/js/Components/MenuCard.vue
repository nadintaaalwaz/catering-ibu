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
        <div class="shoji-frame kisi-belakang relative aspect-4/3" style="--cols: 4; --rows: 3">
            <!-- foto di depan kisi -->
            <div class="relative z-10 h-full w-full p-4">
                <img
                    v-if="menu.image_url"
                    :src="menu.image_url"
                    :alt="menu.name"
                    class="h-full w-full rounded-md object-cover shadow-lg ring-2 ring-kayu/60"
                />
                <div
                    v-else
                    class="flex h-full w-full items-center justify-center rounded-md bg-washi/70 text-sm text-soga/60 ring-2 ring-kayu/40"
                >
                    Belum ada foto
                </div>
            </div>

            <span
                v-if="!menu.is_available"
                class="absolute top-2 left-2 z-20 rounded-full bg-torii px-3 py-1 text-xs font-medium text-white"
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