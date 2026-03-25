<script setup>
definePageMeta({
    middleware: ['auth']
});

const { id } = useRoute().params;

const { data: user, status, error } = useLazySanctumFetch('/api/users/' + id);

function getInitialsName(name) {
    return name.trim()
      .split(/\s+/)
      .slice(0, 2)
      .map(nome => nome[0].toUpperCase())
      .join('');
}

</script>

<template>
    <div class="bg-surface text-txt antialiased">
        <div class="min-h-screen px-4 py-12">
            <div class="mx-auto max-w-md space-y-6">
            <NuxtLink to="/" class="inline-flex items-center gap-1 text-sm text-txt-muted hover:text-txt transition-colors active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Voltar
            </NuxtLink>

            <div v-if="status == 'pending'" class="rounded-2xl border border-border-soft bg-surface-card p-8 shadow-sm space-y-6">
                Carregando...
            </div>

            <div v-if="status == 'error'" class="rounded-2xl border border-border-soft bg-surface-card p-8 shadow-sm space-y-6">
                {{ error.statusText }}
            </div>

            <div v-if="status == 'success'" class="rounded-2xl border border-border-soft bg-surface-card p-8 shadow-sm space-y-6">
                <div class="flex flex-col items-center gap-3">
                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-brand-light text-brand-dark text-xl font-semibold">
                    {{ getInitialsName(user?.data.name) }}
                </div>
                    <h1 class="text-xl font-semibold tracking-tight">{{ user?.data.name }}</h1>
                </div>

                <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-surface">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-txt-muted"><line x1="4" y1="9" x2="20" y2="9"/><line x1="4" y1="15" x2="20" y2="15"/><line x1="10" y1="3" x2="8" y2="21"/><line x1="16" y1="3" x2="14" y2="21"/></svg>
                    </div>
                    <div>
                    <p class="text-xs text-txt-muted">ID</p>
                    <p class="text-sm font-medium">{{ user?.data.id }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-surface">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-txt-muted"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <div>
                    <p class="text-xs text-txt-muted">E-mail</p>
                    <p class="text-sm font-medium">{{ user?.data.email }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-surface">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-txt-muted"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <div>
                    <p class="text-xs text-txt-muted">Data de cadastro</p>
                    <p class="text-sm font-medium">{{ new Date(user?.data.created_at).toLocaleDateString('pt-BR') }}</p>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>