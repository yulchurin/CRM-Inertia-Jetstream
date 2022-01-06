<template>
    <jet-responsive-nav-link :href="route('home')" :active="route().current('home')">
        Главная
    </jet-responsive-nav-link>

    <jet-responsive-nav-link :href="route('appointments.index')" :active="route().current('appointments.index')">
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
