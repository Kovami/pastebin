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
                <v-btn
                    v-if="$page.props.auth.user"
                    color="primary"
                    variant="text"
                    :href="route('my')"
                >
                    Мои пасты
                </v-btn>

                <v-spacer></v-spacer>

                <div>
                    <div v-if="$page.props.auth.user">
                        <v-menu
                            open-on-hover
                        >
                            <template v-slot:activator="{ props }">
                                <v-btn
                                    v-bind="props"
                                    type="text"
                                    color="primary"
                                >
                                    {{ $page.props.auth.user.login }}
                                </v-btn>
                            </template>

                            <v-list>
                                <v-list-item>
                                    <v-list-item-title>
                                        <Link
                                            :href="route('logout')"
                                            method="post"
                                        >
                                            Выйти
                                        </Link>
                                    </v-list-item-title>
                                </v-list-item>
                            </v-list>
                        </v-menu>
                    </div>
                    <div
                        v-else
                        class="d-flex flex-row ga-2"
                    >
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
                </div>
            </v-container>
        </v-app-bar>

        <v-main>
            <v-container>
                <v-row>
                    <v-col>
                        <slot></slot>
                    </v-col>
                    <v-col cols="12" lg="4" class="d-flex flex-column ga-2">
                        <v-card v-if="$page.props.public.length > 0">
                            <v-card-title>
                                Публичные пасты
                            </v-card-title>
                            <v-card-text>
                                <v-list>
                                    <v-list-item
                                        v-for="paste in $page.props.public"
                                        :key="paste.id"
                                    >
                                        <v-list-item-title>
                                            <Link :href="route('paste-show', { uri: paste.uri })">
                                                {{ paste.title }}
                                            </Link>
                                        </v-list-item-title>
                                        <v-list-item-subtitle>
                                            {{ paste.language }}{{ paste.language ? ' | ' : '' }}{{ paste.formatted_created_at }}
                                        </v-list-item-subtitle>
                                        <v-divider />
                                    </v-list-item>
                                </v-list>
                            </v-card-text>
                        </v-card>
                        <v-card v-if="$page.props.auth.user && $page.props.auth.user.last_pastes.length > 0">
                            <v-card-title>
                                Мои пасты
                            </v-card-title>
                            <v-card-text>
                                <v-list>
                                    <v-list-item
                                        v-for="paste in $page.props.auth.user.last_pastes"
                                        :key="paste.id"
                                    >
                                        <v-list-item-title>
                                            <Link :href="route('paste-show', { uri: paste.uri })">
                                                {{ paste.title }}
                                            </Link>
                                        </v-list-item-title>
                                        <v-list-item-subtitle>
                                            {{ paste.language }}{{ paste.language ? ' | ' : '' }}{{ paste.formatted_created_at }}
                                        </v-list-item-subtitle>
                                        <v-divider />
                                    </v-list-item>
                                </v-list>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<style scoped>

</style>
