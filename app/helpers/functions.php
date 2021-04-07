<?php
function responseInJson($request)
{
    if ($request->isJson() || $request->wantsJson() || $request->expectsJson()) {
        return true;
    }
    return false;
}
function generateOtp()
{
    return mt_rand(1000,9999);
}
