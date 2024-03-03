<script setup>
import {Codemirror} from 'vue-codemirror'
import {javascript} from '@codemirror/lang-javascript'
import {html} from '@codemirror/lang-html'
import {php} from '@codemirror/lang-php'
import {oneDark} from '@codemirror/theme-one-dark'
import {watchEffect} from "vue";

const props = defineProps({
    language: {
        type: String,
        default: null,
    },
    message: {
        type: String,
    },
    disabled: {
        type: Boolean,
        default: false,
    }
});

const input = defineModel()

const languageMap = {
    'html': html(),
    'php': php(),
    'javascript': javascript(),
}

const extensions = [
    oneDark
]

watchEffect(() => {
    if (extensions.length > 1) {
        extensions.shift();
    }
    if (languageMap[props.language]) {
        extensions.unshift(languageMap[props.language])
    }
})

</script>

<template>
    <div>
        <codemirror
            v-model="input"
            :style="{ height: '400px' }"
            :autofocus="true"
            :indent-with-tab="true"
            :tab-size="2"
            :extensions="extensions"
            :disabled="disabled"
        />
        <div class="text-red lighten-1 mt-1">
            {{ message }}
        </div>
    </div>
</template>

<style scoped>

</style>
