<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    login: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Регистрация" />

        <v-card>
            <v-card-title>
                Регистрация
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
                    <v-text-field
                        v-model="form.password_confirmation"
                        type="password"
                        label="Повторите пароль"
                        variant="outlined"
                        :error-messages="$page.props.errors.password_confirmation"
                        hide-details="auto"
                    />
                    <v-btn
                        :loading="form.processing"
                        color="primary"
                        @click="submit"
                    >
                        Зарегистрироваться
                    </v-btn>
                </form>
            </v-card-text>
        </v-card>
    </GuestLayout>
</template>
