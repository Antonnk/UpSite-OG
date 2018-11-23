<nav class="flex-1">
    <ul class="list-reset flex justify-end font-medium">
        <li class="flex items-center px-3">
            <svg class="w-5 fill-current text-blue-lightest" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M8 20H3V10H0L10 0l10 10h-3v10h-5v-6H8v6z"/></svg>
            <a class="text-white hover:text-yellow no-underline ml-2" href="">Besøg min side</a>
        </li>
        <li class="flex items-center px-3">
            <svg class="w-5 fill-current text-blue-lightest" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M3.94 6.5L2.22 3.64l1.42-1.42L6.5 3.94c.52-.3 1.1-.54 1.7-.7L9 0h2l.8 3.24c.6.16 1.18.4 1.7.7l2.86-1.72 1.42 1.42-1.72 2.86c.3.52.54 1.1.7 1.7L20 9v2l-3.24.8c-.16.6-.4 1.18-.7 1.7l1.72 2.86-1.42 1.42-2.86-1.72c-.52.3-1.1.54-1.7.7L11 20H9l-.8-3.24c-.6-.16-1.18-.4-1.7-.7l-2.86 1.72-1.42-1.42 1.72-2.86c-.3-.52-.54-1.1-.7-1.7L0 11V9l3.24-.8c.16-.6.4-1.18.7-1.7zM10 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg>
            <a class="text-white hover:text-yellow no-underline ml-2" href="{{ route('account.edit') }}">Rediger Konto</a>
        </li>
        <li class="flex items-center px-3">
            <svg class="w-5 fill-current text-blue-lightest" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 0l10 10-10 10L0 10 10 0zM6 10v3h2v-3h3v3l4-4-4-4v3H8a2 2 0 0 0-2 2z"/></svg>
            <a class="text-white hover:text-yellow no-underline ml-2" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Log ud') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>