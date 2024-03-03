<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    login: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Авторизация" />

        <v-card>
            <v-card-title>
                Авторизация
            </v-card-title>
            <v-card-text>
                <form class="d-flex flex-column ga-4 mt-4">
                    <v-text-field
                        v-model="form.login"
                        label="Логин"
                        variant="outlined"
                        :error-messages="$page.props.errors.login"
                        hide-details="auto"
                    />
                    <v-text-field
                        v-model="form.password"
                        type="password"
                        label="Пароль"
                        variant="outlined"
                        :error-messages="$page.props.errors.password"
                        hide-details="auto"
                    />
                    <v-checkbox
                        v-model="form.remember"
                        label="Запомнить меня"
                        hide-details
                    />
                    <v-btn
                        :loading="form.processing"
                        color="primary"
                        @click="submit"
                    >
                        Войти
                    </v-btn>
                </form>
            </v-card-text>
        </v-card>
    </GuestLayout>
</template>
