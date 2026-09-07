-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2026 at 03:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digi24`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `hour1` varchar(100) NOT NULL,
  `hour2` varchar(100) DEFAULT NULL,
  `hour3` varchar(100) DEFAULT NULL,
  `mobile` varchar(8) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address_1` text NOT NULL,
  `address_2` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `body`, `image`, `hour1`, `hour2`, `hour3`, `mobile`, `phone`, `address_1`, `address_2`) VALUES
(1, 'همراه شما برای انتخابی مطمئن\r\n\r\ndigi24 با هدف ارائه و فروش انواع دوربین‌های دیجیتال و تجهیزات تصویربرداری فعالیت خود را آغاز کرده است. ما تلاش می‌کنیم با ارائه محصولات باکیفیت، اطلاعات دقیق و خدمات مناسب، تجربه‌ای ساده و مطمئن از خرید تجهیزات تصویربرداری برای شما فراهم کنیم.\r\n\r\nدر digi24 می‌توانید مجموعه‌ای از دوربین‌ها، لنزها و تجهیزات جانبی تصویربرداری را مشاهده و با توجه به نیاز و بودجه خود انتخاب کنید. هدف ما این است که قبل از خرید، اطلاعاتی شفاف و کاربردی در اختیار شما قرار گیرد تا بتوانید با اطمینان بیشتری تصمیم بگیرید.', '3421082609423329082e3b70092f74b4e9fcfa95d1ec7fd00226b6_1786911148.webp', 'شنبه الی چهارشنبه 9:00 الی 21:00 ', 'پنجشنبه 9:00 الی 18:00', 'جمعه تعطیل', '55660981', '09334875', 'تهران، خیابان شیخ هادی، خیابان جمهوری', 'تهران، ناصر خسرو، پاساژ ناصر خسرو، پلاک ۳۸۵\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `title`, `img`) VALUES
(14, 'کانن', '647230826034434canon-logo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `body`, `img`) VALUES
(32, 'دوربین عکاسی', 'عنوان: پنجرهای به سوی خلاقیت؛ دوربینهایی که رویاهایتان را ثبت میکنند\r\n\r\nدر دنیای پرهیاهوی امروز، یک عکس خوب میتواند یک ثانیه را برای ابدیت متوقف کند. اگر به دنبال فراتر از یک تصویر ساده هستید، اگر میخواهید نور، احساس و جزئیات را به گونهای ثبت کنید که دوباره و دوباره تماشایش کنید، فروشگاه تخصصی ما همراه شماست.\r\n\r\nچرا دوربین خود را از ما تهیه کنید؟\r\n\r\nضمانت اصالت و کیفیت: تمامی دوربینهای ما به صورت مستقیم از نمایندگیهای معتبر تهیه شده و دارای گارانتی اصلی هستند.\r\n\r\nتنوع بینظیر: از دوربینهای کامپکت فوقخوشدست برای سفر و دوربینهای بدون آینه (Mirrorless) سبک و سریع، تا دوربینهای حرفهای DSLR و میانفرمت (Medium Format) برای عکاسی استودیویی و طبیعت.\r\n\r\nمشاوره تخصصی پیش از خرید: تیم ما متشکل از عکاسان حرفهای است تا بر اساس سبک کاری و بودجهتان، بهترین انتخاب را به شما پیشنهاد دهند.\r\n\r\nارسال سریع و بستهبندی ایمن: دوربینتان را در سریعترین زمان ممکن و با بستهبندی ضدضربه تحویل بگیرید.\r\n\r\nبرای خرید یا مشاوره، همین حالا با کارشناسان ما تماس بگیرید یا به فروشگاه ما سر بزنید. فرصت ثبت لحظات ناب را از دست ندهید!', '506230826034245title.webp');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `weblog_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `comment`, `weblog_id`, `status`, `date`) VALUES
(97, 'اميرحسين ', 'تست وبلاگ', 11, 1, '2026-09-01 09:09:22');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `title`, `body`) VALUES
(1, 'ارسال سریع', 'سفارش شما در سریع‌ترین زمان ممکن بسته‌بندی و ارسال خواهد شد\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `guaranty`
--

CREATE TABLE `guaranty` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `guaranty`
--

INSERT INTO `guaranty` (`id`, `title`) VALUES
(5, 'الماس داران');

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`id`, `image`) VALUES
(1, '355180826070810525180826070334test.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `order_count` int(11) NOT NULL DEFAULT 0,
  `order_status` varchar(50) NOT NULL DEFAULT 'درحال ارسال',
  `total_amount` bigint(20) NOT NULL,
  `shipping_cost` bigint(20) NOT NULL,
  `shipping_method` varchar(100) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_status` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_number`, `order_count`, `order_status`, `total_amount`, `shipping_cost`, `shipping_method`, `payment_method`, `payment_status`, `notes`, `created_at`) VALUES
(27, 27, 'ORD-20260901111637292528', 1, 'تحویل شده', 500000000, 40000000, 'پست', 'online', 'paid', '', '2026-09-01 09:16:37'),
(28, 27, 'ORD-20260901114227219349', 1, 'درحال ارسال', 270000000, 40000000, 'پست', 'cash', 'paid', 'لطفا بسته بندی محکم باشه', '2026-09-01 09:42:27');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `Insurance` tinyint(1) NOT NULL DEFAULT 0,
  `guaranty` varchar(255) NOT NULL,
  `price_per_item` decimal(15,0) NOT NULL,
  `total_price` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `post_id`, `quantity`, `Insurance`, `guaranty`, `price_per_item`, `total_price`) VALUES
(35, 27, 40, 2, 0, 'الماس داران', 230000000, 460000000),
(36, 28, 40, 1, 0, 'الماس داران', 230000000, 230000000);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `author` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sub_img_1` varchar(255) NOT NULL,
  `sub_img_2` varchar(255) NOT NULL,
  `sub_img_3` varchar(255) NOT NULL,
  `sub_img_4` varchar(255) NOT NULL,
  `sub_img_5` varchar(255) NOT NULL,
  `price` decimal(15,0) NOT NULL,
  `review` text NOT NULL,
  `review_img` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `limitation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `category_id`, `brand_id`, `body`, `author`, `image`, `sub_img_1`, `sub_img_2`, `sub_img_3`, `sub_img_4`, `sub_img_5`, `price`, `review`, `review_img`, `quantity`, `limitation`) VALUES
(40, 'دوربین دیجیتال بدون آینه کانن مدل EOS RP به همراه لنز 24 - 105 میلی‌متر f/4 - f/7.1', 32, 14, 'با کیت لنز EOS RP RF24-105mm F4-7.1 IS STM می توانید از پرتره های خیره کننده گرفته تا مناظر خیره کننده تصاویر با کیفیت بگیرید. سبک‌ ترین و کوچک ‌ترین دوربین فول فریم EOS تا به امروزx، EOS RP دارای ویژگی‌ های چشمگیری است، از جمله سنسور 26.2 مگا پیکسلی CMOS، ویدیوی 4K و پردازشگر تصویر DIGIC 8. به علاوه، با اندازه ی جمع و جور RF24-105mm F4-7.1 IS STM، محدوده ی زوم انعطاف پذیر و لرزش گیر اپتیکال تصویر با حداکثر 5 استاپ تصحیح لرزش، این کیت لنز برای تصویر برداری از سوژه های مختلف مناسب است.با وجود تمام ویژگی ‌های جذاب، یکی از نگرانی‌ های استفاده از دوربین فول فریم، پروفایل بزرگ‌ تر آن است، با این حال، EOS RP سبک ‌ترین و کوچک ‌ترین دوربین فول فریم Canon EOS تا به امروز است. وزن تقریبی آن 440 گرم (فقط بدنه) است و در عین حال استفاده از آن بسیار راحت است، EOS RP برای حمل، تصویربرداری و ذخیره راحت تر از هر دوربین فول فریم EOS که قبلا وجود داشته است، می باشد.EOS RP که برای کار یکپارچه با لنزهای RF مهندسی شده است، همچنین با استفاده از یکی از سه آداپتور نصب اختیاری سازگاری کامل با لنزهای EF و EF-S را حفظ می کند. هنگام استفاده از لنزهای EF-S، EOS RP حتی به طور خودکار برش می‌ دهد تا سنسور اندازه APS-C را که لنزها برای آن طراحی شده ‌اند را منعکس کندهمه لنزهای RF دارای فاصله کانونی Flange 20 میلی متری هستند که فاصله کانونی لنز تا سطح سنسور تصویر است. این فاصله کانونی Flange، مزایای فوکوس کوتاه پشتی را با الزامات مهندسی لازم برای پایداری نصب، متعادل می کند. بر این اساس، فاصله کانونی Flange مونت RF عملکرد نوری عالی را تضمین می ‌کند و در عین حال استحکام و دوام لازم برای عملکرد در دنیای واقعی را حفظ می ‌کند.دوربین EOS RP دارای یک بهینه‌ ساز لنز دیجیتال درون دوربین است که با لنزهای RF (و لنزهای EF/EF-S با آداپتور Mount) کار می‌ کند تا کیفیت تصویر را بهبود بخشد. بهینه ساز لنز دیجیتال کاهش کیفیت تصویر ناشی از فیلترهای low-pass با لنزهای با دیافراگم باز را محدود می کند. هم در هنگام تصویر برداری و هم در هنگام توسعه داده های RAW قابل استفاده است و بر سرعت تصویر برداری مداوم تأثیری ندارد. داده های لنزهای EF و EF-S سازگار در دوربین تعبیه شده است.', 'امیرحسین مراد', '9472308260348181.webp', '5712308260348182.webp', '402308260348183.webp', '5402308260348184.webp', '7392308260348185.webp', '445230826034818title.webp', 230000000, 'سنسور ۴۵.۷ مگاپیکسلی استکشده از نوع CMOS، فاقد فیلتر پایینگذر (Low-Pass Filter) است که منجر به ثبت بالاترین میزان وضوح ممکن میگردد. پویایی دامنه دینامیکی (Dynamic Range) در ISO پایه ۶۴، حدود ۱۴.۷ استاپ اندازهگیری شده است که در مقایسه با رقبای همرده، عملکردی استاندارد و قابل قبول ارائه میدهد.رندرینگ رنگها در این دوربین متعادل و با حفظ جزئیات در قسمتهای هایلایت و سایه همراه است. فایلهای خام (RAW) این دوربین فضای مناسبی برای پسپردازش در اختیار کاربر قرار میدهند.', '3682308260348187.webp', 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `post_features`
--

CREATE TABLE `post_features` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `post_features`
--

INSERT INTO `post_features` (`id`, `post_id`, `title`, `body`) VALUES
(6, 40, 'لنز', '2.10');

-- --------------------------------------------------------

--
-- Table structure for table `q&a`
--

CREATE TABLE `q&a` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `question` text NOT NULL,
  `answer` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `q&a`
--

INSERT INTO `q&a` (`id`, `post_id`, `name`, `question`, `answer`, `status`) VALUES
(17, 40, 'اميرحسين', 'چطوري لنز رو عوض كنم', 'توضیحات رو مطالعه کنید.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_methods`
--

CREATE TABLE `shipping_methods` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` decimal(15,0) NOT NULL,
  `delivery_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `shipping_methods`
--

INSERT INTO `shipping_methods` (`id`, `title`, `price`, `delivery_time`) VALUES
(8, 'پست', 40000000, 'دو روز کاری');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `active` tinyint(1) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `body`, `active`, `image`) VALUES
(24, 'اسلایدر اول', 'بهترین دوربین ها و تهجیزات با دیجی 24', 1, '870010926110528ChatGPT Image ۱۰ شهریور ۱۴۰۵، ۱۲_۳۴_۳۹.png'),
(25, 'اسلایدر دوم', 'تنوع محصولات و تهجیزات در دیجی 24', 0, '461010926110805ChatGPT Image ۱۰ شهریور ۱۴۰۵، ۱۲_۳۷_۲۵.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `gender` enum('male','female') CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `pass` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `phone` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `mobile` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `province` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `postal_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `role` enum('main-admin','super-admin','user','post-admin','web-admin','support') CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL DEFAULT 'user',
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `birth_date`, `username`, `pass`, `phone`, `mobile`, `email`, `province`, `city`, `address`, `postal_code`, `role`, `created`, `updated`) VALUES
(16, 'امیرحسین', 'مراد', '', NULL, '', '$2y$10$/w8D9CbBCXRxJ5lM6KzqOeMNdXzs1rl.wBaktuX1HoryAkWmfZ4mG', '09334875211', NULL, 'amir@gmail.com', NULL, NULL, NULL, NULL, 'main-admin', '2026-08-19 12:28:19', '2026-08-21 08:54:31'),
(26, 'تست', 'تست', NULL, NULL, NULL, '$2y$10$Zgafr7ORLdVEw35Yjn0Sd.GHmQK00OAg0.gR9DhyI276VWEIOk616', '09334875233', NULL, 's@gmail.com', NULL, NULL, NULL, NULL, 'support', '2026-08-23 10:09:27', '2026-08-23 10:09:27'),
(27, 'امیر', 'مراد', 'male', '2001-12-12', 'amirttt', '$2y$10$CfDMHZiC.HeiSwaK14nPH..IDJ5Xz6u/yC4frVHh/t.ccGg1Tte/m', '09334875239', '55660981', 'amirmorad@gmail.com', 'تهران', 'تهران', 'محله تست', '1338834685', 'user', '2026-09-01 09:14:03', '2026-09-01 09:14:03');

-- --------------------------------------------------------

--
-- Table structure for table `weblog`
--

CREATE TABLE `weblog` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `img_header` varchar(255) NOT NULL,
  `img_body` varchar(255) NOT NULL,
  `img_footer` varchar(255) NOT NULL,
  `content_header` text NOT NULL,
  `content_body` text NOT NULL,
  `content_footer` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `author` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `weblog`
--

INSERT INTO `weblog` (`id`, `title`, `type`, `img_header`, `img_body`, `img_footer`, `content_header`, `content_body`, `content_footer`, `created`, `author`) VALUES
(11, 'چگونه عکس فلو را فلو کنیم ؟', 'آموزشی', '8172308260543306.webp', '272308260543302.webp', '8612308260543303.webp', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.', '2026-08-23 15:43:30', 'امیرحسین مراد');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_ibfk_1` (`weblog_id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guaranty`
--
ALTER TABLE `guaranty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_number` (`order_number`),
  ADD KEY `orders_ibfk_1` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_ibfk_1` (`category_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `post_features`
--
ALTER TABLE `post_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `q&a`
--
ALTER TABLE `q&a`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weblog`
--
ALTER TABLE `weblog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guaranty`
--
ALTER TABLE `guaranty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `post_features`
--
ALTER TABLE `post_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `q&a`
--
ALTER TABLE `q&a`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `weblog`
--
ALTER TABLE `weblog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`weblog_id`) REFERENCES `weblog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_features`
--
ALTER TABLE `post_features`
  ADD CONSTRAINT `post_features_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `q&a`
--
ALTER TABLE `q&a`
  ADD CONSTRAINT `q&a_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
