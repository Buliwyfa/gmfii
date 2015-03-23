<?php

/**
 *
 * @package humhub.modules.gmfu.views
 * @since 0.5
 * @author b3457m0d3
 */
class GmfuStatisticsWidget extends HWidget {

    public function run() {

        $newUsers = User::model()->active()->recently(10)->findAll();
        Yii::import('application.modules.mail.models.*');
        $statsTotalUsers = User::model()->count();

        $criteria = new CDbCriteria;
        $criteria->group = 'user_id';
        $criteria->condition = 'user_id IS NOT null';
        $statsUserOnline = UserHttpSession::model()->count($criteria);

        $statsMessageEntries = 0;
        if (Yii::app()->moduleManager->isEnabled('mail')) $statsMessageEntries = MessageEntry::model()->count();
        $statsUserFollow = UserFollow::model()->countByAttributes(array('object_model'=>'User'));

        $this->render('gmfuStats', array(
            'newUsers'        => $newUsers, // new users
            'statsTotalUsers' => $statsTotalUsers,
            'statsUserOnline' => $statsUserOnline,
            'statsMessageEntries' => $statsMessageEntries,
            'statsUserFollow' => $statsUserFollow
        ));
    }
}

?>
