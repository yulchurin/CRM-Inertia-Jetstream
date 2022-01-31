<template>
    <app-layout title="Driving Lessons">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Занятия, доступные для брони
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <appointments-list :slots="appointments.data" :places="places" :limited="limited" />
                    <pagination class="mt-6" :links="appointments.links" />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppointmentsList from '@/Pages/Appointments/List'
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from "@/Pages/Components/Pagination";

export default defineComponent({
    props: {
        appointments: Object,
        places: Array,
        limited: Boolean,
    },
    components: {
        AppointmentsList,
        AppLayout,
        Pagination
    },
})
</script>

