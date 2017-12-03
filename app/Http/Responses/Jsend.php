<?php
namespace App\Http\Responses;

class Jsend
{

    private $allowedStatusOptions = [
        'success', // All went well, and (usually) some data was returned.
        'fail', // There was a problem with the data submitted, or some pre-condition of the API call wasn't satisfied
        'error', // An error occurred in processing the request, i.e. an exception was thrown
    ];

    private $status;
    private $data;
    private $message;
    private $transformer;

    public function __construct($status, $data = null, $message = null, $transformer = false)
    {
        $this->status = $status;
        $this->data = $data;
        $this->message = $message;
        $this->transformer = $transformer;
    }

    public function response()
    {
        if ($this->transformer) {
            $this->data = new $this->transformer($this->data);
        }

        return response()->json([
            "status" => $this->allowedStatus($this->status),
            "data" => $this->data,
            "message" => $this->message,

        ]);

    }

    private function allowedStatus($status)
    {
        $status = strtolower($status);
        if (!in_array($status, $this->allowedStatusOptions)) {
            throw JsendException('invalid status value');
        }
        return $status;

    }

}
