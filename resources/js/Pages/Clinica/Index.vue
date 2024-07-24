
<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import { Head, usePage, Link} from '@inertiajs/vue3';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

DataTable.use(DataTablesCore);

const columns = [
    { data: 'nombre' },
    { data: 'email' },
    { data: 'telefono' },
    { orderable: false},
]

</script>


<template>
    <Head title="Clínicas" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Clínicas</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-3">
                
                    <DataTable :columns="columns" :data="$page.props.clinicas" class="display ms-3" width="100%">
                        <thead>
                            <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Telefono</th>
                            <th>
                                <Link
                                    :href="route('clinica.create')"
                                >
                                    <PrimaryButton>
                                        Crear
                                    </PrimaryButton>
                                </Link>
                            </th>
                            </tr>
                        </thead>
                        <template #column-3="actionButton">
                            <Link
                                :href="route('clinica.show', actionButton.rowData.id)"
                            >
                              <SecondaryButton>Ver</SecondaryButton>
                            </Link>
                            <Link
                                :href="route('clinica.edit', actionButton.rowData.id)"
                            >
                                <SecondaryButton class="ms-3">Editar</SecondaryButton>
                            </Link>
                        </template>
                    </DataTable>
                 </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>
