<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class AddTransaction implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private string $userEmail;
    private string $description;
    private float $value;

    /**
     * Create a new job instance.
     *
     * @param mixed $userEmail
     * @param mixed $description
     * @param mixed $value
     */
    public function __construct($userEmail, $description, $value)
    {
        $this->userEmail = $userEmail;
        $this->description = $description;
        $this->value = $value;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            DB::transaction(function () {
                $user = User::query()->where('email', $this->userEmail)->with('balance')->lockForUpdate()->first();
                $user->balance()->update([
                    'value' => $user->balance->value + $this->value,
                ]);
                $user->balance->transactions()->create([
                    'value' => $this->value,
                    'description' => $this->description,
                ]);
            }, 3);
        } catch (\Exception $e) {
            throw new \ErrorException($e->getMessage());
        }
    }
}
