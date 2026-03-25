// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  modules: [
    '@nuxtjs/tailwindcss',
    '@pinia/nuxt',
    'nuxt-auth-sanctum'
  ],
  sanctum: {
    baseUrl: 'http://localhost:8000',
    endpoints: {
      login: '/api/login',
      logout: '/api/logout'
    },
    redirect: {
        onAuthOnly: '/login',
        onGuestOnly: '/users',
    },
  }
})