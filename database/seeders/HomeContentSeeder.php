<?php

namespace Database\Seeders;

use App\Models\PortfolioItem;
use App\Models\ProcessStep;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HomeContentSeeder extends Seeder
{
    public function run(): void
    {
        if (Service::count() === 0) {
            $services = [
                [
                    'tag' => 'Golf',
                    'title' => 'Golf Course Construction',
                    'description' => 'From raw land to opening day — we design and build championship-quality courses with precision grading, shaping, drainage, irrigation, bunkers, water features, and tournament-ready greens.',
                    'bullets' => "New Course Construction (9 & 18-hole)\nFairway Shaping & Earthwork\nGreen Construction & Drainage\nSand Bunker Design & Build\nCart Path & Infrastructure\nIrrigation System Installation",
                    'image' => 'svc-golf.jpg',
                    'icon' => 'golf',
                    'sort_order' => 1,
                ],
                [
                    'tag' => 'Athletics',
                    'title' => 'Athletic Field Construction',
                    'description' => 'Football, soccer, baseball, lacrosse, softball, and multi-sport complexes — built from the ground up with proper grading, drainage systems, field lighting, fencing, and spectator infrastructure.',
                    'bullets' => "Football & Soccer Field Construction\nBaseball & Softball Diamond Build\nSub-surface Drainage Engineering\nField Lighting Installation\nBleacher & Fencing Systems\nMulti-Sport Complex Development",
                    'image' => 'svc-athletics.jpg',
                    'icon' => 'athletics',
                    'sort_order' => 2,
                ],
                [
                    'tag' => 'Renovation',
                    'title' => 'Course & Field Renovation',
                    'description' => 'Breathe new life into aging courses and underperforming fields. We restore drainage, reshape fairways, rebuild greens, and reconstruct fields to modern safety and performance standards — with minimal downtime.',
                    'bullets' => "Golf Course Redesign & Reshaping\nGreen Rebuild & Reconstruction\nDrainage System Overhaul\nAthletic Field Restoration\nInfield & Outfield Reconstruction\nADA Compliance Upgrades",
                    'image' => 'svc-renovation.jpg',
                    'icon' => 'renovation',
                    'sort_order' => 3,
                ],
            ];

            foreach ($services as $data) {
                Service::create(array_merge($data, ['slug' => Str::slug($data['title'])]));
            }
        }

        if (ProcessStep::count() === 0) {
            $steps = [
                ['step_number' => '01', 'phase_label' => 'Phase One', 'title' => 'Site Assessment & Planning', 'description' => 'We evaluate your land, soil conditions, drainage patterns, and project goals to build a detailed construction plan and honest budget estimate.', 'sort_order' => 1],
                ['step_number' => '02', 'phase_label' => 'Phase Two', 'title' => 'Design & Engineering', 'description' => 'Our licensed engineers and course architects develop detailed grading plans, drainage layouts, and irrigation schematics tailored to your site.', 'sort_order' => 2],
                ['step_number' => '03', 'phase_label' => 'Phase Three', 'title' => 'Construction & Build', 'description' => 'Our experienced crews execute every phase — earthwork, drainage, infrastructure, and surfacing — with precision equipment and rigorous quality control.', 'sort_order' => 3],
                ['step_number' => '04', 'phase_label' => 'Phase Four', 'title' => 'Inspection & Handoff', 'description' => 'Final inspections, punch-list completion, and a complete handoff package including as-built drawings, warranties, and maintenance recommendations.', 'sort_order' => 4],
            ];

            foreach ($steps as $data) {
                ProcessStep::create($data);
            }
        }

        if (PortfolioItem::count() === 0) {
            $items = [
                ['category_label' => 'Golf Course — New Build', 'title' => 'Ridgeview Country Club', 'subtitle' => '18-hole championship course — Savannah, GA · 2023', 'image' => 'port-1.jpg', 'image_alt' => 'Ridgeview Country Club championship golf course', 'sort_order' => 1],
                ['category_label' => 'Athletic Field — New Build', 'title' => 'Westlake High School Stadium', 'subtitle' => 'Multi-sport complex, 3 fields — Austin, TX · 2023', 'image' => 'port-2.jpg', 'image_alt' => 'Westlake High School athletic field complex', 'sort_order' => 2],
                ['category_label' => 'Golf Course — Full Renovation', 'title' => 'Sunridge Golf & Resort', 'subtitle' => '27-hole renovation + clubhouse — Scottsdale, AZ · 2024', 'image' => 'port-3.jpg', 'image_alt' => 'Sunridge Golf Resort renovation', 'sort_order' => 3],
                ['category_label' => 'Municipal Complex — New Build', 'title' => 'Maplewood Recreation Complex', 'subtitle' => '4-field soccer + football complex — Columbus, OH · 2024', 'image' => 'port-4.jpg', 'image_alt' => 'Maplewood Recreation Complex', 'sort_order' => 4],
            ];

            foreach ($items as $data) {
                PortfolioItem::create(array_merge($data, ['slug' => Str::slug($data['title'])]));
            }
        }

        if (Testimonial::count() === 0) {
            $testimonials = [
                ['name' => 'Robert Caldwell', 'designation' => 'General Manager — Ridgeview Country Club', 'comment' => "Prime Field delivered our 18-hole course six weeks ahead of schedule. The grading precision and drainage engineering is simply world-class. Our members can't stop talking about it.", 'image' => 'testimonial-1.jpg'],
                ['name' => 'Sandra Torres', 'designation' => 'Athletic Director — Westlake ISD', 'comment' => "Our student athletes now compete on a field that rivals professional facilities. Prime Field's team was transparent, professional, and incredibly skilled throughout every phase of construction.", 'image' => 'testimonial-2.jpg'],
                ['name' => 'James Whitfield', 'designation' => 'Director of Parks — Maplewood County', 'comment' => "We've partnered with Prime Field on four consecutive county projects. Their drainage engineering and earthwork quality is unmatched. Three years later, the fields still perform like day one.", 'image' => 'testimonial-3.jpg'],
            ];

            foreach ($testimonials as $data) {
                Testimonial::create(array_merge($data, ['slug' => Str::slug($data['name'])]));
            }
        }
    }
}
