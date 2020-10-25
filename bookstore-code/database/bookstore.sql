-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2020 at 08:10 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,0) NOT NULL,
  `special` tinyint(1) DEFAULT 0,
  `sale_off` int(3) DEFAULT 0,
  `picture` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `ordering` int(11) DEFAULT 10,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `name`, `description`, `price`, `special`, `sale_off`, `picture`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `category_id`) VALUES
(1, 'UnrealScript Game Programming Cookbook', 'Designed for high-level game programming, UnrealScript is used in tandem with the Unreal Engine to provide a scripting language that is ideal for creating your very own unique gameplay experience. By learning how to replicate some of the advanced techniques used in today\'s modern games, you too can take your game to the next level and stand out from the crowd.\r\n\r\nBy providing a series of engaging and practical recipes, this \"UnrealScript Game Programming Cookbook\" will show you how to leverage the advanced functionality within UDK. You\'ll be shown how to implement a wide variety of practical features using the high-level scripting language ranging from designing your own HUD, creating your very own custom tailored weapons, to generating pathfinding solutions, and even meticulously crafting your own AI.', '25000', 0, 20, 'mj5oqp18.jpg', '2013-12-12 00:00:00', 'admin', '2020-09-19 14:08:46', 'duc', 'active', 3, 3),
(2, 'Functional Programming in Scala', 'Functional programming (FP) is a programming style emphasizing functions that return consistent and predictable results regardless of a program\'s state. As a result, functional code is easier to test and reuse, simpler to parallelize, and less prone to bugs. Scala is an emerging JVM language that offers strong support for FP. Its familiar syntax and transparent interoperability with existing Java libraries make Scala a great place to start learning FP.\r\n\r\nFunctional Programming in Scala is a serious tutorial for programmers looking to learn FP and apply it to the everyday business of coding. The book guides readers from basic techniques to advanced topics in a logical, concise, and clear progression. In it, you\'ll find concrete examples and exercises that open up the world of functional programming.', '35000', 0, 3, '7kyub3oi.jpg', '2013-12-12 00:00:00', 'admin', '2020-09-17 11:23:42', 'duc', 'inactive', 1, 3),
(3, 'iOS 7 Programming Fundamentals', 'If you\'re getting started with iOS development, or want a firmer grasp of the basics, this practical guide provides a clear view of its fundamental building blocks—Objective-C, Xcode, and Cocoa Touch. You\'ll learn object-oriented concepts, understand how to use Apple\'s development tools, and discover how Cocoa provides the underlying functionality iOS apps need to have. Dozens of example projects are available at GitHub.\r\n\r\nOnce you master the fundamentals, you\'ll be ready to tackle the details of iOS app development with author Matt Neuburg\'s companion guide.', '45000', 0, 0, 'm3brd79l.jpg', '2013-12-12 00:00:00', 'admin', '2020-09-24 14:28:12', 'duc', 'active', 2, 3),
(4, 'iOS 7 Programming Cookbook', 'Overcome the vexing issues you\'re likely to face when creating apps for the iPhone, iPad, or iPod touch. With new and thoroughly revised recipes in this updated cookbook, you\'ll quickly learn the steps necessary to work with the iOS 7 SDK, including solutions for bringing real-world physics and movement to your apps with UIKit Dynamics APIs.\r\n\r\nYou\'ll learn hundreds of techniques for storing and protecting data, sending and receiving notifications, enhancing and animating graphics, managing files and folders, and many other options. Each recipe includes sample code you can use right away.', '44000', 0, 0, 'qx5m9u6t.jpg', '2013-12-12 00:00:00', 'admin', '2020-09-17 10:19:00', 'duc', 'active', 3, 3),
(5, 'Advanced Programming in the UNIX Environment, 3rd Edition', 'For more than twenty years, serious C programmers have relied on one book for practical, in-depth knowledge of the programming interfaces that drive the UNIX and Linux kernels: W. Richard Stevens\' Advanced Programming in the UNIX Environment. Now, once again, Rich\'s colleague Steve Rago has thoroughly updated this classic work. The new third edition supports today\'s leading platforms, reflects new technical advances and best practices, and aligns with Version 4 of the Single UNIX Specification.\r\n\r\nSteve carefully retains the spirit and approach that have made this book so valuable. Building on Rich\'s pioneering work, he begins with files, directories, and processes, carefully laying the groundwork for more advanced techniques, such as signal handling and terminal I/O. He also thoroughly covers threads and multithreaded programming, and socket-based IPC.', '36000', 1, 2, '2yo48fgm.jpg', '2013-12-12 00:00:00', 'admin', '2020-09-17 10:19:00', 'duc', 'active', 3, 3),
(6, 'jMonkeyEngine 3.0 Beginner', 'jMonkeyEngine 3.0 is a powerful set of free Java libraries that allows you to unlock your imagination, create 3D games and stunning graphics. Using jMonkeyEngine\'s library of time-tested methods, this book will allow you to unlock its potential and make the creation of beautiful interactive 3D environments a breeze.\r\n\r\njMonkeyEngine 3.0 Beginner\'s Guide teaches aspiring game developers how to build modern 3D games with Java. This primer on 3D programming is packed with best practices, tips and tricks and loads of example code. Progressing from elementary concepts to advanced effects, budding game developers will have their first game up and running by the end of this book.', '36000', 0, 12, 'cq7k0i4j.jpg', '2013-12-12 00:00:00', 'admin', '2020-09-24 14:28:10', 'duc', 'active', 3, 3),
(7, 'Scala Cookbook', 'Save time and trouble when using Scala to build object-oriented, functional, and concurrent applications. With more than 250 ready-to-use recipes and 700 code examples, this comprehensive cookbook covers the most common problems you\'ll encounter when using the Scala language, libraries, and tools. It\'s ideal not only for experienced Scala developers, but also for programmers learning to use this JVM language.\r\n\r\nAuthor Alvin Alexander (creator of DevDaily.com) provides solutions based on his experience using Scala for highly scalable, component-based applications that support concurrency and distribution.', '46000', 0, 0, 'zpg6a0uw.jpg', '2013-12-12 00:00:00', 'admin', '2020-09-19 14:08:41', 'duc', 'active', 10, 3),
(8, 'PostgreSQL Server Programming', 'Learn how to work with PostgreSQL as if you spent the last decade working on it. PostgreSQL is capable of providing you with all of the options that you have in your favourite development language and then extending that right on to the database server. With this knowledge in hand, you will be able to respond to the current demand for advanced PostgreSQL skills in a lucrative and booming market.\r\n\r\nPostgreSQL Server Programming will show you that PostgreSQL is so much more than a database server. In fact, it could even be seen as an application development framework, with the added bonuses of transaction support, massive data storage, journaling, recovery and a host of other features that the PostgreSQL engine provides.', '54000', 0, 5, 'x3et42jv.jpg', '2013-12-12 00:00:00', 'admin', '2020-09-24 14:28:07', 'duc', 'active', 3, 3),
(9, 'Programming Drupal 7 Entities', 'Writing code for manipulating Drupal data has never been easier! Learn to dice and serve your data as you slowly peel back the layers of the Drupal entity onion. Next, expose your legacy local and remote data to take full advantage of Drupal\'s vast solution space.\r\n\r\nProgramming Drupal 7 Entities is a practical, hands-on guide that provides you with a thorough knowledge of Drupal\'s entity paradigm and a number of clear step-by-step exercises, which will help you take advantage of the real power that is available when developing using entities.', '58000', 1, 4, 'zosatu07.jpg', '2013-12-12 00:00:00', 'admin', '2020-09-24 14:28:05', 'duc', 'active', 1, 3),
(10, 'Moving from C to C++', 'The author says it best, I hope to move you, a little at a time,from understanding C to the point where C++ becomes your mindset. This remarkable book is designed to streamline the process of learning C++ in a way that discusses programming problems, why they exist, and the approach C++ has taken to solve such problems.\r\n\r\nYou can\'t just look at C++ as a collection of features; some of the features make no sense in isolation. You can only use the sum of the parts if you are thinking about design, not simply coding. To understand C++, you must understand the problems with C and with programming in general. This book discusses programming problems, why they are problems, and the approach C++ has taken to solve such problems. Thus, the set of features that I explain in each chapter will be based on the way that I see a particular type of problem being solved in C++.', '36000', 1, 3, '901wh8tx.jpg', '2013-12-12 00:00:00', 'admin', '2020-09-24 14:28:03', 'duc', 'active', 3, 3),
(11, 'C Programming for Arduino', 'Physical computing allows us to build interactive physical systems by using software & hardware in order to sense and respond to the real world. C Programming for Arduino will show you how to harness powerful capabilities like sensing, feedbacks, programming and even wiring and developing your own autonomous systems.\r\n\r\nC Programming for Arduino contains everything you need to directly start wiring and coding your own electronic project. You\'ll learn C and how to code several types of firmware for your Arduino, and then move on to design small typical systems to understand how handling buttons, leds, LCD, network modules and much more.', '38000', 0, 0, 'siochmyg.jpg', '2013-12-12 00:00:00', 'admin', '2020-09-17 10:19:00', 'duc', 'active', 2, 3),
(12, 'Advanced Network Programming - Principles and Techniques', 'The field of network programming is so large, and developing so rapidly, that it can appear almost overwhelming to those new to the discipline.\r\n\r\nAnswering the need for an accessible overview of the field, this text/reference presents a manageable introduction to both the theoretical and practical aspects of computer networks and network programming. Clearly structured and easy to follow, the book describes cutting-edge developments in network architectures, communication protocols, and programming techniques and models, supported by code examples for hands-on practice with creating network-based applications.', '43000', 1, 20, 'vradhky9.jpg', '2013-12-12 00:00:00', 'admin', '2020-09-15 22:15:42', 'duc', 'active', 3, 5),
(13, 'Programming Logics', 'This Festschrift volume, published in memory of Harald Ganzinger, contains 17 papers from colleagues all over the world and covers all the fields to which Harald Ganzinger dedicated his work during his academic career.\r\n\r\nThe volume begins with a complete account of Harald Ganzinger\'s work and then turns its focus to the research of his former colleagues, students, and friends who pay tribute to him through their writing. Their individual papers span a broad range of topics, including programming language semantics, analysis and verification, first-order and higher-order theorem proving, unification theory, non-classical logics, reasoning modulo theories, and applications of automated reasoning in biology.', '32000', 1, 0, 'sbx52yne.jpg', '2013-12-12 00:00:00', 'admin', '2020-09-24 14:28:01', 'duc', 'active', 6, 3),
(34, 'Đàn Ông Sao Hỏa Đàn Bà Sao Kim', 'Ngày xửa ngày xưa, những người sao Hỏa và sao Kim đã gặp gỡ, yêu nhau và sống hạnh phúc bởi họ tôn trọng và chấp nhận mọi điều khác biệt. Rồi họ đến Trái Đất và chứng lãng quên đã xảy ra: Họ quên rằng họ đến từ những hành tinh khác\r\n\r\n \r\n\r\nHiểu biết về giới tính giúp chúng ta thêm khoan dung và biết tha thứ khi ai đó không đáp lại theo cách mà ta mong đợi\r\n\r\nTình chỉ đẹp khi còn dang dở\r\nCưới nhau về nham nhở lắm em ơ \r\n\r\nBởi kết hôn không phải là kết thúc một cuộc tình, mà nó mới là mở đầu cho rất nhiều những giai đoạn khó khăn mà cặp vợ chồng nào cũng phải trải qua. Bạn phải biết cách thích ứng và đối phó với nó để không rơi vào tình cảnh hôn nhân đổ vỡ.\r\n\r\nĐàn Ông Sao Hỏa Đàn Bà Sao Kim\r\n\r\nBạn sẽ rất dễ \'VỠ MỘNG\' sau khi kết hôn\r\n\r\nCả hai sẽ bắt đầu phát hiện ra nhiều thứ ở người kia sau khi về sống chung một nhà. Nếu không chuẩn bị cho mình tâm thế tốt và sự thích ứng nhanh, rất có thể cả hai sẽ tạo ra sự… thất vọng và vỡ mộng trong nhau.\r\n\r\nCuộc sống hôn nhân trở nên nhàm chán\r\n\r\nKhi đã quá hiểu nhau về tính cách, chính thói quen hàng ngày, lặp đi lặp lại tạo ra sự nhàm chán. Trong mối quan hệ vợ chồng có thể gia tăng nhiều vụ cãi vã vì những lí do như khủng hoảng kinh tế, cách chăm sóc nuôi dạy con cái, công việc và đặc biệt là chuyện cảm thấy… tình yêu phai nhạt.\r\n\r\nKhông hiểu, kỳ vọng thái quá vào  bạn đời\r\n\r\nAi cũng có những mong muốn riêng về một nửa của mình nhưng đôi khi chính sự kì vọng thái quá làm họ dễ rơi vào trạng thái thất vọng, chán chường. Bạn cảm thấy không hiểu đối phương, cảm thấy họ không được như mình mong muốn, và những cuộc cãi vã bắt đầu diễn ra thường xuyên hơn.\r\n\r\nĐàn Ông Sao Hỏa Đàn Bà Sao Kim\r\n\r\nMuốn gìn giữ hạnh phúc trọn vẹn, cần lắm những sự thấu hiểu, cảm thông, chia sẻ và yêu thương nhau\r\n\r\nVì đàn ông và đàn bà đến từ hai hành tinh khác nhau, hãy tôn trọng và chấp nhận mọi điều khác biệt.\r\nBạn không thể và cũng không nên cố thay đổi người bạn đời của mình. Thay đổi là việc của họ, còn việc của bạn là thay đổi cách giao tiếp, phản ứng và đối đáp với người bạn đời của mình.\r\nChúng ta dễ dàng đổ lỗi của mình lên đầu bạn đời hơn là nhận thấy sai lầm của chính mình. Vì vậy, hãy lắng nghe để tận hưởng cuộc sống hôn nhân ngọt ngào như lúc mới yêuĐàn Ông Sao Hỏa Đàn Bà Sao Kim\r\nĐÀN ÔNG SAO HỎA - ĐÀN BÀ SAO KIM\r\n\r\nĐể cảm thấy dễ chịu hơn, người sao Hỏa náu mình trong kén để tự vấn về rắc rối của mình. Người sao Kim lại cảm thấy nhẹ nhõm hơn khi ai đó sẻ chia những vấn đề cùng họ. Đàn ông giữ kín những bí mật trong khi phụ nữ lại rất thích bày tỏ\r\n\r\nĐàn ông có động lực và tràn đầy sức mạnh khi họ cảm thấy được cần đến. Còn phụ nữ thì có động lực và sẵn sàng hành động khi họ cảm thấy được yêu thương. Làm thế nào để động viên người khác giới? Cuốn sách HAY NHẤT MỌI THỜI ĐẠI về thấu hiểu người khác giới và tạo hạnh phúc trong hôn nhân, gia đình.\r\n\r\nNgôn ngữ của đàn ông sao Hỏa và đàn bà sao Kim có từ ngữ giống nhau nhưng cách sử dụng lại mang tới những ý nghĩa khác nhau. Với phụ nữ, để diễn đạt trọn vẹn cảm xúc của mình họ thường sử dụng lối nói cường điệu, ẩn dụ và khái quát. Giải quyết những bất đồng ngôn ngữ\r\n\r\nKhi đàn ông yêu phụ nữ, nhưng theo định kỳ, anh ấy cần xa cách trước khi có thể gần gũi hơn. Còn với phụ nữ, lòng tự tôn của họ dâng lên và hạ xuống giống như một con sóng. Khi đến tận cùng, nó là sắp xếp lại cảm xúc. Đàn ông giống như dây cao su, đàn bà lại như những con sóng\r\n\r\n101 cách để thấu hiểu và ghi được những điểm số cao trong mắt người khác giới. Rất dễ dàng nếu bạn sở hữu cuốn sách \"Đàn ông sao Hỏa đàn bà sao Kim\" trong tay. Cách để dành được thiện cảm với người khác giới\r\n\r\nMột mối quan hệ cũng giống như một khu vườn, để phát triển, nó phải được tưới nước thường xuyên. Cũng tương tự như thế, để gìn giữ sự kỳ diệu của tình yêu tồn tại, chúng ta hiểu biết và nuôi dưỡng những nhu cầu đặt biệt của tình yêu.\r\n\r\n\"ĐÀN ÔNG SAO HỎA - ĐÀN BÀ SAO KIM\"  ĐÃ ĐẾN TAY HÀNG NGÀN ĐỘC GIẢ VÀ NHẬN ĐƯỢC VÔ SỐ NHỮNG PHẢN HỒI TÍCH CỰC, KHEN NGỢI CUỐN SÁCH', '188000', 1, 39, '4t3yf2ng.jpg', '2020-09-18 21:51:00', 'duc', '2020-09-19 09:24:59', 'duc', 'active', 4, 4),
(35, 'Đắc Nhân Tâm (Khổ Lớn)', 'Đắc nhân tâm của Dale Carnegie là quyển sách duy nhất về thể loại self-help liên tục đứng đầu danh mục sách bán chạy nhất (best-selling Books) do báo The New York Times bình chọn suốt 10 năm liền. Được xuất bản năm 1936, với số lượng bán ra hơn 15 triệu bản, tính đến nay, sách đã được dịch ra ở hầu hết các ngôn ngữ, trong đó có cả Việt Nam, và đã nhận được sự đón tiếp nhiệt tình của đọc giả ở hầu hết các quốc gia.\r\n\r\nLà quyển sách đầu tiên có ảnh hưởng làm thay đổi cuộc đời của hàng triệu người trên thế giới, Đắc Nhân Tâm là cuốn sách đem lại những giá trị tuyệt vời cho người đọc, bao gồm những lời khuyên cực kì bổ ích về cách ứng xử trong cuộc sống hàng ngày. Sức lan toả của quyển sách vô cùng rộng lớn – với nhiều tầng lớp, đối tượng.\r\n\r\nĐắc Nhân Tâm (Bìa Cứng) - Tái Bản\r\n\r\nĐắc Nhân Tâm không chỉ là là nghệ thuật thu phục lòng người, Đắc Nhân Tâm còn đem lại cho độc giả góc nhìn, suy nghĩ sâu sắc về việc giao tiếp ứng xử.\r\n\r\nTriết lý của Đắc Nhân Tâm là hiểu mình, thành thật với chính mình, từ đó hiểu biết và quan tâm đến những người xung quanh để nhìn ra và khơi gợi những tiềm năng ẩn khuất nơi họ, giúp họ phát triển lên một tầm cao mới. Đây chính là nghệ thuật cao nhất về con người và chính là ý nghĩa sâu sắc nhất đúc kết từ những nguyên tắc vàng của Dale Carnegie.\r\n\r\nĐây là phiên bản Đắc Nhân Tâm đặc biệt, bìa cứng dày 320 trang, do First News thực hiện và Nhà xuất bản Tổng hợp TP.HCM ấn hành.\r\n\r\nĐắc Nhân Tâm (Bìa Cứng) - Tái Bản\r\n\r\nMột số nguyên tắc – Nghệ thuật ứng xử căn bản:\r\n\r\nNguyên tắc 1: Không chỉ trích, oán trách hay than phiền.\r\n\r\nNguyên tắc 2: Thành thật khen ngợi và biết ơn người khác.\r\n\r\nNguyên tắc 3: Gợi cho người khác ý muốn thực hiện điều bạn muốn họ làm.\r\n\r\n6 cách tạo thiện cảm:\r\n\r\nNguyên tắc 4: Thật lòng quan tâm đến người khác.\r\n\r\nNguyên tắc 5: Hãy mỉm cười!\r\n\r\nNguyên tắc 6: Luôn nhớ rằng tên của người khác là một âm thâm êm đềm, thân thương và quan trọng nhất đối với họ.\r\n\r\nNguyên tắc 7: Biết lắng nghe và khuyến khích người khác nói về vấn đề của họ.\r\n\r\nNguyên tắc 8: Nói về điều người khác quan tâm.\r\n\r\nNguyên tắc 9: Thật lòng làm cho người khác cảm thấy họ quan trọng.\r\n\r\nĐắc Nhân Tâm (Bìa Cứng) - Tái Bản\r\n\r\nBáo chí nhắc gì về “Đắc Nhân Tâm”\r\n\r\n“Nói đến sách nghệ thuật ứng xử thì không thể không nhắc đến \"Đắc nhân tâm\" của Dale Carnegie. Đây là một trong những cuốn sách gối đầu của nhiều thế hệ đi trước và ngày nay. Với chặng đường hơn 80 năm kể từ khi lần đầu được xuất bản, \"Đắc nhân tâm\" đã mang đến cho chúng ta bài học vô cùng giá trị đó là nghệ thuật ứng xử để được lòng người. \"Đắc nhân tâm\" là quyển sách nổi tiếng và bán chạy nhất và có mặt ở hàng trăm quốc gia khác nhau, và hơn thế nữa đây còn là quyển sách liên tục đứng đầu danh mục sách bán chạy nhất do thời báo NewYork Times bình chọn trọng suốt 10 năm liền.” – C, 3 cuốn sách nên đọc đi đọc lại trong đời để ngẫm về cuộc sống\r\n\r\n“Đắc Nhân Tâm – của tác giả Dale Carnegie là quyển sách nổi tiếng nhất, bán chạy nhất và có tầm ảnh hưởng nhất của mọi thời đại. Tác phẩm đã được chuyển ngữ sang hầu hết các thứ tiếng trên thế giới và có mặt ở hàng trăm quốc gia. Một khám phá rất thú vị dành cho các bậc phụ huynh khi đọc cuốn sách này là biết cách lắng nghe trò chuyện cùng con, cách trị chứng tè dầm của trẻ nhỏ, hay cách làm cho một đứa trẻ từ quậy phá thành ngoan ngoãn… Đó hẳn là những câu chuyện nuôi dạy trẻ rất đúng, rất hay, rất đời thường đáng để bạn đọc suy ngẫm và chiêm nghiệm”. – M, Đắc nhân tâm: ‘Cha đã quên’ nhắc những điều nên nhớ\r\n\r\n“Đắc Nhân Tâm” đưa ra những lời khuyên về cách cư xử, ứng xử và giao tiếp với mọi người để đạt được thành công trong cuộc sống. Đây được coi là một trong những cuốn sách nổi tiếng nhất, bán chạy nhất và có tầm ảnh hưởng nhất mọi thời đại mà bạn không nên bỏ qua.” – C, 20 câu nói vàng đáng nhớ từ tuyệt tác để đời “Đắc Nhân Tâm”.\r\n\r\nĐắc Nhân Tâm (Bìa Cứng) - Tái Bản\r\n\r\nVề tác giả\r\n\r\nDale Breckenridge Carnegie (24 tháng 11 năm 1888 – 1 tháng 11 năm 1955) là một nhà văn và nhà thuyết trình Mỹ và là người phát triển các lớp tự giáo dục, nghệ thuật bán hàng, huấn luyện đoàn thể, nói trước công chúng và các kỹ năng giao tiếp giữa mọi người. Ra đời trong cảnh nghèo đói tại một trang trại ở Missouri, ông là tác giả cuốn Đắc Nhân Tâm, được xuất bản lần đầu năm 1936, một cuốn sách thuộc hàng bán chạy nhất và được biết đến nhiều nhất cho đến tận ngày nay. Ông cũng viết một cuốn tiểu sử Abraham Lincoln, với tựa đề Lincoln con người chưa biết, và nhiều cuốn sách khác.\r\n\r\nCarnegie là một trong những người đầu tiên đề xuất cái ngày nay được gọi là đảm đương trách nhiệm, dù nó chỉ được đề cập tỉ mỉ trong tác phẩm viết của ông. Một trong những ý tưởng chủ chốt trong những cuốn sách của ông là có thể thay đổi thái độ của người khác khi thay đổi sự đối xử của ta với họ.\r\n\r\nĐắc Nhân Tâm (Bìa Cứng) - Tái Bản\r\n\r\nGiá sản phẩm trên Tiki đã bao gồm thuế theo luật hiện hành. Tuy nhiên tuỳ vào từng loại sản phẩm hoặc phương thức, địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như phí vận chuyển, phụ phí hàng cồng kềnh, ...', '76000', 1, 30, 'o1xhs86k.jpg', '2020-09-18 21:57:51', 'duc', '2020-09-19 09:52:52', 'duc', 'active', 1, 4),
(36, 'Siêu Kinh Tế Học Hài Hước ( tặng kèm bookmark Tuyệt Đẹp )', 'Tiếp nối thành công của “Kinh tế học hài hước”, “Siêu kinh tế học hài hước” được hứa hẹn sẽ “bùng nổ hơn” với những góc nhìn thú vị có thể làm ngạc nhiên cả những độc giả khó tính nhất.\r\nKhông tập trung vào các vấn đề vĩ mô như thị trường chứng khoán, nền tài chính quốc tế, v.v. thường được miêu tả trong những tài liệu học thuật, thương hiệu kinh tế học lập dị của bộ đôi Steven Levitt và Stephen Dubner cung cấp những thí nghiệm và kiến thức mới mẻ về kinh tế vi mô, mà nền tảng là nghiên cứu về hành vị của con người – thứ chi phối quy luật cung cầu và nói rộng ra, là cả nền kinh tế.\r\n\r\n“Siêu kinh tế học hài hước” cũng là một trong những tác phẩm tiên phong thách thức lề lối thông thường, những suy nghĩ truyền thống mà nhân loại vẫn một mực tin tưởng suốt nhiều năm qua. Qua đó, độc giả có cơ hội xem xét lại những niềm tin của mình và nếu cần thiết, nhìn thế giới bằng nhiều lăng kính khác nhau, từ đó hiểu rõ bản chất và tìm ra những giải pháp sáng tạo cho những vấn đề nan giải trong cuộc sống.\r\n\r\nKhó mà tìm được cuốn sách nhập môn kinh tế nào vừa giúp người đọc tiếp thu kiến thức về vô số lĩnh vực, vừa cười sảng khoái hay mắt chữ “A”, mồm chữ “O” với những kết quả nghiên cứu tưởng đùa mà logic một cách kỳ diệu như thế. Xe hơi đã từng được xem là cứu cánh của môi trường ư? Cả tivi mà nhiều người cho rằng đang làm hư bọn trẻ của họ ấy, thực ra đã là người hùng cứu vớt cuộc đời những đứa trẻ khác sao?\r\n\r\nSiêu kinh tế học hài hước – góc khuất mới mẻ trong những điều quen thuộc\r\n\r\nNếu những điều trên vẫn chưa đủ khiến bạn ngạc nhiên, dưới đây là một số đề tài nổi bật khác được đề cập đến trong quyển sách.\r\n\r\n“Tại sao những kẻ đánh bom liều chết cần mua bảo hiểm nhân thọ?”\r\nTrước khi trả lời câu hỏi có phần kỳ quặc này, Levitt và Dubner đã đưa ra kha khá dữ liệu mà ít ai ngờ tới về tình trạng khủng bố và những hệ lụy của nó. Hãy khởi động phần lập dị nhất trong não bộ bạn bằng cách xem xét vài vấn đề sau đây.\r\n\r\nThứ nhất, những đối tượng thế nào thì có xu hướng trở thành khủng bố? (bạn sẽ nghĩ là những người không được giáo dục tử tế và lớn lên trong môi trường đầy tệ nạn, đúng chứ?)\r\n\r\nThứ hai, vì sao tiếp nối một vụ khủng bố, số lượng tai nạn giao thông lại gia tăng (hay dịch cúm bị ngăn ngừa và nạn tội phạm đường phố giảm đi trông thấy)? \r\n\r\nCuối cùng, một tên khủng bố bị bắt khi chưa kịp gây án đã lấy đi 14 cuộc đời như thế nào? \r\n\r\nBây giờ, hãy quay lại với câu hỏi chủ đề: Đánh bom liều chết thì liên quan gì với bảo hiểm nhân thọ? \r\n\r\nThay vì tặc lưỡi và phớt lờ khi ai đó hỏi bạn câu này, hãy dừng lại một chút và suy nghĩ thật thấu đáo xem sao. Bảo hiểm nhân thọ quả thật là một trong những yếu tố then chốt để lọc ra những đối tượng khủng bố tiềm năng nhất. Vậy rốt cuộc nó có chức năng gì?\r\n\r\nNếu đã vắt óc nghĩ ngợi cả ngày mà vẫn chưa tìm được đáp án, “Siêu kinh tế học hài hước” chắc chắn sẽ cho bạn câu trả lời thật thỏa đáng (bạn nhất định phải “ồ” lên cho mà xem).\r\n\r\n“Lòng vị tha và sự vô cảm: cái nào dễ kiểm soát hơn?”\r\nBản năng của con người là vị tha, phải không?\r\n\r\nHẳn nhiên rồi. Suy cho cùng, chẳng phải người ta thường nói “Nhân chi sơ, tính bản thiện” sao? \r\n\r\nNgay cả những thí nghiệm nổi tiếng như “Kẻ độc tài” cũng chứng minh điều tương tự đấy chứ. Khi được cho một số tiền, thay vì giữ lại toàn bộ, hầu hết người chơi đều chia sẻ một phần kha khá cho một người khác, mà người đó chẳng thân thích hay giúp đỡ gì cho họ. Còn hình ảnh nào đẹp đẽ hơn những con người sẵn sàng cho đi mà không tính toán như thế? \r\n\r\nNếu lòng vị tha của loài người quả thật dư dả và dồi dào như vậy, những chiến dịch kêu gọi hiến tạng mang đầy tính nhân văn chắc chắn phải rất thành công rồi, phải không? \r\n\r\nChúng ta nên tin tưởng rằng đức tính vị tha, chứ không phải là bất cứ thứ gì khác, có thể cứu rỗi hàng triệu sinh mệnh đang mòn mỏi chờ đợi một quả thận phù hợp, đúng vậy chứ?\r\n\r\nChà, nếu lòng vị tha là bẩm sinh, tại sao cả 38 nhân chứng trong vụ Genovese có thể bình thản từ cửa sổ nhà mình nhìn nạn nhân bị tấn công những 3 lần mà không hề lên tiếng can thiệp hay báo cảnh sát?\r\n\r\nMà tình trạng vô cảm này, thực ra có chắc là kết quả của lòng vị tha bị khiếm khuyết hay không?\r\n\r\nGiông bão, dịch sốt hậu sản và tai nạn giao thông có điểm gì giống nhau?\r\nNếu bạn vẫn chưa nghĩ ra, đây có thể là một gợi ý: cả ba đều là những vấn đề nan giải mà hơn một lần người ta đã nghĩ rằng cách giải quyết cực kỳ khan hiếm hoặc tốn kém. \r\n\r\nNhững cơn bão nhiệt đới với sức tàn phá khủng khiếp hoàn toàn là sản phẩm của Mẹ thiên nhiên và mặc dù có thể dự đoán trước, con người bất lực trong việc ngăn chặn nó. \r\n\r\nDịch sốt hậu sản từng bị xem như một căn bệnh nan y vô phương cứu chữa:  số sản phụ và trẻ sơ sinh chết tăng lên vùn vụt mà các bác sĩ thì mãi vẫn không tìm ra nguồn gốc. Kỳ quặc thay, những người mẹ sinh con trong bệnh viện sạch sẽ và đầy đủ tiện nghi với sự đỡ đẻ của những bác sĩ lành nghề nhất lại có khả năng tử vong cao hơn những người sinh tại nhà với bà đỡ hay thậm chí là sinh ngoài đường. \r\n\r\nVà tai nạn giao thông đường bộ, không còn nghi ngờ gì nữa, đã gây ra vô số thiệt hại về người và của. Người ta từng nghĩ đủ mọi cách, nhưng con số những thiệt hại được giảm bớt vẫn chưa thực sự đáng gây chú ý.\r\n\r\nNhưng may mắn thay, tạ ơn Chúa, những con người thông minh xuất chúng nhất trong lịch sử (dĩ nhiên, vài người trong số đó còn lập dị nữa) đã xuất hiện và đưa ra một loạt giải pháp cực kỳ hiệu quả cho hầu hết các vấn đề nêu trên. Bạn đang nghĩ rằng phương án giải quyết những thứ vĩ mô như vậy chắc chắn phải vô cùng phức tạp và đắt đỏ, đúng không? \r\n\r\nNếu tất cả những vấn đề này, thực chất, có thể được giải quyết chỉ bằng vài món đồ đơn giản với cái giá rẻ như cho, liệu, trong cả những giấc mơ điên rồ nhất, bạn có tin không?\r\n\r\nChương này hứa hẹn sẽ cho bạn thấy, ngay cả những thứ tầm thường nhất cũng có thể cứu cả thế giới!\r\n\r\n“Ngài Al Gore và núi lửa Pinatubo có điểm gì chung?”\r\nTrước khi bàn đến câu hỏi kỳ lạ này, hãy dành một phút nghĩ xem bạn hiểu vấn đề ấm lên toàn cầu đến mức độ nào. \r\n\r\nHẳn là bạn nắm rõ như lòng bàn tay rồi, đúng chứ? Dù sao thì, các chiến dịch tuyên truyền cũng đã nhắc đi nhắc lại kịch bản về một ngày tận thế mà trong đó, mực nước biển dâng cao nhấn chìm cả bang Florida, và cả nhân loại sẽ tuyệt chủng. \r\n\r\nQuả là rùng rợn phải không?\r\n\r\nVậy tên thủ phạm đáng kinh tởm nào đã gây ra thảm họa diệt chủng đó? Không còn nghi ngờ gì nữa, chính là khí thải CO2 – loại khí nhà kính mà người người nhà nhà đều ghét bỏ. Và hẳn rồi, đó cũng là cái tên đầu tiên được xướng lên khi bọn trẻ nói về vấn đề ô nhiễm môi trường. \r\n\r\nCO2 thực sự là thứ nguy hiểm nhất sao?\r\n\r\nThế có nghĩa là, nếu cả xã hội ngừng tất cả mọi hoạt động xả thải CO2 trong hôm nay, nền nhiệt sẽ ngay lập tức hạ xuống, Trái Đất sẽ thoát khỏi thảm họa, phải không? Có thật là sự thay đổi thần kỳ như vậy sẽ xảy ra không?\r\n\r\nHãy xem xét một trường hợp khác. Giả sử bạn đi xe đạp để bảo vệ môi trường. Nhưng nếu bạn đạp xe đi mua thịt, bạn có biết mình đã, ngạc nhiên chưa, đóng góp lại một lượng khí thải gây ô nhiễm gấp 20 lần không?\r\n\r\nMột ví dụ khác nữa. Tại sao một con kangaroo có thể cứu Trái Đất, trong khi một con bò thì không?\r\n\r\nBây giờ trở lại câu hỏi ở đầu chương. Ngài Al Gore – một chính trị gia đáng kính, là một người luôn trăn trở về các vấn đề môi trường, khát khao cứu lấy hành tinh khỏi ngày tận thế bằng một bộ phim gây chấn động, bằng những chiến dịch hùng hồn đanh thép nhằm thay đổi hành vi tiêu dùng của công dân toàn thế giới.\r\n\r\nVậy trong lúc đó, núi lửa Pinatubo đã làm gì? Nó phun một lượng khổng lồ khí thải SO2 vào bầu khí quyển! Thật là một kẻ phá hoại, đúng không?\r\n\r\nNhưng liệu bạn có biết, đỉnh Pinatubo vĩ đại, bất chấp những xú khí mà nó phun ra, cũng nỗ lực ngăn chặn sự ấm lên toàn cầu? Với hiệu quả hơn gấp nhiều lần những chiến dịch của ngài Al Gore?\r\n\r\nNếu bạn vẫn tin rằng những điều nói trên thật hoang đường, mời bạn đến với thế giới kỳ dị của “Siêu kinh tế học hài hước”.', '149000', 1, 31, '9m8nwito.jpg', '2020-09-19 09:08:06', 'duc', '2020-09-19 09:24:56', 'duc', 'active', 5, 2),
(37, 'Kinh Tế Học', 'Được dịch sang 22 thứ tiếng, nằm trong danh sách “best seller” của cả New York Times và USATODAY, Tứ Đại Quyền Lực (The Four) khiến cả thế giới rúng động vì lượng sự thật nó hàm chứa trong nội dung. Quyển sách được khuyến cáo với người đọc là họ sẽ bàng hoàng không hề nhẹ trước những điều mình đọc…\r\n\r\n\r\n\r\n“Đây là quái vật của dòng sách kinh tế. Cuốn sách thiết yếu và bao quát này hết sức sắc bén, thú vị và cay nghiệt. Những nhận xét thẳng và thật của Scott Galloway chẳng kiêng dè bất cứ một đại gia công nghệ nào. Thực sự là một cuốn sách đáng đọc”, Chuyên gia tâm lý Adam Alter, giảng viên ngành tâm lý học tại trường kinh doanh Stern thuộc Đại học New York nhận xét như thế khi đọc xong Tứ Đại Quyền Lực. Đây là cuốn sách đầu tay của Scott Galloway, một giáo sư tại khoa Kinh doanh Stern thuộc đại học New York, phụ trách giảng dạy về chiến lược thương hiệu và tiếp thị số cho các học viên MBA năm thứ hai. \r\n\r\n\r\n\r\nScott là một nhà đầu tư, đã sáng lập 9 công ty bao gồm L2, Red Envelope và Prophet. Anh cũng từng lọt vào danh sách 50 Giáo sư Kinh doanh Xuất sắc nhất thế giới của trang thông tin Poets & Quants vào năm 2012. Loạt clip hàng tuần Winners and Losers của ông trên YouTube đã thu hút được hàng chục triệu lượt xem. Vậy, tác phẩm của một giáo sư “siêu” kinh doanh này hấp dẫn người đọc ở điểm nào?\r\n\r\nĐầu tiên, đây là tác phẩm “đụng chạm” trực diện chuyện kinh doanh của Amazon, Apple, Facebook và Google, bốn doanh nghiệp có sức ảnh hưởng áp đảo nhất hành tinh này hiện nay. Bằng sự tôn trọng tuyệt đối, giáo sư Scott Galloway ghi nhận thành công và hành trình thành công của những tên tuổi đình đám nhất trong giới công nghệ này. Những con số, những phép so sánh mà tác giả mang đến cho người đọc khả năng hình dung các “ông lớn” này đang lớn đến mức nào. Đi sâu vào chiến lược kinh doanh của bốn cái tên hàng đầu, Scott Galloway cùng đồng thời lý giải từng quyết định, từng thương vụ lớn mà những doanh nghiệp này đã thực hiện. Ông quan niệm, hiểu được sự lựa chọn của bộ tứ quyền lực là hiểu được mô hình kinh doanh và cách họ tạo ra giá trị trong kỷ nguyên số. “Tôi viết cuốn sách này với hy vọng độc giả sẽ có được cái nhìn thấu đáo và nhận ra được thế mạnh của doanh nghiệp trong một nền kinh tế mà chưa bao giờ dễ trở thành tỷ phú như bây giờ, nhưng cũng chưa bao giờ trở thành triệu phú khó đến vậy”, tác giả chia sẻ.\r\n\r\n\r\n\r\nTuy nhiên, điều khiến tác phẩm của Scott Galloway cực kỳ hấp dẫn là vì ông đã không kiêng dè khi chứng minh, hiểu biết của cả thế giới về bốn cái tên quyền lực kia gần như đều… sai bét. Vượt thoát khỏi làn khói thần bí vây quanh bộ tứ quyền lực ấy che mắt, ông thẳng tay lột phăng chiếc mặt nạ dát vàng của bộ tứ quyền lực để mổ xẻ chiến lược và năng lực thao túng siêu phàm của họ, từ đó giúp độc giả học hỏi và áp dụng những kỹ thuật đó vào sự nghiệp của chính mình. \r\n\r\nTrong nửa đầu quyển sách, tác giả đưa người đọc vào quá trình xem xét từng chàng kỵ binh và phân tích những chiến lược của họ. Các doanh nghiệp khác có thể học gì từ những chiến lược này. Trong phần thứ hai là cách thức nhận diện những thế mạnh cạnh tranh của bộ tứ này, xem cách kinh doanh mới của họ đang diễn tiến như thế nào. Bên cạnh đó, tac giả cũng cho người đọc thấy được cách thức bộ tứ bảo vệ thị trường của mình ra sao.\r\n\r\n\r\n\r\nBằng một phong thái hết sức từ tốn, Scott Galloway đưa người đọc từ bất ngờ này sang bất ngờ khác. Đâu là tội lỗi của bốn chàng kỵ binh này? Họ đã lợi dụng các chính phủ và đối thủ cạnh tranh như thế nào trong việc bảo vệ sở hữu trí tuệ? \r\n\r\nKhông chỉ dừng lại ở bốn cái tên khổng lồ, tác giả mở rộng bức tranh, mang đến độc giả cái nhìn toàn cảnh bằng cách điểm mặt các ứng cử viên công nghệ sáng giá khác, từ Netflix đến Alibaba, một Amazon thu nhỏ của Trung Hoa, rồi Uber và những người khổng lồ một thời từng làm mưa làm gió như IBM, Microsoft… để cùng tìm câu trả lời cho câu hỏi liệu họ có thể quay lại đường đua hay không? Ai trong số họ có khả năng phát triển một nền tảng chi phối hơn so với bộ tứ hiện tại? Ai sẽ có khả năng trở thành chàng kỵ binh thứ năm? Và, bộ tứ sẽ đưa con người đi đến đâu. \r\n\r\n\r\n\r\nVạch trần bản chất kinh doanh của bốn doanh nghiệp đang ảnh hưởng rất lớn đến đời sống con người nhưng Tứ Đại Quyền lực của Scott Galloway không gây hoang mang cho người đọc. Cuộc trò chuyện ông với độc giả đầy giá trị khi ông cùng người đọc nhìn vào bản thân mình, xem những tính chất nghề nghiệp nào giúp chúng ta tồn tại và có thể hưởng lợi trong kỷ nguyên của bộ tứ quyền lực này. Như lời vị doanh nhân nổi tiếng Calvin McDonald, CEO của Sephora, Scott Galloway thành thật và táo bạo đến tàn nhẫn nhưng cuốn sách này sẽ buộc bạn thay đổi cách nghĩ của mình.\r\n\r\nSách do nhà báo Lương Trọng Vũ, Kênh truyền hình FBNC chuyển ngữ, First News thực hiện, NXB Tổng Hợp TP.HCM ấn hành.\r\n\r\nGiá sản phẩm trên Tiki đã bao gồm thuế theo luật hiện hành. Tuy nhiên tuỳ vào từng loại sản phẩm hoặc phương thức, địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như phí vận chuyển, phụ phí hàng cồng kềnh, ...', '186000', 1, 9, 'ej69dyrh.jpg', '2020-09-19 09:11:12', 'duc', '2020-09-27 09:58:01', 'duc', 'active', 4, 2),
(38, 'Made In Japan (Tái Bản 2018) - (Đột Phá Chất Lượng, Kiến Tạo Tương Lai ', 'Sách Kinh Tế: Made In Japan (Tái Bản 2018) - (Đột Phá Chất Lượng, Kiến Tạo Tương Lai / Tặng Kèm Postcard Happylife)\r\n\r\nMade in Japan - Akio Morita là cuốn sách do chính Akio Morita viết về ông và những người sáng lập Sony, cùng những đồng nghiệp khác trong quá trình phát triển tập đoàn Sony. Made in Japan chính là giấc mơ của những chàng thanh niên Nhật Bản trẻ tuổi. Đây là cuốn sách mở ra cánh cửa giúp chúng ta thấu hiểu triết lý quản trị theo phong cách Nhật Bản và vai trò của đạo đức kinh doanh.\r\n\r\n60 năm về trước, một nhóm người tụ tập quanh tòa nhà bách hóa tổng hợp bị cháy đen tại một khu buôn bán kinh doanh đã bị chiến tranh tàn phá ở Tokyo. Mục đích của họ là dựng nên một công ty mới, nhưng mục tiêu lớn hơn là phát triển các công nghệ góp phần khôi phục nền kinh tế Nhật Bản. Một trong số họ là Akio Morita, kỹ sư trẻ nhất, khi đó mới 25 tuổi.\r\n\r\nSau này, Sony này đã trở thành một trong những tập đoàn đa quốc gia quyền lực nhất trên thế giới và Akio Morita đã trở thành Chủ tịch của Tập đoàn. Từ những chiếc máy ghi âm sơ khai đầu tiên tới cuộc cách mạng về máy nghe nhạc đĩa compact ngày nay. Sony là câu chuyện thành công thần kỳ khởi nguồn từ chính sách đảm bảo chất lượng sản phẩm tuyệt đối của Morita. Ông cũng nhận thấy rằng phải tìm kiếm thị trường mới thông qua các sản phẩm chưa từng có. Khi giới thiệu về máy nghe nhạc Walkman, Morita từng nói: \"Theo tôi, việc nghiên cứu thị trường dù chi tiết đến đâu cũng chưa thể khẳng định được sự thành công của một sản phẩm.\"\r\n\r\n[REVIEW]\r\n\r\n\"Với những câu chuyên về lịch sử từ những ngày đầu thành lập Sony, đến khi đứng vững giữa cạnh tranh và trở thành người tiên phong, mình thấy được nhiều trăn trở về truyền thống và sự hội nhập của một nhà lãnh đạo công ty rất thành công, đồng thời về khía cạnh cá nhân, ông là một người rất lạc quan, kiên định, có trực giác tốt về kinh doanh và triết lý về cách đối xử giữa người và người. Sau khi đọc xong cuốn sách này, mình cũng mong muốn Việt Nam mình cũng sẽ phát triển được những công ty tầm cỡ quốc tế như vậy để khẳng định con người và nét văn hóa sáng tạo, cần cù của người Việt mình.\"\r\n\r\n--Độc Giả Nguyen Huyen--\r\n\r\n\"Người Nhật Bản luôn là một dấu chấm hỏi trong mắt hàng tỉ con người trên thế giới. Tinh thần Samurai như luôn chảy trong huyết quản từng thế hệ thanh niên Nhật Bản và chưa bao giờ có dấu hiệu mai một. Và một trong số đó chính là Sony.\r\n\r\n \r\n\r\nKhi đọc cuốn sách này. Không để lại trong tôi một dấu ấn cá nhân nào của Akio Morita hay Ibuka trong sự hình thành và phát triển của Sony Mà thay vào đó, hình ảnh một Nhật Bản kiên cường đi lên từ trong tro bụi chiến tranh, khát khao tri thức và nỗ lực xây dựng đất nước, chinh phục thế giới đã làm tôi choáng ngợp.\r\n\r\nĐúng như cái tên. Made in Japan. Cuốn sách này thực sự bổ ích đối với những thế hệ doanh nhân và các bạn trẻ mang trong mình mong muốn phụng sự tổ quốc, là cơ hội để nhìn lại thực tế, định hình bản thân và hướng đến tương lai.\r\n\r\nCảm ơn Morita !\"\r\n\r\n--Độc Giả Phương Thảo--', '199000', 1, 12, 'h75cmqvs.jpg', '2020-09-19 09:12:59', 'duc', '2020-09-19 09:24:51', 'duc', 'active', 3, 2),
(39, 'Sự Quyến Rũ Của Thương Hiệu', 'Sản phẩm là cái mà doanh nghiệp tạo ra trong sản xuất, còn cái mà khách hàng chọn mua lại là thương hiệu. Sản phẩm có thể bị các đối thủ cạnh tranh bắt chước còn thương hiệu là tài sản riêng của doanh nghiệp. Sản phẩm nhanh chóng bị lạc hậu. Còn thương hiệu (nếu thành công) thì có thể còn mãi với thời gian.”\r\n\r\nTại sao chúng ta phải tập trung xây dựng thương hiệu khi bắt đầu kinh doanh?\r\n\r\nXây dựng thương hiệu là vấn đề được đặt lên hàng đầu khi bắt đầu kinh doanh, bởi đó không chỉ đơn thuần là một cái tên mà còn chứa đựng ý nghĩa, thông điệp mà doanh nghiệp hướng đến khách hàng. Doanh nghiệp sở hữu thương hiệu mạnh sẽ đạt được mục tiêu kinh doanh một cách nhanh hơn và hiệu quả hơn rất nhiều.\r\n\r\nSự Quyến Rũ Của Thương Hiệu\r\n\r\nThương hiệu tạo dựng hình ảnh doanh nghiệp và sản phẩm trong tâm trí khách hàng. Khách hàng sẽ lựa chọn hàng hóa bằng sự cảm nhận của mình. Khi một thương hiệu lần đầu tiên xuất hiện trên thị trường, nó hoàn toàn chưa có một hình ảnh nào trong tâm trí người tiêu dùng.\r\n\r\nNhững thuộc tính của hàng hóa như kết cấu, hình dáng kích thước, màu sắc hoặc các dịch vụ sau bán hàng sẽ là tiền đề để người tiêu dùng lựa chọn chúng.\r\n\r\nSự Quyến Rũ Của Thương Hiệu\r\n\r\nhương hiệu như lời cam kết giữa doanh nghiệp và Khách hàng\r\n\r\nSự cảm nhận của người tiêu dùng đối với sản phẩm của doanh nghiệp thông qua rất nhiều yếu tố như thuộc tính hóa, cảm nhận thông qua dịch vụ đi kèm uy tín và hình ảnh của doanh nghiệp trong tâm trí Khách hàng.\r\n\r\nSứ mệnh doanh nghiệp, tầm nhìn chiến lược, tầm nhìn thương hiệu, các yếu tố cấu thành nên thương hiệu như logo, khẩu hiệu là những cam kết của doanh nghiệp muốn mang đến cho khách hàng những sản phẩm và dịch vụ tốt nhất.\r\n\r\nThương hiệu mang lại những lợi ích cho doanh nghiệp\r\n\r\nThương hiệu mang lại những nổi bật nhất định cho doanh nghiệp, đó là khách hàng tin tưởng vào chất lượng sản phẩm và yên tâm sử dụng sản phẩm thu hút được khách hàng bởi lẽ nhãn hiệu hàng hóa cũng như tên giao dịch của doanh nghiệp, người ta biết đến trước bởi nó gắn với sản phẩm dịch vụ, muốn có được uy tín vững chắc doanh nghiệp phải đảm bảo chất lượng giữa đồng đều chất lượng đó, điều đó làm cho khách hàng yên tâm hơn và tin tưởng khi sử dụng hàng hóa từ đó dễ thu hút thêm khách hàng.\r\n\r\nSự Quyến Rũ Của Thương Hiệu\r\n\r\nThương hiệu là công cụ bảo vệ lợi ích của doanh nghiệp. Thương hiệu hiểu gồm một số đối tượng sở hữu công nghiệp. Sau khi nhãn hiệu hàng hóa tên thương mại được nhà nước bảo hộ bằng các quy định của pháp luật. chủ sở hữu hợp pháp của đối tượng này được khai thác mọi lợi ích.', '151000', 1, 28, 'c1s3hike.jpg', '2020-09-19 09:16:14', 'duc', '2020-09-19 15:33:47', 'duc', 'active', 2, 39),
(40, 'Sự Giàu Và Nghèo Của Các Dân Tộc', 'Sự Giàu Và Nghèo Của Các Dân Tộc\r\n\r\nTrên thế giới có khoảng 200 quốc gia và vùng lãnh thổ. Tuy nhiên, chỉ có khoảng chưa đến 20% là các quốc gia phát triển. Theo báo cáo của Oxfam (2018), 26 người giàu nhất thế giới sở hữu khối tài sản bằng với tài sản của 3,8 tỷ người thuộc nhóm nghèo nhất. Người giàu ngày càng giàu lên, trong khi người nghèo lại càng nghèo thêm. Vậy tại sao khoảng cách giàu nghèo lại lớn như vậy? Đây chính là câu hỏi mà David S.Landes tìm cách giải đáp trong cuốn sách Sự Giàu Và Nghèo Của Các\r\nDân Tộc (The Wealth and the poverty of Nations).\r\n\r\nLà một công trình đồ sộ, quyển sách chứa đựng những thông tin phong phú với lập luận sắc bén. Landes cho rằng chìa khóa của sự thịnh vượng của các quốc gia trong thời hiện đại chính là Cuộc cách mạng công nghiệp. Nếu muốn trở nên thịnh vượng, các quốc gia phải tiến hành công nghiệp hóa. Đi sâu hơn, ông lý giải nền tảng cho quá trình thực hiện Cách mạng công nghiệp ở các quốc gia. Thách thức những quan điểm cũ, ông cho rằng tài nguyên thiên nhiên (gồm cả cảnh quan,\r\nnguồn nước, đất đai, khoáng chất, khí hậu) quan trọng nhưng không đủ, vị trí địa lý cũng không phải là định mệnh. Điều quan trọng nhất để làm nên cuộc Cách mạng công nghiệp ở từng quốc gia luôn phụ thuộc vào nền văn hóa là nền tảng cho xã hội và những giá trị được bảo tồn trong xã hội đó. Sự thịnh vượng mà thiếu đi những đặc điểm văn hóa phù hợp, chưa bao giờ ổn định và bền vững.\r\n\r\nNước Anh, cũng như các quốc gia thực hiện thành công Cách mạng công nghiệp và trở nên thịnh vượng, họ có một xã hội gắn kết, có năng lực cạnh tranh, sự tôn trọng, mong muốn truyền đạt kiến thức thực nghiệm và kỹ thuật, những con người trong xã hội vươn lên nhờ công trạng và năng lực. Họ không những biết làm ra của cải mà còn biết cách sử dụng của cải. Sự trung thực được tôn trọng, các thiết chế được viết ra để đảm bảo an toàn cho tài sản và việc hưởng thụ thành quả lao động. Họ được giáo dục để từ bỏ nhu cầu trước mắt để hướng đến những giá trị lâu dài và bền\r\nvững. Những điều này khó có thể tìm thấy ở các xã hội còn lại, những xã hội còn đang chật vật trong quá trình công nghiệp hóa.\r\n\r\n+ Nhận xét chuyên gia:\r\n\r\n“David Landes đã viết nên một công trình khảo sát bậc thầy về những thành công lớn và thất bại lớn trong các nền kinh tế ghi vào lịch sử của thế giới. [] Bất kỳ ai nghĩ rằng thành công kinh tế của một xã hội tách biệt với những đòi hỏi về đạo đức và văn hóa của xã hội ấy hẳn nhiên sẽ phải suy nghĩ lại.” – Robert Solow\r\n\r\n“Công trình nghiên cứu lịch sử mới của David Landes về sự nổi lên của phân chia giàu và nghèo hiện nay giữa các quốc gia trên thế giới là một bức tranh có tầm bao quát cực kỳ rộng lớn và sáng suốt khác thường. Ý thức về tính ngẫu nhiên của lịch sử không làm giảm sự nổi trội của những chủ đề lặp đi lặp lại trong các cuộc đụng độ đưa châu Âu vươn lên vị trí dẫn dầu nền kinh tế. Vốn hiểu biết dồi dào khó tin [của tác giả] được trình bày bằng một văn phong sáng sửa và mạnh mẽ, cuốn hút khó cưỡng với người đọc.” – Kenneth Arrow, Nhà kinh tế Mỹ, người nhận giải Nobel Kinh tế 1972.\r\n\r\n+ Trích đoạn:\r\n\r\n“Cách phân chia cũ thế giới thành hai khối quyền lực, phương Đông và phương Tây, đã yếu thế. Giờ đây, thách thức và nguy cơ lớn là sự chênh lệch về của cải và sức khỏe, ngăn cách người giàu và người nghèo. Sự cách biệt ấy thường được gọi là phương Bắc và phương Nam, vì nó mang tính dịa lý; nhưng tên gọi chính xác hơn sẽ là phương Tây và phần Còn lại, bởi sự phân chia này cũng có tính lịch sử. Đây là vấn đề riêng lẻ lớn nhất và là mối nguy hiểm mà thế giới phải đối mặt trong thiên niên kỷ thứ 3. Chỉ có một lo lắng khác quan trọng gần như thế là suy thoái môi trường, cả hai có liên quan mật thiết với nhau và thực ra là một. Chúng là một vì của cải không chỉ dẫn đến việc tiêu thụ mà còn cả rác thải, không chỉ dẫn đến việc sản xuất mà còn cả sự tàn phá. Chỉnh rác thải và sự tàn phá này, đã gia tăng rất nhiều cùng với sản lượng và thu nhập, hiện đe doạn không gian chúng ta sống và di chuyển.” – Davis S. Landes', '399000', 1, 30, 'aurqw69v.jpg', '2020-09-19 09:17:22', 'duc', '2020-09-24 22:48:26', 'duc', 'active', 1, 6),
(41, 'Từ Tốt Đến Vĩ Đại', 'Jim Collins - Tác giả của cuốn sách viết về giới kinh doanh Từ Tốt Đến Vĩ Đại vừa là người học và cũng vừa là người dạy tại các công ty vĩ đại và trường tồn. Trăn trở với câu hỏi lớn “Làm thế nào những công ty tốt, công ty bình thường, hay ngay cả công ty đang trong tình trạng tồi tệ cũng có thể đạt đến mức vĩ đại trường tồn?\" Nên ông và các đồng sự đã mất một khoảng thời gian khá dài để nghiên cứu và khám phá ra cách thức để các công ty này tăng trưởng, đạt thành tích cao, chuyển mình và nhảy vọt từ “tốt” đến “vĩ đại”. Một vấn đề mà ai cũng quan tâm, muốn tìm hiểu nhưng không phải ai cũng có được sự kiên nhẫn tìm đến tận cùng câu trả lời.\r\n\r\nCuối cùng quyển sách ra đời với 9 chương bố cục rõ ràng, rành mạch và kèm theo đó là các phụ lục được ghi chú cẩn thận, chi tiết. Cách trình bày sách logic rõ ràng cùng với những đồ thị, số liệu và biểu đồ được ghi chép rất tỉ mỉ, cẩn thận. Một sự nghiên cứu nghiêm túc và đã trải qua kiểm chứng cụ thể từ sự phát triển nhảy vọt từ mức “tốt” lên “vĩ đại” của 11 công ty. Do đó những thông tin đưa ra cực kì hữu ích và sao sát thực tế hơn bao giờ hết. Cách lồng ghép so sánh trong quyển sách cũng rất thú vị nhưng lại hiệu quả vô cùng như câu chuyện giữa nhím và cáo trong chương 5 cùng những thông điệp hữu ích “Hãy tự biết mình” và biết cách đưa những tình huống khó xử thành ý tưởng đơn giản nhất. Những điểm quan trọng nhất mà sách nhấn mạnh đó là: ý tưởng, chiến lược, kỷ luật, công nghệ và cuối cùng là cách xây dựng nền tảng để nhảy vọt. Mỗi kết luận này đều mang những ý nghĩa to lớn và hữu ích thậm chí có thể khiến độc giả ngạc nhiên nhưng khó có ai phủ nhận được giá trị cùng những triết lí mà quyển sách mang lại.\r\n\r\nQuả thật đây là một cuốn sách không thể thiếu cho những ai đang bước vào giới kinh doanh và đang điều hành những công ty lớn, nhỏ.\r\n\r\n©\r\n\r\nJim Collins cùng nhóm nghiên cứu đã miệt mài nghiên cứu những công ty có bước nhảy vọt và bền vững để rút ra những kết luận sát sườn, những yếu tố cần kíp để đưa công ty từ tốt đến vĩ đại. Đó là những yếu tố khả năng lãnh đạo, con người, văn hóa, kỷ luật, công nghệ… Những yếu tố này được nhóm nghiên cứu xem xét tỉ mỉ và kiểm chứng cụ thể qua 11 công ty nhảy vọt lên vĩ đại.\r\n\r\nMỗi kết luận của nhóm nghiên cứu đều hữu ích, vượt thời gian, ý nghĩa vô cùng to lớn đối với mọi lãnh đạo và quản lý ở mọi loại hình công ty (từ công ty có nền tảng và xuất phát tốt đến những công ty mới khởi nghiệp), và mọi lĩnh vực ngành nghề.', '115000', 1, 33, 'ms94t65l.jpg', '2020-09-19 09:18:42', 'duc', '2020-09-25 08:22:03', 'duc', 'active', 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` varchar(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `books` text NOT NULL,
  `prices` text NOT NULL,
  `quantities` text NOT NULL,
  `names` text NOT NULL,
  `pictures` text NOT NULL,
  `status` varchar(25) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `username`, `books`, `prices`, `quantities`, `names`, `pictures`, `status`, `date`, `modified`, `modified_by`) VALUES
('12sQRtU', 'duc', '[\"35\"]', '[\"53200\"]', '[\"1\"]', '[\"Đắc Nhân Tâm (Khổ Lớn)\"]', '[\"o1xhs86k.jpg\"]', 'active', '2020-09-25 09:29:33', '2020-09-25 11:13:26', 'duc'),
('2RGmAS8', 'duc', '[\"9\",\"40\"]', '[\"55680\",\"279300\"]', '[\"1\",\"1\"]', '[\"Programming Drupal 7 Entities\",\"Sự Giàu Và Nghèo Của Các Dân Tộc\"]', '[\"zosatu07.jpg\",\"aurqw69v.jpg\"]', 'active', '2020-09-25 10:27:23', '2020-09-25 11:13:26', 'duc'),
('9Y5NFZP', 'linh', '[\"39\",\"10\"]', '[\"108720\",\"34920\"]', '[\"2\",\"1\"]', '[\"Sự Quyến Rũ Của Thương Hiệu\",\"Moving from C to C++\"]', '[\"c1s3hike.jpg\",\"901wh8tx.jpg\"]', 'active', '2020-09-25 09:20:15', '2020-09-25 11:13:26', 'duc'),
('adwftmR', 'duc', '[\"5\"]', '[\"35280\"]', '[\"1\"]', '[\"Advanced Programming in the UNIX Environment, 3rd Edition\"]', '[\"2yo48fgm.jpg\"]', 'active', '2020-09-21 12:59:23', '2020-09-25 11:13:26', 'duc'),
('fWP94RM', 'duc', '[\"35\",\"40\"]', '[\"53200\",\"279300\"]', '[\"1\",\"1\"]', '[\"Đắc Nhân Tâm (Khổ Lớn)\",\"Sự Giàu Và Nghèo Của Các Dân Tộc\"]', '[\"o1xhs86k.jpg\",\"aurqw69v.jpg\"]', 'active', '2020-09-21 08:58:23', '2020-09-25 11:13:26', 'duc'),
('FXsAO6Q', 'duc', '[\"36\"]', '[\"102810\"]', '[\"1\"]', '[\"Siêu Kinh Tế Học Hài Hước ( tặng kèm bookmark Tuyệt Đẹp )\"]', '[\"9m8nwito.jpg\"]', 'active', '2020-09-25 10:02:33', '2020-09-25 11:13:26', 'duc'),
('JEbfqzR', 'linh', '[\"40\"]', '[\"279300\"]', '[\"1\"]', '[\"Sự Giàu Và Nghèo Của Các Dân Tộc\"]', '[\"aurqw69v.jpg\"]', 'active', '2020-09-25 09:19:38', '2020-09-26 09:20:28', 'duc'),
('MzOmi53', 'duc', '[\"35\",\"40\",\"39\"]', '[\"53200\",\"279300\",\"108720\"]', '[\"1\",\"1\",\"1\"]', '[\"Đắc Nhân Tâm (Khổ Lớn)\",\"Sự Giàu Và Nghèo Của Các Dân Tộc\",\"Sự Quyến Rũ Của Thương Hiệu\"]', '[\"o1xhs86k.jpg\",\"aurqw69v.jpg\",\"c1s3hike.jpg\"]', 'active', '2020-09-21 13:38:12', '2020-09-26 09:20:27', 'duc');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` text DEFAULT NULL,
  `special` tinyint(1) NOT NULL DEFAULT 0,
  `created` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `ordering` int(11) DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `picture`, `special`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`) VALUES
(1, 'Văn Học - Tiểu Thuyết', 'hft8q1c3.jpg', 1, '2013-12-09 00:00:00', 'admin', '2020-09-24 14:23:40', 'duc', 'inactive', 1),
(2, 'Kinh Tế', 'f1xjgb6z.png', 1, '2013-12-09 00:00:00', 'admin', '2020-09-19 10:31:20', 'duc', 'active', 2),
(3, 'Tin học', 'fl2xv3rk.jpg', 1, '2013-12-09 00:00:00', 'admin', '2020-09-19 10:34:26', 'duc', 'active', 3),
(4, 'Sách tư duy - Kỹ năng sống', 'cw4fengs.jpg', 1, '2020-09-18 21:49:00', 'duc', '2020-09-18 21:49:16', 'duc', 'active', 4),
(5, 'Thiếu Nhi', 'ed13vhpr.png', 0, '2013-12-09 00:00:00', 'admin', '2020-09-19 10:40:56', 'duc', 'active', 13),
(6, ' Thường Thức - Đời Sống', 'tv8basyz.jpg', 0, '2013-12-09 00:00:00', 'admin', '2020-09-15 22:15:06', 'duc', 'active', 3),
(7, 'Ngoại Ngữ - Từ Điển', 'qoflkj8p.jpg', 0, '2013-12-09 00:00:00', 'admin', '2020-09-24 20:53:08', 'duc', 'active', 14),
(8, 'Truyện Tranh', '40grv86k.jpg', 0, '2013-12-09 00:00:00', 'admin', '2020-09-24 20:53:08', 'duc', 'active', 9),
(39, 'Văn Hóa - Nghệ Thuật', 'btkjrfal.jpg', 1, '2020-09-13 19:51:03', 'duc', '2020-09-24 22:32:45', 'duc', 'active', 4),
(42, 'duc', '9cameh3y.png', 1, '2020-09-13 21:37:49', 'duc', '2020-09-24 22:32:45', 'duc', 'active', 15),
(43, 'aaaaaaXXXX', '5mvbzuk0.jpeg', 1, '2020-09-13 21:38:18', 'duc', '2020-09-25 21:58:15', 'duc', 'active', 7),
(44, 'NOT IMAGE', '', 1, '2020-09-13 22:03:23', 'duc', '2020-09-24 22:32:45', 'duc', 'active', 10),
(56, ' Kỹ Năng Sống', 'bntdur5l.jpg', 1, '2013-12-09 00:00:00', 'admin', '2020-09-26 20:48:36', 'duc', 'inactive', 8),
(58, '', '', 0, '2020-09-26 21:40:07', 'duc', NULL, NULL, NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `group_acp` tinyint(1) DEFAULT 0,
  `created` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `ordering` int(11) DEFAULT 10,
  `privilege_id` text NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `group_acp`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `privilege_id`, `picture`) VALUES
(1, 'Founder', 1, '2013-11-07 04:25:45', 'admin', '2020-09-08 14:29:34', 'duc', 'active', 4, '1,2,3,4,5,6,7,8,9,10', ''),
(2, 'Admin 01', 1, '2013-11-05 05:07:18', 'admin', '2020-09-08 14:29:32', 'duc', 'active', 4, '1,3,4,5,6,7,8,9,10', ''),
(3, 'Admin 02', 1, '2013-11-07 00:00:00', 'admin', '2020-09-09 01:08:55', 'duc', 'inactive', 5, '1,2,3,4,5,6,7,8,9,10', ''),
(4, 'Architect', 0, '2020-09-08 14:27:21', 'duc', '2020-09-09 19:43:47', 'thao', 'active', 10, '1,2,3,4,6,7,8,9,10', ''),
(5, 'Manager', 0, '2020-09-02 05:28:11', 'duc', '2020-09-08 22:33:59', 'duc', 'active', 7, '1,2,3,4,6,7,8,9,10', ''),
(6, 'Founder 02', 1, '2013-11-07 04:25:45', 'admin', '2020-09-25 11:11:25', 'duc', 'active', 4, '1,2,3,4,6,7,8,9,10', ''),
(7, 'CEO', 1, '2020-09-09 01:09:11', 'duc', '2020-09-25 11:11:24', 'duc', 'active', 10, '1,2,3,4,6,7,8,9,10', ''),
(8, 'User', 1, '2020-09-09 21:00:06', 'thao', '2020-09-25 13:17:59', 'duc', 'active', 7, '', ''),
(9, 'User 02', 1, '2020-09-01 06:12:21', 'duc', '2020-09-25 13:17:59', 'duc', 'active', 12, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE `privilege` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `module` varchar(45) NOT NULL,
  `controller` varchar(45) NOT NULL,
  `action` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`id`, `name`, `module`, `controller`, `action`) VALUES
(1, 'Hiển thị danh sách người dùng', 'backend', 'user', 'index'),
(2, 'Thay đổi status của người dùng', 'backend', 'user', 'multi_active'),
(3, 'Cập nhật thông tin của người dùng', 'backend', 'user', 'form'),
(4, 'Thay đổi status của người dùng sử dụng Ajax', 'backend', 'user', 'ajaxStatus'),
(5, 'Xóa một hoặc nhiều người dùng', 'backend', 'user', 'trash'),
(6, 'Thay đổi vị trí hiển thị của các người dùng', 'backend', 'user', 'ordering'),
(7, 'Truy cập menu Admin Control Panel', 'backend', 'dashboard', 'index'),
(8, 'Đăng nhập Admin Control Panel', 'backend', 'index', 'login'),
(9, 'Đăng xuất Admin Control Panel', 'backend', 'index', 'logout'),
(10, 'Cập nhật thông tin tài khoản quản trị', 'backend', 'index', 'profile');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(45) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `register_ip` varchar(25) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `ordering` int(11) DEFAULT 10,
  `group_id` int(11) NOT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `fullname`, `password`, `created`, `created_by`, `modified`, `modified_by`, `register_date`, `register_ip`, `status`, `ordering`, `group_id`, `phone`, `address`) VALUES
(1, 'nvan', 'nvan@gmail.com', 'Nguyễn Văn An', 'e10adc3949ba59abbe56e057f20f883e', NULL, '1', '2020-09-12 11:05:58', 'thao', NULL, NULL, 'active', 4, 1, NULL, NULL),
(2, 'nvb', 'nvb@gmail.com', 'Nguyễn Văn B', 'e10adc3949ba59abbe56e057f20f883e', NULL, '1', '2020-09-12 11:04:39', 'thao', NULL, NULL, 'active', 3, 2, NULL, NULL),
(3, 'nvc', 'nvc@gmail.com', 'Nguyễn Văn C', 'e10adc3949ba59abbe56e057f20f883e', NULL, '1', '2020-09-12 13:50:29', 'thao', NULL, NULL, 'inactive', 2, 3, NULL, NULL),
(4, 'admin', 'admin@gmail.com', 'Admin', 'e10adc3949ba59abbe56e057f20f883e', NULL, '1', '2020-09-12 11:04:39', 'thao', NULL, NULL, 'active', 1, 2, NULL, NULL),
(5, 'nguyenvana1', 'lthlan54@gmail.com', 'Admin 3', '3b269d99b6c31f1467421bbcfdec7908', NULL, NULL, '2020-09-12 11:04:39', 'thao', NULL, '127.0.0.1', 'active', 10, 5, NULL, NULL),
(6, 'tuan', 'lthlan55@gmail.com', 'Giản Thái Mỹ Linh', '3b269d99b6c31f1467421bbcfdec7908', '2020-06-08 07:40:18', '3', '2020-09-12 11:04:27', 'thao', NULL, '127.0.0.1', 'active', 10, 4, NULL, NULL),
(7, 'tai', 'lthlan56@gmail.com', '', '3b269d99b6c31f1467421bbcfdec7908', '2016-12-02 13:24:34', '2', '2020-09-12 13:50:29', 'thao', NULL, '127.0.0.1', 'inactive', 10, 3, NULL, NULL),
(8, 'hung', 'lthlan541@gmail.com', 'Giản Thái Phương Linh', '3b269d99b6c31f1467421bbcfdec7908', '2020-03-05 00:00:00', '2', '2020-09-12 11:04:27', 'thao', NULL, '127.0.0.1', 'inactive', 12, 1, NULL, NULL),
(9, 'nga', 'vanduc@gmail.com', '555', '3b269d99b6c31f1467421bbcfdec7908', NULL, NULL, '2020-09-12 11:04:19', 'thao', '0000-00-00 00:00:00', '::1', 'active', 10, 2, NULL, NULL),
(10, 'linh', 'sda@gmail.com', 'Gian Thai My Linh', '3b269d99b6c31f1467421bbcfdec7908', NULL, NULL, '2020-09-24 20:41:55', 'duc', '2020-09-06 23:47:13', '::1', 'active', 10, 3, NULL, NULL),
(13, 'thao', 'lthlan5412@gmail.com', 'bbbbbb', '3b269d99b6c31f1467421bbcfdec7908', '2020-07-01 00:00:00', '4', '2020-09-24 20:41:25', 'duc', NULL, NULL, 'active', 1, 2, NULL, NULL),
(14, 'vanduc', 'vanduc22@gmail.com', '', '3b269d99b6c31f1467421bbcfdec7908', '2020-09-12 13:49:12', 'thao', '2020-09-26 20:37:24', 'duc', NULL, NULL, 'active', 10, 2, NULL, NULL),
(15, 'duc', 'vanduc33@gmail.com', 'grgt', '3b269d99b6c31f1467421bbcfdec7908', NULL, NULL, '2020-09-26 10:08:55', 'duc', '2020-09-09 19:27:43', '::1', 'active', 10, 2, '0334564569', 'H9 Tổ 9, KP2, F.Long Bình Tân, Tp.Biên Hòa, Đồng Nai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
