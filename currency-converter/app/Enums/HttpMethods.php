<?php

namespace App\Enums;

enum HttpMethods {
    case GET;
    case POST;
    case PATCH;
    case PUT;
    case OPTIONS;
    case DELETE;
}