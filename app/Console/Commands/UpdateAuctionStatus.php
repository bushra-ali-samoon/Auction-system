<?php

namespace App\Console\Commands;
// 
use Illuminate\Console\Command;
use App\Models\Auction;
use Carbon\Carbon;
 

class UpdateAuctionStatus extends Command
{
    // Command ka naam
    protected $signature = 'auctions:update-status';

    // Command ka description
    protected $description = 'Update auction status based on start/end times';

    public function handle()
{
    $now = Carbon::now();
    $this->info("Current Time: " . $now);  // Debug ke liye

    // Start auctions
    $updated1 = Auction::where('status', 'pending')
        ->where('auction_start', '<=', $now)
        ->update(['status' => 'started']);
    $this->info("Pending -> Started updated: " . $updated1);

    // Expire auctions
    $updated2 = Auction::where('status', 'started')
        ->where('auction_end', '<=', $now)
        ->update(['status' => 'expired']);
    $this->info("Started -> Expired updated: " . $updated2);

    $this->info('Auction statuses updated successfully!');
}

}
