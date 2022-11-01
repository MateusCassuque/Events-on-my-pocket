<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--Titúlo da página-->
        <title>@yield('title')</title>

        <!--Logo no Titúlo-->
        <link rel="shortcut icon" href="/img/MySchoolLogoSobre1.png" type="image/x-icon">

        <!-- Css do Bootstrap -->
        <link rel="stylesheet" href="/assets/dist/css/bootstrap.min.css">
        
        <!--link para O jquery da pagina-->
        <script src="/assets/dist/jquery/dist/jquery.min.js"></script>
        
        <!--link para O javaScript bootstrap da pagina-->
        <script src="/assets/dist/js/bootstrap.bundle.min.js"></script>
        
        <!--Arquivo compilado style.css-->
        <link rel="stylesheet" href="/css/style.css">

        <!--Arquivo css da pagina filho -->
        <link rel="stylesheet" href=@yield('cssLink')>
        
        <!--link para O javaScript da pagina-->
        <script src=@yield('jsLink')></script>
        
    </head>
    <body>
        <header class="" id="hnav" >
            <nav class="navbar navbar-expand-lg navbar-dark  mt-0 pt-0">
                <a href="/" class="navbar-brand">
                    <img src="/img/social_control.jpg" alt="G-APUPO">
                </a>

                
                <button id="botao" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                
                <div class="collapse navbar-collapse navbar-dark  mt- pt-0" id="navbar">

                    <a href="/" class="navbar-brand" ></a>
                    
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link">Eventos</a>
                        </li>
                        <li class="nav-item">
                            <a href="/Events/create" class="nav-link">Criar Eventos</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a href="/dashboard" class="nav-link">Meus Eventos</a>
                            </li>
                            <li class="nav-item">
                                <form action="/logout" method="post">
                                    @csrf
                                    <a href="/logout"
                                      class="nav-link"
                                      onclick ="event.preventDefault();
                                       this.closest('form').submit();">
                                        Sair
                                    </a>
                                </form>
                            </li>
                        @endauth
                        @guest
                            <li class="nav-item">
                                <a href="/login" class="nav-link">Entrar</a>
                            </li>
                            <li class="nav-item">
                                <a href="/register" class="nav-link">Cadastrar</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </header>
        <main id="corpo">

                @if(session('msg'))
                    <p class="msg"> {{session('msg')}} </p>
                @endif
                
                @yield('content')
        </main>
        <footer>
            <div>
                <p>MFC Events <a href="https://github.com/MateusCassuque" target="blank">&copy; Massuque</a> 2022</p>
            </div>
        </footer>
        <script src="https://unpkg.com/ionicons@5/dist/ionicons.js"></script>
    </body>
</html>
