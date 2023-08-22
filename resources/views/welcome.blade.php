<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>livewire</title>
    <livewire:styles />
    <livewire:scripts />
</head>
<body class="flex justify-center">
<div class="w-10/12 my-10 flex">

@livewire('counter')
    <div class="w-7/12 mx-2 rounded border p-2">
        <livewire:comments />
    </div>
</div>

</body>
</html>
