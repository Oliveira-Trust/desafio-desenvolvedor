<?php

namespace Shared\Enums;

enum HttpStatus: int {
    case Continue = 100;
    case SwitchingProtocols = 101;
    case Processing = 102;
    case EarlyHints = 103;
    case Ok = 200;
    case Created = 201;
    case Accepted = 202;
    case NonAuthoritativeInformation = 203;
    case NoContent = 204;
    case BadRequest = 400;
    case Unauthorized = 401;
    case PaymentRequired = 402;
    case Forbidden = 403;
    case NotFound = 404;
    case MethodNotAllowed = 405;
    case NotAcceptable = 406;
    case InternalServerError = 500;
}
