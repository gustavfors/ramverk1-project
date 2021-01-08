<?php

namespace Gufo\Vote;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Gufo\Commons\UtilityTrait;
use Gufo\Post\Post;
use Gufo\Vote\Vote;
use Gufo\Auth\AuthTrait;

class VoteController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait, UtilityTrait, AuthTrait;

    public function upActionPost($id)
    {
        if (!$this->loggedIn()) {
            return $this->redirect("user/login");
        }

        if (!Post::findById($id)) {
            return $this->redirectBack();
        }

        $user = $this->getUser();

        $vote = Vote::findUserVote($id, $user);

        if (!$vote) {
            $vote = new Vote([
                "score" => 1,
                "post" => $id,
                "user" => $user
            ]);
        } else {
            if ($vote->score == -1) {
                $vote->mergeAttributes([
                    "score" => 1
                ]);
            } else {
                return $this->redirectBack();
            }
        }

        $vote->save();

        return $this->redirectBack();
    }

    public function downActionPost($id)
    {
        if (!$this->loggedIn()) {
            return $this->redirect("user/login");
        }

        if (!Post::findById($id)) {
            return $this->redirectBack();
        }

        $user = $this->getUser();

        $vote = Vote::findUserVote($id, $user);

        if (!$vote) {
            $vote = new Vote([
                "score" => -1,
                "post" => $id,
                "user" => $user
            ]);
        } else {
            if ($vote->score == 1) {
                $vote->mergeAttributes([
                    "score" => -1
                ]);
            } else {
                return $this->redirectBack();
            }
        }

        $vote->save();

        return $this->redirectBack();
    }
}
