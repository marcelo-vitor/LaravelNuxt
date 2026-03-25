<script setup lang="ts">

definePageMeta({
    middleware: 'guest'
});

const email = ref('branson.quigley@example.net');
const password = ref('password');
const error = ref('');

const auth = useAuthStore();

async function handleLogin() {
    error.value = '';

    try {
        await auth.signIn({
            email: email.value,
            password: password.value
        });

        await navigateTo('/');
    } catch (e) {
        error.value = 'Credenciais inválidas';
    }
}
</script>

<template>
    <div class="bg-surface text-txt antialiased">
        <div class="flex min-h-screen items-center justify-center px-4">
            <div class="w-full max-w-sm space-y-8">
            <div class="text-center space-y-2">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-brand text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                </div>
                <h1 class="text-2xl font-semibold tracking-tight">Entrar</h1>
                <p class="text-sm text-txt-muted">Acesse sua conta para continuar</p>
            </div>

            <p v-if="error" class="rounded-md border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-700">
                {{ error }}
            </p>

            <form class="space-y-5 rounded-2xl border border-border-soft bg-surface-card p-6 shadow-sm">
                <div class="space-y-2">
                <label for="email" class="text-sm font-medium">E-mail</label>
                <input v-model="email" placeholder="seu@email.com" class="flex h-10 w-full rounded-md border border-border-soft bg-surface px-3 py-2 text-sm placeholder:text-txt-muted focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2" />
                </div>
                <div class="space-y-2">
                <label for="password" class="text-sm font-medium">Senha</label>
                <input v-model="password" type="password" placeholder="••••••••" class="flex h-10 w-full rounded-md border border-border-soft bg-surface px-3 py-2 text-sm placeholder:text-txt-muted focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2" />
                </div>
                <button @click.prevent="handleLogin" class="w-full h-10 rounded-md bg-brand text-white text-sm font-medium hover:bg-brand/90 active:scale-[0.97] transition-transform">Entrar</button>
            </form>

            <p class="text-center text-sm text-txt-muted">
                Não tem conta?? <NuxtLink to="/register" class="font-medium text-brand hover:underline">Cadastre-se</NuxtLink>
            </p>
            </div>
        </div>
    </div>
</template>
