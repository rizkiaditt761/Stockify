<x-sidebar-dashboard>

    {{-- Dashboard --}}
    <x-sidebar-menu-dashboard
        routeName="dashboard"
        title="Dashboard"/>

    {{-- ADMIN --}}
    @if(auth()->user()->role == 'admin')

        <x-sidebar-menu-dashboard
            routeName="categories.index"
            title="Categories"/>

        <x-sidebar-menu-dashboard
            routeName="suppliers.index"
            title="Suppliers"/>

        <x-sidebar-menu-dashboard
            routeName="products.index"
            title="Products"/>

        <x-sidebar-menu-dashboard
            routeName="users.index"
            title="Users Management"/>

    @endif


    {{-- ADMIN & STAFF --}}
    @if(in_array(auth()->user()->role, ['admin','staff']))

        <x-sidebar-menu-dashboard
            routeName="stock_transactions.index"
            title="Transactions"/>

    @endif


    {{-- ADMIN & MANAGER --}}
    @if(in_array(auth()->user()->role, ['admin','manager']))

        <x-sidebar-menu-dashboard
            routeName="stock.monitoring.index"
            title="Stock Monitoring"/>

        <x-sidebar-menu-dashboard
            routeName="stock.opname.index"
            title="Stock Opname"/>

        <x-sidebar-menu-dashboard
        routeName="reports.index"
        title="Reports"/>

    @endif

</x-sidebar-dashboard>