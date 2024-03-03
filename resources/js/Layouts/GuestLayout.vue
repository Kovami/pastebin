<script setup>
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <v-app id="inspire">
        <v-app-bar flat>
            <v-container class="mx-auto d-flex align-center justify-center">
                <v-btn
                    color="success"
                    variant="text"
                    :href="route('main')"
                >
                    Создать пасту
                </v-btn>

                <v-spacer></v-spacer>

                <div class="d-flex flex-row ga-2">
                    <Link
                        :href="route('login')"
                    >
                        Войти
                    </Link>
                    <div>
                        /
                    </div>
                    <Link
                        :href="route('register')"
                    >
                        Регистрация
                    </Link>
                </div>
            </v-container>
        </v-app-bar>

        <v-main>
            <v-container
                fluid
                style="height: 100vh"
            >
                <v-row
                    align-content="center"
                    justify="center"
                    class="mt-auto"
                    style="height: 80%"
                >
                    <v-col cols="4">
                        <slot></slot>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>
