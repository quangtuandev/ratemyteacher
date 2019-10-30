<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
use App\Models\User;
use App\Models\Role;

$reviewTitle = [
    'Phương Pháp Giảng Dạy Dễ Hiểu, Tiếp Thu Nhớ Bài Ngay Trên Lớp',
    'Thầy Cô Vui Vẻ, Nhiệt Tình Trong Giảng Dạy',
    'Giải Đề Cặn Kẽ, Chi Tiết',
    'Thầy Cô Dạy Hay, Thân Thiện, Dễ Hiểu',
    'Giáo Viên, Nhân Viên Nhiệt Tình, Tận Tâm',
    'Lớp Học Ít Người',
    'Có Giáo Trình Chi Tiết Và Các Tips Để Học Toeic 1 Cách Nhanh Nhất',
    'Tạm Được, Ổn',
    'Giảng viên chưa thật sự bao quát hết tất cả học viên.',
    'Chưa có những buổi thuyết trình',
    'Học phí khá cao',
    'Học phí đắt, tăng mỗi năm.',
    'Học tập với những người bạn mới, rất vui và bổ ích',
    'Ổn Trên Mặt Bằng Chung',
    'Trung Tâm Thân Thiện',
    'Trợ giảng chưa thực sự giỏi',
];
$reviewDetail = [
    'Chương trình học còn kết hợp chơi khá nhiều, phù hợp độ tuổi thiếu nhi hơn là thiếu niên',
    'nhiều chi nhánh không có đủ lớp phù hợp với trình độ của học viên, học phí cao, lớp học khá ít học viên',
    'Các kĩ năng được nâng cao khá rõ qua vài khoá học Môi trường quốc tế năng động',
    'Học phí khá cao, khó có thể theo học lâu dài. Giờ học không linh động, gây nhiều bất tiện cho học viên.',
    'Cơ sở vật chất hiện đại, cập nhật những loại công nghệ tiên tiến nhất trong việc dạy học Lớp học rộng rãi, cách sắp xếp bàn ghế thông minh giúp học viên có thể gần gũi và tương tác với nhau nhiều hơn, lớp có số lượng học viên vừa phải để đảm bảo chất lượng Các bài học đa dạng, thú vị, ngoài tiếng Anh còn được trau dồi thêm về kiến thức Thầy cô có chuyên môn cao vì 100% là người nước ngoài. Đặc biệt, các thầy cô tâm huyết và thân thiện, sẵn sàng tâm sự và giúp chỉ ra lỗi sai của học viên',
    'Học phí hơi cao, bất lợi cho học sinh nhà không có điều kiện, trung tâm chưa có nhiều cơ sở để thuận tiện cho tất cả mọi người Sảnh chính hơi chật chội, cần thêm ghế ngồi',
    'Được nhân viên tư vấn nhiệt tình, được học đúng trình độ. Được gặp những người bạn thân thiện dễ thương, giúp mình vui vẻ hơn trong việc học. Các bài học không quá mang tính căng thẳng về học thuật. Trái lại còn rất vui vẻ và làm học viên phải nói tiếng Anh nhiều với nhau hơn, giúp bản thân tiến bộ lên rõ rệt. Đặc biệt một điều mình thích là không có giáo viên người Việt nên bắt buộc phải nói tiếng Anh để nâng cao trình độ',
    'Đây là một nơi rất đáng để bạn trải nghiệm học tập Các bạn có thể giới thiệu bạn bè đến đây học',
    'Mình rất ấn tượng với môi trường học tập ở đây. Giáo viên chuyên nghiệp, có nhiều kinh nghiệm và chỉ ra được những hướng đi gỡ mắc cho học sinh. Nhờ học ở đây mà các kỹ năng ngoại ngữ của mình tăng lê...',
    'Giáo viên chuyên nghiệp, có trình độ cao, kỹ năng tốt. Môi trường học tập rất ổn. Giáo viên cũng sát sao với học sinh và giao bài tập sát với đề thi thực tế.',
    'Một môi trường học tập xứng đáng đồng tiền bát gạo, học tập tại đây giúp kỹ năng được nâng cao qua từng buổi học.',
    'Trải nghiệm: Sau thời gian học tập thì cảm thấy bản thân đã quyết định rất đúng khi chọn BC. Mình đã có cơ hội học tập làm quen và cải thiện đáng kể TA của mình',
    'Về chất lượng, có thể nói là trên cả tuyệt vời. Điều tuyệt vời nhất là British Council không tuyển giáo viên tại Việt Nam mà lại tuyển giáo viên trực tiếp từ bên Anh, đội ngũ giảng viên hầu hết tốt nghiệp Leeds University ở UK, là nơi duy nhất là các giáo viên có bằng đại học về ngôn ngữ Anh đào tạo tiếng Anh học thuật theo kiểu “mưa dầm thấm lâu”, một tuần học từ 3-5 buổi nên mình thấy không lên trình độ mới là lạ ấy',
];
$specialize = [
    'Toán cao cấp',
    'Toán rời rạc',
    'IELTS',
    'TOEIC',
    'Văn học',
    'Vẽ',
];
$detailCenter = [
    'British Council được mọi người biết đến là địa điểm tổ chức thi IELTS uy tín được phần lớn các thí sinh lựa chọn. Bên cạnh đó, trung tâm còn là địa chỉ tổ chức các lớp luyện thi và các khóa học Anh văn cho độ tuổi thiếu nhi và thiếu niên.',
    'Địa điểm luyện thi mà chất lượng được khẳng định qua bề dày giảng dạy và kết quả học viên. Trung tâm cam kết kết quả dựa những thành tựu học viên đã từng đạt được. Có rất nhiều bạn đã tốt nghiệp với điểm số từ 6.5 đến 8.0 IELTS.',
    'Trung tâm đã có kinh nghiệm 12 năm trong việc giảng dạy chương trình IELTS và 8 năm trong việc giảng dạy chương trình Cambridge. Học viên của trung tâm đã đạt được những thành tích cao trong các kì thi IELTS và Cambridge chẳng hạn có những học viên có điểm thi trung bình IELTS đạt trên 6.0, đặc biệt có những em đạt điểm IELTS 7.5 chỉ trong thời gian ngắn và có cơ hội được các trường ở Mỹ, Canada, Anh hỗ trợ những suất học bổng có giá trị.',
    'Một trong những trung tâm luyện thi TOEIC có tiếng ở Thủ Đức bởi sự tận tụy của giáo viên và phương pháp giảng dạy được đánh giá là hiệu quả. Ngoài ra, trung tâm còn có những lớp phát âm, giao tiếp và tiếng Anh căn bản.',
    'Là đơn vị đào tạo phía Nam duy nhất có bề dày lịch sử 40 năm chuyên về đào tạo giáo viên mầm non, trường Cao đẳng Sư phạm Trung ương là một gợi ý cho những ai có ý định học ngành Sư phạm.',
];
$detailTeacher = [
    'Áp dụng kinh nghiệm và kỹ năng để trở thành một giáo viên xuất sắc, giúp gia tăng hiệu quả làm việc và đóng góp vào sự phát triển của học sinh',
    'Có 3 năm kinh nghiệm giảng dạy trực tiếp tại một trường công có uy tín, yêu nghề, yêu học sinh và không ngừng học tập, đổi mới kiến thức, có tư duy đổi mới dạy và học.',
    'Với hơn hai năm kinh nghiệm ở các vị trí Product Manager, Business Analyst, trong việc hỗ trợ nhóm Agile, tạo, sắp xếp mức độ ưu tiên và quản lý backlog',
    'các chứng chỉ TOEIC 750, Google Adwards và bằng Thạc sỹ Quản trị kinh doanh.',
    'tôi mong muốn tận dụng các kỹ năng và kiến thức của mình để truyền đạt cho học viên.',
];
$centerName = [
    'Trung tâm anh ngữ Alpha',
    'Trung tâm năng khiếu Betal',
    'Trung tâm tiếng Lào Việt-Đức',
    'Trung tâm tiếng Nhật Kimochii',
];
$factory->define(User::class, function (Faker $faker) {
    return [
    'name'           => $faker->name,
    'email'          => $faker->unique()->safeEmail,
    'password'       => '123456',
    'birthday'       => $faker->date(),
    'avatar'         => $faker->imageUrl($width = 250, $height = 250),
    'address'        => $faker->address,
    'phone'          => $faker->e164PhoneNumber,
    'status'         => User::ACTIVE,
    'token_confirm'  => str_random(10),
    'gender'         => $faker->randomElement(array('1','0')),
    'about'          => $faker->text(),
    ];
});

