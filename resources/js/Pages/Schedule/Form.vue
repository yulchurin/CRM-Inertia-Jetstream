<template>
    <jet-form-section @submitted="updateSchedule">
        <template #title>
            Schedule
        </template>

        <template #description>
            Insert start time and select duration
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <jet-label for="start" value="start" />
                <jet-input id="start" type="time" class="mt-1 block w-full" v-model="form.start" autocomplete="start"/>
                <jet-input-error :message="form.errors.start" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <jet-label for="duration" value="duration" />
                <jet-input id="duration" type="time" class="mt-1 block w-full" v-model="form.duration" autocomplete="duration" />
                <jet-input-error :message="form.errors.duration" class="mt-2" />
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
        schedule: Object,
    },

    data() {
        return {
            form: this.$inertia.form({
                _method: 'POST',
                id: this.schedule ? this.schedule.id : null,
                start: this.schedule ? this.schedule.start : '',
                duration: this.schedule ? this.schedule.duration : '',
            }),
        }
    },

    methods: {
        updateSchedule() {
            this.form.post(route('schedules.store'), {
                errorBag: 'updateSchedule',
                preserveScroll: true,
            });
        },
    },
})
</script>
