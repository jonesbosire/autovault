<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\BodyType;
use App\Models\Feature;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ["email" => "admin@autovault.co.ke"],
            ["name" => "AutoVault Admin", "password" => Hash::make("Admin@1234!"), "role" => "super_admin", "status" => "active", "is_verified" => true]
        );
        $brands = [["name"=>"Toyota","slug"=>"toyota","is_popular"=>true,"sort_order"=>1],["name"=>"Nissan","slug"=>"nissan","is_popular"=>true,"sort_order"=>2],["name"=>"Mazda","slug"=>"mazda","is_popular"=>true,"sort_order"=>3],["name"=>"Subaru","slug"=>"subaru","is_popular"=>true,"sort_order"=>4],["name"=>"Honda","slug"=>"honda","is_popular"=>true,"sort_order"=>5],["name"=>"Mercedes","slug"=>"mercedes","is_popular"=>true,"sort_order"=>6],["name"=>"BMW","slug"=>"bmw","is_popular"=>true,"sort_order"=>7],["name"=>"Mitsubishi","slug"=>"mitsubishi","is_popular"=>false,"sort_order"=>8],["name"=>"Isuzu","slug"=>"isuzu","is_popular"=>false,"sort_order"=>9],["name"=>"Land Rover","slug"=>"land-rover","is_popular"=>false,"sort_order"=>10],["name"=>"Lexus","slug"=>"lexus","is_popular"=>false,"sort_order"=>11],["name"=>"Volkswagen","slug"=>"volkswagen","is_popular"=>false,"sort_order"=>12],["name"=>"Ford","slug"=>"ford","is_popular"=>false,"sort_order"=>13],["name"=>"Hyundai","slug"=>"hyundai","is_popular"=>false,"sort_order"=>14],["name"=>"Kia","slug"=>"kia","is_popular"=>false,"sort_order"=>15],["name"=>"Audi","slug"=>"audi","is_popular"=>false,"sort_order"=>16],["name"=>"Suzuki","slug"=>"suzuki","is_popular"=>false,"sort_order"=>17]];
        foreach ($brands as $b) { Brand::firstOrCreate(["slug"=>$b["slug"]], $b); }
        $bodyTypes = [["name"=>"SUV","slug"=>"suv","sort_order"=>1],["name"=>"Sedan","slug"=>"sedan","sort_order"=>2],["name"=>"Hatchback","slug"=>"hatchback","sort_order"=>3],["name"=>"Pickup","slug"=>"pickup","sort_order"=>4],["name"=>"Van","slug"=>"van","sort_order"=>5],["name"=>"Coupe","slug"=>"coupe","sort_order"=>6],["name"=>"Wagon","slug"=>"wagon","sort_order"=>7],["name"=>"Convertible","slug"=>"convertible","sort_order"=>8],["name"=>"Minibus","slug"=>"minibus","sort_order"=>9],["name"=>"Truck","slug"=>"truck","sort_order"=>10]];
        foreach ($bodyTypes as $bt) { BodyType::firstOrCreate(["slug"=>$bt["slug"]], $bt); }
        $features = [["name"=>"ABS Brakes","category"=>"safety"],["name"=>"Airbags","category"=>"safety"],["name"=>"Reverse Camera","category"=>"safety"],["name"=>"Parking Sensors","category"=>"safety"],["name"=>"Cruise Control","category"=>"safety"],["name"=>"Air Conditioning","category"=>"comfort"],["name"=>"Leather Seats","category"=>"comfort"],["name"=>"Sunroof","category"=>"comfort"],["name"=>"Power Steering","category"=>"comfort"],["name"=>"Electric Windows","category"=>"comfort"],["name"=>"Central Locking","category"=>"comfort"],["name"=>"Bluetooth","category"=>"technology"],["name"=>"Navigation / GPS","category"=>"technology"],["name"=>"Apple CarPlay","category"=>"technology"],["name"=>"Android Auto","category"=>"technology"],["name"=>"USB Ports","category"=>"technology"],["name"=>"Alloy Wheels","category"=>"general"],["name"=>"Tow Bar","category"=>"general"],["name"=>"4WD / AWD","category"=>"general"]];
        foreach ($features as $f) { Feature::firstOrCreate(["name"=>$f["name"]], $f); }
        $this->call(VehicleSeeder::class);
    }
}
