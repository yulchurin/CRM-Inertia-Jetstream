<template>
    <!-- Navigation Links -->
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <jet-nav-link :href="route('home')" :active="route().current('home')">
            Главная
        </jet-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <jet-nav-link :href="route('appointments.index')" :active="route().current('appointments.index')">
            Вождение
        </jet-nav-link>
    </div>

<!--    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">-->
<!--        <jet-nav-link :href="route('lessons.index')" :active="route().current('lessons.index')">-->
<!--            Уроки-->
<!--        </jet-nav-link>-->
<!--    </div>-->
</template>

<script>
import JetNavLink from '@/Jetstream/NavLink.vue';
export default {
    components: {
        JetNavLink,
    }
}
</script>
