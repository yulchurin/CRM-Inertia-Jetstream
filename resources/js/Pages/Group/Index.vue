<template>
    <app-layout title="groups">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Groups List
            </h2>
            <Link :href="route('groups.create')">Add group</Link>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <list :groups="groups.data" />
                    <pagination class="mt-6" :links="groups.meta.links" />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import List from '@/Pages/Group/List.vue'
import Pagination from "@/Pages/Components/Pagination";
import { Link } from '@inertiajs/inertia-vue3'
export default defineComponent({
    props: {
        groups: Object,
    },
    components: {
        AppLayout,
        List,
        Pagination,
        Link,
    },
})
</script>
