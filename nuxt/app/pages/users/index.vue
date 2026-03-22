<template>
    <div class="bg-surface text-txt antialiased">
        <div class="min-h-screen px-4 py-12">
            <div class="mx-auto max-w-3xl space-y-8">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-brand text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div>
                <h1 class="text-xl font-semibold tracking-tight">Usuários</h1>
                <p class="text-sm text-txt-muted">5 cadastrados</p>
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
                    <tr class="border-b border-border-soft hover:bg-surface/60 transition-colors">
                    <td class="px-4 py-3 font-mono text-txt-muted tabular-nums">1</td>
                    <td class="px-4 py-3 font-medium">Mariana Costa</td>
                    <td class="px-4 py-3 text-txt-muted">mariana@exemplo.com</td>
                    <td class="px-4 py-3 text-txt-muted tabular-nums">14 jan 2025</td>
                    <td class="px-4 py-3">
                        <a href="usuario-detalhe.html?id=1" class="inline-flex h-8 w-8 items-center justify-center rounded-md hover:bg-brand-light transition-colors active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                    </td>
                    </tr>
                    <tr class="border-b border-border-soft hover:bg-surface/60 transition-colors">
                    <td class="px-4 py-3 font-mono text-txt-muted tabular-nums">2</td>
                    <td class="px-4 py-3 font-medium">Rafael Oliveira</td>
                    <td class="px-4 py-3 text-txt-muted">rafael@exemplo.com</td>
                    <td class="px-4 py-3 text-txt-muted tabular-nums">03 fev 2025</td>
                    <td class="px-4 py-3">
                        <a href="usuario-detalhe.html?id=2" class="inline-flex h-8 w-8 items-center justify-center rounded-md hover:bg-brand-light transition-colors active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                    </td>
                    </tr>
                    <tr class="border-b border-border-soft hover:bg-surface/60 transition-colors">
                    <td class="px-4 py-3 font-mono text-txt-muted tabular-nums">3</td>
                    <td class="px-4 py-3 font-medium">Camila Ferreira</td>
                    <td class="px-4 py-3 text-txt-muted">camila@exemplo.com</td>
                    <td class="px-4 py-3 text-txt-muted tabular-nums">21 mar 2025</td>
                    <td class="px-4 py-3">
                        <a href="usuario-detalhe.html?id=3" class="inline-flex h-8 w-8 items-center justify-center rounded-md hover:bg-brand-light transition-colors active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                    </td>
                    </tr>
                    <tr class="border-b border-border-soft hover:bg-surface/60 transition-colors">
                    <td class="px-4 py-3 font-mono text-txt-muted tabular-nums">4</td>
                    <td class="px-4 py-3 font-medium">Lucas Andrade</td>
                    <td class="px-4 py-3 text-txt-muted">lucas@exemplo.com</td>
                    <td class="px-4 py-3 text-txt-muted tabular-nums">09 abr 2025</td>
                    <td class="px-4 py-3">
                        <a href="usuario-detalhe.html?id=4" class="inline-flex h-8 w-8 items-center justify-center rounded-md hover:bg-brand-light transition-colors active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                    </td>
                    </tr>
                    <tr class="hover:bg-surface/60 transition-colors">
                    <td class="px-4 py-3 font-mono text-txt-muted tabular-nums">5</td>
                    <td class="px-4 py-3 font-medium">Beatriz Souza</td>
                    <td class="px-4 py-3 text-txt-muted">beatriz@exemplo.com</td>
                    <td class="px-4 py-3 text-txt-muted tabular-nums">17 jun 2025</td>
                    <td class="px-4 py-3">
                        <a href="usuario-detalhe.html?id=5" class="inline-flex h-8 w-8 items-center justify-center rounded-md hover:bg-brand-light transition-colors active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                    </td>
                    </tr>
                </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</template>