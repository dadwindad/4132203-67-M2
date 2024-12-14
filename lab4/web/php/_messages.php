<?php

$msg = [
    'blog' => [
        'POST' => [
            'no-data' => 'Title and Post are required',
            'success' => 'Blog inserted successfully',
            'error' => 'Failed to insert blog'
        ],
        'PUT' => [
            'success' => 'Blog updated successfully',
            'error' => 'Failed to update blog'
        ],
        'delete' => [
            'no-id' => 'ID is required for deletion',
            'not-found' => 'No blog found with the given ID',
            'success' => 'Blog deleted successfully',
            'error' => 'Failed to delete blog'
        ]
    ]
];

function query_response($page, $verb, $code, $option = null, $err = null)
{
    global $msg;

    return [
        'status' => $option === null ? 500 : $code,
        'message' => $msg[$page][$verb][$option ?? ($code == 200 ? 'success' : 'error')],
        'error' => $err
    ];
}
