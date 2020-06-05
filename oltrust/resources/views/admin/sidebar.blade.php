<div class="col-md-3">
    <div class="card">
        <div class="card-header">
        <i class="fas fa-caret-down"></i> Menu
        </div>

        <div class="card-body">
            <ul class="nav" role="tablist">
                <li role="presentation">

                    <a  href="{{ url('/') }}"><i class="fas fa-home"></i> Home</a><br />
                    <br />
                    <a  href="{{ url('/admin/clientes') }}"><i class="fas fa-user"></i> Clientes</a><br />
                    <br />
                    <a  href="{{ url('admin/produtos') }}"><i class="fab fa-product-hunt"></i> Produtos</a><br />
                    <br />
                    <a href="{{ url('/admin/pedidos') }}"><i class="fas fa-shopping-basket"></i> Pedidos</a>
                </li>
            </ul>
        </div>
    </div>
</div>
