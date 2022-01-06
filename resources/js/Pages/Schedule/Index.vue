<template>
    <app-layout title="users">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Usr
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <list :schedules="schedules.data" />
                    <pagination class="mt-6" :links="schedules.links" />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import List from '@/Pages/Schedule/List.vue'
import Pagination from "@/Pages/Components/Pagination";

export default defineComponent({
    props: {
        schedules: Object,
    },
    components: {
        AppLayout,
        List,
        Pagination,
    },
})
</script>
