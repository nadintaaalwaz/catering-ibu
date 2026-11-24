<script setup>
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post('/admin/login', {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Login Admin" />

    <div class="flex min-h-screen items-center justify-center bg-stone-100 p-4">
        <form
            @submit.prevent="submit"
            class="w-full max-w-sm space-y-4 rounded-xl bg-white p-6 shadow"
        >
            <h1 class="text-center text-2xl font-bold">Login Admin</h1>

            <div>
                <label class="mb-1 block text-sm font-medium">Email</label>
                <input
                    v-model="form.email"
                    type="email"
                    class="w-full rounded-lg border border-stone-300 px-3 py-2"
                    autofocus
                />
                <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">
                    {{ form.errors.email }}
                </p>
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Password</label>
                <input
                    v-model="form.password"
                    type="password"
                    class="w-full rounded-lg border border-stone-300 px-3 py-2"
                />
                <p v-if="form.errors.password" class="mt-1 text-sm text-red-600">
                    {{ form.errors.password }}
                </p>
            </div>

            <label class="flex items-center gap-2 text-sm">
                <input v-model="form.remember" type="checkbox" />
                Ingat saya
            </label>

            <button
                type="submit"
                :disabled="form.processing"
                class="w-full rounded-lg bg-stone-800 py-2 font-medium text-white disabled:opacity-50"
            >
                Masuk
            </button>
        </form>
    </div>
</template>