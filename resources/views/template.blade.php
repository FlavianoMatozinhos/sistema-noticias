<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choquei Conça</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.min.css">

    {{-- CSS --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link rel="icon" href="{{ asset('images/choquei.png') }}" type="image/x-icon">

    <script src="https://cdn.tiny.cloud/1/q5uay7bl3db8b12nyuw78p608w2whq7p3ynuzri3ef9l1hdb/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
    <link href="//vjs.zencdn.net/8.3.0/video-js.min.css" rel="stylesheet">

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('./images/choquei.png') }}" alt="Logo">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent container">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item row align-items-center">
                        <a class="nav-link col" href="https://www.instagram.com" target="_blank">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        @auth 
                            
                            <div class="dropdown nav-link instagram-icon col">
                                <button class="btn btn_user dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-regular fa-user"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    @if(auth()->user()->isAdmin)
                                        <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                    @endif
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                
                                            <a class="dropdown-item" :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('Sair') }}
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            
                        @else 
                            <div class="dropdown nav-link instagram-icon col">
                                <button class="btn btn_user dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-regular fa-user"></i>
                                </button>
                                <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Entrar</a></li>
                                </ul>
                            </div>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/c236711130.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="//vjs.zencdn.net/8.3.0/video.min.js"></script>

    <script>
        tinymce.init({
          selector: 'textarea',
          plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
          toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
          tinycomments_mode: 'embedded',
          tinycomments_author: 'Author name',
          mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
          ],
          ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const postItems = document.getElementsByClassName('post-item');

        searchInput.addEventListener('input', function() {
            const searchText = searchInput.value.trim().toLowerCase();
            
            Array.from(postItems).forEach(function(postItem) {
                const title = postItem.getAttribute('data-title');
                const display = title.includes(searchText) ? 'block' : 'none';

                console.log(postItem.closest('.col-4'));

                postItem.closest('.col-4').style.display = display;
            });
        });
    });
    </script>

    <script src="https://vjs.zencdn.net/7.2.3/video.js"></script>
    <script>
    videojs.Hls.xhr.beforeRequest = function (options) {
        let newUri = options.uri.includes(".ts") ? options.uri + "?q=test" : options.uri;
        return {
            ...options,
            uri: newUri,
        };
    };
    videojs.options.autoplay = false;
    
    let player = videojs("my-video-1", {responsive: true}, () => {

        player.on('loadeddata', function() {
        player.pause()
        });

        player.one("loadedmetadata", () => {
            let qualities = player
                .tech({ IWillNotUseThisInPlugins: true })
                .hls.representations();
            createButtonsQualities({
                class: "item",
                qualities: qualities,
                father: player.controlBar.el_,
                player: player
            });

            player.play();
        });
    });

    function createAutoQualityButton(params) {
        let button = document.createElement("div");

        button.id = "auto";
        button.innerText = `Auto`;
        button.classList.add("selected");

        if (params && params.class) button.classList.add(params.class);

        button.addEventListener("click", () => {
            removeSelected(params);
            button.classList.add("selected");
            params.qualities.map((quality) => quality.enabled(true));
        });

        return button;
    }

    function createButtonsQualities(params) {
        let contentMenu = document.createElement("div");
        let menu = document.createElement("div");
        let icon = document.createElement("div");

        if (icon && menu) {
            icon.addEventListener('click', function() {
                menu.classList.toggle('show-menu');
            });

            document.addEventListener('click', function(event) {
                if (!menu.contains(event.target) && !icon.contains(event.target)) {
                    menu.classList.remove('show-menu');
                }
            });
        }

        let fullscreen = params.father.querySelector(".vjs-fullscreen-control");
        contentMenu.appendChild(icon);
        contentMenu.appendChild(menu);
        fullscreen.before(contentMenu);

        menu.classList.add("menu");
        icon.classList.add("icon", "vjs-icon-cog");
        contentMenu.classList.add("contentMenu");

        let autoButton = createAutoQualityButton(params);
        menu.appendChild(autoButton);

        params.qualities.sort((a, b) => {
            return b.bandwidth - a.bandwidth; // Inverte a ordem dos valores de BANDWIDTH
        });

        params.qualities.map((quality) => {
            let button = document.createElement("div");

            if (params && params.class) button.classList.add(params.class);

            button.id = quality.bandwidth.toString(); // Define o ID do botão como o valor do BANDWIDTH
            button.innerText = getQualityLabel(quality.bandwidth); // Define o texto do botão com base no valor do BANDWIDTH

            button.addEventListener("click", () => {
                resetQuality(params);
                button.classList.add("selected");
                quality.enabled(true);
            });

            menu.appendChild(button);
        });

        setInterval((player) => {
            let auto = document.querySelector("#auto");
            current = player.tech({ IWillNotUseThisInPlugins: true }).hls.selectPlaylist().attributes.RESOLUTION.height;

            document.querySelector("#auto").innerHTML =
                auto.classList.contains("selected") ? `Auto <span class='current'>${current}p</span>` : "Auto";
        }, 1000, params.player); // Passa o player como argumento para o setInterval
    }

    // Função para obter o rótulo de qualidade com base no valor do BANDWIDTH
    function getQualityLabel(bandwidth) {
        if (bandwidth <= 415800) {
            return '360p';
        } else if (bandwidth <= 690800) {
            return '720p';
        } else {
            return '1080p';
        }
    }

    function removeSelected(params) {
        document.querySelector("#auto").classList.remove("selected");
        [...document.querySelectorAll(`.${params.class}`)].map(
            (quality) => {
                quality.classList.remove("selected");
            }
        );
    }

    function resetQuality(params) {
        removeSelected(params);

        for (let quality of params.qualities) {
            quality.enabled(false);
        }
    }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const inputs = document.querySelectorAll('.input');
        let currentIndex = 0;
    
        function showNextSlide() {
            inputs[currentIndex].checked = false;
            currentIndex = (currentIndex + 1) % inputs.length;
            inputs[currentIndex].checked = true;
        }
    
        setInterval(showNextSlide, 5000);
        });
    </script>
</body>
</html>
