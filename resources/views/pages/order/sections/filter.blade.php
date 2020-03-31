<div class="col-lg-12">
    <div class="card">
        <div class="card-header reload-card">
            <h4 class="card-title">Filtragem</h4>
            <div class="heading-elements">
                <a data-action="collapse" class="btn btn-sm btn-icon btn-success"><i id="icon-filter" class="ft-plus white"></i></a>
                <button type="button" class="btn btn-filter btn-sm btn-icon btn-success btn-click"><i class="ft-filter white"></i> Buscar </button>
                <button onclick="window.location.href='{{route('order.index')}}?reset'" type="button" class="btn btn-clear hidden btn-sm btn-icon btn-danger btn-click"><i id="icon-clear" class="ft-x-square white"></i> Limpar </button>
            </div>
        </div>
        <div id="cardFilter" class="card-content collapse">
            <div class="card-body">
                <form class="form">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-xl-2">
                                <div class="form-group">
                                    <label for="projectinput1">Por código</label>
                                    <input class="form-control" name="id">
                                </div>
                            </div>
                            <div class="col-xl-2">
                                <div class="form-group">
                                    <label for="projectinput1">Por nome</label>
                                    <input class="form-control" name="name">
                                </div>
                            </div>
                            <div class="col-xl-2">
                                <div class="form-group">
                                    <label for="projectinput1">Por e-mail</label>
                                    <input class="form-control" name="email">
                                </div>
                            </div>
                            <div class="col-xl-2">
                                <div class="form-group">
                                    <label for="projectinput1">Por telefone</label>
                                    <input class="form-control" name="phone">
                                </div>
                            </div>
                            <div class="col-xl-2">
                                <div class="form-group">
                                    <label for="projectinput1">Por status</label>
                                    <select class="form-control" name="status">
                                        <option value="">Tudo</option>
                                    @foreach( $statusLabel as $statusCode => $statusLabel )
                                        <option value="{{$statusCode}}">{{$statusLabel}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div><div class="col-xl-2">
                                <div class="form-group">
                                    <label for="projectinput1">Registros por pagina</label>
                                    <select class="form-control" name="limit">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
