<template>
    <jet-responsive-nav-link :href="route('home')" :active="route().current('home')">
        Главная
    </jet-responsive-nav-link>

    <jet-responsive-nav-link :href="route('appointments.instructor')" :active="route().current('appointments.instructor')">
        Вождение
    </jet-responsive-nav-link>
</template>

<script>
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";

export default {
    components: {
        JetResponsiveNavLink,
    }
}
</script>
