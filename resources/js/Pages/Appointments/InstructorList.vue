<template>

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Дата
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Время
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Курсант
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Автомобиль
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Локация
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Комментарий
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Book / Unbook</span>
                            </th>
                        </tr>
                        </thead>

                        <!-- Delete Appointment Modal -->
                        <jet-dialog-modal :show="confirmingUnbooking" @close="closeModal">
                            <template #title>
                                Отменить бронь
                            </template>

                            <template #content>
                                Вы действитьельно хотите отменить бронь?
                            </template>

                            <template #footer>
                                <jet-secondary-button @click="closeModal">
                                    Нет
                                </jet-secondary-button>

                                <jet-danger-button class="ml-2" @click="unbook()" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Отменить бронь
                                </jet-danger-button>
                            </template>
                        </jet-dialog-modal>

                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="appointment in appointments" :key="appointment.id">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ appointment.date }}</div>
                                <div class="text-sm text-gray-500">
                                    {{ appointment.dayOfWeek }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ appointment.start }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            ~ закончится в {{ appointment.end }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ appointment.student.name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            t.: <a :href="`tel:+7${ appointment.student.link }`">+7 {{appointment.student.phone }}</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ appointment.car.model }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            <span
                                                class="border-solid rounded border-2 border-gray-900 focus:border-gray-300 pl-1 pr-1">
                                                {{ appointment.car.number }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ appointment.place.name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ appointment.comment }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

<!--                                <template v-if="appointment.bookedByMe">-->
<!--                                    <jet-danger-button @click="confirmUnbooking(appointment.id)">-->
<!--                                        Отменить-->
<!--                                    </jet-danger-button>-->
<!--                                    <div class="text-sm text-gray-500">-->
<!--                                        {{ appointment.date }} {{ appointment.start }}-->
<!--                                    </div>-->
<!--                                </template>-->

<!--                                <template v-if="!appointment.bookedByMe && !limited">-->
<!--                                    <jet-secondary-button @click="confirmBooking(appointment.id)">-->
<!--                                        Забронировать-->
<!--                                    </jet-secondary-button>-->
<!--                                    <div class="text-sm text-gray-500">-->
<!--                                        {{ appointment.date }} {{ appointment.start }}-->
<!--                                    </div>-->
<!--                                </template>-->

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import JetConfirmationModal from '@/Jetstream/ConfirmationModal.vue';
import JetDangerButton from '@/Jetstream/DangerButton.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
import { defineComponent } from 'vue'
import JetDialogModal from '@/Jetstream/DialogModal.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
export default defineComponent({
    props: {
        appointments: Object,
    },

    data() {
        return {
            confirmingBooking: false,
            confirmingUnbooking: false,

            form: this.$inertia.form({
                id: '',
                comment: '',
            })
        }
    },

    components: {
        JetConfirmationModal,
        JetSecondaryButton,
        JetDangerButton,
        JetDialogModal,
        JetInput,
        JetInputError,
    },

    methods: {

        book(data) {
            this.form.put('/appointment/', {
                data,
                preserveScroll: true,
                onSuccess: () => this.closeModal(),
                onFinish: () => this.form.reset(),
            });
        },

        unbook(data) {
            this.form.delete('/appointment/', {
                data,
                preserveScroll: true,
                onSuccess: () => this.closeModal(),
                onFinish: () => this.form.reset(),
            });
        },

        confirmBooking(id) {
            this.confirmingBooking = true
            this.form.id = id
        },

        confirmUnbooking(id) {
            this.confirmingUnbooking = true
            this.form.id = id
        },

        closeModal() {
            this.confirmingBooking = false
            this.confirmingUnbooking = false
            this.form.reset()
        }
    }
})
</script>
