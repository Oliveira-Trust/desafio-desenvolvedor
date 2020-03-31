<?php
/**
 * @SWG\Get(
 *   path="catalog/avaible",
 *   summary="get store catalog avaible",
 *   operationId="catalog-avaible",
 *   tags={"Catalog"},
 *   @SWG\Parameter(in="query",name="dir",description="Filter direction result",type="string",enum={"asc", "desc"}),
 *   @SWG\Parameter(in="query",name="sort",description="Fields sort",type="string",enum={"name","sku","price","stock","status","created_at"}),
 *   @SWG\Response(response=200, description="successful operation.")
 * )
 *
 * @SWG\Get(
 *   path="catalog",
 *   summary="List Catalog",
 *   operationId="catalog-get",
 *   tags={"Catalog"},
 *   @SWG\Parameter(in="query",name="search",description="Filter by name/sku",type="string",default=""),
 *   @SWG\Parameter(in="query",name="status",description="Filter by status",description="S -> Ativo, N -> Desativado",type="string",enum={"S", "N"}),
 *   @SWG\Parameter(in="query",name="dir",description="Filter direction result",type="string",enum={"asc", "desc"}),
 *   @SWG\Parameter(in="query",name="sort",description="Fields sort",type="string",enum={"name","sku","price","stock","status","created_at"}),
 *   @SWG\Parameter(in="query",name="limit",description="Limit pagination",required=true,type="integer",default="25"),
 *   @SWG\Parameter(in="query",name="page",description="current page",required=true,type="integer",default="1"),
 *   @SWG\Response(response=200, description="successful operation")
 * )
 *
 * @SWG\Get(
 *   path="catalog/{sku}",
 *   summary="Get Catalog by sku",
 *   operationId="catalog-get-by-sku",
 *   tags={"Catalog"},
 *   @SWG\Parameter(in="path", name="id", description="catalog id", type="string", required=true),
 *   @SWG\Response(response=200, description="successful operation")
 * )
 *
 * @SWG\Post(
 *   path="catalog",
 *   summary="Created catalog",
 *   operationId="catalog-create",
 *   tags={"Catalog"},
 *   @SWG\Parameter(in="body",name="body",description="
 *      Atributos 'price' pode ser enviado formatado na moeda brasileira ou americana",
 *      required=true,default="",
 *       @SWG\Schema(type="string",
 *          @SWG\Property(property="name", type="string", example="Poke Salmão ao molho"),
 *          @SWG\Property(property="sku", type="string", example="poke-salmao-molho"),
 *          @SWG\Property(property="price", type="string", example="29,99"),
 *          @SWG\Property(property="status", type="boolean", example=true),
 *     )),
 *   @SWG\Response(response=201, description="successful operation. User created and rescued"),
 *   @SWG\Response(response=400, description="operation not completed"),
 * )
 *
 * @SWG\Put(
 *   path="catalog/{sku}",
 *   summary="Edit catalog",
 *   operationId="catalog-edit",
 *   tags={"Catalog"},
 *   @SWG\Parameter(in="path", name="sku", description="Catalog sku", type="string", required=true ),
 *   @SWG\Parameter(in="body",name="body",description="
 *      Atributos 'price' pode ser enviado formatado na moeda brasileira ou americana",
 *      required=true,default="",
 *       @SWG\Schema(type="string",
 *          @SWG\Property(property="name", type="string", example="Poke Salmão ao molho"),
 *          @SWG\Property(property="sku", type="string", example="poke-salmao-molho"),
 *          @SWG\Property(property="price", type="string", example="29,99"),
 *          @SWG\Property(property="status", type="boolean", example=true),
 *     )),
 *   @SWG\Response(response=201, description="successful operation. User created and rescued"),
 *   @SWG\Response(response=400, description="operation not completed"),
 * )
 *
 * @SWG\Put(
 *   path="catalog/{sku}/stock-in/{new_qtd}",
 *   summary="Increment Catalog Stock",
 *   operationId="catalog-increment-stock",
 *   tags={"Catalog"},
 *   @SWG\Parameter(in="path", name="sku", description="Catalog sku", type="string", required=true ),
 *   @SWG\Parameter(in="path", name="new_qtd", description="New Qtd Stock", type="string", required=true ),
 *   @SWG\Response(response=200, description="successful operation")
 * )
 *
 * @SWG\Delete(
 *   path="catalog/{sku}",
 *   summary="Delete Catalog",
 *   operationId="catalog-del",
 *   tags={"Catalog"},
 *   @SWG\Parameter(in="path", name="sku", description="Catalog sku", type="string", required=true ),
 *   @SWG\Response(response=200, description="successful operation")
 * )
 *
 * @SWG\Delete(
 *   path="catalog/in-batch",
 *   summary="Delete Catalog in-batch",
 *   operationId="catalog-del-in-batch",
 *   tags={"Catalog"},
 *   @SWG\Parameter(in="body",name="body",description="",
 *      required=true,default="",
 *       @SWG\Schema(type="string",
 *          @SWG\Property(property="ids", type="array",
 *              @SWG\Items(type="integer", example="2")
 *          ),
 *     )),
 *   @SWG\Response(response=200, description="successful operation")
 * )
 */
