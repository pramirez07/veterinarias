
<script setup>
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
});

const form = useForm({
    nombre: '',
    email: '',
    telefono: null,
});

const submit = () => {
    form.post(route('clinica.store'), {});
};

</script>


<template>
    <Head title="Clínicas" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear clínica</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                    <form @submit.prevent="submit" class="m-4">
            <div>
                <InputLabel for="nombre" value="Nombre" />

                <TextInput
                    id="nombre"
                    class="mt-1 block w-full"
                    v-model="form.nombre"
                    required
                    autofocus
                />

                <InputError class="mt-2" :message="form.errors.nombre" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="telefono" value="Teléfono" />

                <TextInput
                    id="telefono"
                    class="mt-1 block w-full"
                    v-model="form.telefono"
                />

                <InputError class="mt-2" :message="form.errors.telefono" />
            </div>

            <div class="flex items-center justify-end mt-4">
                            
                <Link
                    :href="route('clinica.index')"
                >
                    <SecondaryButton>
                    Volver
                    </SecondaryButton>
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Crear
                </PrimaryButton>
            </div>
        </form>
                
                 </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>