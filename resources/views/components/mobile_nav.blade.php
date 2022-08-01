<footer class="h-16 bg-white md:hidden w-full fixed bottom-0 flex justify-center items-center px-5">
    <ul class="flex justify-between items-center w-full px-7">
        <li>
            <a href="{{ route('notifications') }}">
                <x-icons.bell_icon2 class="h-5 w-5" style="" />
            </a>
        </li>

        <li>
            <a href="{{ route('explore') }}">
                <x-icons.election_icon class="h-9 w-9" style="color: #0000FF;" />
            </a>
        </li>

        <li>
            <a href="{{ route('profile') }}">
                <x-icons.user_icon class="h-5 w-5" style="" />
            </a>
        </li>
    </ul>
</footer>
