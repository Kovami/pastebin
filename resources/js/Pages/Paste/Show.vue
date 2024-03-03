<script setup>
import {Head, useForm} from '@inertiajs/vue3';
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import CodeArea from "@/Components/CodeArea.vue";

defineProps({
    paste: {
        type: Object,
    }
});

const form = useForm({
    title: null,
    body: null,
    visibility: 'public',
    expires_at: 600
});
const submit = () => {
    form.post(route('main'));
};

</script>

<template>
    <DefaultLayout>
        <Head title="Создать пасту"/>
        <v-card>
            <v-card-title>
                <div>{{ paste.title }}</div>
                <div class="text-body-2">{{ paste.language }}{{ paste.language ? ' | ' : '' }}{{ paste.formatted_created_at }}</div>
            </v-card-title>
            <v-card-text>
                <form
                    class="d-flex flex-column ga-4"
                    @submit.prevent="submit"
                >
                    <CodeArea
                        :model-value="paste.body"
                        :language="paste.language"
                        disabled
                    />
                </form>
            </v-card-text>
        </v-card>
    </DefaultLayout>

</template>

<style scoped>

</style>
