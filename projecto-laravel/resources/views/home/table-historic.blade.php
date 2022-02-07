@forelse ($historic as $item)
    <tr>
        <td>{{$item->currency_origin??''}}</td>
        <td>{{$item->currency_destin??''}}</td>
        <td>{{trans('coin_convertion.success.array.payment_method.'.$item->payment_method)??$item->payment_method}}</td>
        <td>{{$item->conversion_value??''}}</td>
        <td>{{$item->purchased_total??''}}</td>
        <td>{{date(trans('coin_convertion.datetime_format'), strtotime($item->created_at))??''}}</td>
    </tr>
@empty
    <tr>
        <td colspan="6" align="center">{{trans('coin_convertion.table.empty')}}</td>
    </tr>
@endforelse
