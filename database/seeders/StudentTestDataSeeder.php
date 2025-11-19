<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Customer;
use App\Models\Faculty;
use App\Models\Service;
use App\Models\Bill;
use Illuminate\Support\Facades\Hash;

class StudentTestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء كلية الذكاء الاصطناعي
        $aiFaculty = Faculty::firstOrCreate(
            ['ID' => 2],
            [
                'NameAR' => 'كلية الذكاء الاصطناعي',
                'NameEN' => 'Faculty of Artificial Intelligence',
                'Code' => 'AI001',
                'AccountNumber' => '987654321',
                'Note' => 'كلية الذكاء الاصطناعي - جامعة المنو'
            ]
        );

        // إنشاء كلية الهندسة
        $faculty = Faculty::firstOrCreate(
            ['ID' => 1],
            [
                'NameAR' => 'كلية الهندسة',
                'NameEN' => 'Faculty of Engineering',
                'Code' => 'ENG001',
                'AccountNumber' => '123456789',
                'Note' => 'كلية الهندسة - جامعة المنو'
            ]
        );

        // إنشاء خدمات إذا لم تكن موجودة
        $services = [
            ['ID' => 1, 'SERVICESName' => 'بيان حالة', 'value' => 200],
            ['ID' => 2, 'SERVICESName' => 'تربية عسكرية', 'value' => 500],
            ['ID' => 3, 'SERVICESName' => 'رسوم دراسية', 'value' => 1000],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(
                ['ID' => $service['ID']],
                ['SERVICESName' => $service['SERVICESName'], 'value' => $service['value']]
            );
        }

        // إنشاء طالب محمد شرشر
        $mohamedCustomer = Customer::firstOrCreate(
            ['Code' => '30404291700673'],
            [
                'Name' => 'محمد شرشر',
                'Description' => 'طالب - كلية الذكاء الاصطناعي',
                'Mobile' => '01012345678',
                'Email' => '30404291700673@student.ai.edu',
                'facultyID' => $aiFaculty->ID,
                'UserLevelID' => null
            ]
        );

        // إنشاء عميل تجريبي
        $customer = Customer::firstOrCreate(
            ['Code' => 'TEST001'],
            [
                'Name' => 'أحمد محمد علي',
                'Description' => 'طالب تجريبي',
                'Mobile' => '01234567890',
                'Email' => 'test.student@university.edu',
                'facultyID' => $faculty->ID,
                'UserLevelID' => null
            ]
        );

        // إنشاء مستخدم محمد شرشر (الرقم القومي كـ email و password)
        $mohamedUser = User::firstOrCreate(
            ['email' => '30404291700673'],
            [
                'name' => 'محمد شرشر',
                'password' => Hash::make('30404291700673'),
                'customer_code' => $mohamedCustomer->Code
            ]
        );

        if (!$mohamedUser->hasRole('student')) {
            $mohamedUser->assignRole('student');
        }

        // إنشاء مستخدم تجريبي
        $user = User::firstOrCreate(
            ['email' => 'test@test.com'],
            [
                'name' => 'Test Student',
                'password' => Hash::make('password'),
                'customer_code' => $customer->Code
            ]
        );

        // تعيين دور الطالب
        if (!$user->hasRole('student')) {
            $user->assignRole('student');
        }

        // إنشاء إيصالات لمحمد شرشر
        $mohamedBills = [
            [
                'ID' => 2001,
                'ServiceType_ID' => 1,
                'CustomerCode' => $mohamedCustomer->Code,
                'BillStatus' => 2, // مدفوع
                'DueDate' => now()->subDays(20),
                'SettlementDate' => now()->subDays(15),
                'created_at' => now()->subDays(25),
            ],
            [
                'ID' => 2002,
                'ServiceType_ID' => 2,
                'CustomerCode' => $mohamedCustomer->Code,
                'BillStatus' => 2, // مدفوع
                'DueDate' => now()->subDays(45),
                'SettlementDate' => now()->subDays(40),
                'created_at' => now()->subDays(50),
            ],
            [
                'ID' => 2003,
                'ServiceType_ID' => 3,
                'CustomerCode' => $mohamedCustomer->Code,
                'BillStatus' => 1, // معلق
                'DueDate' => now()->addDays(20),
                'created_at' => now()->subDays(3),
            ],
            [
                'ID' => 2004,
                'ServiceType_ID' => 1,
                'CustomerCode' => $mohamedCustomer->Code,
                'BillStatus' => 1, // معلق
                'DueDate' => now()->addDays(30),
                'created_at' => now()->subDays(1),
            ],
        ];

        foreach ($mohamedBills as $bill) {
            Bill::firstOrCreate(
                ['ID' => $bill['ID']],
                $bill
            );
        }

        // إنشاء إيصالات تجريبية
        $bills = [
            [
                'ID' => 1001,
                'ServiceType_ID' => 1,
                'CustomerCode' => $customer->Code,
                'BillStatus' => 2, // مدفوع
                'DueDate' => now()->subDays(30),
                'SettlementDate' => now()->subDays(25),
                'created_at' => now()->subDays(35),
            ],
            [
                'ID' => 1002,
                'ServiceType_ID' => 2,
                'CustomerCode' => $customer->Code,
                'BillStatus' => 1, // معلق
                'DueDate' => now()->addDays(10),
                'created_at' => now()->subDays(5),
            ],
            [
                'ID' => 1003,
                'ServiceType_ID' => 3,
                'CustomerCode' => $customer->Code,
                'BillStatus' => 1, // معلق
                'DueDate' => now()->addDays(15),
                'created_at' => now()->subDays(2),
            ],
            [
                'ID' => 1004,
                'ServiceType_ID' => 1,
                'CustomerCode' => $customer->Code,
                'BillStatus' => 2, // مدفوع
                'DueDate' => now()->subDays(60),
                'SettlementDate' => now()->subDays(55),
                'created_at' => now()->subDays(65),
            ],
        ];

        foreach ($bills as $bill) {
            Bill::firstOrCreate(
                ['ID' => $bill['ID']],
                $bill
            );
        }

        $this->command->info('✅ تم إنشاء البيانات التجريبية بنجاح!');
        $this->command->info('');
        $this->command->info('👤 === بيانات محمد شرشر ===');
        $this->command->info('📧 الرقم القومي (Email): 30404291700673');
        $this->command->info('🔑 كلمة المرور: 30404291700673');
        $this->command->info('🎓 الكلية: ' . $aiFaculty->NameAR);
        $this->command->info('📝 عدد الإيصالات: ' . count($mohamedBills));
        $this->command->info('');
        $this->command->info('📧 حساب تجريبي: test@test.com');
        $this->command->info('🔑 كلمة المرور: password');
        $this->command->info('👤 الطالب: ' . $customer->Name);
        $this->command->info('🏛️ الكلية: ' . $faculty->NameAR);
        $this->command->info('📝 الإيصالات: ' . count($bills));
    }
}
