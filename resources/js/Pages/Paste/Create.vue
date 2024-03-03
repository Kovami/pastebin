<script setup>
import {Head, useForm} from '@inertiajs/vue3';
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import CodeArea from "@/Components/CodeArea.vue";

defineProps({
    visibilities: {
        type: Array
    },
    languages: {
        type: Array,
    },
    expirations: {
        type: Array
    },
});

const form = useForm({
    title: null,
    body: null,
    language: null,
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
                Новая паста
            </v-card-title>
            <v-card-text>
                <form
                    class="d-flex flex-column ga-4"
                    @submit.prevent="submit"
                >
                    <CodeArea
                        v-model="form.body"
                        :language="form.language"
                        :message="$page.props.errors.body"
                    />
                    <div class="d-flex flex-column ga-4">
                        <v-text-field
                            id="title"
                            v-model="form.title"
                            variant="outlined"
                            label="Наименование пасты"
                            dense
                            hide-details="auto"
                        />
                        <v-select
                            v-model="form.language"
                            :items="[{name: 'None', value: null}, ...languages]"
                            item-title="name"
                            item-value="value"
                            label="Подстветка синтаксиса языка"
                            variant="outlined"
                            hide-details="auto"
                        />
                        <v-select
                            v-model="form.expires_at"
                            :items="expirations"
                            item-title="name"
                            item-value="value"
                            label="Срок действия пасты"
                            variant="outlined"
                            hide-details="auto"
                        />
                        <v-select
                            v-model="form.visibility"
                            :items="visibilities"
                            item-title="name"
                            item-value="value"
                            variant="outlined"
                            label="Ограничение доступа пасты"
                            hide-details="auto"
                        >
                            <template v-slot:item="{ item, props }">
                                <v-list-item
                                    v-bind="props"
                                    :disabled="item.value === 'private' && !$page.props.auth.user"
                                >
                                    {{ item.name }}
                                </v-list-item>
                            </template>
                        </v-select>
                    </div>
                    <v-btn
                        :loading="form.processing"
                        variant="outlined"
                        flat
                        @click="submit"
                    >
                        Создать новую пасту
                    </v-btn>
                </form>
            </v-card-text>
        </v-card>
    </DefaultLayout>

</template>

<style scoped>

</style>
