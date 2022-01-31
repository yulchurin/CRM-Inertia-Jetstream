<template>
    <!-- Navigation Links -->
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <jet-nav-link :href="route('home')" :active="route().current('home')">
            Главная
        </jet-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <jet-nav-link :href="route('appointments.instructor')" :active="route().current('appointments.instructor')">
            Вождение
        </jet-nav-link>
    </div>

</template>

<script>
import JetNavLink from '@/Jetstream/NavLink.vue';
export default {
    components: {
        JetNavLink,
    }
}
</script>
