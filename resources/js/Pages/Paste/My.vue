<script setup>
import {Head, Link, router, useForm} from '@inertiajs/vue3';
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

const props = defineProps({
    pastes: {
        type: Object,
    }
});

const form = useForm({
    page: props.pastes.current_page,
});

function redirect() {
    router.visit(route('my'), {
        data: { page: props.pastes.current_page }
    })
}

</script>

<template>
    <DefaultLayout>
        <Head title="Мои пасты"/>
        <div class="d-flex flex-column ga-4">
            <v-card>
                <v-card-title>
                    Мои пасты
                </v-card-title>
            </v-card>
            <v-card
                v-if="pastes.data.length > 0"
                v-for="paste in pastes.data"
                :key="paste.id"
            >
                <v-card-title>
                    <Link :href="route('paste-show', { uri: paste.uri })">
                        {{ paste.title }}
                    </Link>
                </v-card-title>
                <v-card-text>
                    {{ paste.language }}{{ paste.language ? ' | ' : '' }}{{ paste.formatted_created_at }}
                </v-card-text>
            </v-card>
            <v-card v-else>
                <v-card-text>
                    У вас пока нету не одной пасты
                </v-card-text>
            </v-card>
            <v-pagination
                v-if="pastes.data.length > 0"
                v-model="props.pastes.current_page"
                :length="pastes.last_page"
                variant="elevated"
                show-first-last-page
                total-visible="10"
                @update:modelValue="redirect"
            />
        </div>

    </DefaultLayout>

</template>

<style scoped>

</style>
