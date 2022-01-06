<template>
    <jet-form-section @submitted="updatePersonalInformation">
        <template #title>
            Паспорт родителя (законного представителя)
        </template>

        <template #description>
            Пожалуйста, убедитесь что информаия заполнена корректно в точности как в Вашем паспорте
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <jet-label for="series" value="Серия" />
                <input
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                    v-maska="'######'"
                    v-model="form.series"
                    id="series"
                    type="text"
                    autocomplete="series"
                />
                <jet-input-error :message="form.errors.series" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <jet-label for="number" value="Номер" />
                <input
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                    v-maska="'######'"
                    v-model="form.number"
                    id="number"
                    type="text"
                    autocomplete="number"
                />
                <jet-input-error :message="form.errors.number" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <jet-label for="issuance_date" value="Дата выдачи" />
                <jet-input id="issuance_date" type="date" class="mt-1 block w-full" v-model="form.issuance_date" autocomplete="issuance_date" />
                <jet-input-error :message="form.errors.issuance_date" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-6">
                <jet-label for="issuer" value="Кем выдан" />
                <jet-input id="issuer" type="text" class="mt-1 block w-full" v-model="form.issuer" autocomplete="issuer" />
                <jet-input-error :message="form.errors.issuer" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button
                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
import { defineComponent } from 'vue'
import JetButton from '@/Jetstream/Button.vue'
import JetFormSection from '@/Jetstream/FormSection.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetActionMessage from '@/Jetstream/ActionMessage.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
export default defineComponent({
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
    },

    props: ['paper'],

    data() {
        return {
            form: this.$inertia.form({
                _method: 'POST',
                id: this.paper ? this.paper.id : '',
                series: this.paper ? this.paper.series : '',
                number: this.paper ? this.paper.number : '',
                issuer: this.paper ? this.paper.issuer : '',
                issuance_date: this.paper ? this.paper.issuance_date : '',
                place_of_birth: this.paper ? this.paper.place_of_birth : '',
                snils: this.paper ? this.paper.snils : '',
            }),
        }
    },

    methods: {
        updatePersonalInformation() {
            this.form.post(route('parent.paper.store'), {
                errorBag: 'updatePaperInformation',
                preserveScroll: true,
            });
        },
    },
})
</script>
