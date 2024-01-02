<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="flex-row nav navbar-nav">
            <li class="mr-auto nav-item"><a class="navbar-brand" href="{{ route('home') }}">
                    <div class="brand-logo" style="background : url('{{ asset('setting_images') }}/{{ $setting->logo }}') no-repeat;"></div>
                    <h2 class="mb-0 brand-text">{{ $setting->shop_name }}</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="pr-0 nav-link modern-nav-toggle" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @permission(['Dashboard','All'])
            <li class=" nav-item"><a href="{{ route('home') }}"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Email">Dashboard</span></a>
            </li>
            @endpermission
            @permission(['Medicine List','All'])
            <li class=" nav-item"><a href="index.html"><i class="fa fa-plus-square-o"></i><span class="menu-title" data-i18n="Dashboard">Medicine</span></a>
                <ul class="menu-content">
                    @permission(['Medicine Add','All'])
                    <li class=""><a href="{{ route('medicine.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Add Medicine</span></a>
                    </li>
                    @endpermission
                    @permission(['Medicine List','All'])
                    <li><a href="{{ route('medicine.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="eCommerce">Manage Medicine</span></a>
                    </li>
                    @endpermission
                    @permission(['Medicine Stock','All'])
                    <li><a href="{{ route('medicine.stock') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="eCommerce">Stock</span></a>

                    </li>
                    @endpermission
                    @permission(['Medicine Expire','All'])
                    <li><a href="{{ route('medicine.expire') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="eCommerce">Expiration</span></a>
                    </li>
                    @endpermission

                    @permission(['Unit List','All'])
                    <li><a href="{{ route('unit.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="eCommerce">Unit</span></a>
                    </li>
                    @endpermission
{{--                    @permission(['Medicine Report','All'])--}}
{{--                    <li><a href="{{ route('med.report') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="eCommerce">Medicine Report</span></a>--}}
{{--                    </li>--}}
{{--                    @endpermission--}}
                    @permission(['Medicine checkStock','All'])
                    <li><a href="{{ route('med.stock') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="eCommerce">Check Stock</span></a>
                    </li>
                    @endpermission
                    @permission(['Sales Value','All'])
                    <li class=""><a href="{{ route('salesValue') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Sales Value</span></a>
                    </li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission(['Sale Add','All'])
            <li class=" nav-item"><a href="index.html"><i class="fa fa-cart-plus"></i><span class="menu-title" data-i18n="Dashboard">Sales</span></a>
                <ul class="menu-content">
                    @permission(['Sale Add','All'])
                    <li class=""><a href="{{ route('sales.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Create Sales</span></a>
                    </li>
                    @endpermission
                    @permission(['wholesale Add','All'])
                    <li class=""><a href="{{ route('sales.wholesale') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Whole Sales</span></a>
                    </li>
                    @endpermission
                    @permission(['Sale List','All'])
                    <li><a href="{{ route('sales.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="eCommerce">Manage Sales</span></a>
                    </li>
                    @endpermission
{{--                    @permission(['Sale Report','All'])--}}
{{--                    <li><a href="{{ route('sales.report') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="eCommerce">Sales Report</span></a>--}}
{{--                    </li>--}}
{{--                    @endpermission--}}
                    @permission(['Sale Person','All'])
                    <li><a href="{{ route('saPerson') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="eCommerce">Sales Person Filter</span></a>
                    </li>
                    @endpermission
                    @permission(['Sales Filter','All'])
                    <li class=""><a href="{{ route('sales.filter') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Filter Sales List</span></a>
                    </li>
                    @endpermission
                    @permission(['Customer Purchase','All'])
                    <li class=""><a href="{{ route('customer.purchase') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Customer Purchase</span></a>
                    </li>
                    @endpermission
                    @permission(['Profoma Invoice','All'])
                    <li class=""><a href="{{ route('profoma.invoice') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Profoma Invoice</span></a>
                    </li>
                    @endpermission

                </ul>
            </li>
            @endpermission
            @permission(['Return Sales','All'])
             <li class=" nav-item"><a href="index.html"><i class="fa fa-thumbs-down"></i><span class="menu-title" data-i18n="Dashboard">Returns</span></a>
                <ul class="menu-content">
                    @permission(['Return Sales','All'])
                    <li class=""><a href="{{ route('sales.return') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Sales Return</span></a>
                    </li>
                    @endpermission
                    @permission(['Return Purchase','All'])
                    <li class=""><a href="{{ route('purchases.return') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Purchases Return</span></a>
                    </li>
                    @endpermission
                    @permission(['Return Sales List','All'])
                    <li class=""><a href="{{ route('return.list') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Sales Return List</span></a>
                    </li>
                    @endpermission



                </ul>
            </li>
            @endpermission
            @permission(['Purchase Add','All'])
            <li class=" nav-item"><a href="index.html"><i class="fa fa-product-hunt"></i><span class="menu-title" data-i18n="Dashboard">Purchases</span></a>
               <ul class="menu-content">
                   @permission(['Purchase Add','All'])
                   <li class=""><a href="{{ route('purchase.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Add Purchase</span></a>
                   </li>
                   @endpermission
                   @permission(['Purchase List','All'])
                   <li class=""><a href="{{ route('purchase.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Manage Purchase</span></a>
                   </li>
                   @endpermission
                   @permission(['Purchase Filter','All'])
                   <li class=""><a href="{{ route('purchase.filter') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Filter Purchase</span></a>
                   </li>
                   @endpermission
                   @permission(['Purchase Filter','All'])
                   <li class=""><a href="{{ route('filterMedicine') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Filter Purchase Medicine</span></a>
                   </li>
                   @endpermission


               </ul>
           </li>
           @endpermission
           @permission(['Wastage Add','All'])
           <li class=" nav-item"><a href="index.html"><i class="fa fa-trash-o"></i><span class="menu-title" data-i18n="Dashboard">Wastages</span></a>
              <ul class="menu-content">

                  @permission(['Wastage Add','All'])
                  <li class=""><a href="{{ route('wastage.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Add Wastage</span></a>
                  </li>
                  @endpermission
                  @permission(['Wastage List','All'])
                  <li class=""><a href="{{ route('wastage.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Manage Wastage</span></a>
                  </li>
                  @endpermission
                  @permission(['WastageType Add','All'])
                  <li class=""><a href="{{ route('wastage_type.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Add Wastage Type</span></a>
                  </li>
                  @endpermission


              </ul>
          </li>
          @endpermission
            @permission(['Expense Add','All'])
            <li class=" nav-item"><a href="index.html"><i class="fa fa-money"></i><span class="menu-title" data-i18n="Dashboard">Expenses</span></a>
                <ul class="menu-content">
                    @permission(['Expense Add','All'])
                    <li class=""><a href="{{ route('expense.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Add Expense</span></a>
                    </li>
                    @endpermission
                    @permission(['Payment List','All'])
                    <li class=""><a href="{{ route('payment.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Payment</span></a>
                    </li>
                    @endpermission
                    @permission(['Expense Category List','All'])
                    <li class=""><a href="{{ route('expensecategory.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Expense Category</span></a>
                    </li>
                    @endpermission
                    @permission(['Expense Report','All'])
                    <li class=""><a href="{{ route('expense.report') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Report</span></a>
                    </li>
                    @endpermission


                </ul>
            </li>
            @endpermission

            @permission(['User List','All'])
            <li class=" nav-item"><a href="{{route('user.index')}}"><i class="feather icon-user"></i><span class="menu-title" data-i18n="User">Users</span></a>
             @endpermission
             @permission(['Shop List','All'])
             <li class=" nav-item"><a href="{{route('shops.index')}}"><i class="feather icon-at-sign"></i><span class="menu-title" data-i18n="User">Shops</span></a>
              @endpermission
              @permission(['Transfer List','All'])
              <li class=" nav-item"><a href="{{route('transfer.index')}}"><i class="feather icon-at-sign"></i><span class="menu-title" data-i18n="User">Transfers</span></a>
               @endpermission
              @permission(['Prescription List','All'])
            <li class=" nav-item"><a href="{{route('medicine.prescription')}}"><i class="fa fa-heart"></i><span class="menu-title" data-i18n="User">Prescriptions</span></a>
             @endpermission

            @permission(['Supplier List','All'])
            <li class=" nav-item"><a href="{{route('supply.index')}}"><i class="feather icon-anchor"></i><span class="menu-title" data-i18n="User">Suppliers</span></a>
            </li>
            @endpermission
            @permission(['Customer List','All'])
            <li class=" nav-item"><a href="{{route('customer.index')}}"><i class="fa fa-users"></i><span class="menu-title" data-i18n="User">Customers</span></a>
            </li>
            @endpermission
            @permission(['Category List','All'])
            <li class=" nav-item"><a href="{{route('category.index')}}"><i class="fa fa-list-ul"></i><span class="menu-title" data-i18n="User">Category</span></a>
            </li>
            @endpermission

             @permission(['MedicineType List','All'])
            <li class=" nav-item"><a href="{{route('type.index')}}"><i class="fa fa-files-o"></i><span class="menu-title" data-i18n="User">Medicine Types</span></a>
            </li>
            @endpermission
            @permission(['Manufacture List','All'])
            <li class=" nav-item"><a href="{{route('manufacture.index')}}"><i class="fa fa-certificate"></i><span class="menu-title" data-i18n="User">Manufacturer</span></a>
            </li>
            @endpermission

            @permission(['All'])
            <li class=" nav-item"><a href="index.html"><i class="fa fa-thumbs-down"></i><span class="menu-title" data-i18n="Dashboard">Report</span></a>
                <ul class="menu-content">
                    @permission(['All'])
                    <li class=""><a href="{{ route('report.sales') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Sales Report</span></a>
                    </li>
                    @endpermission
                    @permission(['All'])
                    <li class=""><a href="{{ route('purchases.return') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Purchases Report</span></a>
                    </li>
                    @endpermission
                    @permission(['All'])
                    <li class=""><a href="{{ route('return.list') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Medicine Report</span></a>
                    </li>
                    @endpermission
                </ul>
            </li>
            @endpermission

            @permission(['Permission List','All'])
            <li class=" nav-item"><a href="{{route('permission.index')}}"><i class="feather icon-lock"></i><span class="menu-title" data-i18n="User">Permissions</span></a>
                @endpermission
            @permission(['Role List','All'])
            <li class=" nav-item"><a href="{{route('role.index')}}"><i class="fa fa-empire"></i><span class="menu-title" data-i18n="User">Roles</span></a>
            </li>
            @endpermission
            @permission(['Settings','All'])
            <li class=" nav-item"><a href="{{ route('account') }}"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="User">Setting</span></a>
            </li>
            @endpermission

        </ul>
    </div>
</div>
