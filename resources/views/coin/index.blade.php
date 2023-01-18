@extends('layouts.app-master')

@section('template_title')
    Coin
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Coin') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('coins.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
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
                                        
										<th>Coin Dest</th>
										<th>Coin Base</th>
										<th>Label</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coins as $coin)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $coin->coin_dest }}</td>
											<td>{{ $coin->coin_base }}</td>
											<td>{{ $coin->label }}</td>

                                            <td>
                                                <form action="{{ route('coins.destroy',$coin->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('coins.show',$coin->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('coins.edit',$coin->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $coins->links() !!}
            </div>
        </div>
    </div>
@endsection
