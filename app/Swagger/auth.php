<?php
/**
 * @SWG\Post(
 *   path="auth",
 *   summary="Auth",
 *   operationId="Auth",
 *   tags={"Auth"},
 *   @SWG\Parameter(in="body",name="body",description="",required=true,default="",
 *       @SWG\Schema(type="string",
 *          @SWG\Property(property="login", type="string", example="admin@admin.com"),
 *          @SWG\Property(property="password", type="string", example="admin123")
 *     )),
 *   @SWG\Response(response=201, description="successful operation. User created and rescued"),
 *   @SWG\Response(response=401, description="Unauthorized"),
 * )
 *
 */
