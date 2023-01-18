@extends('layouts.app-master')

@section('template_title')
    Coin Ask
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Coin Ask') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('coin-asks.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Value Of</th>
										<th>Payment Method</th>
										<th>Ranting Ask</th>
										<th>Tax Convert</th>
										<th>Tax Payment</th>
										<th>Total Used</th>
										<th>Total Dest</th>
										<th>User Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coinAsks as $coinAsk)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $coinAsk->coin_dest }}</td>
											<td>{{ $coinAsk->coin_base }}</td>
											<td>{{ $coinAsk->value_of }}</td>
											<td>{{ $coinAsk->payment_method }}</td>
											<td>{{ $coinAsk->ranting_ask }}</td>
											<td>{{ $coinAsk->tax_convert }}</td>
											<td>{{ $coinAsk->tax_payment }}</td>
											<td>{{ $coinAsk->total_used }}</td>
											<td>{{ $coinAsk->total_dest }}</td>
											<td>{{ $coinAsk->user_id }}</td>

                                            <td>
                                                <form action="{{ route('coin-asks.destroy',$coinAsk->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('coin-asks.show',$coinAsk->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('coin-asks.edit',$coinAsk->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $coinAsks->links() !!}
            </div>
        </div>
    </div>
@endsection
