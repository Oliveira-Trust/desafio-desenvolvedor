<?php
/**
 * @SWG\Get(
 *   path="customer/avaible",
 *   summary="get store category avaible",
 *   operationId="customer-avaible",
 *   tags={"Customer"},
 *   @SWG\Parameter(in="query",name="dir",description="Filter direction result",type="string",enum={"asc", "desc"}),
 *   @SWG\Parameter(in="query",name="sort",description="Fields sort",type="string",enum={"name","email","document","phone","status","created_at"}),
 *   @SWG\Response(response=200, description="successful operation.")
 * )
 *
 * @SWG\Get(
 *   path="customer",
 *   summary="List Customer",
 *   operationId="customer-get",
 *   tags={"Customer"},
 *   @SWG\Parameter(in="query",name="search",description="Filter by name/email",type="string",default=""),
 *   @SWG\Parameter(in="query",name="document",description="Filter by document",type="string",default=""),
 *   @SWG\Parameter(in="query",name="status",description="Filter by status",description="S -> Ativo, N -> Desativado",type="string",enum={"S", "N"}),
 *   @SWG\Parameter(in="query",name="dir",description="Filter direction result",type="string",enum={"asc", "desc"}),
 *   @SWG\Parameter(in="query",name="sort",description="Fields sort",type="string",enum={"name","email","document","phone","status","created_at"}),
 *   @SWG\Parameter(in="query",name="limit",description="Limit pagination",required=true,type="integer",default="25"),
 *   @SWG\Parameter(in="query",name="page",description="current page",required=true,type="integer",default="1"),
 *   @SWG\Response(response=200, description="successful operation")
 * )
 *
 * @SWG\Get(
 *   path="customer/{id}",
 *   summary="Get Customer by id",
 *   operationId="customer-get-by-id",
 *   tags={"Customer"},
 *   @SWG\Parameter(in="path", name="id", description="customer id", type="string", required=true,
 *     @SWG\Schema( type="integer", format="int64" )
 *    ),
 *   @SWG\Response(response=200, description="successful operation")
 * )
 *
 * @SWG\Post(
 *   path="customer",
 *   summary="Created customer",
 *   operationId="customer-create",
 *   tags={"Customer"},
 *   @SWG\Parameter(in="body",name="body",description="
 *      Atributos 'document' e 'phone' podem ser enviados formatados ou somente os números",
 *      required=true,default="",
 *       @SWG\Schema(type="string",
 *          @SWG\Property(property="name", type="string", example="Fulano dos santos"),
 *          @SWG\Property(property="email", type="string", example="fulano.santos@nobody.com.br"),
 *          @SWG\Property(property="document", type="string", example="999.999.999-99"),
 *          @SWG\Property(property="phone", type="string", example="(99) 99999-9999"),
 *          @SWG\Property(property="status", type="boolean", example=true),
 *     )),
 *   @SWG\Response(response=201, description="successful operation. User created and rescued"),
 *   @SWG\Response(response=400, description="operation not completed"),
 * )
 *
 * @SWG\Put(
 *   path="customer/{id}",
 *   summary="Edit customer",
 *   operationId="customer-edit",
 *   tags={"Customer"},
 *   @SWG\Parameter(in="path", name="id", description="Customer id", type="string", required=true ),
 *   @SWG\Parameter(in="body",name="body",description="
 *      Atributos 'document' e 'phone' podem ser enviados formatados ou somente os números",
 *      required=true,default="",
 *       @SWG\Schema(type="string",
 *          @SWG\Property(property="name", type="string", example="Fulano dos santos"),
 *          @SWG\Property(property="email", type="string", example="fulano.santos@nobody.com.br"),
 *          @SWG\Property(property="document", type="string", example="999.999.999-99"),
 *          @SWG\Property(property="phone", type="string", example="(99) 99999-9999"),
 *          @SWG\Property(property="status", type="boolean", example=true),
 *     )),
 *   @SWG\Response(response=201, description="successful operation. User created and rescued"),
 *   @SWG\Response(response=400, description="operation not completed"),
 * )
 *
 * @SWG\Delete(
 *   path="customer/{id}",
 *   summary="Delete Customer",
 *   operationId="customer-del",
 *   tags={"Customer"},
 *   @SWG\Parameter(in="path", name="id", description="Customer id", type="string", required=true ),
 *   @SWG\Response(response=200, description="successful operation")
 * )
 *
 * @SWG\Delete(
 *   path="customer/in-batch",
 *   summary="Delete Customer in-batch",
 *   operationId="customer-del-in-batch",
 *   tags={"Customer"},
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
