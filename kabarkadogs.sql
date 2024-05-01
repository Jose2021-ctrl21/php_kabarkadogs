-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2024 at 07:22 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kabarkadogs`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_our_pets`
--

CREATE TABLE `about_our_pets` (
  `id` int(11) NOT NULL,
  `img` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `about_our_pets`
--

INSERT INTO `about_our_pets` (`id`, `img`, `title`, `description`) VALUES
(1, 'dog5.jpg', ' About our pets', 'Before we put our rescued dogs or cats up for adoption, we make sure they are free of any diseases since they were once abused, abandoned, or stray animals on the road. They will be treated as members of the family and given a new chance at life and genuine love.'),
(2, 'dogs.png\r\n', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_user_role_id` int(11) NOT NULL,
  `admin_email` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_username`, `admin_password`, `admin_user_role_id`, `admin_email`) VALUES
(1, 'Admin', 'admin12345', 1, 'admin@kabarkadogs.com');

-- --------------------------------------------------------

--
-- Table structure for table `adoptions`
--

CREATE TABLE `adoptions` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `outdoors_kept` text DEFAULT NULL,
  `petscompanion` varchar(255) DEFAULT NULL,
  `petcompanion_other` text DEFAULT NULL,
  `medicines_and_vaccinations` varchar(255) DEFAULT NULL,
  `personal_references` text DEFAULT NULL,
  `additional_information` text DEFAULT NULL,
  `agree_terms_and_conditions` varchar(3) DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `created_date` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `animal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `adoption_fee`
--

CREATE TABLE `adoption_fee` (
  `id` int(11) NOT NULL,
  `img` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_description` text NOT NULL,
  `subtitle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adoption_fee`
--

INSERT INTO `adoption_fee` (`id`, `img`, `title`, `title_description`, `subtitle`) VALUES
(1, 'cat3.jpg', 'Adoption Feed', 'The adoption fee is P500 for cats and P1,000 for dogs. This should be paid when you pick up your new pet', 'Why is there an adoption fee? ');

-- --------------------------------------------------------

--
-- Table structure for table `adoption_stories_settings`
--

CREATE TABLE `adoption_stories_settings` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `rescue_date` varchar(50) NOT NULL,
  `rescue_location` varchar(50) NOT NULL,
  `adoption_date` varchar(50) NOT NULL,
  `adoption_location` varchar(50) NOT NULL,
  `story_link` varchar(1024) NOT NULL,
  `animal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `mammal` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `archive` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `rescued_location` varchar(255) NOT NULL,
  `rescued_date` varchar(255) NOT NULL,
  `story_link` varchar(1024) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `date_of_appointment` date NOT NULL,
  `time` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dcf`
--

CREATE TABLE `dcf` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `donate` text NOT NULL,
  `costs` text NOT NULL,
  `funding` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dcf`
--

INSERT INTO `dcf` (`id`, `img`, `donate`, `costs`, `funding`) VALUES
(1, 'dogs.png', 'ertuysertyhserthst', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `deceased`
--

CREATE TABLE `deceased` (
  `id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL,
  `date_of_death` date NOT NULL,
  `cause_of_death` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `donor_name` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date_of_donation` date NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `donation_setting`
--

CREATE TABLE `donation_setting` (
  `id` int(11) NOT NULL,
  `account_img` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `instructions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donation_setting`
--

INSERT INTO `donation_setting` (`id`, `account_img`, `account_name`, `instructions`) VALUES
(5, 'e40f674a0b27b9026d2e6be9bc76a789.jpg', 'GCASH', '1. Log in to your GCash account, then tap on QR on your navigation bar. 2. Align your phone’s camera to our QR code to scan it. 3. Input the total amount and tap Next. 4. Review all details then tap on Pay.'),
(9, '15738969f374e6ad49b86ec89c27f7f4.png', 'BPI', 'BPI Scan Donation Instructions:\r\n1.)Launch the BPI Mobile App on your device or download it from the App Store (iOS) or Google Play Store (Android).\r\n\r\n2.)Log In: Enter your username and password or sign up if you\'re new to online banking.\r\n\r\n3.)Find the \"Scan\" option in the app\'s menu.\r\n\r\n4.)Use your camera to scan the QR code.\r\n\r\n5.)Input your desired donation amount.\r\n\r\n6.)Check recipient and donation details.\r\n\r\n7.)Tap to confirm, use PIN or biometrics if prompted.\r\n\r\n8.)Receive a confirmation message.\r\n\r\n9.)Capture or save the confirmation for your records.');

-- --------------------------------------------------------

--
-- Table structure for table `donation_setting_instructions`
--

CREATE TABLE `donation_setting_instructions` (
  `account_id` int(11) NOT NULL,
  `instructions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` varchar(255) NOT NULL,
  `archive` varchar(10) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `img`, `title`, `description`, `date`, `archive`) VALUES
(1, 'event1.jpg', 'CAPON FREE FOR ALL', 'sample description v', '2024-03-30', 'no'),
(2, 'event2.jpg', 'CAPON', 'Paws and Whiskers Gala: A Feast is Fit for Royalty!  Join us for a culinary celebration designed exclusively for our furry friends at the upcoming Paws and Whiskers Gala! This year, we\'re excited to introduce a delectable experience with our exclusive ', '2024-03-30', 'no'),
(3, 'cat1.jpg', 'gdf', 'dfgdfg', '2024-03-20', 'no'),
(6, 'event3.jpg', 'vdv', 'dvdv', '2024-02-07', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `img`, `title`, `title_description`) VALUES
(1, 'cat4.jpg', 'Adoption Feed', ' The adoption fee is P500 for cats and P1,000 for dogs. This should be paid when you pick up your new pet                                                        '),
(2, '', 'Republic Act 1063.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `home_carousel`
--

CREATE TABLE `home_carousel` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `home_carousel`
--

INSERT INTO `home_carousel` (`id`, `img`, `heading`, `caption`) VALUES
(4, 'carousel-img.jpg', 'Adoption can change their life.', ' The KabarkaDogs is a Non-Profit Organization that was formed in 2019 to give abandoned, neglected and stray pets a chance to have a good life.'),
(5, 'carousel-img2.jpg', 'Adoption can change their life.', ' The KabarkaDogs is a Non-Profit Organization that was formed in 2019 to give abandoned, neglected and stray pets a chance to have a good life.'),
(6, '283e3db41cb7105493405f2b4fd6378f.png', 'Is the joney is layp is hard', 'bat donut stap yur drem cam tro'),
(7, 'top-10-the-most-beautiful-japanese-actresses.jpg', 'vhfglihjfg,.hikfgvlhi,f', 'lydfkluydfkldf'),
(8, 'Cyclic-RedunDancy-Check-1.png', 'hHhHhahhahahahah yyyy', 'ahahahahahahahyyyy');

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE `lists` (
  `id` int(11) NOT NULL,
  `description` varchar(1020) NOT NULL,
  `policy_id` varchar(11) NOT NULL,
  `adoption_fee_id` varchar(11) NOT NULL,
  `about_our_pets_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`id`, `description`, `policy_id`, `adoption_fee_id`, `about_our_pets_id`) VALUES
