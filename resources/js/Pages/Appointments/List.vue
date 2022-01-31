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
                                Инструктор
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Автомобиль
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

                        <!-- Appointment Booking Modal -->
                        <jet-dialog-modal :show="confirmingBooking" @close="closeModal">
                            <template #title>
                                Забронировать
                            </template>

                            <template #content>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="place" class="block text-sm font-medium text-gray-700">Место встречи</label>
                                    <select
                                        required
                                        id="place"
                                        v-model="form.place"
                                        name="place"
                                        autocomplete="place"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    >
                                        <option v-for="place in places" :key="place.id" :value="place.id">
                                            {{ place.name }}
                                        </option>
                                    </select>
                                </div>
                                <jet-input-error :message="form.errors.place" class="mt-2" />
                                <div class="mt-1">
                                    <textarea
                                        id="comment"
                                        name="comment"
                                        v-model="form.comment"
                                        rows="3"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                                        placeholder="Comment"
                                    />
                                </div>
                                <jet-input-error :message="form.errors.limit_per_week" class="mt-2" />
                            </template>

                            <template #footer>
                                <jet-secondary-button @click="closeModal">
                                    Отмена
                                </jet-secondary-button>

                                <jet-secondary-button class="ml-2" @click="book()"
                                                   :class="{ 'opacity-25': form.processing }"
                                                   :disabled="form.processing">
                                    Забронировать
                                </jet-secondary-button>
                            </template>
                        </jet-dialog-modal>

                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="slot in slots" :key="slot.id">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ slot.date }}</div>
                                <div class="text-sm text-gray-500">
                                    {{ slot.dayOfWeek }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ slot.start }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            ~ закончится в {{ slot.end }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ slot.instructor.name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            t.: <a :href="`tel:+7${ slot.instructor.link }`">+7 {{slot.instructor.phone }}</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            <span
                                                class="border-solid rounded border-2 border-gray-900 focus:border-gray-300 pl-1 pr-1"
                                            >
                                                {{ slot.car.number }}
                                            </span>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ slot.car.model }} | цвет: {{ slot.car.color }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ slot.comment }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                                <template v-if="slot.bookedByMe">
                                    <jet-danger-button @click="confirmUnbooking(slot.id)">
                                        Отменить
                                    </jet-danger-button>
                                    <div class="text-sm text-gray-500">
                                        {{ slot.date }} {{ slot.start }}
                                    </div>
                                </template>

                                <template v-if="!slot.bookedByMe && !limited">
                                    <jet-secondary-button @click="confirmBooking(slot.id)">
                                        Забронировать
                                    </jet-secondary-button>
                                    <div class="text-sm text-gray-500">
                                        {{ slot.date }} {{ slot.start }}
                                    </div>
                                </template>

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
        slots: Object,
        places: Array,
        limited: Boolean,
    },

    data() {
        return {
            confirmingBooking: false,
            confirmingUnbooking: false,

            form: this.$inertia.form({
                comment: '',
                id: '',
                place: '',
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
