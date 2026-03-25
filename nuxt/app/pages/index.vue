<script setup>

definePageMeta({
    middleware: ['auth']
});

import { useAuthStore } from '~/stores/auth'

const auth = useAuthStore();
const router = useRouter();
const route = useRoute();

async function handleLogout() {
    try {
        await auth.signOut();
    } finally {
        return navigateTo('/login');
    }
}

const { data:users, status } = await useLazySanctumFetch('/api/users', {
    query: {...route.query}
});

const currentPage = ref(route.query.page ?? 1);

async function goToPage(page) {
    currentPage.value = page;
    status.value = 'pending';
    users.value = {};
    router.replace({
        query: {
            ...route.query,
            page
        }
    });

    await useLazySanctumFetch(`/api/users?page=${page}`).then(res => {
        users.value = res.data.value;
        status.value = res.status.value;
    });
}

const filters = ref({
    id: route.query.id ?? '',
    name: route.query.name ?? '',
    email: route.query.email ?? '',
    created_at: route.query.created_at ?? ''
});

const applyFilters = async () => {
    currentPage.value = 1;
    status.value = 'pending';
    users.value = {};

    let cleanFilters = Object.fromEntries(
        Object.entries(filters.value).filter(([i, v]) => v != null && v !== '')
    );

    router.replace({
        query: {
            ...cleanFilters
        }
    });

    await useLazySanctumFetch(`/api/users`, {
        query: {
            ...cleanFilters
        }
    }).then(res => {
        users.value = res.data.value;
        status.value = res.status.value;
    });
};

const clearFilters = () => {
    filters.value = { id: '', name: '', email: '', created_at: '' };
    applyFilters();
};

</script>

