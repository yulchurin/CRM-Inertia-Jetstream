<template>
    <jet-responsive-nav-link :href="route('home')" :active="route().current('home')">
        Главная
    </jet-responsive-nav-link>

    <jet-responsive-nav-link :href="route('users.index')" :active="route().current('users.index')">
        Пользователи
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
