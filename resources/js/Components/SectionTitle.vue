<script setup>
defineProps({
    title: String,
    sub: String,
});
</script>

<template>
    <div class="mb-5">
        <h2 class="font-display text-2xl font-bold text-kon">{{ title }}</h2>
        <p v-if="sub" class="text-sm text-soga/70">{{ sub }}</p>
        <div class="ornamen mt-2 max-w-xs"><span class="text-xs">◆</span></div>
    </div>
</template>