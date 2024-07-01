<!DOCTYPE html>
<html>

<head>
    <title>@yield('title', 'My Application')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #000000;
            --primary-light: #121212;
            --secondary: #0ee951;
            --tertiary: #00dabf;
            --gradient: linear-gradient(129deg, rgba(0, 198, 63, 1) -72%, #00FFF5 97%);
        }


        #loader {
            margin: 0px;
            padding: 0px;
            position: fixed;
            inset: 0px;
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(--primary-light);
            z-index: 10000000;
            display: none;
        }

        .loader {
            width: 50px;
            aspect-ratio: 1;
            border-radius: 50%;
            background:
                radial-gradient(farthest-side, #00FFF5 94%, rgba(0, 198, 63, .7)) top/8px 8px no-repeat,
                conic-gradient(rgba(0, 198, 63, .7) 30%, #00FFF5);
            -webkit-mask: radial-gradient(farthest-side, #0000 calc(100% - 8px), #000 0);
            animation: loader_spinner 1s infinite linear;
        }

        @keyframes loader_spinner {
            100% {
                transform: rotate(1turn)
            }
        }
    </style>
    @yield('style')
</head>

<body>
    <div id="loader">
        <div class="loader"></div>
    </div>

    <div class="container mt-5">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: '{{ session('success') }}',
                });
            @endif

            @if ($errors->any())
                var errorMessages = '';
                @foreach ($errors->all() as $error)
                    errorMessages += '{{ $error }}<br>';
                @endforeach

                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    html: errorMessages,
                });
            @endif
        });

        function loader(type = 'show', timeOut = 0) {
            setTimeout(() => {
                if (type == 'show') {
                    $('#loader').css('display', 'flex');
                } else if (type == 'hide') {
                    $('#loader').css('display', 'none');
                }
            }, timeOut);
        }

        function validCpf(cpf) {
            cpf = cpf.replace(/[^\d]+/g, '');
            if (cpf == '') return false;
            if (cpf.length != 11 ||
                cpf == "00000000000" ||
                cpf == "11111111111" ||
                cpf == "22222222222" ||
                cpf == "33333333333" ||
                cpf == "44444444444" ||
                cpf == "55555555555" ||
                cpf == "66666666666" ||
                cpf == "77777777777" ||
                cpf == "88888888888" ||
                cpf == "99999999999")
                return false;
            add = 0;
            for (i = 0; i < 9; i++)
                add += parseInt(cpf.charAt(i)) * (10 - i);
            rev = 11 - (add % 11);
            if (rev == 10 || rev == 11)
                rev = 0;
            if (rev != parseInt(cpf.charAt(9)))
                return false;
            add = 0;
            for (i = 0; i < 10; i++)
                add += parseInt(cpf.charAt(i)) * (11 - i);
            rev = 11 - (add % 11);
            if (rev == 10 || rev == 11)
                rev = 0;
            if (rev != parseInt(cpf.charAt(10)))
                return false;
            return true;
        }
    </script>
    @yield('script')
</body>

</html>