$factory->define(Role::class, function (Faker $faker) {
    static $typeId;

    return [
        'name' => $faker->word,
        'type' => $faker->randomElement([1, 2]),
    ];
});

$factory->state(User::class, Role::ROLE_ADMIN, function () {
    return [
        'name' => 'Admin',
        'email' => 'admin@gmail.com',
        'status' => User::ACTIVE,
    ];
});

// Define factory for Teacher
use App\Models\Center;
use App\Models\Teacher;
$factory->define(Center::class, function (Faker $faker) use ($detailCenter, $centerName) {
    return [
        'name' => array_random($centerName),
        'description' => array_random($detailCenter),
        'address' => $faker->address,
        'phone' => $faker->e164PhoneNumber,
        'image' => $faker->imageUrl($width = 250, $height = 250),
        'email' => $faker->safeEmail,
        'website' => $faker->url,
    ];
});
// Define factory for Teacher
$factory->define(Teacher::class, function (Faker $faker) use ($specialize, $detailTeacher) {
    $description = array_random($detailTeacher);
    $birthday = $faker->date();
    $gender = $faker->randomElement(array(0,1));
    return [
        'name' => $faker->name,
        'description' => $description,
        'birthday' => $birthday,
        'gender' => $gender,
        'address' => $faker->address,
        'phone' => $faker->e164PhoneNumber,
        'specialize' => array_random($specialize),
        'image' => $faker->imageUrl($width = 250, $height = 250),
        'identity_card' => $faker->creditCardNumber,
        'email' => $faker->safeEmail,
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
    ];
});

use App\Models\ReviewTeacher;
$factory->define(ReviewTeacher::class, function (Faker $faker) use ($reviewTitle, $reviewDetail) {
    $name = array_random($reviewTitle);
    $description = array_random($reviewDetail);
    $status = $faker->randomElement(array('1','0'));
    $voting_helpful = $faker->randomNumber;
    $rating = $faker->numberBetween(1,5);
    return [
        'name' => $name,
        'description' => $description,
        'status' => $status,
        'number_of_likes' => $voting_helpful,
        'rating' => $rating,
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'teacher_id' => function () {
            return factory(App\Models\Teacher::class)->create()->id;
        }
    ];
});

$factory->define(App\Models\Media::class, function (Faker $faker) {
    return [
        'url' => $faker->imageUrl(),
        'type' => rand(0, 1),
    ];
});


