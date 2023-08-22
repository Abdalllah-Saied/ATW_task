<head>
    @livewireStyles
</head>
<body>
@yield('content')
<livewire:show-post :post="$post">

@livewireScripts
</body>
