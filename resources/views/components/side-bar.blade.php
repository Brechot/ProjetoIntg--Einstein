<nav class="navbar">
    <!-- Botão de abrir o menu (aparece só em telas pequenas) -->
    <button class="btn btn-dark d-lg-none m-3" id="menu-toggle">
        <i class="fa-solid fa-bars"></i>
    </button>
</nav>

<!-- side bar -->
<aside>
    <nav class="sidebar" id="sidebar">
        <!-- Botão de fechar o menu (aparece só em telas pequenas) -->
        <button id="closeSidebar" class="btn btn-light d-lg-none align-self-end m-3">
            <i class="fas fa-times"></i>
        </button>

        <a href="{{route("einstein.home")}}">
            <button class="sidebar-button-user">
                <span>
                  <i class="fa-solid fa-house"></i>
                      <span>Home</span>
                </span>
            </button>
        </a>

        @if (auth()->user()->hasAnyRole(['admin', 'diretor']))
            <a href="{{route("einstein.users.index")}}">
                <button class="sidebar-button-user">
                      <span>
                        <i class="fa-regular fa-user"></i>
                        <span>Usuários</span>
                      </span>
                </button>
            </a>
        @endif

        @if (auth()->user()->hasAnyRole(['admin', 'diretor']))
            <a href="{{route("einstein.roles.index")}}">
                <button class="sidebar-button-regras">
                      <span>
                        <i class="fa-regular fa-pen-to-square"></i>
                        <span>Regras</span>
                      </span>
                </button>
            </a>
        @endif

        @if (auth()->user()->hasAnyRole(['admin', 'diretor', 'ti']))
            <a href="{{route("einstein.laboratory.index")}}">
                <button class="sidebar-button-lab">
                      <span>
                        <i class="fa-solid fa-flask"></i>
                        <span>Laboratórios</span>
                      </span>
                </button>
            </a>
        @endif

        @if (auth()->user()->hasAnyRole(['admin', 'coordenador']))
            <a href="{{route("einstein.discipline.index")}}">
                <button class="sidebar-button-disciplina">
                      <span>
                        <i class="fa-solid fa-book"></i>
                          <span>Disciplinas</span>
                      </span>
                </button>
            </a>
        @endif

        @if (auth()->user()->hasAnyRole(['admin', 'ti']))
            <a href="{{route("einstein.software.index")}}">
                <button class="sidebar-button-software">
                      <span>
                        <i class="fa-solid fa-laptop-code"></i>
                        <span>Software</span>
                      </span>
                </button>
            </a>
        @endif

        @if (auth()->user()->hasAnyRole(['admin', 'coordenador','diretor','ti','professor']))
            <a href="{{route("einstein.reserve.index")}}">
                <button class="sidebar-button-reservas">
                      <span>
                        <i class="fa-solid fa-marker"></i>
                            <span>Reservas</span>
                      </span>
                </button>
            </a>
        @endif


        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">
            <button class="sidebar-button">
                  <span>
                    <i class="fa-solid fa-right-from-bracket"></i> Sair
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                  </span>
            </button>
        </a>

    </nav>
</aside>

<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('active');
    });

    const closeBtn = document.getElementById('closeSidebar');
    const sidebar = document.getElementById('sidebar');

    //fechando a sidebar clicando no X
    closeBtn.addEventListener('click', function() {
        sidebar.classList.remove('active');
    });

    //fechando a sidebar caso clique fora dela
    document.addEventListener('click', function(event) {
        const isClickInsideSidebar = sidebar.contains(event.target);
        const isClickInsideMenuButton = document.getElementById('menu-toggle').contains(event.target);
        if (!isClickInsideSidebar && !isClickInsideMenuButton) {
            sidebar.classList.remove('active');
        }
    });
</script>
