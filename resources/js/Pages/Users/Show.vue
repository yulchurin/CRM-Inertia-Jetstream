<template>
    <app-layout title="Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profile
            </h2>
        </template>
        {{ user.name }}
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'

export default defineComponent({
    props: {
        user: Object,

    },

    components: {
        AppLayout,
    },
})
</script>
