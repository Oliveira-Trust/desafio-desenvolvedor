@extends('layouts.app-master')

@section('template_title')
    Config
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Config') }}
                            </span>
                          
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Configure</th>
										<th>Description</th>
										<th>Val</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($configs as $config)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $config->configure }}</td>
											<td>{{ $config->description }}</td>
											<td>{{ $config->val }}</td>

                                            <td>
                                                                                              
                                                    <a class="btn btn-sm btn-success" href="{{ route('configs.edit',$config->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                               
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $configs->links() !!}
            </div>
        </div>
    </div>
@endsection
