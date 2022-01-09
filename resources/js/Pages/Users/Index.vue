<template>
    <app-layout title="users">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <list :users="users.data" />
                    <pagination class="mt-6" :links="users.meta.links" />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import List from '@/Pages/Users/List.vue'
import Pagination from "@/Pages/Components/Pagination";
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'

export default defineComponent({
    setup() {
        const auth = computed(() => usePage().props.value.auth.user)
        return { auth }
    },
    props: {
        users: Object,
    },
    components: {
        AppLayout,
        List,
        Pagination,
    },
})
</script>
