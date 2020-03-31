<?php
function get_label_bool( $value, $returnLabel = false, $labelTrue=null, $labelFalse=null ){

    if( empty( $labelTrue ) ) {$labelTrue  = \Lang::get('default.active');}
    if( empty( $labelFalse ) ){$labelFalse = \Lang::get('default.inactive');}


    if( !$returnLabel ) {
        $return = $value ? $labelTrue : $labelFalse;
    } else {
        if( $value ){
            $return = '<i class="la la-dot-circle-o success font-medium-1 mr-1"></i> ' . $labelTrue;
        } else {
            $return = '<i class="la la-dot-circle-o warning font-medium-1 mr-1"></i> ' . $labelFalse;
        }
    }

    return $return;
}

function route_is_input(){
    return strpos( getRouteName(), 'input') === FALSE ? FALSE : TRUE;
}

function convert_sn_bool($char){
    $char = trim( $char );
    return empty( $char ) ? null : ($char == 'S' || $char == 1 ? 1 : 0);
}


function format_paginate( $resultPaginateModel ){
    if( empty( $resultPaginateModel ) ){
        $resultPaginateModel = [];
    } else{

        if( !is_array( $resultPaginateModel ) ) {
            $resultPaginateModel = $resultPaginateModel->toArray();
        }

        array_pull( $resultPaginateModel, 'from' );
        array_pull( $resultPaginateModel, 'first_page_url' );
        $lastPage = array_pull( $resultPaginateModel, 'last_page_url' );
        $nextPage = array_pull( $resultPaginateModel, 'next_page_url' );
        $prevPage = array_pull( $resultPaginateModel, 'prev_page_url' );
        $path     = array_pull( $resultPaginateModel, 'path' );
        $resultPaginateModel['prev_page'] = null;
        $resultPaginateModel['next_page'] = null;

        if( !empty( $nextPage ) ){$resultPaginateModel['next_page'] = (int)str_replace( $path.'?page=', '', $nextPage);}
        if( !empty( $prevPage ) ){$resultPaginateModel['prev_page'] = (int)str_replace( $path.'?page=', '', $prevPage);}

        $resultPaginateModel['limit'] = array_pull( $resultPaginateModel, 'per_page' );
    }

    return $resultPaginateModel;
}


function create_section_product_addition( &$array, $onlyOrder=false ){

    $isAdditional = false;
    foreach ( $array as $key => $item ){
        if( $item['product_id_parent'] ){
            $row = search_in_array( $array, 'product_id', $item['product_id_parent'] );
            if( count( $row ) === 1 ){
                $subItems[ $item['product_id_parent'] ][] = $item;
                unset( $array[$key] );

                foreach ( $row as $key2 => $item2 ){
                    $array[$key2]['additional'][] = $item;
                    $isAdditional                 = true;
                }

            }
        }
    }

    if( $isAdditional && $onlyOrder === true ){
        $item = [];
        foreach ( $array as $key => $row ){
            if( array_has( $row, 'additional' ) ){
                $additional = array_pull( $row, 'additional' );
                $item       = array_merge( $item, array_merge( [$row], $additional ) );
            } else {
                $item[] = $row;
            }
        }
        $array = $item;
        unset( $item );
    }
}

function insertValueAtPosition($arr, $insertedArray, $position) {
    $i = 0;
    $new_array=[];
    foreach ($arr as $key => $value) {
        if ($i == $position) {
            foreach ($insertedArray as $ikey => $ivalue) {
                $new_array[$ikey] = $ivalue;
            }
        }
        $new_array[$key] = $value;
        $i++;
    }
    return $new_array;
}

function implodeArrayQueryString($array){
    return implode('&', array_map(
        function ($v, $k) {
            if( !is_array( $v ) ) {
                return sprintf("%s=%s", $k, $v);
            } else if( in_array( $k, ['categories','tags'] ) ) {
                $link = '';
                foreach ( $v as $value ){
                    $link .= $k.'[]='.$value.'&';
                }
                return rtrim($link,'&');
            }
        },
        $array,
        array_keys($array)
    ));

    return str_replace(['&&','.'],['','_'],$string);
}

