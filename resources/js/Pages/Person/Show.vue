<template>
    <app-layout title="Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profile
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <person :person="person" />
                <jet-section-border />
            </div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8" v-if="$page.props.person">
                <paper :paper="paper" />
                <jet-section-border />
            </div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8" v-if="$page.props.userIsMinor">
                <legal-person :person="parent" />
                <jet-section-border />
            </div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8" v-if="$page.props.userIsMinor && $page.props.parent">
                <legal-paper :paper="parent_paper" />
                <jet-section-border />
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import JetSectionBorder from '@/Jetstream/SectionBorder.vue'
import Person from "@/Pages/Person/Person";
import Paper from "@/Pages/Person/Paper";
import LegalPerson from "@/Pages/Person/LegalPerson";
import LegalPaper from "@/Pages/Person/LegalPaper";

export default defineComponent({
    props: ['person', 'paper', 'parent', 'parent_paper'],

    components: {
        AppLayout,
        JetSectionBorder,
        Person,
        Paper,
        LegalPerson,
        LegalPaper,
    },
})
</script>
