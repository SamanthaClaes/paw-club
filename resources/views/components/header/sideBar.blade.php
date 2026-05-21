<input type="checkbox" id="sidebar-toggle" class="peer hidden">
<label for="sidebar-toggle" class="md:hidden fixed top-4 left-4 z-50 p-2 rounded bg-element text-text cursor-pointer">
    <svg class="w-6 h-6" aria-hidden="true" viewBox="0 0 20 20">
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
    </svg>
</label>
<nav
    class="fixed top-0 left-0 z-40 w-90 min-h-screen bg-element dark:bg-gray-600 transform -translate-x-full peer-checked:translate-x-0 transition-transform md:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4">
        <ul class="flex flex-col items-center gap-12">
            <li class="flex justify-center">
                <a href="/">
                <x-svg.logo/>
                </a>
            </li>
            <li class="w-full">
                <a href="{{ route('dashboard.index') }}"
                   class="flex items-center p-2 w-full rounded-lg dark:text-white hover:bg-white dark:hover:bg-gray-700 group font-text   ">
                    <x-svg.icons.dashboard/>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            <li class="w-full">
                <a href="{{ route('dashboard.petsitter') }}"
                   class="flex items-center   p-2 w-full  rounded-lg dark:text-white hover:bg-white dark:hover:bg-gray-700 group font-text   ">
                    <x-svg.icons.user/>
                    <span class="ms-3">Nos petsitters</span>
                </a>
            </li>
            <li class="w-full">
                <a href="{{ route('dashboard.dogs') }}"
                   class="flex items-center    p-2 w-full text-text rounded-lg dark:text-white hover:bg-white dark:hover:bg-gray-700 group font-text">
                    <x-svg.icons.animal/>
                    <span class="ms-3">Nos chiens</span>
                </a>
            </li>
            <li class="w-full">
                <a href="{{ route('dashboard.messages') }}"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-white dark:hover:bg-gray-700 group font-text">
                    <x-svg.icons.msg/>
                    <span class="ms-3">Messages</span>
                </a>
            </li>
            <li class="w-full">
                <a href="{{ route('dashboard.request') }}"
                   class="flex items-center  p-2 text-text rounded-lg dark:text-white hover:bg-white dark:hover:bg-gray-700 group font-text">
                    <x-svg.icons.schedule/>
                    <span class="ms-3">Mes demandes</span>
                </a>
            </li>
            <li class="w-full">
                <form method="POST" action="">
                    @csrf
                    <button type="submit"
                            class="flex items-center p-2 w-full text-gray-900 rounded-lg dark:text-white hover:bg-white dark:hover:bg-gray-700 group cursor-pointer">
                        <x-svg.icons.logout/>
                        <span class="ms-3">Se déconnecter</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>

