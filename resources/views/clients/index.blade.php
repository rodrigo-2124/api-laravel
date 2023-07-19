<x-app-layout>

    <x-slot name="header">

         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Clientes
        </h2>

    </x-slot>

    <x-container class="py-8">

        <x-form-section>
            <x-slot name="title">
                Crea un nuevo Cliente
            </x-slot>

            <x-slot name="description">
                Ingrese los datos solicitados para crear un nuevo cliente.
            </x-slot>

            <x-slot name="actions">
                <x-primary-button>
                    Crear
                </x-primary-button>
            </x-slot>

        </x-form-section>

    </x-container>

</x-app-layout>