(7, ' 1. Ang puppy/dog ay panitilihing nasa loob ng bakuran at hindi hahayaang makalabas.', '1', '0', ''),
(9, ' 2. Kumpletuhin ang 5-in-1 vaccine at antirabies, iaupdate yearly.', '1', '0', ''),
(15, '3. Ipagamot sa vet kapag nagsakit', '1', '0', ''),
(18, ' 6. Hindi pwede isurrender sa pound.', '1', '0', ''),
(19, '  7. Ipapakapon sa tamang edad.', '1', '0', ''),
(20, '8. Magpapadala ng updated picture and video monthly', '1', '0', ''),
(21, ' 9. Pwede namin bisitahin anytime', '1', '0', ''),
(22, ' 10. Mamahalin at aalagaan mabuti na para bang sariling anak ang iaadopt na puppy/dog', '1', '0', ''),
(24, '11. lydfliyflyidfl8yfkgcfkhfku', '1', '0', ''),
(30, ' 1. Freedom from hunger or thirst', '8', '0', ''),
(32, '3. Freedom from pain, injury and disease', '8', '0', ''),
(33, ' 4. Freedom to express normal behavior', '8', '0', ''),
(34, '5. Freedom from fear and distress', '8', '0', ''),
(48, 'When you adopt a pet from us, you can be sure that they are:', '', '1', ''),
(49, '1) up               to date on vaccinations', '', '1', ''),
(50, '2) treated for ticks and fleas, and', '', '1', ''),
(51, '3)               already spayed or neutered. All of this would cost between P5,000               to P10,000 at private vet clinics. Therefore, the adoption fee is               a very small amount to pay for ensuring that you are taking home a               healthy pet.', '', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_read` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `policy`
--

CREATE TABLE `policy` (
  `id` int(11) NOT NULL,
  `img` varchar(100) NOT NULL,
  `republic_act` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `subtitle` text NOT NULL,
  `lists_id` varchar(11) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `policy`
--

INSERT INTO `policy` (`id`, `img`, `republic_act`, `title`, `subtitle`, `lists_id`, `date`) VALUES
(1, 'terms-and-condition_1.jpg', 'The KabarkaDogs hahahaha', ' Terms and Condition hahahaha', '  Promotes and safeguards the welfare and well being of animals. These Rules and Regulations shall be strictly construed in favor of the welfare and rights of animals by ensuring the protection and security of their five basic freedoms:', '', '2024-04-26'),
(6, 'Republic Act 1063.jpg', ' Republic Act 1063', 'ABUSE, CRUELTY & NEGLECT', 'Include every act, omission, or neglect whereby unnecessary or unjustifiable physical pain or suffering is caused or permitted. This includes physical cruelty by assault, by overwork, by deprivation of adequate food, water, and shelter and proper caring during transport, illness, pregnancy and parturition; and participation in sporting event s at level beyond animal\'s capacity to perform', '', '2024-04-27'),
(7, 'dog6.jpg', 'Republic Act 1063', ' ABANDONMENT OF ANIMALS', ' The relinquishment of all rights, title, claim or possesion of the animal with the intention of not reclaiming or resuming its ownership or possession, or if the animals are left in circumstances likely to cause the animal any unnecessary suffering, or if this abandonment results in the death of the animal.', '', '2024-04-27'),
(8, 'Republic Act 1063.jpg', 'Republic Act 8485', ' The Animal Welfare Act of 1998', ' Promotes and safeguards the welfare and well being of animals. These Rules and Regulations shall be strictly construed in favor of the welfare and rights of animals by ensuring the protection and security of their five basic freedoms:', '', '2024-04-27');

-- --------------------------------------------------------

--
-- Table structure for table `profile_setting`
--

CREATE TABLE `profile_setting` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `date_established` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile_setting`
--

INSERT INTO `profile_setting` (`id`, `img`, `name`, `position`, `date_established`) VALUES
(20, '33ba9259c5b470d9fee23e54a5eeb301.jpg', 'XAI', 'PRESIDENT', '2024-04-24'),
(25, 'dog5.jpg', 'Naruto', 'Hokage', '2024-04-04'),
(30, 'dog4.jpg', 'Shikamaru', 'Hokage advisor', '2024-04-19'),
(31, 'dog6.jpg', 'susuke', 'Shadow hokage', '2024-04-04');

-- --------------------------------------------------------

--
-- Table structure for table `qa_lists`
--

CREATE TABLE `qa_lists` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `qa_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qa_lists`
--

INSERT INTO `qa_lists` (`id`, `question`, `answer`, `qa_id`) VALUES
(1, 'hahahahhahahahaha', 'hahahahhahahahaha', '1'),
(8, 'bbbbbbbbbbbbbbbbbbbbbbb', 'dfsdfsd', '1'),
(9, 'zdh', 'dzhdztjhzetj', '1');

-- --------------------------------------------------------

--
-- Table structure for table `recommendation`
--

CREATE TABLE `recommendation` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `small_title` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `map_link` text NOT NULL,
  `map_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recommendation`
--

INSERT INTO `recommendation` (`id`, `img`, `small_title`, `title`, `description`, `map_link`, `map_name`) VALUES
(2, 'event2.jpg', 'Also Promotes', 'Cavite City Veterinary Office', 'Eradication, prevention or cure all forms of animal diseases particularly those that can affect the health of the human population. To promote healthy beneficial living with the animals by promoting responsible animal ownership.', 'https://www.google.com/maps/place/Rotary+Club+-+Cavite/@14.4810457,120.9059619,17z/data=!3m1!4b1!4m6!3m5!1s0x3397cd39f35424df:0xd7fb39ec99d0ce3!8m2!3d14.4810457!4d120.9085368!16s%2Fg%2F11bzv_0pcj?entry=ttu', ' Visit: Rotary Club of Cavite, Rotary Center, Cavite City, Philippines 4100'),
(3, 'event1.jpg', 'Also Promotes', 'Jamir Vet Clinic', ' Located in Kawit Cavite, Jamir Veterinary Clinic aims to provide professional, affordable, and quality.', 'https://www.google.com/maps/place/Jamir+Veterinary+Clinic/@14.4524673,120.9229257,17z/data=!3m1!4b1!4m6!3m5!1s0x3397d302a8edbf1b:0x2f17e891934ebb0e!8m2!3d14.4524673!4d120.9255006!16s%2Fg%2F11g0gpsjv5?entry=ttu', 'Visit: Jamir Veterinary Clinic Sea Oil, Kawit, 4104 Cavite'),
(4, 'cat5.jpg', 'Partner Organization', ' Cavite Animal Welfare Advocates Group INC.', ' We encourage people to help the voiceless animals the best way we all can. We educate on how to care & treat animals the same way on how we do to our own pets & rescues. We are not paid to rescue nor funded by anybody. We use our own resources and would appreciate any form of help given or shared to us for our rescues.', 'https://www.google.com/maps/place/Dra.+Salamanca,+Cavite+City,+Cavite/@14.4834101,120.9020304,17z/data=!3m1!4b1!4m6!3m5!1s0x3397cd317a0adcc3:0x52a94628067b790!8m2!3d14.4834101!4d120.9020304!16s%2Fg%2F1jky3726j?entry=ttu', 'Visit: Dra. Salamanca St., San Antonio, Cavite City, Philippines 4100');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `created_at`) VALUES
(1, 'Pending', ''),
(2, 'Approved', ''),
(4, 'Failed', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sec_1` varchar(255) NOT NULL,
  `ans_1` varchar(50) NOT NULL,
  `sec_2` varchar(255) NOT NULL,
  `ans_2` varchar(50) NOT NULL,
  `sec_3` varchar(255) NOT NULL,
  `ans_3` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`) VALUES