<template>
    <div class="bg-surface text-txt antialiased">
        <div class="min-h-screen px-4 py-12">
            <div class="mx-auto max-w-3xl space-y-8">
                <div class="flex items-center justify-between mb-4 p-4 bg-surface-card rounded-lg border border-border-soft shadow-sm">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="text-brand" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="7" r="4"/><path d="M5.5 21v-2A4.5 4.5 0 0 1 10 14.5h4A4.5 4.5 0 0 1 18.5 19v2"/></svg>
                        <span class="text-base font-medium" v-if="auth.loading">⏳</span>
                        <span class="text-base font-medium" v-else-if="auth.user">{{ auth.user.data.name }}</span>
                    </div>
                    <button @click="handleLogout" class="h-9 px-4 rounded-md bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition-colors active:scale-95">Sair</button>
                </div>

                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-brand text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div>
                    <h1 class="text-xl font-semibold tracking-tight">Usuários</h1>
                    <p v-if="status == 'pending'" class="text-sm text-txt-muted">Carregando...</p>
                    <p v-else-if="status == 'success'" class="text-sm text-txt-muted"> {{ users.meta.total }} Usuários</p>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-t-lg border-x border-t border-gray-200 flex flex-wrap gap-4 items-end">
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase">ID</label>
                        <input 
                            v-model="filters.id" 
                            type="number" 
                            placeholder="Ex: 123"
                            class="h-9 px-3 rounded-md border border-gray-300 text-sm focus:ring-2 focus:ring-brand focus:outline-none w-24"
                        >
                    </div>

                    <div class="flex flex-col gap-1 flex-1 min-w-[200px]">
                        <label class="text-xs font-semibold text-gray-500 uppercase">Nome</label>
                        <input 
                            v-model="filters.name" 
                            type="text" 
                            placeholder="Buscar por nome..."
                            class="h-9 px-3 rounded-md border border-gray-300 text-sm focus:ring-2 focus:ring-brand focus:outline-none"
                        >
                    </div>

                    <div class="flex flex-col gap-1 flex-1 min-w-[200px]">
                        <label class="text-xs font-semibold text-gray-500 uppercase">E-mail</label>
                        <input 
                            v-model="filters.email" 
                            type="email" 
                            placeholder="email@exemplo.com"
                            class="h-9 px-3 rounded-md border border-gray-300 text-sm focus:ring-2 focus:ring-brand focus:outline-none"
                        >
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase">Cadastro</label>
                        <input 
                            v-model="filters.date" 
                            type="date" 
                            class="h-9 px-3 rounded-md border border-gray-300 text-sm focus:ring-2 focus:ring-brand focus:outline-none"
                        >
                    </div>

                    <div class="flex gap-2 w-full justify-center">
                        <button 
                            @click="applyFilters"
                            class="h-9 px-4 bg-brand text-white rounded-md text-sm font-medium hover:bg-brand-dark transition-all active:scale-95 flex items-center gap-2"
                        >
                            <span>Filtrar</span>
                        </button>
                        
                        <button 
                            @click="clearFilters"
                            class="h-9 px-4 bg-gray-100 text-gray-600 rounded-md text-sm font-medium hover:bg-gray-200 transition-all"
                        >
                            Limpar
                        </button>
                    </div>
                </div>

                <div class="rounded-2xl border border-border-soft bg-surface-card shadow-sm overflow-hidden">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-border-soft">
                                <th class="px-4 py-3 text-left font-medium text-txt-muted w-16">ID</th>
                                <th class="px-4 py-3 text-left font-medium text-txt-muted">Nome</th>
                                <th class="px-4 py-3 text-left font-medium text-txt-muted">E-mail</th>
                                <th class="px-4 py-3 text-left font-medium text-txt-muted">Cadastro</th>
                                <th class="px-4 py-3 w-16"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="status == 'pending'">
                                <td class="px-4 py-3 text-txt-muted text-center" colspan="5">Carregando...</td>
                            </tr>
                            <tr v-for="user in users?.data" :key="user.id" class="border-b border-border-soft hover:bg-surface/60 transition-colors">
                                <td class="px-4 py-3 font-mono text-txt-muted tabular-nums">{{ user.id }}</td>
                                <td class="px-4 py-3 font-medium">{{ user.name }}</td>
                                <td class="px-4 py-3 text-txt-muted">{{ user.email }}</td>
                                <td class="px-4 py-3 text-txt-muted tabular-nums">{{ new Date(user.created_at).toLocaleDateString('pt-BR') }}</td>
                                <td class="px-4 py-3">
                                    <NuxtLink :to="{ name: 'user-id', params: {id: user.id}}" class="inline-flex h-8 w-8 items-center justify-center rounded-md hover:bg-brand-light transition-colors active:scale-95">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </NuxtLink>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div
                        v-if="users?.meta?.last_page > 1"
                        class="flex justify-center items-center gap-2 px-4 py-3 border-t border-border-soft bg-surface-card"
                    >
                        <button
                            :disabled="currentPage == 1"
                            @click="goToPage(currentPage - 1)"
                            class="h-8 w-8 rounded-md flex items-center justify-center text-txt-muted hover:bg-brand-light transition-colors disabled:opacity-50 disabled:pointer-events-none"
                        >
                            <span aria-label="Anterior">&lt;</span>
                        </button>
                        <template v-for="page in users.meta.last_page" :key="page">
                            <button
                                @click="goToPage(page)"
                                :class="[
                                    'min-w-[32px] h-8 px-2 rounded-md text-sm flex items-center justify-center transition-all',
                                    currentPage == page
                                        ? 'bg-brand text-white font-medium scale-105'
                                        : 'bg-transparent text-txt hover:bg-brand-light'
                                ]"
                            >
                                {{ page }}
                            </button>
                        </template>
                        <button
                            :disabled="currentPage == users.meta.last_page"
                            @click="goToPage(currentPage + 1)"
                            class="h-8 w-8 rounded-md flex items-center justify-center text-txt-muted hover:bg-brand-light transition-colors disabled:opacity-50 disabled:pointer-events-none"
                        >
                            <span aria-label="Próxima">&gt;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>