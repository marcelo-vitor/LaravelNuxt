<script setup>
definePageMeta({
    middleware: 'guest'
});

const name = ref('');
const email = ref('');
const password = ref('');
const error = ref({});

const auth = useAuthStore();
const client = useSanctumClient();

async function handleRegister() {
    error.value = {};

    try {
        await client('/api/register', {
            method: 'POST',
            body: {
                name: name.value,
                email: email.value,
                password: password.value
            }
        });

        await auth.signIn({
            email: email.value,
            password: password.value
        });

        await navigateTo('/');
    } catch (e) {
        error.value = e.data;
    }
}

</script>

<template>
    <div class="bg-surface text-txt antialiased">
        <div class="flex min-h-screen items-center justify-center px-4">
            <div class="w-full max-w-sm space-y-8">
                <div class="text-center space-y-2">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-brand text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
                    </div>
                    <h1 class="text-2xl font-semibold tracking-tight">Criar conta</h1>
                    <p class="text-sm text-txt-muted">Preencha os dados abaixo para se cadastrar</p>
                </div>

                <form class="space-y-5 rounded-2xl border border-border-soft bg-surface-card p-6 shadow-sm">
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-medium">Nome completo</label>
                        <template v-if="error?.errors?.name">
                            <div class="text-sm text-red-600 rounded bg-red-50 px-2 py-1 mb-1">
                                {{ error.errors.name[0] }}
                            </div>
                        </template>
                        <input v-model="name" id="name" placeholder="Seu nome" class="flex h-10 w-full rounded-md border border-border-soft bg-surface px-3 py-2 text-sm placeholder:text-txt-muted focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2" />
                    </div>
                    <div class="space-y-2">
                        <label for="email" class="text-sm font-medium">E-mail</label>
                        <template v-if="error?.errors?.email">
                            <div class="text-sm text-red-600 rounded bg-red-50 px-2 py-1 mb-1">
                                {{ error.errors.email[0] }}
                            </div>
                        </template>
                        <input v-model="email" id="email" type="email" placeholder="seu@email.com" class="flex h-10 w-full rounded-md border border-border-soft bg-surface px-3 py-2 text-sm placeholder:text-txt-muted focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2" />
                    </div>
                    <div class="space-y-2">
                        <label for="password" class="text-sm font-medium">Senha</label>
                        <template v-if="error?.errors?.password">
                            <div class="text-sm text-red-600 rounded bg-red-50 px-2 py-1 mb-1">
                                {{ error.errors.password[0] }}
                            </div>
                        </template>
                        <input v-model="password" id="password" type="password" placeholder="••••••••" class="flex h-10 w-full rounded-md border border-border-soft bg-surface px-3 py-2 text-sm placeholder:text-txt-muted focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2" />
                    </div>
                    <button @click.prevent="handleRegister" class="w-full h-10 rounded-md bg-brand text-white text-sm font-medium hover:bg-brand/90 active:scale-[0.97] transition-transform">Cadastrar</button>
                </form>

                <p class="text-center text-sm text-txt-muted">
                    Já tem conta? <NuxtLink to="/login" class="font-medium text-brand hover:underline">Entrar</NuxtLink>
                </p>
            </div>
        </div>
    </div>
</template>