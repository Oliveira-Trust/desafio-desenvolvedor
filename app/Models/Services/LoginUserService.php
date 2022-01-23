<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Entries\LoginUserEntry;
use App\Models\Outputs\LoginUserOutput;

class LoginUserService extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "entry",
        "output"
    ];

    public function __construct(LoginUserEntry $entry){
        $this->entry = $entry;
    }

    public function Process(){
        $result = User::where(["email"=>$this->entry->email])->first();

        $this->output = LoginUserOutput::formatOutput($result);
    }

}

?>