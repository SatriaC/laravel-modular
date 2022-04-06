<?php

return [

    'message' => [
        'create' => [
            'success' => 'Data has been created.',
            'failed' => 'Could not create :object. Please check again.',
        ],
        'read' => [
            'success' => 'Data found.',
            'failed' => 'Could not found data :object.',
        ],
        'update' => [
            'success' => 'Data has been updated.',
            'failed' => 'Could not update :object. Please check again.',
        ],
        'delete' => [
            'success' => 'Data has been deleted.',
            'failed' => 'Could not delete :object. Please check again.',
        ],
        'active' => [
            'success' => 'Data has been activated.',
            'failed' => 'Could not activate :object. Please check again.',
        ],
        'inactive' => [
            'success' => 'Data has been inactivated.',
            'failed' => 'Could not inactivate :object. Please check again.',
        ],

        'quota' => [
            'reach_limit' => 'You have reach your limitation quota. Please check again.',
        ],
        'presence' => [
            'incomplete_presence' => 'You must complete your presence by tapping out first.',
            'complete_presence' => 'Presence has been tapped out.',
            'duplicate_date_validation' => 'System can not validate duplicate punch in date (:date). Please check again.',
            'validate_valid_presence' => 'Validation process error. There is data has been validated. Please check again.',
            'date_is_valid' => 'There is data presence for date :date has been validated. Please check again.',
            'correction_invalid_type' => 'Presence type must be a punch-in or correction to perform this action. Please check again.',
            'update_invalid_type' => 'Presence type must be a manual to perform this action. Please check again.',
            'is_valid' => 'Cannot edit presence, presence has been validated. Please check again.'
        ],

        'permit' => [
            'quota_does_not_exists' => 'You dont have quota to submit this leaving. For your quota information please ask to your system administrator.',
            'reach_limit_quota' => 'Your leaving quota remaining (:remain_quota) is not enough with your leaving submission (:num_of_day). Please check again.'
        ],

        'general' => [
            'not_owner_subject' => 'You are not authorize to perform this action.'
        ],
        'login' => [
            'success' => 'Authenticated.',
            'failed' => 'Could not create :object. Please check again.',
        ],

        'not_authorize' => 'You\'re not authorize to perform this action.',

        'image' => [
            'empty' => 'Image cannot be empty'
        ]
    ],

];
