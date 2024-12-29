-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: blog_schema
-- ------------------------------------------------------
-- Server version	8.0.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `categoryId` int NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`categoryId`),
  UNIQUE KEY `categoryId_UNIQUE` (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Du lịch'),(2,'Nấu ăn'),(3,'Đời sống'),(7,'điện ảnh');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `commentId` int NOT NULL AUTO_INCREMENT,
  `commentContent` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `postId` int NOT NULL,
  `commentTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subCommentId` int DEFAULT NULL,
  `userId` int NOT NULL,
  PRIMARY KEY (`commentId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'This is the first comment',1,'2024-12-17 23:40:21',NULL,2),(2,'This is the second comment',1,'2024-12-26 21:29:13',NULL,1),(3,'Reply for first comment',1,'2024-12-26 21:35:17',1,1),(4,'Reply for 2 comment',1,'2024-12-26 23:00:21',1,2);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `postId` int NOT NULL AUTO_INCREMENT,
  `postName` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `categoryId` varchar(45) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `uploadTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userId` int NOT NULL,
  `commentId` int DEFAULT NULL,
  `status` int DEFAULT '0',
  PRIMARY KEY (`postId`),
  UNIQUE KEY `postId_UNIQUE` (`postId`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Post 1','Description 1','1','blog-post-01.jpg','<p>Content for post 1</p>','2024-12-17 23:35:31',2,NULL,1),(2,'Post 2','Description 2','1','photo1.jpg','<p>Content for post 2</p>','2024-12-17 23:35:49',2,NULL,0),(3,'Post 3','Description 3','2','photo1.jpg','<p>Content for post 3</p>','2024-12-17 23:36:07',2,NULL,0),(4,'Post 4','Description 4','1','photo1.jpg','<p>Content for post 4</p>','2024-12-17 23:36:25',2,NULL,0),(5,'Post 5','Description 5','2','blog-post-02.jpg','<p>Content for post 5</p>','2024-12-17 23:36:33',2,NULL,1),(6,'Post6 edit','test','2','WIN_20220515_09_15_52_Pro (2).jpg','<p>nội dung update</p>','2024-12-27 17:41:06',2,NULL,1),(7,'Món ngon cuối tuần','dạy nấu ăn','1','','</p>Diệu hiền dạy nấu ăn</p>','2024-12-27 10:49:46',2,NULL,0),(8,'Diệu hiền chiên cơm','xịt tương ớt','2','','<p>Xịt tương ớt xong ch&ecirc;</p>','2024-12-27 11:28:54',2,NULL,1),(9,'Tiêu đề','Mô tả test','2','','<p>abc</p>','2024-12-27 16:11:19',2,NULL,0),(10,'Tiêu đề2','Mô tả 2','1','','<p>abc test</p>','2024-12-27 16:14:13',2,NULL,0),(11,'Tiêu đề2','Mô tả 2','1','WIN_20220408_14_20_01_Pro (2).jpg','<p>abc test</p>','2024-12-27 16:16:18',2,NULL,1),(12,'Tiêu đề222','Mô tả','2','','<p>abc&nbsp;</p>','2024-12-27 16:16:53',2,NULL,0),(13,'Tiêu đề222','Mô tả','2','','<p>abc&nbsp;</p>','2024-12-27 16:17:10',2,NULL,1),(14,'test','abc','1','WIN_20220515_09_15_52_Pro (2).jpg','<p>test</p>','2024-12-27 16:18:58',2,NULL,1),(15,'Tiêu đề','abc','1','WIN_20220408_14_20_01_Pro (2).jpg','<p>abc</p>','2024-12-27 16:28:10',2,NULL,1),(17,'test Img df','test','1','Irises-Vincent_van_Gogh.jpg','<p>Thay mặt&nbsp;<a title=\"Ủy ban Thường vụ Quốc hội\" href=\"https://tuoitre.vn/uy-ban-thuong-vu-quoc-hoi.html\" target=\"_blank\" rel=\"noopener\" data-id=\"0\" data-zoneid=\"0\">Ủy ban Thường vụ Quốc hội</a>,&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<div data-style=\"align-right\" data-relatednewsboxtype=\"type-1\">\r\n<ul style=\"list-style-type: none;\">\r\n<li data-title=\"Chủ tịch Quốc hội k&yacute; nghị quyết về nh&acirc;n sự, chuẩn bị tinh gọn bộ m&aacute;y\" data-url=\"/chu-tich-quoc-hoi-ky-nghi-quyet-ve-nhan-su-chuan-bi-tinh-gon-bo-may-20241225195410124.htm\" data-avatar=\"https://cdn.tuoitre.vn/471584752817336320/2024/12/25/tran-thanh-man-1734589944687259675338-14-0-764-1200-crop-17351308279371517964139.jpg\" data-id=\"20241225195410124\" data-date=\"25/12/2024 20:06\"><br><br></li>\r\n</ul>\r\n</div>\r\n<p>&nbsp;</p>','2024-12-29 00:38:35',4,NULL,0),(21,'exampleUpdate','test','1','EVGj2P1.jpg','<p>example</p>','2024-12-28 23:30:19',4,NULL,1),(22,'check admin','hehe','2','43182.jpg','<p>chehehe</p>','2024-12-29 00:35:49',4,NULL,-1),(26,'test 1','abc','1','EVGj2P1.jpg','<p>Thay mặt&nbsp;<a title=\"Ủy ban Thường vụ Quốc hội\" href=\"https://tuoitre.vn/uy-ban-thuong-vu-quoc-hoi.html\" target=\"_blank\" rel=\"noopener\" data-id=\"0\" data-zoneid=\"0\">Ủy ban Thường vụ Quốc hội</a>, Chủ tịch Quốc hội Trần Thanh Mẫn vừa k&yacute; ban h&agrave;nh nghị quyết về việc bổ sung c&oacute; mục ti&ecirc;u từ ng&acirc;n s&aacute;ch trung ương năm 2024 cho c&aacute;c địa phương</p>\r\n<p>Cụ thể, nghị quyết bổ sung cho c&aacute;c địa phương số tiền hơn 5.834 tỉ đồng thực hiện ch&iacute;nh s&aacute;ch an sinh x&atilde; hội c&aacute;c năm 2023 - 2024 v&agrave; hỗ trợ chi trả chế độ cho số bi&ecirc;n chế&nbsp;<a title=\"gi&aacute;o vi&ecirc;n\" href=\"https://tuoitre.vn/giao-vien.html\" data-rel=\"follow\">gi&aacute;o vi&ecirc;n</a>&nbsp;được bổ sung cho năm học 2022 - 2023 v&agrave; năm học 2023 - 2024 theo đ&uacute;ng nội dung, số liệu tại tờ tr&igrave;nh của Ch&iacute;nh phủ.</p>\r\n<p><img src=\"https://cdn.tuoitre.vn/thumb_w/730/471584752817336320/2024/12/25/tran-thanh-man-1734589944687259675338-14-0-764-1200-crop-17351308279371517964139.jpg\" alt=\"Bổ sung hơn 5.834 tỉ đồng để địa phương chi trả chế độ cho gi&aacute;o vi&ecirc;n, an sinh x&atilde; hội - Ảnh 2.\"></p>\r\n<div data-style=\"align-right\" data-relatednewsboxtype=\"type-1\">\r\n<h4><a href=\"https://tuoitre.vn/chu-tich-quoc-hoi-ky-nghi-quyet-ve-nhan-su-chuan-bi-tinh-gon-bo-may-20241225195410124.htm\" target=\"_blank\" rel=\"noopener\">Chủ tịch Quốc hội k&yacute; nghị quyết về nh&acirc;n sự, chuẩn bị tinh gọn bộ m&aacute;y</a><a href=\"https://tuoitre.vn/chu-tich-quoc-hoi-ky-nghi-quyet-ve-nhan-su-chuan-bi-tinh-gon-bo-may-20241225195410124.htm\" target=\"_blank\" rel=\"noopener\">ĐỌC NGAY</a></h4>\r\n</div>\r\n<p>Ủy ban Thường vụ Quốc hội cũng đồng &yacute; bổ sung c&oacute; mục ti&ecirc;u từ ng&acirc;n s&aacute;ch trung ương cho c&aacute;c địa phương số tiền 600 tỉ đồng để thực hiện đề &aacute;n tăng cường quản l&yacute; đối với đất đai c&oacute; nguồn gốc từ c&aacute;c n&ocirc;ng, l&acirc;m trường quốc doanh cho 19 địa phương theo đ&uacute;ng số liệu tại tờ tr&igrave;nh trước đ&oacute; của Ch&iacute;nh phủ.</p>\r\n<p>Nghị quyết y&ecirc;u cầu Ch&iacute;nh phủ chịu tr&aacute;ch nhiệm về căn cứ ph&aacute;p l&yacute;, t&iacute;nh ch&iacute;nh x&aacute;c của số liệu, chế độ chi v&agrave; c&aacute;c điều kiện bổ sung dự to&aacute;n, giao dự to&aacute;n theo đ&uacute;ng quy định của ph&aacute;p luật.</p>\r\n<p>Ch&iacute;nh phủ được giao triển khai kịp thời, hiệu quả, đ&uacute;ng mục đ&iacute;ch, kh&ocirc;ng để xảy ra thất tho&aacute;t, l&atilde;ng ph&iacute;, ti&ecirc;u cực; b&aacute;o c&aacute;o Quốc hội kết quả thực hiện tại kỳ họp thứ 9.</p>','2024-12-29 01:05:00',4,NULL,1),(27,'abc','abc','2','EVGj2P1.jpg','<p>abc</p>','2024-12-29 01:51:25',4,NULL,0),(29,'Diệu Hiền cắm cơm ','Thanh An ăn cứt','1','451443-A_VanGogh-Poenies.jpg','<p>hehe</p>','2024-12-29 06:31:58',4,NULL,-1);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `is_email_verified` tinyint(1) DEFAULT '0',
  `email_verification_token` varchar(255) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role` tinyint(1) DEFAULT '0',
  `photo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin@gmail.com','Nguyễn','admin','123456',0,NULL,NULL,NULL,'2024-12-26 04:58:37','2024-12-26 16:25:11',0,NULL),(2,'user@gmail.com','Minh','Lại','123456',0,NULL,NULL,NULL,'2024-12-26 04:59:09','2024-12-26 16:25:02',0,NULL),(3,'21t1020328@husc.edu.vn','Duong đẹp trai ','Tran','$2y$10$qtxKtIqyE4mJtx7BufHsUuNlexI0zho8LfDvf7ak9rN1BtK46EIpC',1,NULL,NULL,NULL,'2024-12-27 11:45:36','2024-12-29 10:03:05',0,'1735466520_EVGj2P1.jpg'),(4,'hoanghieugpt@gmail.com','hieuu','hoang','$2y$10$RYKu3uY0X0ANwa1k2kAUoOQAcB.P38NPh3PEo04RlCVpksHwS7mtG',1,NULL,NULL,'2024-12-29 07:29:51','2024-12-27 12:06:28','2024-12-29 09:58:03',1,'1735462367_EVGj2P1.jpg');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-29 17:08:08
