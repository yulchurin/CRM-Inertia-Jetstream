<template>
    <jet-form-section @submitted="updatePersonalInformation">
        <template #title>
            Персональная информация
        </template>

        <template #description>
            Пожалуйста, убедитесь что информаия заполнена корректно в точности как в Вашем паспорте
        </template>

        <template #form>
            <!-- Last Name -->
            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <jet-label for="last_name" value="Фамилия" />
                <jet-input id="last_name" type="text" class="mt-1 block w-full" v-model="form.last_name" />
                <jet-input-error :message="form.errors.last_name" class="mt-2" />
            </div>

            <!-- First Name -->
            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <jet-label for="first_name" value="Имя" />
                <jet-input id="first_name" type="text" class="mt-1 block w-full" v-model="form.first_name" autocomplete="first_name" />
                <jet-input-error :message="form.errors.first_name" class="mt-2" />
            </div>

            <!-- Mid Name -->
            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <jet-label for="middle_name" value="Отчество" />
                <jet-input id="middle_name" type="text" class="mt-1 block w-full" v-model="form.middle_name" autocomplete="middle_name" />
                <jet-input-error :message="form.errors.middle_name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-2 lg:col-span-2">
                <fieldset>
                    <div>
                        <p class="text-sm text-gray-500">Пол</p>
                    </div>
                    <div class="mt-4">
                        <div class="mt-2">
                            <label class="inline-flex items-center" for="g-man">
                                <input
                                    id="g-man"
                                    name="gender"
                                    type="radio"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                    value="1"
                                    v-model="form.gender"
                                    :checked="form.gender === 1"
                                />
                                <span class="ml-2">Мужской</span>
                            </label>
                            <label class="inline-flex items-center ml-6" for="g-woman">
                                <input
                                    id="g-woman"
                                    name="gender"
                                    type="radio"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                    value="0"
                                    v-model="form.gender"
                                    :checked="form.gender === 0"/>
                                <span class="ml-2">Женский</span>
                            </label>
                        </div>
                    </div>
                </fieldset>
            </div>

            <!-- Date Of Birth -->
            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <jet-label for="date_of_birth" value="Дата рождения" />
                <jet-input id="date_of_birth" type="date" class="mt-1 block w-full" v-model="form.date_of_birth" autocomplete="date_of_birth" />
                <jet-input-error :message="form.errors.date_of_birth" class="mt-2" />
            </div>


            <!-- Phone -->
            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <jet-label for="phone" value="Номер телефона" />
                <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                       v-maska="'+7 (###) ###-##-##'"
                       v-model="form.phone"
                       id="phone" type="text" autocomplete="phone" />
                <jet-input-error :message="form.errors.phone" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <jet-label for="zip" value="Индекс" />
                <input
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                    v-maska="'######'"
                    v-model="form.zip"
                    id="zip"
                    type="text"
                    autocomplete="zip"
                />
                <jet-input-error :message="form.errors.zip" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <jet-label for="region" value="Регион" />
                <jet-input id="region" type="text" class="mt-1 block w-full" v-model="form.region" autocomplete="region" />
                <jet-input-error :message="form.errors.region" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <jet-label for="city" value="Город (населённый пункт)" />
                <jet-input id="city" type="text" class="mt-1 block w-full" v-model="form.city" autocomplete="city" />
                <jet-input-error :message="form.errors.city" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <jet-label for="street" value="Улица" />
                <jet-input id="street" type="text" class="mt-1 block w-full" v-model="form.street" autocomplete="street" />
                <jet-input-error :message="form.errors.street" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <jet-label for="house" value="Дом" />
                <jet-input id="house" type="text" class="mt-1 block w-full" v-model="form.house" autocomplete="house" />
                <jet-input-error :message="form.errors.house" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <jet-label for="flat" value="Квартира" />
                <jet-input id="flat" type="text" class="mt-1 block w-full" v-model="form.flat" autocomplete="flat" />
                <jet-input-error :message="form.errors.flat" class="mt-2" />
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

    props: ['person'],

    data() {
        return {
            form: this.$inertia.form({
                _method: 'POST',
                id: this.person ? this.person.id : '',
                gender: this.person ? this.person.gender : '',
                last_name: this.person ? this.person.last_name : '',
                first_name: this.person ? this.person.first_name : '',
                middle_name: this.person ? this.person.middle_name : '',
                date_of_birth: this.person ? this.person.date_of_birth : '',
                phone: this.person ? this.person.phone : '',
                zip: this.person ? this.person.zip : '',
                region: this.person ? this.person.region : '',
                city: this.person ? this.person.city : '',
                street: this.person ? this.person.street : '',
                house: this.person ? this.person.house : '',
                flat: this.person ? this.person.flat : '',
            }),
        }
    },

    methods: {
        updatePersonalInformation() {
            this.form.post(route('person.store'), {
                errorBag: 'updatePersonalInformation',
                preserveScroll: true,
            });
        },
    },
})
</script>
