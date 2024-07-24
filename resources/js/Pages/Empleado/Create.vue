
<script setup>
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

const clinicas = usePage().props.clinicas

const form = useForm({
    nombre: '',
    apellido:'',
    dni:'',
    clinica:'',
    email: '',
    telefono: null,
});

const submit = () => {
    form.post(route('empleado.store'), {});
};

</script>


<template>
    <Head title="Empleados" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear empleado</h2>
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
                <InputLabel for="apellido" value="Apellido" />

                <TextInput
                    id="apellido"
                    class="mt-1 block w-full"
                    v-model="form.apellido"
                    required
                />

                <InputError class="mt-2" :message="form.errors.apellido" />
            </div>

            <div class="mt-4">
                <InputLabel for="dni" value="DNI" />

                <TextInput
                    id="dni"
                    class="mt-1 block w-full"
                    v-model="form.dni"
                    required
                />

                <InputError class="mt-2" :message="form.errors.dni" />
            </div>

            <div class="mt-4">
                <InputLabel for="clinica" value="Clínica" />
                    <select v-model="form.clinica" class="mt-1 block w-full" :disabled="viewOnly">
                        <option disabled value="">Selecciona una clínica</option>
                        <option v-for="clinica in clinicas" :value="clinica.id">
                            {{ clinica.nombre }}
                        </option>
                    </select>

                <InputError class="mt-2" :message="form.errors.clinica" />
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
                    :href="route('empleado.index')"
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