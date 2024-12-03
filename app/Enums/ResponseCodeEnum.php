<?php
namespace App\Enums ;


class ResponseCodeEnum{
    const Success = 200;
    const Not_Found =404;
    const Unauthorized =401;
    const Unsupported_Media_Type = 415;
    const Payload_Too_Long = 413;
    const Internal_Server_Error = 500;
    const Bad_request = 400;
    const CONFLICT = 409;
    const Unprocessable_Content =422;

}
