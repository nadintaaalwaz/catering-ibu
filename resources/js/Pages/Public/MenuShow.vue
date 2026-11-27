<script setup>
import { computed, ref } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import PublicLayout from '../../Layouts/PublicLayout.vue';
import MenuCard from '../../Components/MenuCard.vue';
import { rupiah, waLink } from '../../utils.js';

const props = defineProps({
    menu: Object,
    related: Array,
});

const site = computed(() => usePage().props.site);

const qty = ref(props.menu.min_order);
const note = ref('');

const valid = computed(() => Number(qty.value) >= props.menu.min_order);
const total = computed(() => Number(qty.value || 0) * props.menu.price);

const order = computed(() => {
    let text = `Halo ${site.value?.business_name ?? ''}, saya ingin memesan:\n`;
    text += `- ${props.menu.name} x ${qty.value} (${rupiah(total.value)})\n`;
    if (note.value.trim()) {
        text += `\nCatatan: ${note.value.trim()}`;
    }
    return waLink(site.value, text);
});
</script>

<template>
    <Head :title="menu.name" />

    <PublicLayout>
        <Link href="/menu" class="mb-4 inline-block text-sm text-soga/70">&larr; Kembali ke menu</Link>

        <div class="grid gap-6 md:grid-cols-2">
            <div class="shoji-frame kisi-belakang relative aspect-4/3" style="--cols: 5; --rows: 4">
                <div class="relative z-10 h-full w-full p-5">
                    <img
                        v-if="menu.image_url"
                        :src="menu.image_url"
                        :alt="menu.name"
                        class="h-full w-full rounded-md object-cover shadow-xl ring-2 ring-kayu/60"
                    />
                    <div
                        v-else
                        class="flex h-full w-full items-center justify-center rounded-md bg-washi/70 text-soga/60 ring-2 ring-kayu/40"
                    >
                        Belum ada foto
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <p class="text-sm text-soga/60">{{ menu.category?.name }}</p>
                <h1 class="font-display text-3xl font-bold text-kon">{{ menu.name }}</h1>
                <p class="text-2xl font-bold text-torii">{{ rupiah(menu.price) }}</p>
                <p v-if="menu.description" class="whitespace-pre-line text-soga">
                    {{ menu.description }}
                </p>
                <p class="text-sm text-soga/60">Minimal pesan: {{ menu.min_order }}</p>

                <div
                    v-if="menu.is_available"
                    class="space-y-3 rounded-lg border border-soga/20 bg-kertas p-4 shadow-sm"
                >
                    <div>
                        <label class="mb-1 block text-sm font-medium">Jumlah</label>
                        <input
                            v-model="qty"
                            type="number"
                            :min="menu.min_order"
                            class="w-full rounded-lg border border-soga/30 bg-white px-3 py-2"
                        />
                        <p v-if="!valid" class="mt-1 text-sm text-torii">
                            Minimal pemesanan {{ menu.min_order }}.
                        </p>
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium">Catatan (opsional)</label>
                        <textarea
                            v-model="note"
                            rows="2"
                            class="w-full rounded-lg border border-soga/30 bg-white px-3 py-2"
                            placeholder="Tanggal acara, alamat antar, dll."
                        ></textarea>
                    </div>

                    <p class="text-sm">
                        Perkiraan total: <span class="font-bold">{{ rupiah(total) }}</span>
                    </p>

                    <a
                        v-if="valid"
                        :href="order"
                        target="_blank"
                        rel="noopener"
                        class="block rounded-lg bg-green-600 py-2 text-center font-medium text-white"
                    >
                        Pesan via WhatsApp
                    </a>
                    <span
                        v-else
                        class="block rounded-lg bg-stone-300 py-2 text-center font-medium text-stone-500"
                    >
                        Pesan via WhatsApp
                    </span>
                </div>

                <p v-else class="rounded-lg bg-torii/10 px-4 py-3 text-torii">
                    Maaf, menu ini sedang habis.
                </p>
            </div>
        </div>

        <section v-if="related.length" class="mt-10">
            <h2 class="mb-3 font-display text-xl font-bold text-kon">Menu lainnya</h2>
            <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
                <MenuCard v-for="m in related" :key="m.id" :menu="m" />
            </div>
        </section>
    </PublicLayout>
</template>