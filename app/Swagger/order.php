<?php
/**
 *
 * @SWG\Get(
 *   path="order",
 *   summary="List Orders",
 *   operationId="order-get",
 *   tags={"Order"},
 *   @SWG\Parameter(in="query",name="id",description="Filter by id",type="string",default=""),
 *   @SWG\Parameter(in="query",name="status",description="Filter by status",type="string",enum={"em_aberto", "pago", "cancelado"}),
 *   @SWG\Parameter(in="query",name="name",description="Filter by customer name",type="string"),
 *   @SWG\Parameter(in="query",name="email",description="Filter by customer e-mail",type="string"),
 *   @SWG\Parameter(in="query",name="phone",description="Filter by customer telefone",type="string"),
 *   @SWG\Parameter(in="query",name="dir",description="Filter direction result",type="string",enum={"asc", "desc"}),
 *   @SWG\Parameter(in="query",name="sort",description="Fields sort",type="string",enum={"id","customer_name","customer_phone","customer_email","final_price","status","created_at"}),
 *   @SWG\Parameter(in="query",name="limit",description="Limit pagination",required=true,type="integer",default="25"),
 *   @SWG\Parameter(in="query",name="page",description="current page",required=true,type="integer",default="1"),
 *   @SWG\Response(response=200, description="successful operation")
 * )
 *
 * @SWG\Get(
 *   path="order/{id}",
 *   summary="Get Order by id",
 *   operationId="order-get-by-id",
 *   tags={"Order"},
 *   @SWG\Parameter(in="path", name="id", description="order id", type="string", required=true,
 *     @SWG\Schema( type="integer", format="int64" )
 *    ),
 *   @SWG\Response(response=200, description="successful operation")
 * )
 *
 * @SWG\Post(
 *   path="order",
 *   summary="Created order",
 *   operationId="order-create",
 *   tags={"Order"},
 *   @SWG\Parameter(in="body",name="body",description="",required=true,default="",
 *       @SWG\Schema(type="string",
 *          @SWG\Property(property="customer_id", type="string", example="37"),
 *          @SWG\Property(property="final_price", type="float", example="50,40"),
 *       @SWG\Property(property="items", type="array",
 *           @SWG\Items(type="object",
 *               @SWG\Property(property="catalog_id" ,type="integer", example=3),
 *               @SWG\Property(property="qty",type="integer", example=2)
 *           )
 *       ),
 *     )),
 *   @SWG\Response(response=201, description="successful operation. User created and rescued"),
 *   @SWG\Response(response=400, description="operation not completed"),
 * )
 *
 * @SWG\Put(
 *   path="order/{id}/status/{newstatus}",
 *   summary="Update new status Order",
 *   operationId="order-updt-new-status",
 *   tags={"Order"},
 *   @SWG\Parameter(in="path", name="id", description="Order id", type="string", required=true ),
 *   @SWG\Parameter(in="path", name="newstatus", description="New Status", type="string",enum={"pago","cancelado"}, required=true ),
 *   @SWG\Response(response=200, description="successful operation")
 * )
 *
 * @SWG\Delete(
 *   path="order/{id}",
 *   summary="Delete Order",
 *   operationId="order-del",
 *   tags={"Order"},
 *   @SWG\Parameter(in="path", name="id", description="Order id", type="string", required=true ),
 *   @SWG\Response(response=200, description="successful operation")
 * )
 *
 * @SWG\Delete(
 *   path="order/in-batch",
 *   summary="Delete Order in-batch",
 *   operationId="order-del-in-batch",
 *   tags={"Order"},
 *   @SWG\Parameter(in="body",name="body",description="",required=true,default="",
 *       @SWG\Schema(type="string",
 *          @SWG\Property(property="ids", type="array",
 *              @SWG\Items(type="integer", example="2")
 *          ),
 *     )),
 *   @SWG\Response(response=200, description="successful operation")
 * )
 *
 */