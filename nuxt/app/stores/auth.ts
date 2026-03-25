import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', () => {
    const user = ref<any>(null);
    const loading = ref(false);

    const {
        user: sanctumUser,
        isAuthenticated,
        login,
        logout,
        refreshIdentity,
        init
    } = useSanctumAuth();

    async function initialize() {
        loading.value = true;

        try {
            await init();
            user.value = sanctumUser.value
        } finally {
            loading.value = false;
        }
    }

    async function signIn(credentials: { email: string, password: string}) {
        loading.value = true;

        try {
            await login(credentials, true);
            user.value = sanctumUser.value;
        } finally {
            loading.value = false;
        }
    }

    async function signOut() {
        loading.value = true;

        try {
            await logout();
            user.value = null;
        } finally {
            loading.value = false;
        }
    }

    async function syncUser() {
        loading.value = true;

        try {
            await refreshIdentity();
            user.value = sanctumUser.value;
        } finally {
            loading.value = false;
        }
    }

    return {
        user,
        isAuthenticated,
        loading,
        syncUser,
        initialize,
        signIn,
        signOut
    }
});