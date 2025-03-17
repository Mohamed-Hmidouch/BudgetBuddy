<?php

namespace App\Services;

use App\Models\Group;

class GroupService
{
    public function createGroup(array $data)
    {
        $users = $data['users'] ?? [];
        unset($data['users']);
        $group = Group::create([
            'name' => $data['name'],
            'currency' => $data['currency'],
        ]);
        if (!empty($users)) {
            $group->users()->attach($users);
            if (!in_array($data['user_id'], $users)) {
                $group->users()->attach($data['user_id']);
            }
        }

        return $group;
    }
    public function getAllGroups()
    {
        return Group::with('users')->get()->map(function ($group) {
            return [
            'id' => $group->id,
            'name' => $group->name,
            'currency' => $group->currency,
            'created_by' => $group->user_id ?? null,
            'users' => $group->users->map(function ($user) {
                return [
                'id' => $user->id,
                'name' => $user->name,
                ];
            })
            ];
        });
    }

    public function getGroupById($id)
    {

    }

    public function updateGroup($id, array $data)
    {

    }

    public function deleteGroup($id)
    {

    }
    public function getGroupUsers($groupId)
    {

    }
}
