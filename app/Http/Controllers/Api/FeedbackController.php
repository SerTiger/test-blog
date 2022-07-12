<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FeedbackRequest;
use App\Models\Feedback;
use App\Services\CRMService;


class FeedbackController extends Controller
{
    /**
     * @var CRMService
     */
    private $service;

    public function __construct(CRMService $service)
    {
        $this->service = $service;
    }

    public function send(FeedbackRequest $request)
    {
        $data = $request->only('name', 'phone', 'time');

        $feedback = Feedback::create($data);

        $data['id'] = $feedback->id;

        $this->service->addLead($data);

        return response()->json(['message' => 'success']);
    }
}
