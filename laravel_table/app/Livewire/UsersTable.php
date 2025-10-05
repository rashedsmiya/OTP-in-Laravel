<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public $search = '';

    public $admin = '';

    public $sortBy = 'created_at';

    public $sortDir = 'DESC';

    public $perPage = 5;

    public function delete(User $user)
    {
        $user->delete();
    }

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = $this->sortDir === 'ASC' ? 'DESC' : 'ASC';
        } else {
            $this->sortBy = $sortByField;
            $this->sortDir = 'DESC';
        }
    }

    public function render()
    {
        return view('livewire.users-table',
            [
                'users' => User::search($this->search)
                    ->when($this->admin !== '', function ($query) {
                        $query->where('is_admin', $this->admin);
                    })
                    ->orderBy($this->sortBy, $this->sortDir)
                    ->paginate($this->perPage),
            ]);
    }
}
