<script setup>
import { ref, watch } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import PublicLayout from '../../Layouts/PublicLayout.vue';
import MenuCard from '../../Components/MenuCard.vue';
import SectionTitle from '../../Components/SectionTitle.vue';
const props = defineProps({
    menus: Array,
    categories: Array,
    filters: Object,
});

const q = ref(props.filters.q ?? '');
const category = ref(props.filters.category ?? '');

const apply = () => {
    router.get(
        '/menu',
        { category: category.value || undefined, q: q.value || undefined },
        { preserveState: true, preserveScroll: true, replace: true }
    );
};

const pick = (slug) => {
    category.value = slug;
    apply();
};

let timer;
watch(q, () => {
    clearTimeout(timer);
    timer = setTimeout(apply, 400);
});
</script>

<template>
    <Head title="Menu" />

    <PublicLayout>
        <SectionTitle title="Menu" sub="お品書き · Daftar menu kami" />

        <input
            v-model="q"
            type="search"
            placeholder="Cari menu..."
            class="mb-4 w-full rounded-lg border border-stone-300 bg-kertas px-4 py-2"
        />

        <div class="mb-6 flex flex-wrap gap-2">
            <button
                type="button"
                @click="pick('')"
                class="rounded-full border px-4 py-1.5 text-sm"
                :class="category === '' ? 'bg-kon text-washi' : 'bg-kertas'"
            >
                Semua
            </button>
            <button
                v-for="c in categories"
                :key="c.id"
                type="button"
                @click="pick(c.slug)"
                class="rounded-full border px-4 py-1.5 text-sm"
                :class="category === c.slug ? 'bg-kon text-washi' : 'bg-kertas'"
            >
                {{ c.name }}
            </button>
        </div>

        <div v-if="menus.length" class="grid grid-cols-2 gap-4 md:grid-cols-3">
            <MenuCard v-for="m in menus" :key="m.id" :menu="m" />
        </div>
        <p v-else class="py-10 text-center text-stone-500">Menu tidak ditemukan.</p>
    </PublicLayout>
</template>