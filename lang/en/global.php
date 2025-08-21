<?php

return [

    'action' => [
        'add' => 'Add',
        'edit' => 'Edit',
        'view' => 'View',
        'title' => 'Action',
        'delete' => 'Delete',
        'add_new' => 'Add New',
    ],

    'email_template' => [
        'title' => 'Email Templates',
        'title_singular' => 'Email Template',
        'fields' => [
            'title' => 'Title',
            'slug' => 'Slug',
            'subject' => 'Subject',
            'is_active' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'description' => 'Description',
            'footer_text' => 'Footer Text',
            'email_preference_id' => 'Email Preference',
        ],
    ],

    'dashboard' => [
        'title' => 'Dashboard',
    ],

    'profile' => [
        'title' => 'My Profile',
        'profile' => 'Profile',
        'change_password' => 'Change Password',
        'fields' => [
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone No.',
            'new_password' => 'New Password',
            'profile_image' => 'Profile Image',
            'current_password' => 'Current Password',
            'confirm_new_password' => 'Confirm New Password',
        ],
    ],

    'settings' => [
        'title' => 'Settings',
        'manage_settings' => 'Manage Settings',
    ],

    'roles' => [
        'title' => 'Roles Management',
        'role' => 'Role',
        'list' => 'Role List',
        'fields' => [
            'add' => 'Add New',
            'title' => 'Role Management',
            'list-title' => 'Roles List',
            'role_detail' => 'Role Detail',
            'list' => [
                'name' => 'Name',
            ],
            'add-role' => [
                'title' => 'Add Role',
                'edit_role' => 'Edit Role',
                'givepermit' => 'Select Permissions',
            ],
        ],
    ],

    'permissions' => [
        'title' => 'Permission Management',
        'allow_permissions' => 'Allow Permissions',
        'fields' => [
            'add' => 'Add New',
            'title' => 'Title',
            'list-title' => 'Permission List',
            'list' => [
                'name' => 'Name',
            ],
        ],
    ],

    'staff' => [
        'title' => 'Staff Management',
        'staff' => 'Staff',
        'list' => 'Staff List',
        'staff_detail' => 'Staff Detail',
        'fields' => [
            'role' => 'Role',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone No.',
            'status' => 'Status',
            'created_at' => 'Created At',
            'profile_image' => 'Profile Image',
        ],
    ],

    'qa_sn' => 'S.No.',
    'qa_submit' => 'Submit',
    'qa_update' => 'Update',
    'qa_action' => 'Action',
    'qa_password' => 'Password',
    'qa_new_password' => 'New Password',
    'qa_confirm_password' => 'Confirm Password',
];
