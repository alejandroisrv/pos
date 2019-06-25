<!-- Start Header Top Area -->
<div class="header-top-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="logo-area">
                    <a href="./" style="color:white !important;font-size:1.4rem;">
                      <img src="../assets/img/logo-inv.png" alt="" width="45" style="margin-top:-8px !important;"/> LocalSucre</a>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="header-top-menu">
                    <ul class="nav navbar-nav notika-top-nav">
                        <li class="nav-item nc-al">
                          <a href="../../out" class="nav-link">
                            <span><i class="notika-icon notika-next"></i></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mobile Menu start -->
<div class="mobile-menu-area">
   <div class="container">
       <div class="row">
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="mobile-menu">
                   <nav id="dropdown">
                       <ul class="mobile-menu-nav">
                         <li><a data-toggle="collapse" data-target="#home" href="#">Inicio</a>
                             <ul class="collapse dropdown-header-top">
                                 <li><a href="./" route="home">Dashboard</a>
                             </ul>
                         </li>
                         <li><a data-toggle="collapse" data-target="#inventario" href="#">Inventario</a>
                             <ul class="collapse dropdown-header-top">
                               <li class="routes" route="inventario"><a href="#productos" class="routes" route="inventario">Productos</a>
                               </li>
                               <li><a href="#"  class="routes" route="movimientos">Historial</a>
                               </li>
                             </ul>
                         </li>
                         <li class="routes" route="ventas"><a data-toggle="collapse" data-target="#Charts" href="#">Ventas</a>
                             <ul class="collapse dropdown-header-top">
                               <li class="routes" route="ventas"><a href="#ventas" class="routes" route="ventas">Listado de ventas</a></li>
                               <li class="routes" route="delivery"><a href="#delivery" class="routes" route="delivery">Delivery</a></li>
                               <li class="routes" route="ventas-reportes"><a href="#reportes" class="routes" route="ventas-reportes">Reportes</a></li>
                             </ul>
                         </li>
                         <li><a data-toggle="collapse" data-target="#Charts" href="#">Gastos</a>
                             <ul class="collapse dropdown-header-top">
                               <li class="routes" route="gastos"><a href="#" class="routes" route="gastos">Listado de gastos</a>
                               </li>
                               <li class="routes" route="gastos-reportes"><a class="routes" route="gastos-reportes">Reportes</a>
                               </li>
                               <li class="routes" route="gastos-reportes"><a class="routes" route="gastos-reportes">Reportes</a>
                               </li>
                             </ul>
                         </li>
                       </ul>
                   </nav>
               </div>
           </div>
       </div>
   </div>
</div>
<!-- Mobile Menu end -->
<!-- Main Menu area start-->
<div class="main-menu-area mg-tb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                    <li class="active"><a class="routes" data-toggle="tab" href="#Home" route="home"><i class="notika-icon notika-house"></i> Inicio</a>
                    </li>
                    <li><a class="routes" data-toggle="tab" href="#Inventario" route="inventario"><i class="notika-icon notika-form"></i>Inventario</a>
                    </li>
                    <li><a class="routes" data-toggle="tab" href="#Ventas" route="ventas"><i class="notika-icon notika-promos"></i> Ventas</a>
                    </li>
                    <li><a class="routes" data-toggle="tab" href="#Gastos" route="gastos"><i class="notika-icon notika-bar-chart"></i> Gastos</a>
                    </li>
                    </li>
                </ul>
                <div class="tab-content custom-menu-content">
                    <div id="Home" class="tab-pane in active notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            <li><a href="./" route="home">Dashboard</a>
                            </li>
                            <li><a class="routes" href="#balance" route="balances">Balance</a>
                            </li>
                        </ul>
                    </div>

                    <div id="Inventario" class="tab-pane notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            <li><a href="#productos" class="routes" route="inventario">Productos</a>
                            </li>
                            <li><a href="#" onclick="modalLoad(this)" url="editProducts" redirect="inventario">Agregar productos</a>
                            </li>
                            <li><a href="#" onclick="modalLoad(this)" url="modifyCantidad" data-producto="1" redirect="inventario">Entrada de productos</a>
                            </li>
                            <li><a href="#"  onclick="modalLoad(this)" url="modifyCantidad" data-producto="-1" redirect="inventario">Salida de productos</a>
                            </li>
                            <li><a href="#"  class="routes" route="movimientos">Historial</a>
                            </li>
                            <li><a href="pages/inventario-reportes" target="_blank">Pedido</a>
                            </li>
                        </ul>
                    </div>
                    <div id="Ventas" class="tab-pane notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            <li><a href="#ventas" class="routes" route="ventas">Listado de ventas</a>
                            </li>
                            <li><a href="#delivery" class="routes" route="delivery">Delivery</a>
                            <li><a href="#reportes" class="routes" route="ventas-reportes">Reportes</a>

                            </li>
                        </ul>
                    </div>
                    <div id="Gastos" class="tab-pane notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            <li><a href="#" class="routes" route="gastos">Listado de gastos</a>
                            </li>
                            <li><a href="#" onclick="modalLoad(this)" url="addGastos" redirect="gastos">Agregar gastos</a>
                            </li>
                            <li><a href="#" onclick="modalLoad(this)" url="establerMonto" redirect="gastos">Establecer monto de caja chica</a>
                            </li>
                            <li><a class="routes" route="gastos-reportes">Reportes</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
