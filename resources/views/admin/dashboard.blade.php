@section('views')
    <div>
        <div class="flex lg:flex-nowrap flex-wrap items-center gap-4 justify-stretch w-full">
            <x-analysis_card :data="$totalAdmins" title="Admins" icon="fas fa-user-tie" />
            <x-analysis_card :data="$totalUsers" title="Total Users" icon="fas fa-users" />
            <x-analysis_card :data="$elections" title="Elections" icon="fas fa-box" />
        </div>
    </div>
@endsection
