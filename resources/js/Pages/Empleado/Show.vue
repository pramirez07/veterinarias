
<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';

defineProps({
});

const empleado = usePage().props.empleado
const clinicas = usePage().props.clinicas
const confirmingDeletion = ref(false);
const viewOnly = !usePage().props.editMode

const form = useForm({
    id: empleado.id,
    nombre: empleado.nombre,
    apellido: empleado.apellido,
    dni: empleado.dni,
    clinica: empleado.clinica_id,
    email: empleado.email,
    telefono: empleado.telefono,
});

const submit = () => {
    console.log(form)
    form.patch(route('empleado.update'), {});
};

const confirmDeletion = (e) => {
    confirmingDeletion.value = true;
    e.preventDefault();
};

const deleteEmpleado= () => {
    form.delete(route('empleado.destroy', form.id), {});
};

const closeModal = (e) => {
    confirmingDeletion.value = false;
    e.preventDefault();
};

</script>


<template>
    <Head title="Empleados" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" v-if="!viewOnly">Editar empleado</h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" v-if="viewOnly">Ver empleado</h2>
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
                    :disabled="viewOnly"
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
                    :disabled="viewOnly"
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
                    :disabled="viewOnly"
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
                    :disabled="viewOnly"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="telefono" value="Teléfono" />

                <TextInput
                    id="telefono"
                    class="mt-1 block w-full"
                    v-model="form.telefono"
                    :disabled="viewOnly"
                />

                <InputError class="mt-2" :message="form.errors.telefono" />
            </div>

            <div class="flex items-center justify-end mt-6 p-4">
                
                <Link
                    :href="route('empleado.index')"
                    v-if="viewOnly"
                >
                    <SecondaryButton>
                    Volver
                    </SecondaryButton>
                </Link>

                <Link
                    :href="route('empleado.edit', form.id)"
                    v-if="viewOnly"
                    class="ms-3"
                >
                    <PrimaryButton>
                    Editar
                    </PrimaryButton>
                </Link>
  
                    <DangerButton @click="confirmDeletion" v-if="viewOnly" class="ms-3">Borrar</DangerButton>

                    <Modal :show="confirmingDeletion" @close="closeModal">
                        <div class="p-6">
                            <h2 class="text-lg font-medium text-gray-900">
                                Estas seguro de que desea borrar este empleado?
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Todos los datos serán borrados permanentememte. Esta acción es irreversible. 
                            </p>

                            <div class="mt-6 flex justify-end">
                                <SecondaryButton @click="closeModal"> Cancelar </SecondaryButton>

                                <DangerButton
                                    class="ms-3"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                    @click="deleteEmpleado"
                            >
                                    Borrar
                                </DangerButton>
                            </div>
                        </div>
                    </Modal>

                <Link
                    :href="route('empleado.show', form.id)"
                    v-if="!viewOnly"
                >
                    <SecondaryButton>
                    Cancelar
                    </SecondaryButton>
                </Link>

                <PrimaryButton v-if="!viewOnly" class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Confirmar
                </PrimaryButton>

                
            </div>
        </form>
                
                 </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>