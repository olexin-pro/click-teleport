<script setup>
import {ref} from "vue";
import {useForm} from "@inertiajs/vue3";

import SecondaryButton from "@/Components/SecondaryButton.vue";
import DialogModal from "@/Components/DialogModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import Checkbox from "@/Components/Checkbox.vue";
import SelectInput from "@/Components/SelectInput.vue";
import FormSection from "@/Components/FormSection.vue";

const modalOpened = ref(false);
const form = useForm({
    url: '',
    key: '',
    single_use: '',
    forward_query: '',
    redirect_code: 301,
    activated_at: '',
    deactivated_at: '',
});

function sendForm() {


    form.post(route('dashboard.url.store'), {
        //errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            modalOpened.value = false;
        },
    });
}
</script>

<template>
<SecondaryButton type="button" @click.prevent="modalOpened = true">Добавить</SecondaryButton>




    <form @submit.prevent="sendForm">
        <dialog-modal :show="modalOpened" :closeable="true">
            <template #title>
                Добавить ссылку
            </template>
            <template #content>

                        <div class="">
                            <input-label for="url" value="Адрес ссылки" />
                            <text-input
                                id="url"
                                v-model="form.url"
                                placeholder="https://website-url.com"
                                type="url"
                                class="mt-1 block w-full"
                                autocomplete="url"
                                autofocus
                                required
                            />
                            <input-error :message="form.errors.url" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <input-label for="key" value="Значение кор. ссылки"/>
                            <text-input
                                id="key"
                                v-model="form.key"
                                type="text"
                                placeholder="app-action"
                                class="mt-1 block w-full"
                                autocomplete="url-key"
                            />
                            <input-error :message="form.errors.key" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <input-label for="redirect_code" value="Код переадресации"/>
                            <select-input
                                id="redirect_code"
                                v-model="form.redirect_code"
                                :values="[{value: 301, name: '301'},{value: 302, name: '302'}]"
                                class="mt-1 block w-full"
                            />
                            <input-error :message="form.errors.key" class="mt-2" />
                        </div>

                        <div class="col-span-6 sm:col-span-4 grid grid-cols-1 md:grid-cols-2 gap-4">


                            <div class="mt-4">
                                <input-label for="activated_at" value="Активировать с"/>
                                <text-input
                                    id="activated_at"
                                    v-model="form.activated_at"
                                    type="datetime-local"
                                    class="mt-1 block w-full"
                                    autocomplete="activated_at"
                                />
                                <input-error :message="form.errors.activated_at" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <input-label for="deactivated_at" value="Деактивировать"/>
                                <text-input
                                    id="deactivated_at"
                                    v-model="form.deactivated_at"
                                    type="datetime-local"
                                    class="mt-1 block w-full"
                                    autocomplete="deactivated_at"
                                />
                                <input-error :message="form.errors.deactivated_at" class="mt-2" />
                            </div>
                        </div>


                        <div class="mt-4">
                            <input-label for="single_use">
                                <div class="flex flex-row flex-wrap items-center gap-2">
                                    <checkbox
                                        id="single_use"
                                        v-model="form.single_use"
                                    />
                                    <span>Только одно использование</span>
                                </div>
                            </input-label>
                            <input-error :message="form.errors.single_use" class="mt-2" />
                        </div>


                        <div class="mt-4">
                            <input-label for="forward_query">
                                <div class="flex flex-row flex-wrap items-center gap-2">
                                    <checkbox
                                        id="forward_query"
                                        v-model="form.forward_query"
                                    />
                                    <span>Передавать query</span>
                                </div>
                            </input-label>
                            <p class="text-gray-400 text-sm">
                                {{$page.props.app_url ?? 'https://app-url.com'}}/url/xxx<span class="text-black dark:text-white">?param1=abc</span> <code class="text-black dark:text-white">-></code> https://you-url.com<span class="text-black dark:text-white">?param1=abc</span>
                            </p>
                            <input-error :message="form.errors.forward_query" class="mt-2" />
                        </div>
            </template>
            <template #footer>
                <div class="w-full flex flex-row flex-wrap gap-2 items-center justify-between">
                    <secondary-button type="button" @click.prevent="modalOpened = false">
                        Отменить
                    </secondary-button>
                    <primary-button>
                        Добавить
                    </primary-button>
                </div>
            </template>
        </dialog-modal>
    </form>
</template>

<style scoped>

</style>
