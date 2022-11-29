<?php

namespace App\Http\Controllers;

use App\Contracts\GameInterface;
use App\Contracts\MessageInterface;
use App\Contracts\ResponseFactoryInterface;
use App\Contracts\ResultCollectorInterface;
use App\Contracts\StorageInterface;
use App\Contracts\SubmittedAnswerValidatorInterface;
use App\Enums\MessageType;
use App\TriviaGame\Response\ResponseValue;
use App\TriviaGame\Validator\InputValidator;
use Illuminate\Http\Request;

final class GameController extends Controller
{
    public function __invoke(
        Request $request,
        GameInterface $game,
        StorageInterface $storage,
        ResultCollectorInterface $resultCollector,
    ): ResponseValue {
        $gameInstance = $storage->load() ?: $game;

        if ($gameInstance->isGameOver()) {
            $storage->delete();
            $gameInstance = $game;
        }

        /** @var InputValidator $validator */
        $validator = app(SubmittedAnswerValidatorInterface::class, ['game' => $gameInstance]);

        if (!$validator->validate($request->input('answer'))) {

            return $this->response($gameInstance, app(MessageInterface::class, [
                'text' => 'Invalid input',
                'type' => MessageType::ALERT,
            ]));
        }

        $gameInstance->process($request->input('answer'));

        $storage->store($gameInstance);

        return $this->response($gameInstance, $resultCollector->create($gameInstance));
    }

    private function response(GameInterface $game, MessageInterface $message): ResponseValue
    {
        return app(ResponseFactoryInterface::class, [
            'game' => $game,
            'message' => $message
        ])->create();
    }
}