function getVariablesFilter(\Illuminate\Http\Request $request){
    $all = $request->all();
    array_forget($all, ['cssFiles','jsFiles','routeName']);
    return $all;
}

function assemblePaginatorInfo($pag){
    $partes         = explode(";", $pag);
    $paginator_info = [];
    if( !empty( $partes[0] ) ) {

        $paginator_info['total'] = 1;

        preg_match_all('!\d+!', $partes[0], $matches);
        $paginator_info['count'] = $matches[0][0];
        preg_match_all('!\d+!', $partes[1], $matches);
        $paginator_info['next'] = $matches[0][0];
        preg_match_all('!\d+!', $partes[2], $matches);
        $paginator_info['limit'] = $matches[0][0];
        preg_match_all('!\d+!', $partes[3], $matches);
        $paginator_info['range'] = $matches[0][0];

        // calculando total de paginas
        if($paginator_info['limit'] == 0 && $paginator_info['next'] > 0)
            $paginator_info['total'] = intval(ceil($paginator_info['count'] / $paginator_info['next']));
        else if( $paginator_info['limit'] > 0 )
            $paginator_info['total'] = intval(ceil($paginator_info['count'] / $paginator_info['limit']));

        // calculando pagina atual
        if($paginator_info['limit'] == 0)
            $paginator_info['actual'] = 1;
        else if($paginator_info['next'] == 0)
            $paginator_info['actual'] = $paginator_info['total'];
        else
            $paginator_info['actual'] = ($paginator_info['next'] / $paginator_info['limit']);
    }

    return $paginator_info;
}

function format_order_type($type){
    return mb_strtoupper( \Lang::get('default.'.strtolower( $type ) ), 'UTF-8' );
}

function buildUrlPaginator($filters, $arrayResult){

    $paginatorHeader = [];
    $arrayTmp        = [];

    if( array_has( $arrayResult, 'PAGINATOR' ) && !empty( $arrayResult['PAGINATOR'] ) ){
        $arrayTmp = array_get( $arrayResult, 'PAGINATOR' );
    } else if ( is_array( $arrayResult ) && !empty( $arrayResult ) ){
        $arrayTmp = current( $arrayResult );
    }

    if( !empty(  $arrayTmp ) ) {
        foreach (explode(';', $arrayTmp) AS $row) {
            $tmp = explode('=', $row);
            $paginatorHeader[$tmp[0]] = (int)$tmp[1];
        }
    }

    $limit      = array_get( $paginatorHeader, 'limit');
    $offsetPrev = array_get( $filters        , 'offset', 0 );
    $offsetNext = array_get( $paginatorHeader, 'next'  , $limit );

    $filters['limit'] = array_get( $filters, 'limit', 1 );

    $filtersPrev = $filtersNext = $filters;
    $filtersPrev['offset']      = $offsetPrev - $limit;
    $filtersNext['offset']      = $offsetNext;

    $return = [
        'prev' => implodeArrayQueryString($filtersPrev),
        'next' => implodeArrayQueryString($filtersNext)
    ];

    if( $offsetPrev == 0 && $limit == 0 ){
        $return['prev'] = null;
    }

    if( empty( $offsetNext ) ){
        $filtersPrev['offset'] -= $filtersPrev['limit'];
        $return['next'] = null;
    }

    //dd( $filters, $offsetNext, $paginatorHeader, $return );
    //\LogDebug::paginator('------->',$filters);
    //\LogDebug::paginator('------->'.$offsetNext);
    //\LogDebug::paginator('------->',$paginatorHeader);
    //\LogDebug::paginator('------->----------------------');

    return $return;

}

