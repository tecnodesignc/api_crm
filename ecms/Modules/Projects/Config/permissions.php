<?php

return [
    'projects.projects' => [
        'index' => 'projects::projects.list resource',
        'create' => 'projects::projects.create resource',
        'edit' => 'projects::projects.edit resource',
        'destroy' => 'projects::projects.destroy resource',
    ],
    'projects.objects' => [
        'index' => 'projects::objects.list resource',
        'create' => 'projects::objects.create resource',
        'edit' => 'projects::objects.edit resource',
        'destroy' => 'projects::objects.destroy resource',
    ],
    'projects.activities' => [
        'index' => 'projects::activities.list resource',
        'create' => 'projects::activities.create resource',
        'edit' => 'projects::activities.edit resource',
        'destroy' => 'projects::activities.destroy resource',
    ],
    'projects.tasks' => [
        'index' => 'projects::tasks.list resource',
        'create' => 'projects::tasks.create resource',
        'edit' => 'projects::tasks.edit resource',
        'destroy' => 'projects::tasks.destroy resource',
    ],
// append




];
