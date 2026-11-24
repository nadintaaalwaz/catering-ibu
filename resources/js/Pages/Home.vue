<script setup>
defineProps({ nama: String });
</script>

<template>
    <div class="p-10 text-center">
        <h1 class="text-3xl font-bold">Halo, {{ nama }}!</h1>
        <p>Vue + Inertia + Laravel sudah jalan.</p>
    </div>
</template>