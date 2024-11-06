<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <script src="
        https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js
        "></script>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css
" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/css/admin_custom.css">
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            @if (Session::has('mensaje'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ Session::get('mensaje') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            {{ $slot }}
        </main>
    </div>


    @stack('modals')

    @livewireScripts
    <script>
        Livewire.on('swal:success', param => {
            Swal.fire({
                title: param[0].title || '¡Éxito!',
                text: param[0].text || 'Operación completada con éxito.',
                icon: 'success',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#1d9a06',
                background: '#def4da',
            });
        });
    </script>

    <script>
        Livewire.on('swal:loading', param => {
            Swal.fire({
                title: param.title || 'Generando consulta',
                text: param.text || 'Por favor, espere...',
                icon: 'info',
                showConfirmButton: false,
                background: '#def4da',
                didOpen: () => {
                    Swal.showLoading(); 
                },
                timer: 5000, 
                timerProgressBar: true,
            });
        });
    </script>

    <script>
        Livewire.on('swal:confirm', param => {
            Swal.fire({
                title: param[0].title,
                text: param[0].text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: param[0].confirmButtonText,
                cancelButtonText: param[0].cancelButtonText,
                confirmButtonColor: '#e1402d',
                cancelButtonColor: '#c4aa2d',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, puedes ejecutar una acción en Livewire
                    Livewire.dispatch('destroy', {
                        id: param[0].data.id
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    // Acción si se cancela (opcional)
                    //Swal.fire('Cancelado', 'La acción ha sido cancelada', 'info');
                    Swal.close();
                }
            });
            console.log(param[0].data.id);
            console.log(param[0].data);
        });
    </script>

</body>

</html>
