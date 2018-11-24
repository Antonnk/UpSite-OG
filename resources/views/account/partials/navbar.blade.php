<nav class="flex-1">
    <ul class="list-reset flex justify-end font-medium">
        @isset(Auth::user()->site)
            <li class="flex items-center px-3">
                <svg class="w-5 fill-current text-blue-lightest" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M8 20H3V10H0L10 0l10 10h-3v10h-5v-6H8v6z"/></svg>
                <a class="text-white hover:text-yellow no-underline ml-2" target="_blank" href="{{ Auth::user()->site->url() }}">Besøg min side</a>
            </li>
        @endisset
        
        <li class="flex items-center px-3">
            <svg class="w-5 fill-current text-blue-lightest" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M3.94 6.5L2.22 3.64l1.42-1.42L6.5 3.94c.52-.3 1.1-.54 1.7-.7L9 0h2l.8 3.24c.6.16 1.18.4 1.7.7l2.86-1.72 1.42 1.42-1.72 2.86c.3.52.54 1.1.7 1.7L20 9v2l-3.24.8c-.16.6-.4 1.18-.7 1.7l1.72 2.86-1.42 1.42-2.86-1.72c-.52.3-1.1.54-1.7.7L11 20H9l-.8-3.24c-.6-.16-1.18-.4-1.7-.7l-2.86 1.72-1.42-1.42 1.72-2.86c-.3-.52-.54-1.1-.7-1.7L0 11V9l3.24-.8c.16-.6.4-1.18.7-1.7zM10 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg>
            <a class="text-white hover:text-yellow no-underline ml-2" href="{{ route('account.edit') }}">Rediger Konto</a>
        </li>
        <li class="flex items-center px-3">
            <svg class="w-5 fill-current text-blue-lightest" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.16 4.16l1.42 1.42A6.99 6.99 0 0 0 10 18a7 7 0 0 0 4.42-12.42l1.42-1.42a9 9 0 1 1-11.69 0zM9 0h2v8H9V0z"/></svg>
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