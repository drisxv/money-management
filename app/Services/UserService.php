<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    public function all(): Collection
    {
        return User::all();
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return User::paginate($perPage);
    }

    public function find(int $id): ?User
    {
        return User::find($id);
    }
    public function create(array $data): User
    {
        $user = new User();

        if (isset($data['nama'])) {
            $user->nama = $data['nama'];
        }

        $user->email = $data['email'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        foreach ($data as $key => $value) {
            if (in_array($key, ['nama', 'email', 'password'])) {
                continue;
            }
            if (array_key_exists($key, $user->getAttributes()) || in_array($key, $user->getFillable())) {
                $user->{$key} = $value;
            }
        }

        $user->save();

        return $user;
    }

    public function update(User $user, array $data): User
    {
        if (isset($data['nama'])) {
            $user->nama = $data['nama'];
        }

        if (isset($data['email'])) {
            $user->email = $data['email'];
        }

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        foreach ($data as $key => $value) {
            if (in_array($key, ['nama', 'email', 'password'])) {
                continue;
            }
            if (array_key_exists($key, $user->getAttributes()) || in_array($key, $user->getFillable())) {
                $user->{$key} = $value;
            }
        }

        $user->save();

        return $user;
    }
    public function delete(User|int $user): bool
    {
        if (! $user instanceof User) {
            $user = $this->find($user);
            if (! $user) {
                return false;
            }
        }

        return (bool) $user->delete();
    }

    public function updatePassword(User|int $user, string $newPassword): ?User
{
    if (! $user instanceof User) {
        $user = $this->find($user);
        if (! $user) {
            return null;
        }
    }

    $user->password = Hash::make($newPassword);
    $user->save();

    return $user;
}

}
