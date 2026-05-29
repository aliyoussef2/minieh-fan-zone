<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FootballMatch;

class MatchSeeder extends Seeder
{
    public function run(): void
    {
        FootballMatch::truncate();

        $matches = [
            ['team_a'=>'Mexico','team_b'=>'Ecuador','flag_code_a'=>'mx','flag_code_b'=>'ec','match_date'=>'2026-06-11','match_time'=>'13:00','stage'=>'Group Stage','group'=>'A'],
            ['team_a'=>'USA','team_b'=>'Canada','flag_code_a'=>'us','flag_code_b'=>'ca','match_date'=>'2026-06-12','match_time'=>'22:00','stage'=>'Group Stage','group'=>'A'],
            ['team_a'=>'Canada','team_b'=>'Ecuador','flag_code_a'=>'ca','flag_code_b'=>'ec','match_date'=>'2026-06-15','match_time'=>'19:00','stage'=>'Group Stage','group'=>'A'],
            ['team_a'=>'USA','team_b'=>'Mexico','flag_code_a'=>'us','flag_code_b'=>'mx','match_date'=>'2026-06-16','match_time'=>'22:00','stage'=>'Group Stage','group'=>'A'],
            ['team_a'=>'Canada','team_b'=>'Mexico','flag_code_a'=>'ca','flag_code_b'=>'mx','match_date'=>'2026-06-19','match_time'=>'22:00','stage'=>'Group Stage','group'=>'A'],
            ['team_a'=>'Ecuador','team_b'=>'USA','flag_code_a'=>'ec','flag_code_b'=>'us','match_date'=>'2026-06-19','match_time'=>'22:00','stage'=>'Group Stage','group'=>'A'],
            ['team_a'=>'Argentina','team_b'=>'TBD','flag_code_a'=>'ar','flag_code_b'=>'','match_date'=>'2026-06-12','match_time'=>'13:00','stage'=>'Group Stage','group'=>'B'],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-12','match_time'=>'19:00','stage'=>'Group Stage','group'=>'B'],
            ['team_a'=>'Argentina','team_b'=>'TBD','flag_code_a'=>'ar','flag_code_b'=>'','match_date'=>'2026-06-16','match_time'=>'16:00','stage'=>'Group Stage','group'=>'B'],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-16','match_time'=>'19:00','stage'=>'Group Stage','group'=>'B'],
            ['team_a'=>'Argentina','team_b'=>'TBD','flag_code_a'=>'ar','flag_code_b'=>'','match_date'=>'2026-06-20','match_time'=>'22:00','stage'=>'Group Stage','group'=>'B'],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-20','match_time'=>'22:00','stage'=>'Group Stage','group'=>'B'],
            ['team_a'=>'Brazil','team_b'=>'TBD','flag_code_a'=>'br','flag_code_b'=>'','match_date'=>'2026-06-13','match_time'=>'13:00','stage'=>'Group Stage','group'=>'C'],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-13','match_time'=>'16:00','stage'=>'Group Stage','group'=>'C'],
            ['team_a'=>'Brazil','team_b'=>'TBD','flag_code_a'=>'br','flag_code_b'=>'','match_date'=>'2026-06-17','match_time'=>'13:00','stage'=>'Group Stage','group'=>'C'],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-17','match_time'=>'16:00','stage'=>'Group Stage','group'=>'C'],
            ['team_a'=>'Brazil','team_b'=>'TBD','flag_code_a'=>'br','flag_code_b'=>'','match_date'=>'2026-06-21','match_time'=>'22:00','stage'=>'Group Stage','group'=>'C'],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-21','match_time'=>'22:00','stage'=>'Group Stage','group'=>'C'],
            ['team_a'=>'France','team_b'=>'TBD','flag_code_a'=>'fr','flag_code_b'=>'','match_date'=>'2026-06-13','match_time'=>'19:00','stage'=>'Group Stage','group'=>'D'],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-13','match_time'=>'22:00','stage'=>'Group Stage','group'=>'D'],
            ['team_a'=>'France','team_b'=>'TBD','flag_code_a'=>'fr','flag_code_b'=>'','match_date'=>'2026-06-17','match_time'=>'19:00','stage'=>'Group Stage','group'=>'D'],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-17','match_time'=>'22:00','stage'=>'Group Stage','group'=>'D'],
            ['team_a'=>'France','team_b'=>'TBD','flag_code_a'=>'fr','flag_code_b'=>'','match_date'=>'2026-06-21','match_time'=>'19:00','stage'=>'Group Stage','group'=>'D'],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-21','match_time'=>'19:00','stage'=>'Group Stage','group'=>'D'],
            ['team_a'=>'Spain','team_b'=>'TBD','flag_code_a'=>'es','flag_code_b'=>'','match_date'=>'2026-06-14','match_time'=>'13:00','stage'=>'Group Stage','group'=>'E'],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-14','match_time'=>'16:00','stage'=>'Group Stage','group'=>'E'],
            ['team_a'=>'Spain','team_b'=>'TBD','flag_code_a'=>'es','flag_code_b'=>'','match_date'=>'2026-06-18','match_time'=>'13:00','stage'=>'Group Stage','group'=>'E'],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-18','match_time'=>'16:00','stage'=>'Group Stage','group'=>'E'],
            ['team_a'=>'Spain','team_b'=>'TBD','flag_code_a'=>'es','flag_code_b'=>'','match_date'=>'2026-06-22','match_time'=>'22:00','stage'=>'Group Stage','group'=>'E'],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-22','match_time'=>'22:00','stage'=>'Group Stage','group'=>'E'],
            ['team_a'=>'Germany','team_b'=>'TBD','flag_code_a'=>'de','flag_code_b'=>'','match_date'=>'2026-06-14','match_time'=>'19:00','stage'=>'Group Stage','group'=>'F'],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-14','match_time'=>'22:00','stage'=>'Group Stage','group'=>'F'],
            ['team_a'=>'Germany','team_b'=>'TBD','flag_code_a'=>'de','flag_code_b'=>'','match_date'=>'2026-06-18','match_time'=>'19:00','stage'=>'Group Stage','group'=>'F'],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-18','match_time'=>'22:00','stage'=>'Group Stage','group'=>'F'],
            ['team_a'=>'Germany','team_b'=>'TBD','flag_code_a'=>'de','flag_code_b'=>'','match_date'=>'2026-06-22','match_time'=>'19:00','stage'=>'Group Stage','group'=>'F'],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-22','match_time'=>'19:00','stage'=>'Group Stage','group'=>'F'],
            ['team_a'=>'Portugal','team_b'=>'TBD','flag_code_a'=>'pt','flag_code_b'=>'','match_date'=>'2026-06-15','match_time'=>'13:00','stage'=>'Group Stage','group'=>'G'],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-15','match_time'=>'16:00','stage'=>'Group Stage','group'=>'G'],
            ['team_a'=>'Portugal','team_b'=>'TBD','flag_code_a'=>'pt','flag_code_b'=>'','match_date'=>'2026-06-19','match_time'=>'13:00','stage'=>'Group Stage','group'=>'G'],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-19','match_time'=>'16:00','stage'=>'Group Stage','group'=>'G'],
            ['team_a'=>'Portugal','team_b'=>'TBD','flag_code_a'=>'pt','flag_code_b'=>'','match_date'=>'2026-06-23','match_time'=>'22:00','stage'=>'Group Stage','group'=>'G'],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-23','match_time'=>'22:00','stage'=>'Group Stage','group'=>'G'],
            ['team_a'=>'England','team_b'=>'TBD','flag_code_a'=>'gb-eng','flag_code_b'=>'','match_date'=>'2026-06-15','match_time'=>'22:00','stage'=>'Group Stage','group'=>'H'],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-16','match_time'=>'13:00','stage'=>'Group Stage','group'=>'H'],
            ['team_a'=>'England','team_b'=>'TBD','flag_code_a'=>'gb-eng','flag_code_b'=>'','match_date'=>'2026-06-20','match_time'=>'13:00','stage'=>'Group Stage','group'=>'H'],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-20','match_time'=>'16:00','stage'=>'Group Stage','group'=>'H'],
            ['team_a'=>'England','team_b'=>'TBD','flag_code_a'=>'gb-eng','flag_code_b'=>'','match_date'=>'2026-06-24','match_time'=>'22:00','stage'=>'Group Stage','group'=>'H'],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-24','match_time'=>'22:00','stage'=>'Group Stage','group'=>'H'],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-27','match_time'=>'16:00','stage'=>'Round of 32','group'=>null],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-27','match_time'=>'22:00','stage'=>'Round of 32','group'=>null],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-28','match_time'=>'16:00','stage'=>'Round of 32','group'=>null],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-28','match_time'=>'22:00','stage'=>'Round of 32','group'=>null],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-29','match_time'=>'16:00','stage'=>'Round of 32','group'=>null],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-29','match_time'=>'22:00','stage'=>'Round of 32','group'=>null],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-30','match_time'=>'16:00','stage'=>'Round of 32','group'=>null],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-06-30','match_time'=>'22:00','stage'=>'Round of 32','group'=>null],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-07-04','match_time'=>'19:00','stage'=>'Round of 16','group'=>null],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-07-04','match_time'=>'22:00','stage'=>'Round of 16','group'=>null],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-07-05','match_time'=>'19:00','stage'=>'Round of 16','group'=>null],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-07-05','match_time'=>'22:00','stage'=>'Round of 16','group'=>null],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-07-09','match_time'=>'22:00','stage'=>'Quarter Final','group'=>null],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-07-10','match_time'=>'22:00','stage'=>'Quarter Final','group'=>null],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-07-14','match_time'=>'22:00','stage'=>'Semi Final','group'=>null],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-07-15','match_time'=>'22:00','stage'=>'Semi Final','group'=>null],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-07-18','match_time'=>'19:00','stage'=>'Third Place','group'=>null],
            ['team_a'=>'TBD','team_b'=>'TBD','flag_code_a'=>'','flag_code_b'=>'','match_date'=>'2026-07-19','match_time'=>'22:00','stage'=>'Final','group'=>null],
        ];

        foreach ($matches as $match) {
            FootballMatch::create($match);
        }
    }
}