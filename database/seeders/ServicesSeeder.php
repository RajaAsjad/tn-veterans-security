<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            // Security Training Services
            [
                'title' => 'Unarmed Guard Training',
                'short_description' => '4-hour comprehensive training program for unarmed security officers.',
                'categories' => ['security_training'],
                'subcategory' => 'Unarmed Guard Training',
                'location' => null,
                'price' => null, // Set pricing as needed
                'deposit_amount' => null,
                'class_type' => 'group',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Armed Security Certification',
                'short_description' => 'Complete armed security guard certification program. Available at Location A and Location B.',
                'categories' => ['security_training'],
                'subcategory' => 'Armed Security Certification',
                'location' => null, // Location is set at schedule level, not service level
                'price' => null,
                'deposit_amount' => null,
                'class_type' => 'group',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'ASP (Batons & Restraints) with OC Spray',
                'short_description' => 'Advanced training in batons, restraints, and OC spray techniques. Available at Location A and Location B.',
                'categories' => ['security_training'],
                'subcategory' => 'ASP (Batons & Restraints)',
                'location' => null, // Location is set at schedule level, not service level
                'price' => null,
                'deposit_amount' => null,
                'class_type' => 'group',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'title' => 'Force Science (De-Escalation)',
                'short_description' => 'Learn effective de-escalation techniques and force science principles.',
                'categories' => ['security_training'],
                'subcategory' => 'Force Science',
                'location' => null,
                'price' => null,
                'deposit_amount' => null,
                'class_type' => 'group',
                'is_active' => true,
                'order' => 6,
            ],
            [
                'title' => 'Enhanced Handgun Carry Permit',
                'short_description' => 'Enhanced handgun carry permit training and certification.',
                'categories' => ['security_training'],
                'subcategory' => 'Enhanced Handgun Carry Permit',
                'location' => null,
                'price' => null,
                'deposit_amount' => null,
                'class_type' => 'group',
                'is_active' => true,
                'order' => 7,
            ],
            [
                'title' => 'Standard Handgun Carry',
                'short_description' => 'Standard handgun carry permit training program.',
                'categories' => ['security_training'],
                'subcategory' => 'Standard Handgun Carry',
                'location' => null,
                'price' => null,
                'deposit_amount' => null,
                'class_type' => 'group',
                'is_active' => true,
                'order' => 8,
            ],
            [
                'title' => 'Less Lethal Training',
                'short_description' => 'Comprehensive less lethal weapons and techniques training.',
                'categories' => ['security_training'],
                'subcategory' => 'Less Lethal Training',
                'location' => null,
                'price' => null,
                'deposit_amount' => null,
                'class_type' => 'group',
                'is_active' => true,
                'order' => 9,
            ],
            [
                'title' => 'Dallas Law Training',
                'short_description' => 'Required training for security officers working around alcohol.',
                'categories' => ['security_training'],
                'subcategory' => 'Dallas Law',
                'location' => null,
                'price' => null,
                'deposit_amount' => null,
                'class_type' => 'group',
                'requires_dallas_law' => false, // This IS the Dallas Law training
                'is_active' => true,
                'order' => 10,
            ],
            [
                'title' => 'Active Shooter Training',
                'short_description' => 'Required training for security officers working at schools, churches, or daycares.',
                'categories' => ['security_training'],
                'subcategory' => 'Active Shooter',
                'location' => null,
                'price' => null,
                'deposit_amount' => null,
                'class_type' => 'group',
                'requires_active_shooter' => false, // This IS the Active Shooter training
                'is_active' => true,
                'order' => 11,
            ],
            
            // NRA Services
            [
                'title' => 'Refuse to be the Victim',
                'short_description' => 'NRA personal safety and crime prevention program.',
                'categories' => ['nra'],
                'subcategory' => 'Refuse to be the Victim',
                'location' => null,
                'price' => null,
                'deposit_amount' => null,
                'class_type' => 'group',
                'is_active' => true,
                'order' => 12,
            ],
            [
                'title' => 'NRA Rifle Training',
                'short_description' => 'Comprehensive rifle training and certification.',
                'categories' => ['nra'],
                'subcategory' => 'Rifle',
                'location' => null,
                'price' => null,
                'deposit_amount' => null,
                'class_type' => 'group',
                'is_active' => true,
                'order' => 13,
            ],
            [
                'title' => 'NRA Shotgun Training',
                'short_description' => 'Comprehensive shotgun training and certification.',
                'categories' => ['nra'],
                'subcategory' => 'Shotgun',
                'location' => null,
                'price' => null,
                'deposit_amount' => null,
                'class_type' => 'group',
                'is_active' => true,
                'order' => 14,
            ],
            
            // Red Cross Services
            [
                'title' => 'First Aid / CPR / AED',
                'short_description' => 'Red Cross First Aid, CPR, and AED certification training.',
                'categories' => ['red_cross'],
                'subcategory' => 'First Aid / CPR / AED',
                'location' => null,
                'price' => null,
                'deposit_amount' => null,
                'class_type' => 'group',
                'is_active' => true,
                'order' => 15,
            ],
            [
                'title' => 'BLS (Basic Life Support)',
                'short_description' => 'Red Cross Basic Life Support certification for healthcare providers.',
                'categories' => ['red_cross'],
                'subcategory' => 'BLS',
                'location' => null,
                'price' => null,
                'deposit_amount' => null,
                'class_type' => 'group',
                'is_active' => true,
                'order' => 16,
            ],
            
            // Handgun Carry Permit
            [
                'title' => 'Handgun Carry Permit',
                'short_description' => 'State of Tennessee handgun carry permit training and certification.',
                'categories' => ['handgun_carry'],
                'subcategory' => null,
                'location' => null,
                'price' => null,
                'deposit_amount' => null,
                'class_type' => 'group',
                'is_active' => true,
                'order' => 17,
            ],
        ];

        foreach ($services as $serviceData) {
            Service::updateOrCreate(
                [
                    'title' => $serviceData['title'],
                    'subcategory' => $serviceData['subcategory'] ?? null,
                ],
                $serviceData
            );
        }
    }
}