(2, 'user'),
(1, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_our_pets`
--
ALTER TABLE `about_our_pets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adoptions`
--
ALTER TABLE `adoptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adoption_fee`
--
ALTER TABLE `adoption_fee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adoption_stories_settings`
--
ALTER TABLE `adoption_stories_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dcf`
--
ALTER TABLE `dcf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deceased`
--
ALTER TABLE `deceased`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donation_setting`
--
ALTER TABLE `donation_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_carousel`
--
ALTER TABLE `home_carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `policy`
--
ALTER TABLE `policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_setting`
--
ALTER TABLE `profile_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qa_lists`
--
ALTER TABLE `qa_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recommendation`
--
ALTER TABLE `recommendation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_our_pets`
--
ALTER TABLE `about_our_pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `adoptions`
--
ALTER TABLE `adoptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `adoption_fee`
--
ALTER TABLE `adoption_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `adoption_stories_settings`
--
ALTER TABLE `adoption_stories_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `dcf`
--
ALTER TABLE `dcf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `deceased`
--
ALTER TABLE `deceased`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donation_setting`
--
ALTER TABLE `donation_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `home_carousel`
--
ALTER TABLE `home_carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policy`
--
ALTER TABLE `policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `profile_setting`
--
ALTER TABLE `profile_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `qa_lists`
--
ALTER TABLE `qa_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `recommendation`
--
ALTER TABLE `recommendation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
