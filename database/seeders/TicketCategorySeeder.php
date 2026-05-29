<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TicketCategory;

class TicketCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['section'=>'A','name'=>'VIP Lounge','seating_style'=>'Couch / Sofa Seating','tables_count'=>18,'per_table'=>6,'total_capacity'=>108,'location_label'=>'Left Wing — Front'],
            ['section'=>'B','name'=>'VIP Lounge','seating_style'=>'Couch / Sofa Seating','tables_count'=>16,'per_table'=>6,'total_capacity'=>96,'location_label'=>'Center — Front Row'],
            ['section'=>'C','name'=>'VIP Lounge','seating_style'=>'Couch / Sofa Seating','tables_count'=>18,'per_table'=>6,'total_capacity'=>108,'location_label'=>'Right Wing — Front'],
            ['section'=>'D','name'=>'High Tables','seating_style'=>'High Chair Seating','tables_count'=>24,'per_table'=>4,'total_capacity'=>96,'location_label'=>'Left Wing — Mid'],
            ['section'=>'E','name'=>'High Tables','seating_style'=>'High Chair Seating','tables_count'=>22,'per_table'=>4,'total_capacity'=>88,'location_label'=>'Center — Mid'],
            ['section'=>'F','name'=>'High Tables','seating_style'=>'High Chair Seating','tables_count'=>24,'per_table'=>4,'total_capacity'=>96,'location_label'=>'Right Wing — Mid'],
            ['section'=>'G','name'=>'Standard Tables','seating_style'=>'Regular Chair Seating','tables_count'=>36,'per_table'=>4,'total_capacity'=>144,'location_label'=>'Left Side — Back'],
            ['section'=>'H','name'=>'Standard Tables','seating_style'=>'Regular Chair Seating','tables_count'=>36,'per_table'=>4,'total_capacity'=>144,'location_label'=>'Right Side — Back'],
            ['section'=>'I','name'=>'Single Seats','seating_style'=>'Individual Chair','tables_count'=>162,'per_table'=>1,'total_capacity'=>162,'location_label'=>'Back Rows'],
        ];

        foreach ($categories as $cat) {
            TicketCategory::updateOrCreate(['section' => $cat['section']], $cat);
        }
    }
}