function check_acl_user( $aclSlug, $returnBool = FALSE ){
    $profile = sessionOpen('get', 'profile.MAIN');
    if( !empty( $profile ) ){
        $profile = search_in_array( $profile, 'acl_slug', $aclSlug );
    }
    return $returnBool === FALSE ? $profile : ( empty( $profile  ) ? FALSE : TRUE );
}

function js_code_product_page(){
        
    return "$('.more-actions').last().prepend('<button id=\"showBottomMenu\" type=\"button\" class=\"btn btn-light btn-icon btn-title-sub-menu dropdown-toggle\"><i class=\"ft-menu\"></i></button>');
    
            let menuBottom = document.getElementById( 'cbp-spmenu-s4' );
            let showBottomMenu = document.getElementById( 'showBottomMenu' );
            showBottomMenu.onclick = function() {
                classie.toggle( this, 'no-action' );
                classie.toggle( menuBottom, 'cbp-spmenu-open' );
                disableOther( 'showBottomMenu' );
            };
            function disableOther( button ) {
                if( button !== 'showBottomMenu' ) {
                    classie.toggle( showBottomMenu, 'disabled' );
                }
            }";
}

function format_html_paginate( $paginator, $links = 3 ) {

    $last  = ceil( $paginator['total'] / $paginator['limit'] );

    $start = ( ( $paginator['current_page'] - $links ) > 0 ) ? $paginator['current_page'] - $links : 1;
    $end   = ( ( $paginator['current_page'] + $links ) < $last ) ? $paginator['current_page'] + $links : $last;

    $html  = '<ul class="pagination justify-content-center pagination-separate pagination-round pagination-lg mb-1">';

    $class = ( $paginator['current_page'] == 1 ) ? "disabled" : "";
    $html  .= '<li class="page-item ' . $class . '"><a class="page-link" href="?limit=' . $paginator['limit'] . '&page=' . ( $paginator['current_page'] - 1 ) . '">&laquo;</a></li>';

    if ( $start > 1 ) {
        $html   .= '<li class="page-item"><a class="page-link" href="?limit=' . $paginator['limit'] . '&page=1">1</a></li>';
        $html   .= '<li class="page-item disabled"><a class="page-link">...</a></li>';
    }

    for ( $i = $start ; $i <= $end; $i++ ) {
        $class  = ( $paginator['current_page'] == $i ) ? "active" : "";
        $html   .= '<li class="page-item ' . $class . '"><a class="page-link" href="?limit=' . $paginator['limit'] . '&page=' . $i . '">' . $i . '</a></li>';
    }

    if ( $end < $last ) {
        $html   .= '<li class="page-item disabled"><a class="page-link">...</a></li>';
        $html   .= '<li class="page-item"><a class="page-link" href="?limit=' . $paginator['limit'] . '&page=' . $last . '">' . $last . '</a></li>';
    }

    $class = ( $paginator['current_page'] == $last ) ? "disabled" : "";
    $html  .= '<li class="page-item' . $class . '"><a class="page-link" href="?limit=' . $paginator['limit'] . '&page=' . ( $paginator['current_page'] + 1 ) . '">&raquo;</a></li>';

    $html  .= '</ul>';

    return $html;
}

function search_like_in_array($array, $search)
{
    $return = [];
    if( !empty( $search ) && !is_array( $search ) ) {
        foreach ($array as $key => $value) {
            if (strpos($value, $search) !== FALSE) { // Yoshi version
                $return[] = $value;
            }
        }
    }
    return $return;
}

function format_hmt_sort( $local, $filters ){
    $icon = 'fa-sort';
    $dir  = array_get( $filters, 'dir', 'asc' );

    if( $local == array_get( $filters, 'sort', '' ) ){
        $icon .= '-' . ( $dir == 'asc' ? 'up' : 'down' );
        $dir   =  $dir == 'asc' ? 'desc' : 'asc';
    }
    return '<a href="?sort='.$local.'&dir='.$dir.'"><i class="fa '.$icon.' i-sort"></i></a>';
}

