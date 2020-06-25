<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrderProductsAPIRequest;
use App\Http\Requests\API\UpdateOrderProductsAPIRequest;
use App\Models\OrderProducts;
use App\Repositories\OrderProductsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class OrderProductsController
 * @package App\Http\Controllers\API
 */

class OrderProductsAPIController extends AppBaseController
{
    /** @var  OrderProductsRepository */
    private $orderProductsRepository;

    public function __construct(OrderProductsRepository $orderProductsRepo)
    {
        $this->orderProductsRepository = $orderProductsRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/orderProducts",
     *      summary="Get a listing of the OrderProducts.",
     *      tags={"OrderProducts"},
     *      description="Get all OrderProducts",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/OrderProducts")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $orderProducts = $this->orderProductsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($orderProducts->toArray(), 'Order Products retrieved successfully');
    }

    /**
     * @param CreateOrderProductsAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/orderProducts",
     *      summary="Store a newly created OrderProducts in storage",
     *      tags={"OrderProducts"},
     *      description="Store OrderProducts",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OrderProducts that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OrderProducts")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/OrderProducts"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOrderProductsAPIRequest $request)
    {
        $input = $request->all();

        $orderProducts = $this->orderProductsRepository->create($input);

        return $this->sendResponse($orderProducts->toArray(), 'Order Products saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/orderProducts/{id}",
     *      summary="Display the specified OrderProducts",
     *      tags={"OrderProducts"},
     *      description="Get OrderProducts",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OrderProducts",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/OrderProducts"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var OrderProducts $orderProducts */
        $orderProducts = $this->orderProductsRepository->find($id);

        if (empty($orderProducts)) {
            return $this->sendError('Order Products not found');
        }

        return $this->sendResponse($orderProducts->toArray(), 'Order Products retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOrderProductsAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/orderProducts/{id}",
     *      summary="Update the specified OrderProducts in storage",
     *      tags={"OrderProducts"},
     *      description="Update OrderProducts",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OrderProducts",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OrderProducts that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OrderProducts")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/OrderProducts"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOrderProductsAPIRequest $request)
    {
        $input = $request->all();

        /** @var OrderProducts $orderProducts */
        $orderProducts = $this->orderProductsRepository->find($id);

        if (empty($orderProducts)) {
            return $this->sendError('Order Products not found');
        }

        $orderProducts = $this->orderProductsRepository->update($input, $id);

        return $this->sendResponse($orderProducts->toArray(), 'OrderProducts updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/orderProducts/{id}",
     *      summary="Remove the specified OrderProducts from storage",
     *      tags={"OrderProducts"},
     *      description="Delete OrderProducts",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OrderProducts",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var OrderProducts $orderProducts */
        $orderProducts = $this->orderProductsRepository->find($id);

        if (empty($orderProducts)) {
            return $this->sendError('Order Products not found');
        }

        $orderProducts->delete();

        return $this->sendSuccess('Order Products deleted successfully');
    }
}
