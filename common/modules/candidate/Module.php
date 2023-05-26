<?php

namespace common\modules\candidate;

use common\models\Candidate;
use Yii;
use yii\base\Event;
use \common\models\User;

/**
 * finance module definition class
 */
class Module extends \yii\base\Module
{

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        Event::on(User::className(), User::EVENT_AFTER_SIGNUP, [$this, 'afterSignupCreateCandidate']);
    }

//    public function afterSignupCreateCandidate($event)
//    {
//        $user_id = $event->sender->id;
//        $candidate = new Candidate();
//        $candidate->user_id = $user_id;
//        $candidate->education = [];
//        $candidate->experience = [];
//        $candidate->save();
//    }
}
