<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Welcome</div>
                <a class="nav-link {{ Request::is('user/dashboard') ? 'active' : '' }}"
                    href="{{ url('user/dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>


                <a class="nav-link {{ Request::is('user/types') || Request::is('user/add-types') || Request::segment(2) === 'stypes' || Request::segment(2) === 'edit-types' ? 'collapsed' : 'collapsed' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsExpensesTypes"
                    aria-expanded="false" aria-controls="collapseLayoutsExpensesTypes">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Expenses Types
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>

                <div class="collapse {{ Request::is('user/types') || Request::is('user/add-types') || Request::segment(2) === 'stypes' || Request::segment(2) === 'edit-types' ? 'show' : '' }}"
                    id="collapseLayoutsExpensesTypes" aria-labelledby="headingExpensesTypes"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('user/add-types') ? 'active' : '' }}"
                            href="{{ url('user/add-types') }}">Add Expenses Type</a>
                        <a class="nav-link {{ Request::is('user/types') || Request::is('user/edit-types/*') || Request::is('user/stypes/*') ? 'active' : '' }}"
                            href="{{ url('user/types') }}">View Expenses Types</a>
                    </nav>
                </div>



                <a class="nav-link {{ Request::is('user/expenses') || Request::is('user/add-expenses') || Request::segment(2) === 'edit-expenses' ? 'collapsed' : 'collapsed' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsExpenses"
                    aria-expanded="false" aria-controls="collapseLayoutsExpenses">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Monthly Expenses
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>

                <div class="collapse {{ Request::is('user/expenses') || Request::is('user/add-expenses') || Request::segment(2) === 'edit-expenses' ? 'show' : '' }}"
                    id="collapseLayoutsExpenses" aria-labelledby="headingExpenses" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('user/add-expenses') ? 'active' : '' }}"
                            href="{{ url('user/add-expenses') }}">Add Expenses</a>
                        <a class="nav-link {{ Request::is('user/expenses') || Request::is('user/edit-expenses/*') || Request::segment(2) === 'edit-expenses' ? 'active' : '' }}"
                            href="{{ url('user/expenses') }}">View Expenses</a>
                    </nav>
                </div>




                <a class="nav-link {{ Request::is('user/lexpenses') || Request::is('user/add-lexpenses') ? 'collapsed' : 'collapsed' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsLateExpenses"
                    aria-expanded="false" aria-controls="collapseLayoutsLateExpenses">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Late Expenses
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>

                <div class="collapse {{ Request::is('user/lexpenses') || Request::is('user/add-lexpenses') ? 'show' : '' }}"
                    id="collapseLayoutsLateExpenses" aria-labelledby="headingLateExpenses"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('user/add-lexpenses') ? 'active' : '' }}"
                            href="{{ url('user/add-lexpenses') }}">Add Late Expenses</a>
                        <a class="nav-link {{ Request::is('user/lexpenses') || Request::is('user/edit-lexpenses/*') ? 'active' : '' }}"
                            href="{{ url('user/lexpenses') }}">View Late Expenses</a>
                    </nav>
                </div>







                <a class="nav-link {{ Request::is('user/btypes') || Request::is('user/add-btypes') || Request::segment(2) === 'edit-btypes' ? 'collapsed' : 'collapsed' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsBudgetTypes"
                    aria-expanded="false" aria-controls="collapseLayoutsBudgetTypes">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Budget Types
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>

                <div class="collapse {{ Request::is('user/btypes') || Request::is('user/add-btypes') || Request::segment(2) === 'edit-btypes' ? 'show' : '' }}"
                    id="collapseLayoutsBudgetTypes" aria-labelledby="headingBudgetTypes"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('user/add-btypes') ? 'active' : '' }}"
                            href="{{ url('user/add-btypes') }}">Add Budget Type</a>
                        <a class="nav-link {{ Request::is('user/btypes') || Request::is('user/edit-btypes/*') || Request::segment(2) === 'edit-btypes' ? 'active' : '' }}"
                            href="{{ url('user/btypes') }}">View Budget Types</a>
                    </nav>
                </div>


                <a class="nav-link {{ Request::is('user/summary') || Request::is('user/add-summary') ? 'collapse show' : 'collapsed' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsSummary"
                    aria-expanded="false" aria-controls="collapseLayoutsSummary">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Monthly Receipt
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('user/summary') || Request::is('user/add-summary') ? 'show' : '' }}"
                    id="collapseLayoutsSummary" aria-labelledby="headingSummary" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('user/add-summary') ? 'active' : '' }}"
                            href="{{ url('user/add-summary') }}">Add ReceIpt</a>

                    </nav>
                </div>


                <a class="nav-link {{ Request::is('user/summary') ? 'active' : '' }}"
                    href="{{ url('user/summary') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    View Monthly Summary
                </a>


                <a class="nav-link {{ Request::is('user/ysummary') || Request::is('user/add-ysummary') ? 'collapse show' : 'collapsed' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsySummary"
                    aria-expanded="false" aria-controls="collapseLayoutsySummary">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Yearly Summary
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('user/ysummary') || Request::is('user/add-ysummary') ? 'show' : '' }}"
                    id="collapseLayoutsySummary" aria-labelledby="headingSummary" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('user/add-ysummary') ? 'active' : '' }}"
                            href="{{ url('user/add-ysummary') }}">Add Yearly Budget</a>
                        <a class="nav-link {{ Request::is('user/ysummary') ? 'active' : '' }}"
                            href="{{ url('user/ysummary') }}">View Yearly Summary</a>
                    </nav>
                </div>


            </div>
        </div>





        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:{{ strtoupper(Auth::user()->name) }}</div>
        </div>
    </nav>
</div>
