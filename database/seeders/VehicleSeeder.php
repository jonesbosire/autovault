<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\BodyType;
use App\Models\CarModel;
use App\Models\Feature;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        // Create a seller user
        $seller = User::firstOrCreate(
            ['email' => 'seller@autovault.co.ke'],
            [
                'name'        => 'John Kamau',
                'password'    => Hash::make('Seller@1234!'),
                'role'        => 'seller',
                'status'      => 'active',
                'phone'       => '+254712345678',
                'is_verified' => true,
            ]
        );

        $seller2 = User::firstOrCreate(
            ['email' => 'dealer@autovault.co.ke'],
            [
                'name'        => 'Nairobi Auto Dealers',
                'password'    => Hash::make('Dealer@1234!'),
                'role'        => 'seller',
                'status'      => 'active',
                'phone'       => '+254722000000',
                'is_verified' => true,
            ]
        );

        // Helper to get or create car model
        $model = function (string $brandSlug, string $modelName, string $bodyTypeSlug): ?array {
            $brand    = Brand::where('slug', $brandSlug)->first();
            $bodyType = BodyType::where('slug', $bodyTypeSlug)->first();
            if (!$brand || !$bodyType) return null;
            $carModel = CarModel::firstOrCreate(
                ['name' => $modelName, 'brand_id' => $brand->id],
                ['slug' => Str::slug($brandSlug . '-' . $modelName), 'is_active' => true]
            );
            return ['brand' => $brand, 'model' => $carModel, 'body' => $bodyType];
        };

        $featureIds = function (array $names): array {
            return Feature::whereIn('name', $names)->pluck('id')->toArray();
        };

        $listings = [
            // ── Toyota Land Cruiser Prado TX ───────────────────────────────────────
            [
                'meta'     => $model('toyota', 'Land Cruiser Prado', 'suv'),
                'user'     => $seller,
                'data'     => [
                    'title'         => '2019 Toyota Land Cruiser Prado TX',
                    'year'          => 2019,
                    'mileage'       => 62000,
                    'condition'     => 'used',
                    'transmission'  => 'automatic',
                    'fuel_type'     => 'diesel',
                    'drive_type'    => '4wd',
                    'engine_cc'     => 2800,
                    'color'         => 'White',
                    'doors'         => 5,
                    'seats'         => 7,
                    'price'         => 7500000,
                    'is_negotiable' => true,
                    'county'        => 'Nairobi',
                    'availability'  => 'local',
                    'description'   => 'Well maintained Toyota Land Cruiser Prado TX. Single owner from new. Full service history. Comes with 7 seats, rear AC, reverse camera, and all original accessories. No accidents. Logbook ready.',
                    'is_featured'   => true,
                    'is_verified'   => true,
                    'auto_score'    => 92,
                    'cover_image_url' => 'https://images.unsplash.com/photo-1617788138017-80ad40651399?w=800&q=80',
                ],
                'features' => ['ABS Brakes', 'Airbags', 'Reverse Camera', 'Parking Sensors', 'Air Conditioning', 'Leather Seats', 'Navigation / GPS', 'Bluetooth', '4WD / AWD'],
            ],

            // ── Mazda Demio ────────────────────────────────────────────────────────
            [
                'meta'     => $model('mazda', 'Demio', 'hatchback'),
                'user'     => $seller,
                'data'     => [
                    'title'         => '2015 Mazda Demio XD Diesel',
                    'year'          => 2015,
                    'mileage'       => 88000,
                    'condition'     => 'used',
                    'transmission'  => 'automatic',
                    'fuel_type'     => 'diesel',
                    'drive_type'    => '2wd',
                    'engine_cc'     => 1500,
                    'color'         => 'Silver',
                    'doors'         => 5,
                    'seats'         => 5,
                    'price'         => 950000,
                    'is_negotiable' => true,
                    'county'        => 'Nairobi',
                    'availability'  => 'local',
                    'description'   => 'Mazda Demio XD diesel in perfect condition. Fuel-efficient (25km/l), ideal for Nairobi traffic. Just serviced. New tyres. No rust, no accidents. NTSA clear.',
                    'is_featured'   => false,
                    'is_verified'   => true,
                    'auto_score'    => 85,
                    'cover_image_url' => 'https://images.unsplash.com/photo-1541038765-dc1fe7c4e39e?w=800&q=80',
                ],
                'features' => ['ABS Brakes', 'Airbags', 'Bluetooth', 'Electric Windows', 'Air Conditioning', 'Central Locking'],
            ],

            // ── Nissan X-Trail ─────────────────────────────────────────────────────
            [
                'meta'     => $model('nissan', 'X-Trail', 'suv'),
                'user'     => $seller2,
                'data'     => [
                    'title'         => '2014 Nissan X-Trail 4WD',
                    'year'          => 2014,
                    'mileage'       => 112000,
                    'condition'     => 'used',
                    'transmission'  => 'automatic',
                    'fuel_type'     => 'petrol',
                    'drive_type'    => '4wd',
                    'engine_cc'     => 2000,
                    'color'         => 'Black',
                    'doors'         => 5,
                    'seats'         => 7,
                    'price'         => 1550000,
                    'is_negotiable' => true,
                    'county'        => 'Mombasa',
                    'availability'  => 'local',
                    'description'   => 'Nissan X-Trail in excellent condition. 4WD, panoramic roof, 7 seater, leather seats. Recently imported from Japan. Low mileage for the year. Logbook ready. Asking 1.55M slightly negotiable.',
                    'is_featured'   => true,
                    'is_verified'   => true,
                    'auto_score'    => 88,
                    'cover_image_url' => 'https://images.unsplash.com/photo-1569227997603-33b9195e0545?w=800&q=80',
                ],
                'features' => ['ABS Brakes', 'Airbags', 'Sunroof', 'Leather Seats', 'Reverse Camera', 'Bluetooth', 'Navigation / GPS', '4WD / AWD', 'Air Conditioning'],
            ],

            // ── Subaru Forester ────────────────────────────────────────────────────
            [
                'meta'     => $model('subaru', 'Forester', 'suv'),
                'user'     => $seller,
                'data'     => [
                    'title'         => '2013 Subaru Forester XT Turbo AWD',
                    'year'          => 2013,
                    'mileage'       => 135000,
                    'condition'     => 'used',
                    'transmission'  => 'automatic',
                    'fuel_type'     => 'petrol',
                    'drive_type'    => 'awd',
                    'engine_cc'     => 2500,
                    'color'         => 'White Pearl',
                    'doors'         => 5,
                    'seats'         => 5,
                    'price'         => 1950000,
                    'is_negotiable' => false,
                    'county'        => 'Nairobi',
                    'availability'  => 'local',
                    'description'   => 'Subaru Forester XT turbo AWD. Panoramic roof, leather seats, reverse camera. Serviced at authorized Subaru dealer. Timing belt recently done. Clean, no rust. Firm price.',
                    'is_featured'   => false,
                    'is_verified'   => true,
                    'auto_score'    => 82,
                    'cover_image_url' => 'https://images.unsplash.com/photo-1609521263047-f8f205293f24?w=800&q=80',
                ],
                'features' => ['ABS Brakes', 'Airbags', 'Sunroof', 'Leather Seats', 'Reverse Camera', 'Bluetooth', '4WD / AWD', 'Air Conditioning', 'Power Steering'],
            ],

            // ── Toyota Axio ────────────────────────────────────────────────────────
            [
                'meta'     => $model('toyota', 'Axio', 'wagon'),
                'user'     => $seller2,
                'data'     => [
                    'title'         => '2016 Toyota Axio Hybrid 1.5',
                    'year'          => 2016,
                    'mileage'       => 74000,
                    'condition'     => 'used',
                    'transmission'  => 'automatic',
                    'fuel_type'     => 'hybrid',
                    'drive_type'    => '2wd',
                    'engine_cc'     => 1500,
                    'color'         => 'White',
                    'doors'         => 4,
                    'seats'         => 5,
                    'price'         => 1350000,
                    'is_negotiable' => true,
                    'county'        => 'Nairobi',
                    'availability'  => 'local',
                    'description'   => 'Toyota Axio hybrid, excellent fuel economy. Ideal for city and upcountry. Very clean interior. Full service history. Fuel sensor recently replaced. Negotiable for genuine buyers.',
                    'is_featured'   => true,
                    'is_verified'   => true,
                    'auto_score'    => 90,
                    'cover_image_url' => 'https://images.unsplash.com/photo-1550355291-bbee04a92027?w=800&q=80',
                ],
                'features' => ['ABS Brakes', 'Airbags', 'Air Conditioning', 'Bluetooth', 'Electric Windows', 'Central Locking', 'Reverse Camera'],
            ],

            // ── Honda CR-V ─────────────────────────────────────────────────────────
            [
                'meta'     => $model('honda', 'CR-V', 'suv'),
                'user'     => $seller,
                'data'     => [
                    'title'         => '2018 Honda CR-V 1.5T AWD',
                    'year'          => 2018,
                    'mileage'       => 58000,
                    'condition'     => 'used',
                    'transmission'  => 'automatic',
                    'fuel_type'     => 'petrol',
                    'drive_type'    => 'awd',
                    'engine_cc'     => 1500,
                    'color'         => 'Gunmetal Grey',
                    'doors'         => 5,
                    'seats'         => 5,
                    'price'         => 3800000,
                    'is_negotiable' => true,
                    'county'        => 'Nairobi',
                    'availability'  => 'local',
                    'description'   => 'Honda CR-V 2018 1.5 Turbo AWD. Lane assist, Apple CarPlay, Android Auto, adaptive cruise control. Original paint. One owner. Extremely well maintained.',
                    'is_featured'   => true,
                    'is_verified'   => true,
                    'auto_score'    => 94,
                    'cover_image_url' => 'https://images.unsplash.com/photo-1614914000-1f3cdd8f72a0?w=800&q=80',
                ],
                'features' => ['ABS Brakes', 'Airbags', 'Reverse Camera', 'Parking Sensors', 'Cruise Control', 'Apple CarPlay', 'Android Auto', 'Leather Seats', 'Sunroof', 'Bluetooth', 'Navigation / GPS', '4WD / AWD'],
            ],

            // ── BMW X3 ─────────────────────────────────────────────────────────────
            [
                'meta'     => $model('bmw', 'X3', 'suv'),
                'user'     => $seller2,
                'data'     => [
                    'title'         => '2017 BMW X3 xDrive20i',
                    'year'          => 2017,
                    'mileage'       => 92000,
                    'condition'     => 'used',
                    'transmission'  => 'automatic',
                    'fuel_type'     => 'petrol',
                    'drive_type'    => '4wd',
                    'engine_cc'     => 2000,
                    'color'         => 'Space Grey',
                    'doors'         => 5,
                    'seats'         => 5,
                    'price'         => 4200000,
                    'is_negotiable' => true,
                    'county'        => 'Nairobi',
                    'availability'  => 'local',
                    'description'   => 'BMW X3 xDrive20i. Panoramic sunroof, heated leather seats, iDrive 6, park assist. Imported from UK. Full BMW service history. Clean and ready to drive.',
                    'is_featured'   => true,
                    'is_verified'   => true,
                    'auto_score'    => 87,
                    'cover_image_url' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800&q=80',
                ],
                'features' => ['ABS Brakes', 'Airbags', 'Sunroof', 'Leather Seats', 'Parking Sensors', 'Cruise Control', 'Navigation / GPS', 'Bluetooth', '4WD / AWD', 'Electric Windows'],
            ],

            // ── Toyota Hilux ───────────────────────────────────────────────────────
            [
                'meta'     => $model('toyota', 'Hilux', 'pickup'),
                'user'     => $seller,
                'data'     => [
                    'title'         => '2020 Toyota Hilux Double Cab 4x4',
                    'year'          => 2020,
                    'mileage'       => 48000,
                    'condition'     => 'used',
                    'transmission'  => 'manual',
                    'fuel_type'     => 'diesel',
                    'drive_type'    => '4wd',
                    'engine_cc'     => 2800,
                    'color'         => 'White',
                    'doors'         => 4,
                    'seats'         => 5,
                    'price'         => 5200000,
                    'is_negotiable' => false,
                    'county'        => 'Nakuru',
                    'availability'  => 'local',
                    'description'   => 'Toyota Hilux 2.8D Double Cab 4x4. Used for light farm work only. No body dents. Low mileage for the year. Towbar, bed liner, roll bar. All docs in order. Firm price — serious buyers only.',
                    'is_featured'   => false,
                    'is_verified'   => true,
                    'auto_score'    => 91,
                    'cover_image_url' => 'https://images.unsplash.com/photo-1512461260-9a73af0804c6?w=800&q=80',
                ],
                'features' => ['ABS Brakes', 'Airbags', 'Reverse Camera', 'Air Conditioning', 'Bluetooth', '4WD / AWD', 'Tow Bar', 'Central Locking'],
            ],

            // ── Mercedes C200 ──────────────────────────────────────────────────────
            [
                'meta'     => $model('mercedes', 'C200', 'sedan'),
                'user'     => $seller2,
                'data'     => [
                    'title'         => '2016 Mercedes-Benz C200 Sedan',
                    'year'          => 2016,
                    'mileage'       => 78000,
                    'condition'     => 'used',
                    'transmission'  => 'automatic',
                    'fuel_type'     => 'petrol',
                    'drive_type'    => '2wd',
                    'engine_cc'     => 2000,
                    'color'         => 'Obsidian Black',
                    'doors'         => 4,
                    'seats'         => 5,
                    'price'         => 3600000,
                    'is_negotiable' => true,
                    'county'        => 'Nairobi',
                    'availability'  => 'local',
                    'description'   => 'Mercedes-Benz C200 in showroom condition. AMG sports package, Burmester sound, panoramic roof, LED headlights. All service done at Mercedes authorized dealer. Clean logbook.',
                    'is_featured'   => true,
                    'is_verified'   => true,
                    'auto_score'    => 89,
                    'cover_image_url' => 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=800&q=80',
                ],
                'features' => ['ABS Brakes', 'Airbags', 'Sunroof', 'Leather Seats', 'Parking Sensors', 'Cruise Control', 'Navigation / GPS', 'Bluetooth', 'Electric Windows', 'Apple CarPlay'],
            ],

            // ── Isuzu D-Max ────────────────────────────────────────────────────────
            [
                'meta'     => $model('isuzu', 'D-Max', 'pickup'),
                'user'     => $seller,
                'data'     => [
                    'title'         => '2019 Isuzu D-Max 3.0 Double Cab 4x4',
                    'year'          => 2019,
                    'mileage'       => 86000,
                    'condition'     => 'used',
                    'transmission'  => 'automatic',
                    'fuel_type'     => 'diesel',
                    'drive_type'    => '4wd',
                    'engine_cc'     => 3000,
                    'color'         => 'Pearl White',
                    'doors'         => 4,
                    'seats'         => 5,
                    'price'         => 4100000,
                    'is_negotiable' => true,
                    'county'        => 'Eldoret',
                    'availability'  => 'local',
                    'description'   => 'Isuzu D-Max 3.0 automatic 4x4. Used on farm and highways. Bull bar, spotlights, tonneau cover. Very strong and reliable. Recently replaced injectors and filters. Ready to work.',
                    'is_featured'   => false,
                    'is_verified'   => true,
                    'auto_score'    => 83,
                    'cover_image_url' => 'https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?w=800&q=80',
                ],
                'features' => ['ABS Brakes', 'Airbags', 'Reverse Camera', 'Air Conditioning', 'Bluetooth', '4WD / AWD', 'Tow Bar', 'Central Locking', 'Cruise Control'],
            ],

            // ── Mitsubishi Outlander ───────────────────────────────────────────────
            [
                'meta'     => $model('mitsubishi', 'Outlander', 'suv'),
                'user'     => $seller2,
                'data'     => [
                    'title'         => '2016 Mitsubishi Outlander PHEV 4WD',
                    'year'          => 2016,
                    'mileage'       => 101000,
                    'condition'     => 'used',
                    'transmission'  => 'automatic',
                    'fuel_type'     => 'hybrid',
                    'drive_type'    => '4wd',
                    'engine_cc'     => 2400,
                    'color'         => 'Silver',
                    'doors'         => 5,
                    'seats'         => 7,
                    'price'         => 3200000,
                    'is_negotiable' => true,
                    'county'        => 'Nairobi',
                    'availability'  => 'import',
                    'import_country'=> 'Japan',
                    'description'   => 'Mitsubishi Outlander PHEV (plug-in hybrid) electric. 7 seater. EV mode range ~50km. Near-zero fuel costs in city. Recently imported from Japan. EV battery health 90%+. Rare find in Kenya.',
                    'is_featured'   => false,
                    'is_verified'   => true,
                    'auto_score'    => 86,
                    'cover_image_url' => 'https://images.unsplash.com/photo-1502877338535-766e1452684a?w=800&q=80',
                ],
                'features' => ['ABS Brakes', 'Airbags', 'Reverse Camera', 'Parking Sensors', 'Air Conditioning', 'Leather Seats', 'Sunroof', 'Bluetooth', 'Navigation / GPS', '4WD / AWD'],
            ],

            // ── Toyota Vitz ────────────────────────────────────────────────────────
            [
                'meta'     => $model('toyota', 'Vitz', 'hatchback'),
                'user'     => $seller,
                'data'     => [
                    'title'         => '2017 Toyota Vitz 1.0 F Grade',
                    'year'          => 2017,
                    'mileage'       => 52000,
                    'condition'     => 'used',
                    'transmission'  => 'automatic',
                    'fuel_type'     => 'petrol',
                    'drive_type'    => '2wd',
                    'engine_cc'     => 1000,
                    'color'         => 'Red',
                    'doors'         => 5,
                    'seats'         => 5,
                    'price'         => 720000,
                    'is_negotiable' => true,
                    'county'        => 'Kisumu',
                    'availability'  => 'local',
                    'description'   => 'Toyota Vitz 1.0F in perfect condition. Great first car or city runner. Very fuel efficient. Newly imported, low mileage. All accessories present. Can arrange delivery to Nairobi.',
                    'is_featured'   => false,
                    'is_verified'   => true,
                    'auto_score'    => 88,
                    'cover_image_url' => 'https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=800&q=80',
                ],
                'features' => ['ABS Brakes', 'Airbags', 'Air Conditioning', 'Electric Windows', 'Central Locking', 'Bluetooth'],
            ],
        ];

        foreach ($listings as $listing) {
            if (!$listing['meta']) continue;

            $slug = Str::slug($listing['data']['title']);
            // Ensure unique slug
            $count = Vehicle::where('slug', 'LIKE', $slug . '%')->count();
            if ($count > 0) $slug .= '-' . ($count + 1);

            $vehicle = Vehicle::firstOrCreate(
                ['slug' => $slug],
                array_merge($listing['data'], [
                    'slug'        => $slug,
                    'user_id'     => $listing['user']->id,
                    'brand_id'    => $listing['meta']['brand']->id,
                    'car_model_id'=> $listing['meta']['model']->id,
                    'body_type_id'=> $listing['meta']['body']->id,
                    'status'      => 'active',
                    'currency'    => 'KES',
                    'approved_at' => now(),
                    'expires_at'  => now()->addMonths(3),
                    'views_count' => rand(20, 350),
                    'enquiries_count' => rand(1, 18),
                ])
            );

            // Attach features
            if (!empty($listing['features'])) {
                $ids = Feature::whereIn('name', $listing['features'])->pluck('id')->toArray();
                $vehicle->features()->syncWithoutDetaching($ids);
            }
        }

        $this->command->info('Seeded ' . count($listings) . ' vehicle listings.');
    }
}
