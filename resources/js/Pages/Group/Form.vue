<template>
    <jet-form-section @submitted="updateSchedule">
        <template #title>
            Groups
        </template>

        <template #description>
            Insert group specs
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <jet-label for="title" value="No" />
                <jet-input id="title" type="text" class="mt-1 block w-full" v-model="form.title" autocomplete="title" />
                <jet-input-error :message="form.errors.title" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <jet-label for="start" value="start" />
                <jet-input id="start" type="date" class="mt-1 block w-full" v-model="form.start" autocomplete="start"/>
                <jet-input-error :message="form.errors.start" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <jet-label for="end" value="end" />
                <jet-input id="end" type="date" class="mt-1 block w-full" v-model="form.end" autocomplete="end" />
                <jet-input-error :message="form.errors.end" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <jet-label for="base_price" value="base_price" />
                <input
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                    v-maska="['##### ₽ ## коп', '#### ₽ ## коп', '### ₽ ## коп']"
                    v-model="form.base_price"
                    id="base_price"
                    type="text"
                    autocomplete="base_price"
                />
                <jet-input-error :message="form.errors.base_price" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <jet-label for="price_per_driving_hour" value="price_per_driving_hour" />
                <input
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                    v-maska="['##### ₽ ## коп', '#### ₽ ## коп', '### ₽ ## коп']"
                    v-model="form.price_per_driving_hour"
                    id="price_per_driving_hour"
                    type="text"
                    autocomplete="price_per_driving_hour"
                />
                <jet-input-error :message="form.errors.price_per_driving_hour" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <jet-label for="drive_hours" value="drive_hours" />
                <jet-input id="drive_hours" type="number" class="mt-1 block w-full" v-model="form.drive_hours" autocomplete="drive_hours" />
                <jet-input-error :message="form.errors.drive_hours" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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

    props: {
        group: Object,
    },

    data() {
        return {
            form: this.$inertia.form({
                _method: 'POST',
                id: this.group ? this.group.id : null,
                title: this.group ? this.group.title : null,
                start: this.group ? this.group.start : '',
                end: this.group ? this.group.end : '',
                base_price: this.group ? this.group.base_price : '',
                drive_hours: this.group ? this.group.drive_hours : '',
                price_per_driving_hour: this.group ? this.group.price_per_driving_hour : '',
            }),
        }
    },

    methods: {
        updateSchedule() {
            this.form.post(route('groups.store'), {
                errorBag: 'updateGroup',
                preserveScroll: true,
            });
        },
    },
})
</script>
