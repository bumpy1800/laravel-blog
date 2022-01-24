<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            //carbon 라이브러리를 활용해서 현재 날짜와 3분뺀 시간을 시간과 날짜로 포맷해서 따로 저장
            $date = Carbon::parse(now())->format('Y-m-d');
            $time = Carbon::parse(now()->subMinutes(3))->toTimeString();
            //현재 날짜랑 같거나 적으며 현재 시간에서 3분뺀 시간보다 적으면 삭제(토큰이 만들어진지 3분뒤랑 같은 연산)
            DB::table('password_resets')->whereDate('created_at', '<=', $date)->whereTime('created_at', '<', $time)->delete();
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
