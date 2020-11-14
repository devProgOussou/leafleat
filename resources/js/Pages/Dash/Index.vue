<template>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <h1 class="text-center text-lg m-5">Déclarer un problème</h1>
            <form @submit.prevent="submit">
                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                    <text-input v-model="form.lastName" class="pr-6 pb-8 w-full lg:w-1/2" label="Nom" required />
                    <text-input v-model="form.firstName" class="pr-6 pb-8 w-full lg:w-1/2" label="Prénom" />
                    <text-input v-model="form.email" class="pr-6 pb-8 w-full lg:w-1/2" label="Email" />
                    <text-input v-model="form.locality" class="pr-6 pb-8 w-full lg:w-1/2" label="Localité" />
                    <text-input v-model="form.population" class="pr-6 pb-8 w-full lg:w-1/2" label="population impacté" />
                    <text-input v-model="form.area" class="pr-6 pb-8 w-full lg:w-1/2" label="Localisation(ex: pikine)" />
                    <text-input v-model="form.phone" class="pr-6 pb-8 w-full lg:w-1/2" label="Telephone" required />
                    <select-input v-model="form.category" class="pr-6 pb-8 w-full lg:w-1/2" label="Catégorie">
                        <option value="Acces-a-l'eau-potable">Accés à l'eau potable</option>
                        <option value="education">Education</option>
                        <option value="sante">Santé</option>
                        <option value="Autre">Autres</option>
                    </select-input>
                    <textarea-input class="pr-6 pb-8 w-full lg:w-1/2" v-model="form.details" label="plus de details" />
                </div>
                <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                    <loading-button :loading="sending" class="btn-indigo-500" type="submit">soumettre le formulaire</loading-button>
                </div>
            </form>
        </div>
    </div>
</div>
</template>

<script>
import TextInput from "../Shared/TextInput";
import SelectInput from "../Shared/SelectInput";
import LoadingButton from "../Shared/LoadingButton";
import TextareaInput from '../Shared/TextareaInput';

export default {
    metaInfo: {
        title: "Create repo",
    },
    components: {
        LoadingButton,
        SelectInput,
        TextInput,
        TextareaInput
    },
    remember: "form",
    data() {
        return {
            sending: false,
            form: {
                lastName: null,
                firstName: null,
                email: null,
                locality: null,
                population: null,
                area: null,
                phone: null,
                details: null,
                category: null
            },
        };
    },
    methods: {
        submit() {
            this.sending = true;
            var data = new FormData();

            data.append("lastName", this.form.lastName || '');
            data.append("firstName", this.form.firstName || '');
            data.append("email", this.form.email || '');
            data.append("locality", this.form.locality || '');
            data.append("population", this.form.population || '');
            data.append("area", this.form.area || '');
            data.append("phone", this.form.phone || '');
            data.append("details", this.form.details || '');
            data.append("category", this.form.category || '');

            this.$inertia
                .post(this.route("contact.store"), data)
                .then(() => (this.sending = false));
        },
    },
};
</script>
