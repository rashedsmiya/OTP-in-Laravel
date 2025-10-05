<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    public function getStatusTitle()
    {
        switch ($this->status) {
            case 1:
                return 'Active';
                break;

            case 0:
                return 'Inactive';
                break;
        }
    }

    public function getStatusBg()
    {
        switch ($this->status) {
            case 1:
                return 'bg-success';
                break;

            case 0:
                return 'bg-danger';
                break;
        }
    }
}
