<template>
    <Head title="Welcome" />

    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">

        <div v-if="!auth" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <template>
                <Link :href="route('login')" class="text-sm text-gray-700 underline">
                    Log in
                </Link>

                <Link :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
                    Register
                </Link>
            </template>
        </div>
        <div>
            <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
                <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                        <div v-if="user" class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                            {{ user }}
                        </div>

                        <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                            Учётная запись ещё не активирована
                        </div>
                    </div>
                    <div class="relative my-6">
                        <div class="relative flex justify-center text-sm border-t border-gray-300">
                                <div class="font-mono">
                                    Пожалуйста, дождитесь активации!<br><br>
                                    Не нужно регистрировать новую учётную запись
                                    или входить с другого сервиса.<br><br>
                                    <strong v-if="google">
                                        Вы вошли используя Google - продолжайте использовать Google<br><br>
                                    </strong>
                                    <strong v-if="vk">
                                        Вы вошли используя VK - продолжайте использовать VK<br><br>
                                    </strong>
                                    <strong v-if="!google && !vk">
                                        Вы зарегистрировали аккаунт в нашем сервисе -
                                        не используйте для входа социальные сети.<br><br>
                                    </strong>
                                    Если учётная запись не активна в течение 48 часов после регистрации -
                                    обратитесь к администартору системы<br><br>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .bg-gray-100 {
        background-color: #f7fafc;
        background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
    }

    .border-gray-200 {
        border-color: #edf2f7;
        border-color: rgba(237, 242, 247, var(--tw-border-opacity));
    }

    .text-gray-400 {
        color: #cbd5e0;
        color: rgba(203, 213, 224, var(--tw-text-opacity));
    }

    .text-gray-500 {
        color: #a0aec0;
        color: rgba(160, 174, 192, var(--tw-text-opacity));
    }

    .text-gray-600 {
        color: #718096;
        color: rgba(113, 128, 150, var(--tw-text-opacity));
    }

    .text-gray-700 {
        color: #4a5568;
        color: rgba(74, 85, 104, var(--tw-text-opacity));
    }

    .text-gray-900 {
        color: #1a202c;
        color: rgba(26, 32, 44, var(--tw-text-opacity));
    }

    @media (prefers-color-scheme: dark) {
        .dark\:bg-gray-800 {
            background-color: #2d3748;
            background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
        }

        .dark\:bg-gray-900 {
            background-color: #1a202c;
            background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
        }

        .dark\:border-gray-700 {
            border-color: #4a5568;
            border-color: rgba(74, 85, 104, var(--tw-border-opacity));
        }

        .dark\:text-white {
            color: #fff;
            color: rgba(255, 255, 255, var(--tw-text-opacity));
        }

        .dark\:text-gray-400 {
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--tw-text-opacity));
        }
    }
</style>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Head,
            Link,
        },

        props: {
            auth: Boolean,
            user: String,
            google: Boolean,
            vk: Boolean
        }
    })
</script>
