<template>
    <app-layout title="users">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Group
            </h2>
        </template>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <group-form :group="group" />
                <jet-section-border />
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import GroupForm from '@/Pages/Group/Form.vue'
import JetSectionBorder from '@/Jetstream/SectionBorder.vue'

export default defineComponent({
    props: {
        group: Object,
    },
    components: {
        AppLayout,
        JetSectionBorder,
        GroupForm,
    },
})
</script>
